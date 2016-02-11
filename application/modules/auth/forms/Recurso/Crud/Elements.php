<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela at_recurso
 */
class Auth_Form_Recurso_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_auth');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Form_Recurso_Elements
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
        $element->setLabel($this->_translate->_('at_recurso.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdTipoRecurso(){

        $element = new ZendT_Form_Element_Seeker('id_tipo_recurso');
        $element->setSuffix('tipo_recurso');
        $element->setLabel($this->_translate->_('at_recurso.id_tipo_recurso') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('width'=>'50'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
        $element->url()->setGrid('/auth/tipo-recurso/grid');
        $element->url()->setSearch('/auth/tipo-recurso/seeker-search');
        $element->url()->setRetrieve('/auth/tipo-recurso/retrive');
        $element->setMapperView('Auth_DataView_TipoRecurso_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdAplicacao(){

        $element = new ZendT_Form_Element_Seeker('id_aplicacao');
        $element->setSuffix('aplicacao');
        $element->setLabel($this->_translate->_('at_recurso.id_aplicacao') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('sigla');
        $element->setSearchAttribs(array('css-width'=>'80px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/auth/aplicacao/grid');
        $element->url()->setSearch('/auth/aplicacao/seeker-search');
        $element->url()->setRetrieve('/auth/aplicacao/retrieve');
        $element->setMapperView('Auth_DataView_Aplicacao_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('nome');
        $element->setDisplayAttribs(array('css-width'=>'190px'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdRecursoPai(){

        $element = new ZendT_Form_Element_Seeker('id_recurso_pai');
        $element->setSuffix('recurso_pai');
        $element->setLabel($this->_translate->_('at_recurso.id_recurso_pai') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('hierarquia');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/auth/recurso/grid');
        $element->url()->setSearch('/auth/recurso/seeker-search');
        $element->url()->setRetrieve('/auth/recurso/retrieve');
        $element->setMapperView('Auth_DataView_Recurso_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getNome(){

        $element = new ZendT_Form_Element_Text('nome');
        $element->setLabel($this->_translate->_('at_recurso.nome') . ':');
        $element->setAttribs(array('maxlength'=>'80','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getHierarquia(){

        $element = new ZendT_Form_Element_Text('hierarquia');
        $element->setLabel($this->_translate->_('at_recurso.hierarquia') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtolower(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getDescricao(){

        $element = new ZendT_Form_Element_Text('descricao');
        $element->setLabel($this->_translate->_('at_recurso.descricao') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getStatus(){

        $element = new ZendT_Form_Element_Select('status');
        $element->setLabel($this->_translate->_('at_recurso.status') . ':');
        $element->addMultiOption('A', 'Ativo');
        $element->addMultiOption('I', 'Inativo');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getIcone(){

        $element = new ZendT_Form_Element_Text('icone');
        $element->setLabel($this->_translate->_('at_recurso.icone') . ':');
        $element->setAttribs(array('maxlength'=>'30','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getObservacao(){

        $element = new ZendT_Form_Element_Text('observacao');
        $element->setLabel($this->_translate->_('at_recurso.observacao') . ':');
        $element->setAttribs(array('maxlength'=>'4000','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getOrdem(){

        $element = new ZendT_Form_Element_Text('observacao');
        $element->setLabel($this->_translate->_('at_recurso.observacao') . ':');
        $element->setAttribs(array('maxlength'=>'4000','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getNivel(){

        $element = new ZendT_Form_Element_Text('observacao');
        $element->setLabel($this->_translate->_('at_recurso.observacao') . ':');
        $element->setAttribs(array('maxlength'=>'4000','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);");
        return $element;
    }
            
}
?>