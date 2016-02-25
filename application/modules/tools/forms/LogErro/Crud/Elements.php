<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela tl_log_erro
 */
class Tools_Form_LogErro_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_tools');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Tools_Form_LogErro_Elements
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
        $element->setLabel($this->_translate->_('tl_log_erro.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getProcedimento(){

        $element = new ZendT_Form_Element_Text('procedimento');
        $element->setLabel($this->_translate->_('tl_log_erro.procedimento') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_DateTime
     */
    public function getDhLog(){

        $element = new ZendT_Form_Element_DateTime('dh_log');
        $element->setLabel($this->_translate->_('tl_log_erro.dh_log') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px','maxlength'=>'5','id'=>''));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getMensagem(){

        $element = new ZendT_Form_Element_Text('mensagem');
        $element->setLabel($this->_translate->_('tl_log_erro.mensagem') . ':');
        $element->setAttribs(array('maxlength'=>'1000','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);");
        return $element;
    }
            
}
?>