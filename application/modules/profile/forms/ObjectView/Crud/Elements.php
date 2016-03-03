<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela pf_object_view
 */
class Profile_Form_ObjectView_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_profile');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Profile_Form_ObjectView_Elements
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
        $element->setLabel($this->_translate->_('pf_object_view.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
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
        $element->setLabel($this->_translate->_('pf_object_view.tipo') . ':');
        $element->addMultiOption('F', 'Formulário');
        $element->addMultiOption('G', 'Tabela');
        $element->addMultiOption('C', 'Gráfico Dinâmico');
        $element->addMultiOption('D', 'Tabela Dinâmica');
        $element->addMultiOption('I', 'Impressão Dinâmica');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getPadrao(){

        $element = new ZendT_Form_Element_Select('padrao');
        $element->setLabel($this->_translate->_('pf_object_view.padrao') . ':');
        $element->addMultiOption('S', 'Sim');
        $element->addMultiOption('N', 'Não');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getNome(){

        $element = new ZendT_Form_Element_Text('nome');
        $element->setLabel($this->_translate->_('pf_object_view.nome') . ':');
        $element->setAttribs(array('maxlength'=>'60','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getObjeto(){

        $element = new ZendT_Form_Element_Text('objeto');
        $element->setLabel($this->_translate->_('pf_object_view.objeto') . ':');
        $element->setAttribs(array('maxlength'=>'60','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getObservacao(){

        $element = new ZendT_Form_Element_Text('observacao');
        $element->setLabel($this->_translate->_('pf_object_view.observacao') . ':');
        $element->setAttribs(array('maxlength'=>'4000','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Textarea
     */
    public function getConfig(){

        $element = new ZendT_Form_Element_Textarea('config');
        $element->setLabel($this->_translate->_('pf_object_view.config') . ':');
        $element->enableEditorHtml(0);
        $element->setAttribs(array('cols'=>'50','rows'=>'10'));        
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdUsuario(){

        $element = new ZendT_Form_Element_Seeker('id_usuario');
        $element->setSuffix('usuario');
        $element->setLabel($this->_translate->_('pf_object_view.id_usuario') . ':');
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
     * @return \ZendT_Form_Element_Text
     */
    public function getUri(){

        $element = new ZendT_Form_Element_Text('uri');
        $element->setLabel($this->_translate->_('pf_object_view.uri') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
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
        $element->setLabel($this->_translate->_('pf_object_view.chave') . ':');
        $element->setAttribs(array('maxlength'=>'40','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);");
        return $element;
    }
            
}
?>