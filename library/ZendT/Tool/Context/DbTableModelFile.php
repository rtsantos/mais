<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelFile
 *
 * @author rsantos
 */
class ZendT_Tool_Context_DbTableModelFile extends Zend_Tool_Project_Context_Filesystem_File
{

    protected $_modelName = null;
    protected $_moduleName = null;
    protected $_adapter = null;
    protected $_tableName = null;
    protected $_referenceMap = array();
    protected $_dependentTables = array();

    /**
     * init() is called after resources have been assembled, this effectively
     * gives a "resource" within a project a "context" to operate under.
     */
    public function init()
    {
        $this->_modelName = $this->_resource->getAttribute('modelName');
        $this->_moduleName = $this->_resource->getAttribute('moduleName');
        $this->_adapter = $this->_resource->getAttribute('adapter');
        $this->_tableName = $this->_resource->getAttribute('tableName');
        $this->_filesystemName = ucfirst($this->_modelName) . '.php';
        parent::init();
    }
    
    public function setProperties($data){
        foreach ($data as $name=>$value){
            $this->{"_".$name} = $value;
        }
    }

    /**
     * The name the system will use to identify resources by.
     *
     * @return unknown
     */
    public function getName()
    {
        return 'DbTableModelFile';
    }

    /**
     * The attributes assigned to any given resource within
     * a project.  These aid in searching as well as distinguishing
     * one resource of 'ModelFile' from another.
     *
     * @return unknown
     */
    public function getPersistentAttributes()
    {
        return array(
            'modelName' => $this->_modelName,
            'moduleName' => $this->_moduleName,
            'adapter' => $this->_adapter,
            'tableName' => $this->_tableName,
            );
    }

    /**
     * getContents() will be called at creation time.  This could be
     * as simple as you see below or could use Zend_Tool_CodeGenerator
     * for this task.
     *
     * @return string
     */
    public function getContents()
    {
        $modelName = ucfirst($this->_modelName);
        $moduleName = ucfirst($this->_moduleName);
        $adapter = strtolower($this->_adapter);
        $tableName = strtoupper($this->_tableName);
        $referenceMap = $this->_referenceMap;
        $dependentTables = $this->_dependentTables;
        
        if ($moduleName == '') 
            $moduleName = 'Application';
        
        $strDependentTables = '';
        foreach ($dependentTables as $table){
            $className = $table['OBJECT_NAME'];            
            /**
             * @todo pensar em uma forma de localizar o nome do módulo 
             */
            if ($className == ''){
                $className = $moduleName."_Model_".ZendT_Tool_ModelTProvider::convertTableNameToClassName($table['TABLE_NAME'])."_Crud_Table";
                $strDependentTables.= ",
                    '".$className."'";
            }
        }        
        $strDependentTables = substr($strDependentTables,1);
        
        $strReferenceMap = '';
        foreach ($referenceMap as $reference){
            $className = $reference['OBJECT_NAME_PK'];
            /**
             * @todo pensar em uma forma de localizar o nome do módulo 
             */
            if ($className == ''){
                $className = $moduleName."_Model_".ZendT_Tool_ModelTProvider::convertTableNameToClassName($reference['TABLE_NAME_PK'])."_Crud_Table";
                $strReferenceMap.= ",
                    '".$className."' = array(
                        'columns' => '".$reference['COLUMN_NAME']."',
                        'refTableClass' => '".$className."',
                        'refColumns' => '".$reference['COLUMN_NAME_PK']."'
                    )";
            }
        }        
        $strReferenceMap = substr($strReferenceMap,1);
        
        $contents = <<<EOS

class {$moduleName}_Model_{$modelName}_Crud_Table extends Zend_Db_Table_Abstract
{
    protected \$_name = '{$tableName}';
    protected \$_schema  = '{$adapter}';
    protected \$_adapter = 'db.{$adapter}';
    protected \$_dependentTables = array({$strDependentTables});
    protected \$_referenceMap = array({$strReferenceMap});
}

EOS;

        return $contents;
    }
}
?>
