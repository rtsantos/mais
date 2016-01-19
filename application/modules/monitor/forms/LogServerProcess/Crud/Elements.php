<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela log_server_process
 */
class Monitor_Form_LogServerProcess_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_monitor');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Monitor_Form_LogServerProcess_Elements
     */
    public function getElement($columnName){
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $this->$method();
    }
     
    
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('log_server_process.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdLogServer(){

        $element = new ZendT_Form_Element_Seeker('id_log_server');
        $element->setSuffix('log_server');
        $element->setLabel($this->_translate->_('log_server_process.id_log_server') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('dh_log');
        $element->setSearchAttribs(array('css-width'=>'200px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/monitor/log-server/grid');
        $element->url()->setSearch('/monitor/log-server/seeker-search');
        $element->url()->setRetrieve('/monitor/log-server/retrive');
        $element->setMapperView('Monitor_DataView_LogServer_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('cpu_load');
        $element->setDisplayAttribs(array('css-width'=>'70px'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getPid(){

        $element = new ZendT_Form_Element_Numeric('pid');
        $element->setLabel($this->_translate->_('log_server_process.pid') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getCpu(){

        $element = new ZendT_Form_Element_Numeric('cpu');
        $element->setLabel($this->_translate->_('log_server_process.cpu') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','2');
        $element->setJQueryParam('numInteger','8');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getMem(){

        $element = new ZendT_Form_Element_Numeric('mem');
        $element->setLabel($this->_translate->_('log_server_process.mem') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','2');
        $element->setJQueryParam('numInteger','8');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getMenVsz(){

        $element = new ZendT_Form_Element_Numeric('men_vsz');
        $element->setLabel($this->_translate->_('log_server_process.men_vsz') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getMenRss(){

        $element = new ZendT_Form_Element_Numeric('men_rss');
        $element->setLabel($this->_translate->_('log_server_process.men_rss') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getTimeMin(){

        $element = new ZendT_Form_Element_Numeric('time_min');
        $element->setLabel($this->_translate->_('log_server_process.time_min') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','4');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getProgram(){

        $element = new ZendT_Form_Element_Text('program');
        $element->setLabel($this->_translate->_('log_server_process.program') . ':');
        $element->setAttribs(array('maxlength'=>'30','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);");
        return $element;
    }
            
}
?>