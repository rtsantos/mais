<?php
/**
 * ZFDoctrine
 *
 * LICENSE
 *
 */
require "ZendT/Tool/Context/FormFile.php";
/**
 * Doctrine Tool Provider
 *
 * @author Benjamin Eberlei (kontakt@beberlei.de)
 */
class ZendT_Tool_FormTProvider extends Zend_Tool_Project_Provider_Abstract
    implements Zend_Tool_Framework_Provider_Pretendable
{
    /**
     *
     * @var Zend_Db_Adapter_Abstract
     */
    protected $_dbAdapter = null;
    /**
     *
     * @param Zend_Tool_Project_Profile $profile
     * @param type $adapter
     * @throws Zend_Tool_Project_Exception 
     */
    private function connect(Zend_Tool_Project_Profile $profile, $adapter){
        $applicationConfigResource = $profile->search('ApplicationConfigFile');

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
        
        $this->connect($this->_loadedProfile,$adapter);

        // Check that there is not a dash or underscore, return if doesnt match regex
        if (preg_match('#[_-]#', $name)) {
            throw new Zend_Tool_Project_Provider_Exception('Form names should be camel cased.');
        }

        $originalName = $name;
        $name = ucfirst($name);

        if ($table == '') {
            throw new Zend_Tool_Project_Provider_Exception('You must provide both the Form name as well as the actual db table\'s name.');
        }

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
            $formResources = Zend_Tool_Project_Provider_Form::createResource($this->_loadedProfile, $name, $module);
        } catch (Exception $e) {
            $response = $this->_registry->getResponse();
            $response->setException($e);
            return;
        }

        // do the creation
        if ($request->isPretend()) {
            $response->appendContent('Would create a Form at '  . $formResources->getContext()->getPath());
        } else {
            $response->appendContent('Creating a Form at ' . $formResources->getContext()->getPath());
            $formResources->create();
            $this->_storeProfile();
            
            $fileName = $formResources->getContext()->getPath();
            $formContext = new ZendT_Tool_Context_FormFile();
            
            $descTable = $this->_dbAdapter->describeTable($originalName);
            $formContext->setProperties($descTable);
            file_put_contents($fileName, "<?php \n".$formContext->getContents()."\n?>");
            
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
}