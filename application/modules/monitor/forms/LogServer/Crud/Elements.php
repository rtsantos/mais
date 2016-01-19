<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela log_server
 */
class Monitor_Form_LogServer_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_monitor');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Monitor_Form_LogServer_Elements
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
        $element->setLabel($this->_translate->_('log_server.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_DateTime
     */
    public function getDhLog(){

        $element = new ZendT_Form_Element_DateTime('dh_log');
        $element->setLabel($this->_translate->_('log_server.dh_log') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getTotalAccesses(){

        $element = new ZendT_Form_Element_Numeric('total_accesses');
        $element->setLabel($this->_translate->_('log_server.total_accesses') . ':');
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
    public function getTotalTraffic(){

        $element = new ZendT_Form_Element_Numeric('total_traffic');
        $element->setLabel($this->_translate->_('log_server.total_traffic') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','2');
        $element->setJQueryParam('numInteger','8');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getCpuUsage(){

        $element = new ZendT_Form_Element_Text('cpu_usage');
        $element->setLabel($this->_translate->_('log_server.cpu_usage') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'100px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getCpuLoad(){

        $element = new ZendT_Form_Element_Numeric('cpu_load');
        $element->setLabel($this->_translate->_('log_server.cpu_load') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','3');
        $element->setJQueryParam('numInteger','7');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getTotalRequests(){

        $element = new ZendT_Form_Element_Numeric('total_requests');
        $element->setLabel($this->_translate->_('log_server.total_requests') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','6');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getMemTotal(){

        $element = new ZendT_Form_Element_Numeric('mem_total');
        $element->setLabel($this->_translate->_('log_server.mem_total') . ':');
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
    public function getMemUsed(){

        $element = new ZendT_Form_Element_Numeric('mem_used');
        $element->setLabel($this->_translate->_('log_server.mem_used') . ':');
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
    public function getMemCached(){

        $element = new ZendT_Form_Element_Numeric('mem_cached');
        $element->setLabel($this->_translate->_('log_server.mem_cached') . ':');
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
    public function getSwapTotal(){

        $element = new ZendT_Form_Element_Numeric('swap_total');
        $element->setLabel($this->_translate->_('log_server.swap_total') . ':');
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
    public function getSwapUsed(){

        $element = new ZendT_Form_Element_Numeric('swap_used');
        $element->setLabel($this->_translate->_('log_server.swap_used') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>