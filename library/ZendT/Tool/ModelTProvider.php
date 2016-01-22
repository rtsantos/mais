<?php
/**
 * ZFDoctrine
 *
 * LICENSE
 *
 */
require "ZendT/Tool/Context/DbTableModelFile.php";
require "ZendT/Tool/Context/ModelFile.php";
/**
 * Doctrine Tool Provider
 *
 * @author Benjamin Eberlei (kontakt@beberlei.de)
 */
class ZendT_Tool_ModelTProvider extends Zend_Tool_Project_Provider_Abstract
    implements Zend_Tool_Framework_Provider_Pretendable
{
    /**
     *
     * @var Zend_Db_Adapter_Abstract
     */
    protected $_dbAdapter = null;
    /**
     *
     * @param type $tableName
     * @return type 
     */
    private function getConfigTable($tableName){
        $sql = "SELECT utc.comments 
                  FROM user_tab_comments utc
                 WHERE utc.table_name = :tableName
                   AND utc.TABLE_TYPE = 'TABLE'";
        $rows = $this->_dbAdapter->fetchAll($sql, array('tableName'=>$tableName));
        if (!$rows) return array();
        else{
            $comments = $rows[0]['comments'];
            $strZF = substr($comments,strpos($comments, '<?zf'),strpos($data, 'zf?>')+4);
            return Zend_Json::encode($strZF);
        }
    }
    /**
     *
     * @param string $tableName
     * @param array $config
     * @return boolean 
     */
    private function setConfigTable($tableName,$config){
        $sql = "SELECT utc.comments 
                  FROM user_tab_comments utc
                 WHERE utc.table_name = :tableName
                   AND utc.TABLE_TYPE = 'TABLE'";
        $rows = $this->_dbAdapter->fetchAll($sql, array('tableName'=>$tableName));
        if (count($rows) > 0){
            $comments = $rows[0]['comments'];
            $strZF = substr($comments,strpos($comments, '<?zf'),strpos($data, 'zf?>')+4);
            $comments = str_replace($strZF,'',$comments);
            $comments.= '<?zf '.Zend_Json::decode($config).' zf?>';
            $sql = "comment on table ".$tableName."  is :comment ";
            $this->_dbAdapter->query($sql, array('comment'=>$comments));
            return true;
        }
    }
    /**
     * 
     * @param string $tableName 
     */
    private function getObjectName($tableName){
        $config = $this->getConfigTable($tableName);
        return $config['objectName'];
    }
    /**
     *
     * @param string $tableName
     * @param string $objectName 
     */
    private function setObjectName($tableName,$objectName){
        $config = $this->getConfigTable($tableName);
        $config['objectName'] = $objectName;
        return $this->setConfigTable($tableName, $config);
    }
    /**
     *
     * @param string $table
     * @param string $adapter
     * @param string $module
     * @return void
     * @throws Zend_Tool_Project_Exception
     * @throws Exception 
     */
    public function create($table, $adapter, $module=null)
    {
        $name = ZendT_Tool_ModelTProvider::convertTableNameToClassName($table);
        $this->_print(' Criando Models ');
        $this->_print('name: '.$name . ' |  table: '.$table.' | adapter : '.$adapter. ' | module: '. $module);
        $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
        
        $applicationConfigResource = $this->_loadedProfile->search('ApplicationConfigFile');

        if (!$applicationConfigResource) {
            throw new Zend_Tool_Project_Exception('A project with an application config file is required to use this provider.');
        }

        $zf = $applicationConfigResource->getAsZendConfig();
        
        $_configDb = $zf->resources->multidb->{$adapter};
        if (!$_configDb){
            throw new Zend_Tool_Project_Exception('Adapter not found in config application "resources.multidb.'.$adapter.'" .');
        }
        $configDb = array();
        $configDb['host'] = $_configDb->host;
        $configDb['username'] = $_configDb->username;
        $configDb['password'] = $_configDb->password;
        $configDb['dbname'] = $_configDb->dbname;

        $this->_dbAdapter = Zend_Db::factory($_configDb->adapter, $configDb);
        $sql = "SELECT uccfk.column_name
                      ,uccpk.table_name  table_name_pk
                      ,NULL object_name_pk
                      ,uccpk.column_name column_name_pk
                  FROM user_cons_columns uccfk
                      ,user_constraints  uc
                      ,user_cons_columns uccpk
                 WHERE uccfk.constraint_name = uc.constraint_name
                   AND uc.r_constraint_name = uccpk.constraint_name
                   AND uc.constraint_type = 'R'
                   AND uccfk.table_name = '".strtoupper($table)."'";
        $referenceMap = $this->_dbAdapter->fetchAll($sql);
        foreach ($referenceMap as &$reference){
            $reference['OBJECT_NAME_PK'] = $this->getObjectName($reference['TABLE_NAME_PK']);
        }
        
        $sql = "SELECT distinct uccfk.TABLE_NAME
                  FROM user_cons_columns uccfk
                      ,user_constraints  uc
                      ,user_cons_columns uccpk
                 WHERE uccfk.constraint_name = uc.constraint_name
                   AND uc.r_constraint_name = uccpk.constraint_name
                   AND uc.constraint_type = 'R'
                   AND uccpk.table_name = '".strtoupper($table)."'";
        $dependentTables = $this->_dbAdapter->fetchAll($sql);
        foreach ($dependentTables as &$dependentTable){
            $dependentTable['OBJECT_NAME'] = $this->getObjectName($dependentTable['TABLE_NAME']);
        }

        // Check that there is not a dash or underscore, return if doesnt match regex
        if (preg_match('#[_-]#', $name)) {
            throw new Zend_Tool_Project_Provider_Exception('DbTable names should be camel cased.');
        }

        $originalName = $name;
        $name = ucfirst($name);

        if ($table == '') {
            throw new Zend_Tool_Project_Provider_Exception('You must provide both the DbTable name as well as the actual db table\'s name.');
        }

        /*if (Zend_Tool_Project_Provider_DbTable::hasResource($this->_loadedProfile, $name, $module)) {
            throw new Zend_Tool_Project_Provider_Exception('This project already has a DbTable named ' . $name);
        }*/

        // get request/response object
        $request = $this->_registry->getRequest();
        $response = $this->_registry->getResponse();

        // alert the user about inline converted names
        $tense = (($request->isPretend()) ? 'would be' : 'is');

        if ($name !== $originalName) {
            $response->appendContent(
                'Note: The canonical model name that ' . $tense
                    . ' used with other providers is "' . $name . '";'
                    . ' not "' . $originalName . '" as supplied',
                array('color' => array('yellow'))
                );
        }
        /**
         * Cria o DB Table 
         */
        try {
            $tableResource = Zend_Tool_Project_Provider_DbTable::createResource($this->_loadedProfile, $name, $table, $module);
        } catch (Exception $e) {
            $response = $this->_registry->getResponse();
            $response->setException($e);
            return;
        }

        // do the creation
        if ($request->isPretend()) {
            $response->appendContent('Would create a DbTable at '  . $tableResource->getContext()->getPath());
        } else {
            $response->appendContent('Creating a DbTable at ' . $tableResource->getContext()->getPath());
            $tableResource->create();
            $this->_storeProfile();
            
            $fileName = $tableResource->getContext()->getPath();
            $dbTableContext = new ZendT_Tool_Context_DbTableModelFile();
            
            $this->_dbAdapter->describeTable($originalName);
            
            $data = array();
            $data['modelName'] = $name;
            $data['moduleName'] = $module;
            $data['tableName'] = $table;
            $data['adapter'] = $adapter;
            $data['referenceMap'] = $referenceMap;
            $data['dependentTables'] = $dependentTables;
            $dbTableContext->setProperties($data);
            file_put_contents($fileName, "<?php \n".$dbTableContext->getContents()."\n?>");
            /**
             * Configura o nome do objeto dentro dos comentários
             * da tabela 
             */
            $this->setObjectName($table,
                                 ZendT_Tool_ModelTProvider::convertTableNameToObjectName($module, $table));
            
        }        
        /**
         * Cria o Model 
         */        
        try {
            $modelResource = Zend_Tool_Project_Provider_Model::createResource($this->_loadedProfile, $name, $module);
        } catch (Exception $e) {
            $response->setException($e);
            return;
        }

        // do the creation
        if ($request->isPretend()) {

            $response->appendContent('Would create a model at '  . $modelResource->getContext()->getPath());
        } else {

            $response->appendContent('Creating a model at ' . $modelResource->getContext()->getPath());
            $modelResource->create();
            $this->_storeProfile();
            
            $fileName = $modelResource->getContext()->getPath();
            $modelContext = new ZendT_Tool_Context_ModelFile();
            $data = array();
            $data['modelName'] = $name;
            $data['moduleName'] = $module;
            $modelContext->setProperties($data);
            file_put_contents($fileName,  "<?php \n".$modelContext->getContents()."\n?>");
        }
        $this->_print(' Finalizado Models ');
    }
    /**
     * @param string $line
     * @param array $decoratorOptions
     */
    protected function _print($line, array $decoratorOptions = array())
    {
        $this->_registry->getResponse()->appendContent("[ZendT] " . $line, $decoratorOptions);
    }
    
    public static function convertTableNameToClassName($tableName)
    {
        $data = explode('_',$tableName);
        //var_dump($tableName,$data);
        $result = '';
        foreach ($data as $value){
            $result.= ucfirst(strtolower($value));
        }
        return $result;
    }
    
    public static function convertTableNameToObjectName($moduleName,$tableName){
        if ($moduleName == '')
            $moduleName = 'Application';
        return ucfirst($moduleName)."_Model_".ZendT_Tool_ModelTProvider::convertTableNameToClassName($tableName)."_Crud_Table";
    }
}