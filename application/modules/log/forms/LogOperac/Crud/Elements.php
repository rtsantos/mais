<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela log_operac
 */
class Log_Form_LogOperac_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_log');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Log_Form_LogOperac_Elements
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
        $element->setLabel($this->_translate->_('log_operac.id') . ':');
        $element->setAttribs(array('css-width'=>'50','maxlength'=>'2'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getCodigo(){

        $element = new ZendT_Form_Element_Text('codigo');
        $element->setLabel($this->_translate->_('log_operac.codigo') . ':');
        $element->setAttribs(array('maxlength'=>'3','css-width'=>'50'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getOperacao(){

        $element = new ZendT_Form_Element_Text('operacao');
        $element->setLabel($this->_translate->_('log_operac.operacao') . ':');
        $element->setAttribs(array('maxlength'=>'20','css-width'=>'150'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getStatus(){

        $element = new ZendT_Form_Element_Text('status');
        $element->setLabel($this->_translate->_('log_operac.status') . ':');
        $element->setAttribs(array('maxlength'=>'20','css-width'=>'150'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getAcao(){

        $element = new ZendT_Form_Element_Text('acao');
        $element->setLabel($this->_translate->_('log_operac.acao') . ':');
        $element->setAttribs(array('maxlength'=>'20','css-width'=>'150'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
}
?>