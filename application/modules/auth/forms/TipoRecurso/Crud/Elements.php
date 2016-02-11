<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela at_tipo_recurso
 */
class Auth_Form_TipoRecurso_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_auth');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Form_TipoRecurso_Elements
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
        $element->setLabel($this->_translate->_('at_tipo_recurso.id') . ':');
        $element->setAttribs(array('size'=>'15','maxlength'=>'10','css-width'=>'15'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getNome(){

        $element = new ZendT_Form_Element_Text('nome');
        $element->setLabel($this->_translate->_('at_tipo_recurso.nome') . ':');
        $element->setAttribs(array('maxlength'=>'30','size'=>'35'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getDescricao(){

        $element = new ZendT_Form_Element_Text('descricao');
        $element->setLabel($this->_translate->_('at_tipo_recurso.descricao') . ':');
        $element->setAttribs(array('maxlength'=>'30','size'=>'35'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
}
?>