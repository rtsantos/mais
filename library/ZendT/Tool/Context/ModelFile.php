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
require_once 'Zend/Tool/Project/Context/Filesystem/File.php';

class ZendT_Tool_Context_ModelFile extends Zend_Tool_Project_Context_Filesystem_File
{

    protected $_modelName = null;
    protected $_moduleName = null;

    /**
     * init() is called after resources have been assembled, this effectively
     * gives a "resource" within a project a "context" to operate under.
     */
    public function init()
    {
        $this->_modelName = $this->_resource->getAttribute('modelName');
        $this->_moduleName = $this->_resource->getAttribute('moduleName');
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
        return 'ModelFile';
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
        
        if ($moduleName == '') 
            $moduleName = 'Application';

        $contents = <<<EOS

class {$moduleName}_Model_{$modelName}_Table extends {$moduleName}_Model_{$modelName}_Crud_Table
{


}

EOS;

        return $contents;
    }

}
?>
