<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela img_prop_docto
 */
class Ged_Form_PropDocto_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_ged');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ged_Form_PropDocto_Elements
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
        $element->setLabel($this->_translate->_('img_prop_docto.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdAplicacao(){

        $element = new ZendT_Form_Element_Seeker('id_aplicacao');
        $element->setSuffix('aplicacao');
        $element->setLabel($this->_translate->_('img_prop_docto.id_aplicacao') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('sigla_aplic_prouser');
        $element->setSearchAttribs(array('css-width'=>'100px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ged/aplicacao/grid');
        $element->url()->setSearch('/ged/aplicacao/seeker-search');
        $element->url()->setRetrieve('/ged/aplicacao/retrive');
        $element->setMapperView('Ged_DataView_Aplicacao_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('nome_aplic_prouser');
        $element->setDisplayAttribs(array('css-width'=>'170px'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getNome(){

        $element = new ZendT_Form_Element_Text('nome');
        $element->setLabel($this->_translate->_('img_prop_docto.nome') . ':');
        $element->setAttribs(array('maxlength'=>'30','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getTabela(){

        $element = new ZendT_Form_Element_Text('tabela');
        $element->setLabel($this->_translate->_('img_prop_docto.tabela') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Textarea
     */
    public function getSql(){

        $element = new ZendT_Form_Element_Textarea('sql');
        $element->setLabel($this->_translate->_('img_prop_docto.sql') . ':');
        $element->enableEditorHtml(0);
        $element->setAttribs(array('maxlength'=>'500','css-width'=>'200px','rows'=>'5'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getConfig(){

        $element = new ZendT_Form_Element_Text('config');
        $element->setLabel($this->_translate->_('img_prop_docto.config') . ':');
        $element->setAttribs(array('maxlength'=>'1000','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
}
?>