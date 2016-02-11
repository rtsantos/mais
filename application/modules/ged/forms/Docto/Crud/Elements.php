<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela img_docto
 */
class Ged_Form_Docto_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_ged');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ged_Form_Docto_Elements
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
        $element->setLabel($this->_translate->_('img_docto.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdTipoDocto(){

        $element = new ZendT_Form_Element_Seeker('id_tipo_docto');
        $element->setSuffix('tipo_docto');
        $element->setLabel($this->_translate->_('img_docto.id_tipo_docto') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ged/tipo-docto/grid');
        $element->url()->setSearch('/ged/tipo-docto/seeker-search');
        $element->url()->setRetrieve('/ged/tipo-docto/retrive');
        $element->setMapperView('Ged_DataView_TipoDocto_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getIdPropRelac(){

        $element = new ZendT_Form_Element_Numeric('id_prop_relac');
        $element->setLabel($this->_translate->_('img_docto.id_prop_relac') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_DateTime
     */
    public function getDhInclusao(){

        $element = new ZendT_Form_Element_DateTime('dh_inclusao');
        $element->setLabel($this->_translate->_('img_docto.dh_inclusao') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdUsuIncl(){

        $element = new ZendT_Form_Element_Seeker('id_usu_incl');
        $element->setSuffix('usu_incl');
        $element->setLabel($this->_translate->_('img_docto.id_usu_incl') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('login');
        $element->setSearchAttribs(array('css-width'=>'70px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/auth/usuario/grid');
        $element->url()->setSearch('/auth/usuario/seeker-search');
        $element->url()->setRetrieve('/auth/usuario/retrive');
        $element->setMapperView('Auth_DataView_Usuario_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('nome');
        $element->setDisplayAttribs(array('css-width'=>'200px'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getDescricao(){

        $element = new ZendT_Form_Element_Text('descricao');
        $element->setLabel($this->_translate->_('img_docto.descricao') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdArquivo(){

        $element = new ZendT_Form_Element_Seeker('id_arquivo');
        $element->setSuffix('arquivo');
        $element->setLabel($this->_translate->_('img_docto.id_arquivo') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('conteudo_name');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ged/arquivo/grid');
        $element->url()->setSearch('/ged/arquivo/seeker-search');
        $element->url()->setRetrieve('/ged/arquivo/retrive');
        $element->setMapperView('Ged_DataView_Arquivo_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>