<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela cms_priv_conteudo
 */
class Cms_Form_PrivConteudo_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_cms');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Cms_Form_PrivConteudo_Elements
     */
    public function getElement($columnName){
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $this->$method();
    }
     
    
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdConteudo(){

        $element = new ZendT_Form_Element_Seeker('id_conteudo');
        $element->setSuffix('conteudo');
        $element->setLabel($this->_translate->_('cms_priv_conteudo.id_conteudo') . ':');
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
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdPapel(){

        $element = new ZendT_Form_Element_Seeker('id_papel');
        $element->setSuffix('papel');
        $element->setLabel($this->_translate->_('cms_priv_conteudo.id_papel') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('size'=>'40px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
        $element->url()->setGrid('/auth/papel/grid');
        $element->url()->setSearch('/auth/papel/seeker-search');
        $element->url()->setRetrieve('/auth/papel/retrive');
        $element->setMapperView('Auth_DataView_Papel_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('cms_priv_conteudo.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getTipo(){

        $element = new ZendT_Form_Element_Select('tipo');
        $element->setLabel($this->_translate->_('cms_priv_conteudo.tipo') . ':');
        $element->addMultiOption('A', 'Administração');
        $element->addMultiOption('V', 'Visualização');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getEnvEmail(){

        $element = new ZendT_Form_Element_Select('env_email');
        $element->setLabel($this->_translate->_('cms_priv_conteudo.env_email') . ':');
        $element->addMultiOption('S', 'Sim');
        $element->addMultiOption('N', 'Não');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdUsuario(){

        $element = new ZendT_Form_Element_Seeker('id_usuario');
        $element->setSuffix('usuario');
        $element->setLabel($this->_translate->_('cms_priv_conteudo.id_usuario') . ':');
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
            
}
?>