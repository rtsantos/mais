<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela cms_categoria
 */
class Cms_Form_Categoria_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_cms');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Cms_Form_Categoria_Elements
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
        $element->setLabel($this->_translate->_('cms_categoria.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getDescricao(){

        $element = new ZendT_Form_Element_Text('descricao');
        $element->setLabel($this->_translate->_('cms_categoria.descricao') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdCategoriaPai(){

        $element = new ZendT_Form_Element_Seeker('id_categoria_pai');
        $element->setSuffix('categoria_pai');
        $element->setLabel($this->_translate->_('cms_categoria.id_categoria_pai') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('descricao');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/cms/categoria/grid');
        $element->url()->setSearch('/cms/categoria/seeker-search');
        $element->url()->setRetrieve('/cms/categoria/retrieve');
        $element->setMapperView('Cms_DataView_Categoria_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getTipo(){

        $element = new ZendT_Form_Element_Select('tipo');
        $element->setLabel($this->_translate->_('cms_categoria.tipo') . ':');
        $element->addMultiOption('C', 'Categoria');
        $element->addMultiOption('S', 'Seção');
        $element->addMultiOption('A', 'Assunto');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getStatus(){

        $element = new ZendT_Form_Element_Select('status');
        $element->setLabel($this->_translate->_('cms_categoria.status') . ':');
        $element->addMultiOption('A', 'Ativo');
        $element->addMultiOption('I', 'Inativo');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getPublico(){

        $element = new ZendT_Form_Element_Select('publico');
        $element->setLabel($this->_translate->_('cms_categoria.publico') . ':');
        $element->addMultiOption('S', 'Sim');
        $element->addMultiOption('N', 'Não');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getMenu(){

        $element = new ZendT_Form_Element_Select('menu');
        $element->setLabel($this->_translate->_('cms_categoria.menu') . ':');
        $element->addMultiOption('N', 'Não');
        $element->addMultiOption('S', 'Sim');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getObservacao(){

        $element = new ZendT_Form_Element_Text('observacao');
        $element->setLabel($this->_translate->_('cms_categoria.observacao') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getOrdem(){

        $element = new ZendT_Form_Element_Numeric('ordem');
        $element->setLabel($this->_translate->_('cms_categoria.ordem') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','2');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getThumbnail(){

        $element = new ZendT_Form_Element_Numeric('thumbnail');
        $element->setLabel($this->_translate->_('cms_categoria.thumbnail') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getUrl(){

        $element = new ZendT_Form_Element_Text('url');
        $element->setLabel($this->_translate->_('cms_categoria.url') . ':');
        $element->setAttribs(array('maxlength'=>'200','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getChave(){

        $element = new ZendT_Form_Element_Text('chave');
        $element->setLabel($this->_translate->_('cms_categoria.chave') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);this.value=strtolower(this.value);this.value=trim(this.value);this.value=replace(this.value,' ','-');");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getNivel(){

        $element = new ZendT_Form_Element_Numeric('nivel');
        $element->setLabel($this->_translate->_('cms_categoria.nivel') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','3');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getUrlMacro(){

        $element = new ZendT_Form_Element_Text('url_macro');
        $element->setLabel($this->_translate->_('cms_categoria.url_macro') . ':');
        $element->setAttribs(array('maxlength'=>'200','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
}
?>