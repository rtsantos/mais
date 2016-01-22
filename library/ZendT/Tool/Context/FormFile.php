<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormFile
 *
 * @author rsantos
 */
require_once 'Zend/Tool/Project/Context/Filesystem/File.php';

class ZendT_Tool_Context_FormFile extends Zend_Tool_Project_Context_Filesystem_File
{

    protected $_modelName = null;
    protected $_moduleName = null;

    /**
     * init() is called after resources have been assembled, this effectively
     * gives a "resource" within a project a "context" to operate under.
     */
    public function init()
    {
        $this->_formName = $this->_resource->getAttribute('formName');
        $this->_moduleName = $this->_resource->getAttribute('moduleName');
        $this->_filesystemName = ucfirst($this->_formName) . '.php';
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
        return 'FormFile';
    }

    /**
     * The attributes assigned to any given resource within
     * a project.  These aid in searching as well as distinguishing
     * one resource of 'FormFile' from another.
     *
     * @return unknown
     */
    public function getPersistentAttributes()
    {
        return array(
            'formName' => $this->_formName,
            'moduleName' => $this->_moduleName,
            );
    }
    
    private function getElementText($prop){
        $requred = '';
        if ($prop['NULLABLE']){
            $requred = "        \$elementText->setRequired();\n";
        }
        $strElement = "\n";
        $strElement = "     \$elementText = new ZendT_Form_Element_Text('".$prop['NAME']."');";
        $strElement.= $requred."\n";
        $strElement = "     \$elementText->setLabel('".$prop['NAME'].".':');\n";
        $strElement = "     \$elementText->addDecorator(\$decoratorDefault);\n";
        $strElement = "     \$elementText->setName('".$prop['NAME']."');\n";
        $strElement = "     \$elementText->setAttrib('maxlength', ".$prop['LENGTH'].");\n";
        $strElement = "     \$elementText->renderDefault();\n";        
        $strElement = "     \$this->addElement(\$elementText);\n";
        return $strElement;
    }
    
    private function getElementDate($prop){
        $requred = '';
        if ($prop['NULLABLE']){
            $requred = "        \$elementDate->setRequired();\n";
        }
        $strElement = "\n";
        $strElement = "     \$elementDate = new ZendT_Form_Element_Date('".$prop['NAME']."');";
        $strElement.= $requred."\n";
        $strElement = "     \$elementDate->setLabel('".$prop['NAME'].".':');\n";
        $strElement = "     \$elementDate->addDecorator(\$decoratorDefault);\n";
        $strElement = "     \$elementDate->setName('".$prop['NAME']."');\n";
        $strElement = "     \$elementDate->setAttrib('maxlength', 10);\n";
        $strElement = "     \$elementDate->renderDefault();\n";        
        $strElement = "     \$this->addElement(\$elementDate);\n";
        return $strElement;
    }
    /**
     *
     * @param type $prop 
     */
    private function getElementNumeric($prop){        
        $requred = '';
        if ($prop['NULLABLE']){
            $requred = "        \$elementNumeric->setRequired();\n";
        }
        $strElement = "\n";
        $strElement = "     \$elementNumeric = new ZendT_Form_Element_Numeric('".$prop['NAME']."');";
        $strElement.= $requred."\n";
        $strElement = "     \$elementNumeric->setLabel('".$prop['NAME'].".':');\n";
        $strElement = "     \$elementNumeric->addDecorator(\$decoratorDefault);\n";
        $strElement = "     \$elementNumeric->setName('".$prop['NAME']."');\n";        
        $strElement = "     \$elementNumeric->setJQueryParam('numDecimal', ".$numDecimal.");\n";
        $strElement = "     \$elementNumeric->setJQueryParam('numInteger', ".$numInteger.");\n";
        $strElement = "     \$elementNumeric->renderDefault();\n";
        $strElement = "     \$this->addElement(\$elementNumeric);\n";
        return $strElement;
    }
    /**
     *
     * @param type $prop 
     */
    private function getElementTime($prop){        
        $requred = '';
        if ($prop['NULLABLE']){
            $requred = "        \$elementTimer->setRequired();\n";
        }
        $strElement = "\n";
        $strElement = "     \$elementTimer = new ZendT_Form_Element_Time('".$prop['NAME']."');";
        $strElement.= $requred."\n";
        $strElement = "     \$elementTimer->setLabel('".$prop['NAME'].".':');\n";
        $strElement = "     \$elementTimer->addDecorator(\$decoratorDefault);\n";
        $strElement = "     \$elementTimer->setName('".$prop['NAME']."');\n";
        $strElement = "     \$elementTimer->renderDefault();\n";
        $strElement = "     \$this->addElement(\$elementTimer);\n";
        return $strElement;
    }
    /**
     *
     * @param type $prop 
     */
    private function getElementSeeker($prop){        
        $moduleName = 'default';
        $controllerName = 'index';
        $search = 'codigo';
        $display = 'descricao';
        $requred = '';
        if ($prop['NULLABLE']){
            $requred = "        \$elementSeeker->setRequired();\n";
        }
        $strElement = "\n";
        $strElement = "     \$elementSeeker = new ZendT_Form_Element_Time('".$prop['NAME']."');";
        $strElement.= $requred."\n";
        $strElement = "     \$elementSeeker->setLabel('".$prop['NAME'].".':');\n";
        $strElement = "     \$elementSeeker->addDecorator(\$decoratorSeeker);\n";
        $strElement = "     \$elementSeeker->setName('".$prop['NAME']."');\n";
        $strElement = "     \$elementSeeker->setAttrib('modal',array('width'=>750\n";
        $strElement = "                                             ,'height'=>350));\n";
        $strElement = "     \$elementSeeker->setAttrib('field',array('id'=>'id'\n";
        $strElement = "                                             ,'search'=>'$search'\n";
        $strElement = "                                             ,'display'=>'$display'));\n";
        $strElement = "     \$elementSeeker->setAttrib('search',array('size'=>20);\n";
        $strElement = "     \$elementSeeker->setAttrib('display',array('size'=>40);\n";
        $strElement = "     \$elementSeeker->setAttrib('url',array('grid'=>ZendT_Url::getBaseDiretoryPublic() . '/'.$moduleName.'/'.$controllerName.'/grid',\n";
        $strElement = "                                            'search'=>ZendT_Url::getBaseDiretoryPublic() . '/'.$moduleName.'/'.$controllerName.'/search',\n";
        $strElement = "                                            'retrive'=>ZendT_Url::getBaseDiretoryPublic() . '/'.$moduleName.'/'.$controllerName.'/retrive'));\n";
        $strElement = "     \$elementSeeker->renderSeeker();\n";
        $strElement = "     \$this->addElement(\$elementSeeker);\n";
        return $strElement;
    }
    
    public function detectType(&$describeTable){
        foreach ($describeTable['COLUMNS'] as $key=>$value){
            $columns[$key]['NAME'] = $key;
            $columns[$key]['SEARCH'] = 'codigo';
            $columns[$key]['DISPLAY'] = 'descricao';
            $columns[$key]['MODULE'] = 'default';
            $columns[$key]['CONTROLLER'] = 'index';
            if ($value['TYPE'] == 'DATE'){
                $columns[$key]['strElement'] = $this->getElementDate($columns);
            }elseif ($value['TYPE'] == 'INTEGER'){
                
            }
        }
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
        $formName = ucfirst($this->_formName);
        $moduleName = ucfirst($this->_moduleName);
        
        if ($moduleName == '') 
            $moduleName = 'Application';

        $contents = <<<EOS
class {$moduleName}_Form_{$formName} extends ZendT_Form
{
    \$decoratorDefault = new ZendT_Form_Decorator_Default();
    \$decoratorSeeker = new ZendT_Form_Decorator_Seeker();

}

EOS;

        return $contents;
    }

}
?>
