<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela img_tipo_docto
 */
class Ged_Form_TipoDocto_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_ged');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ged_Form_TipoDocto_Elements
     */
    public function getElement($columnName){
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $this->$method();
    }
     
    
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('img_tipo_docto.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getIdPropDocto(){

        $element = new ZendT_Form_Element_Seeker('id_prop_docto');
        $element->setSufix('prop_docto');
        $element->setLabel($this->_translate->_('img_tipo_docto.id_prop_docto') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ged/prop-docto/grid');
        $element->url()->setSearch('/ged/prop-docto/seeker-search');
        $element->url()->setRetrive('/ged/prop-docto/retrive');
        $element->enableAutoComplete();
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getNome(){

        $element = new ZendT_Form_Element_Text('nome');
        $element->setLabel($this->_translate->_('img_tipo_docto.nome') . ':');
        $element->setAttribs(array('maxlength'=>'30','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getStatus(){

        $element = new ZendT_Form_Element_Select('status');
        $element->setLabel($this->_translate->_('img_tipo_docto.status') . ':');
        $element->addMultiOption('A', 'Ativo');
        $element->addMultiOption('I', 'Inativo');
        $element->addMultiOption('1', 'Ativo (1)');        
                
        return $element;
    }
            
}
?>