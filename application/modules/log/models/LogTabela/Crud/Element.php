<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela log_tabela
 */
class Log_Model_LogTabela_Crud_Element
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_log');
    }

    
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('log_tabela.id') . ':');
        $element->setAttribs(array('css-width'=>'87.5','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getNome(){

        $element = new ZendT_Form_Element_Text('nome');
        $element->setLabel($this->_translate->_('log_tabela.nome') . ':');
        $element->setAttribs(array('maxlength'=>'150','css-width'=>'150'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getOwner(){

        $element = new ZendT_Form_Element_Text('owner');
        $element->setLabel($this->_translate->_('log_tabela.owner') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'100'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getTableName(){

        $element = new ZendT_Form_Element_Text('table_name');
        $element->setLabel($this->_translate->_('log_tabela.table_name') . ':');
        $element->setAttribs(array('maxlength'=>'150','css-width'=>'150'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
}
?>