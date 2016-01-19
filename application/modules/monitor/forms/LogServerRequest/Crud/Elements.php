<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela log_server_request
 */
class Monitor_Form_LogServerRequest_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_monitor');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Monitor_Form_LogServerRequest_Elements
     */
    public function getElement($columnName){
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $this->$method();
    }
     
    
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('log_server_request.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getIdLogServer(){

        $element = new ZendT_Form_Element_Seeker('id_log_server');
        $element->setSufix('log_server');
        $element->setLabel($this->_translate->_('log_server_request.id_log_server') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('dh_log');
        $element->setSearchAttribs(array('css-width'=>'200px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/monitor/log-server/grid');
        $element->url()->setSearch('/monitor/log-server/seeker-search');
        $element->url()->setRetrive('/monitor/log-server/retrive');
        $element->addValidators(array());
                
        $element->setDisplayField('cpu_load');
        $element->setDisplayAttribs(array('css-width'=>'70px'));
        return $element;
    }
            
    public function getSrv(){

        $element = new ZendT_Form_Element_Text('srv');
        $element->setLabel($this->_translate->_('log_server_request.srv') . ':');
        $element->setAttribs(array('maxlength'=>'7','css-width'=>'40px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getPid(){

        $element = new ZendT_Form_Element_Numeric('pid');
        $element->setLabel($this->_translate->_('log_server_request.pid') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getAcc(){

        $element = new ZendT_Form_Element_Text('acc');
        $element->setLabel($this->_translate->_('log_server_request.acc') . ':');
        $element->setAttribs(array('maxlength'=>'12','css-width'=>'80px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getM(){

        $element = new ZendT_Form_Element_Text('m');
        $element->setLabel($this->_translate->_('log_server_request.m') . ':');
        $element->setAttribs(array('maxlength'=>'1','css-width'=>'20px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getCpu(){

        $element = new ZendT_Form_Element_Numeric('cpu');
        $element->setLabel($this->_translate->_('log_server_request.cpu') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','2');
        $element->setJQueryParam('numInteger','8');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getSs(){

        $element = new ZendT_Form_Element_Numeric('ss');
        $element->setLabel($this->_translate->_('log_server_request.ss') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getReq(){

        $element = new ZendT_Form_Element_Numeric('req');
        $element->setLabel($this->_translate->_('log_server_request.req') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getConn(){

        $element = new ZendT_Form_Element_Numeric('conn');
        $element->setLabel($this->_translate->_('log_server_request.conn') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','1');
        $element->setJQueryParam('numInteger','9');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getChild(){

        $element = new ZendT_Form_Element_Numeric('child');
        $element->setLabel($this->_translate->_('log_server_request.child') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','2');
        $element->setJQueryParam('numInteger','8');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getSlot(){

        $element = new ZendT_Form_Element_Numeric('slot');
        $element->setLabel($this->_translate->_('log_server_request.slot') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','2');
        $element->setJQueryParam('numInteger','8');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getClient(){

        $element = new ZendT_Form_Element_Text('client');
        $element->setLabel($this->_translate->_('log_server_request.client') . ':');
        $element->setAttribs(array('maxlength'=>'15','css-width'=>'90px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getVhost(){

        $element = new ZendT_Form_Element_Text('vhost');
        $element->setLabel($this->_translate->_('log_server_request.vhost') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'160px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    public function getRequest(){

        $element = new ZendT_Form_Element_Text('request');
        $element->setLabel($this->_translate->_('log_server_request.request') . ':');
        $element->setAttribs(array('maxlength'=>'255','css-width'=>'280px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    public function getPercCpu(){

        $element = new ZendT_Form_Element_Numeric('perc_cpu');
        $element->setLabel($this->_translate->_('log_server_request.perc_cpu') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','1');
        $element->setJQueryParam('numInteger','9');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getPercMem(){

        $element = new ZendT_Form_Element_Numeric('perc_mem');
        $element->setLabel($this->_translate->_('log_server_request.perc_mem') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','1');
        $element->setJQueryParam('numInteger','9');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getTime(){

        $element = new ZendT_Form_Element_Numeric('time');
        $element->setLabel($this->_translate->_('log_server_request.time') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getSystem(){

        $element = new ZendT_Form_Element_Text('system');
        $element->setLabel($this->_translate->_('log_server_request.system') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
}
?>