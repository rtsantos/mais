<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela img_arquivo
 */
class Ged_Form_Arquivo_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_ged');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ged_Form_Arquivo_Elements
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
        $element->setLabel($this->_translate->_('img_arquivo.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_DateTime
     */
    public function getDhInc(){

        $element = new ZendT_Form_Element_DateTime('dh_inc');
        $element->setLabel($this->_translate->_('img_arquivo.dh_inc') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getHashcode(){

        $element = new ZendT_Form_Element_Text('hashcode');
        $element->setLabel($this->_translate->_('img_arquivo.hashcode') . ':');
        $element->setAttribs(array('maxlength'=>'32','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_FileUpload
     */
    public function getConteudo(){

        $element = new ZendT_Form_Element_FileUpload('conteudo');
        $element->setLabel($this->_translate->_('img_arquivo.conteudo') . ':');
        $element->setAttribs(array());
        $element->enableMultiple(false);
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdPropDocto(){

        $element = new ZendT_Form_Element_Seeker('id_prop_docto');
        $element->setSuffix('prop_docto');
        $element->setLabel($this->_translate->_('img_arquivo.id_prop_docto') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ged/prop-docto/grid');
        $element->url()->setSearch('/ged/prop-docto/seeker-search');
        $element->url()->setRetrieve('/ged/prop-docto/retrive');
        $element->setMapperView('Ged_DataView_PropDocto_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getPathArq(){

        $element = new ZendT_Form_Element_Text('path_arq');
        $element->setLabel($this->_translate->_('img_arquivo.path_arq') . ':');
        $element->setAttribs(array('maxlength'=>'40','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Date
     */
    public function getDtExpira(){

        $element = new ZendT_Form_Element_Date('dt_expira');
        $element->setLabel($this->_translate->_('img_arquivo.dt_expira') . ':');
        $element->setAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>