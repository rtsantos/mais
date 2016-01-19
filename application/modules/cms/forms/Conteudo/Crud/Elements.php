<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela cms_conteudo
 */
class Cms_Form_Conteudo_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_cms');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Cms_Form_Conteudo_Elements
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
        $element->setLabel($this->_translate->_('cms_conteudo.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdCategoria(){

        $element = new ZendT_Form_Element_Seeker('id_categoria');
        $element->setSuffix('categoria');
        $element->setLabel($this->_translate->_('cms_conteudo.id_categoria') . ':');
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
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdConteudoPai(){

        $element = new ZendT_Form_Element_Seeker('id_conteudo_pai');
        $element->setSuffix('conteudo_pai');
        $element->setLabel($this->_translate->_('cms_conteudo.id_conteudo_pai') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('titulo');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/cms/conteudo/grid');
        $element->url()->setSearch('/cms/conteudo/seeker-search');
        $element->url()->setRetrieve('/cms/conteudo/retrieve');
        $element->setMapperView('Cms_DataView_Conteudo_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getTitulo(){

        $element = new ZendT_Form_Element_Text('titulo');
        $element->setLabel($this->_translate->_('cms_conteudo.titulo') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getSubTitulo(){

        $element = new ZendT_Form_Element_Text('sub_titulo');
        $element->setLabel($this->_translate->_('cms_conteudo.sub_titulo') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_DateTime
     */
    public function getDhIniPub(){

        $element = new ZendT_Form_Element_DateTime('dh_ini_pub');
        $element->setLabel($this->_translate->_('cms_conteudo.dh_ini_pub') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_DateTime
     */
    public function getDhFimPub(){

        $element = new ZendT_Form_Element_DateTime('dh_fim_pub');
        $element->setLabel($this->_translate->_('cms_conteudo.dh_fim_pub') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Textarea
     */
    public function getCorpo(){

        $element = new ZendT_Form_Element_Textarea('corpo');
        $element->setLabel($this->_translate->_('cms_conteudo.corpo') . ':');
        $element->enableEditorHtml(0);
        $element->setAttribs(array('cols'=>'50','rows'=>'10'));        
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getArquivo(){

        $element = new ZendT_Form_Element_Numeric('arquivo');
        $element->setLabel($this->_translate->_('cms_conteudo.arquivo') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getThumbnail(){

        $element = new ZendT_Form_Element_Numeric('thumbnail');
        $element->setLabel($this->_translate->_('cms_conteudo.thumbnail') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdUsuarioInc(){

        $element = new ZendT_Form_Element_Seeker('id_usuario_inc');
        $element->setSuffix('usuario_inc');
        $element->setLabel($this->_translate->_('cms_conteudo.id_usuario_inc') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('login');
        $element->setSearchAttribs(array('css-width'=>'100px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/auth/usuario/grid');
        $element->url()->setSearch('/auth/usuario/seeker-search');
        $element->url()->setRetrieve('/auth/usuario/retrive');
        $element->setMapperView('Auth_DataView_Usuario_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('nome');
        $element->setDisplayAttribs(array('css-width'=>'170px'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdStatus(){

        $element = new ZendT_Form_Element_Seeker('id_status');
        $element->setSuffix('status');
        $element->setLabel($this->_translate->_('cms_conteudo.id_status') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('descricao');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/cms/status/grid');
        $element->url()->setSearch('/cms/status/seeker-search');
        $element->url()->setRetrieve('/cms/status/retrieve');
        $element->setMapperView('Cms_DataView_Status_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getPublico(){

        $element = new ZendT_Form_Element_Select('publico');
        $element->setLabel($this->_translate->_('cms_conteudo.publico') . ':');
        $element->addMultiOption('S', 'Sim');
        $element->addMultiOption('N', 'Não');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getBanner(){

        $element = new ZendT_Form_Element_Numeric('banner');
        $element->setLabel($this->_translate->_('cms_conteudo.banner') . ':');
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
    public function getCorpoUrl(){

        $element = new ZendT_Form_Element_Text('corpo_url');
        $element->setLabel($this->_translate->_('cms_conteudo.corpo_url') . ':');
        $element->setAttribs(array('maxlength'=>'200','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getChave(){

        $element = new ZendT_Form_Element_Text('chave');
        $element->setLabel($this->_translate->_('cms_conteudo.chave') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);this.value=strtolower(this.value);this.value=trim(this.value);this.value=replace(this.value,'Array','-');");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getChaveMacro(){

        $element = new ZendT_Form_Element_Text('chave_macro');
        $element->setLabel($this->_translate->_('cms_conteudo.chave_macro') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtolower(this.value);this.value=trim(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdUsuarioAprov(){

        $element = new ZendT_Form_Element_Seeker('id_usuario_aprov');
        $element->setSuffix('usuario_aprov');
        $element->setLabel($this->_translate->_('cms_conteudo.id_usuario_aprov') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('login');
        $element->setSearchAttribs(array('css-width'=>'100px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/auth/usuario/grid');
        $element->url()->setSearch('/auth/usuario/seeker-search');
        $element->url()->setRetrieve('/auth/usuario/retrive');
        $element->setMapperView('Auth_DataView_Usuario_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('nome');
        $element->setDisplayAttribs(array('css-width'=>'170px'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdFilial(){

        $element = new ZendT_Form_Element_Seeker('id_filial');
        $element->setSuffix('filial');
        $element->setLabel($this->_translate->_('cms_conteudo.id_filial') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('sigla');
        $element->setSearchAttribs(array('size'=>'5'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
        $element->url()->setGrid('/ca/filial/grid');
        $element->url()->setSearch('/ca/filial/seeker-search');
        $element->url()->setRetrieve('/ca/filial/retrive');
        $element->setMapperView('Ca_DataView_Filial_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('nome_cidade');
        $element->setDisplayAttribs(array('size'=>'30'));
        return $element;
    }
            
}
?>