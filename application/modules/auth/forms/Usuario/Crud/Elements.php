<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela usuario
 */
class Auth_Form_Usuario_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_auth');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Form_Usuario_Elements
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
        $element->setLabel($this->_translate->_('usuario.id') . ':');
        $element->setAttribs(array('css-width'=>'192.5px','maxlength'=>'22'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdtipousuario(){

        $element = new ZendT_Form_Element_Seeker('idtipousuario');
        $element->setSuffix('tipousuario');
        $element->setLabel($this->_translate->_('usuario.idtipousuario') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('descricao');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
        $element->url()->setGrid('/auth/tipo-usuario/grid');
        $element->url()->setSearch('/auth/tipo-usuario/seeker-search');
        $element->url()->setRetrieve('/auth/tipo-usuario/retrive');
        $element->setMapperView('Auth_DataView_TipoUsuario_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getLogin(){

        $element = new ZendT_Form_Element_Text('login');
        $element->setLabel($this->_translate->_('usuario.login') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Password
     */
    public function getSenha(){

        $element = new ZendT_Form_Element_Text('senha');
        $element->setLabel($this->_translate->_('usuario.senha') . ':');
        $element->setAttribs(array('maxlength'=>'10','css-width'=>'100px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getNome(){

        $element = new ZendT_Form_Element_Text('nome');
        $element->setLabel($this->_translate->_('usuario.nome') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Date
     */
    public function getValidadesenha(){

        $element = new ZendT_Form_Element_Date('validadesenha');
        $element->setLabel($this->_translate->_('usuario.validadesenha') . ':');
        $element->setAttribs(array('css-width'=>'120px','maxlength'=>'10'));
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getTrocasenha(){

        $element = new ZendT_Form_Element_Select('trocasenha');
        $element->setLabel($this->_translate->_('usuario.trocasenha') . ':');
        $element->addMultiOption('', '');
        $element->addMultiOption('S', 'Sim');
        $element->addMultiOption('N', 'Não');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_DateTime
     */
    public function getDhtrocasenha(){

        $element = new ZendT_Form_Element_DateTime('dhtrocasenha');
        $element->setLabel($this->_translate->_('usuario.dhtrocasenha') . ':');
        $element->setDateAttribs(array('css-width'=>'150px'));
        $element->setTimeAttribs(array('css-width'=>'80px'));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getExpiracaosenha(){

        $element = new ZendT_Form_Element_Numeric('expiracaosenha');
        $element->setLabel($this->_translate->_('usuario.expiracaosenha') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','22');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getStatus(){

        $element = new ZendT_Form_Element_Select('status');
        $element->setLabel($this->_translate->_('usuario.status') . ':');
        $element->addMultiOption('', '');
        $element->addMultiOption('A', 'Ativo');
        $element->addMultiOption('I', 'Inativo');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getNerroslogin(){

        $element = new ZendT_Form_Element_Numeric('nerroslogin');
        $element->setLabel($this->_translate->_('usuario.nerroslogin') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','2');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getUsuarioadmin(){

        $element = new ZendT_Form_Element_Text('usuarioadmin');
        $element->setLabel($this->_translate->_('usuario.usuarioadmin') . ':');
        $element->setAttribs(array('maxlength'=>'1','css-width'=>'100px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getCgccpf(){

        $element = new ZendT_Form_Element_Text('cgccpf');
        $element->setLabel($this->_translate->_('usuario.cgccpf') . ':');
        $element->setAttribs(array('maxlength'=>'20','css-width'=>'25'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEndereco(){

        $element = new ZendT_Form_Element_Text('endereco');
        $element->setLabel($this->_translate->_('usuario.endereco') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getTelefone(){

        $element = new ZendT_Form_Element_Text('telefone');
        $element->setLabel($this->_translate->_('usuario.telefone') . ':');
        $element->setAttribs(array('maxlength'=>'20','css-width'=>'25'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEmail(){

        $element = new ZendT_Form_Element_Text('email');
        $element->setLabel($this->_translate->_('usuario.email') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtolower(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getUsuario(){

        $element = new ZendT_Form_Element_Text('usuario');
        $element->setLabel($this->_translate->_('usuario.usuario') . ':');
        $element->setAttribs(array('maxlength'=>'20','css-width'=>'25'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_DateTime
     */
    public function getDatahora(){

        $element = new ZendT_Form_Element_DateTime('datahora');
        $element->setLabel($this->_translate->_('usuario.datahora') . ':');
        $element->setDateAttribs(array('css-width'=>'120px'));
        $element->setTimeAttribs(array('css-width'=>'80px'));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getFax(){

        $element = new ZendT_Form_Element_Text('fax');
        $element->setLabel($this->_translate->_('usuario.fax') . ':');
        $element->setAttribs(array('maxlength'=>'20','css-width'=>'25'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getIdpessoal(){

        $element = new ZendT_Form_Element_Numeric('idpessoal');
        $element->setLabel($this->_translate->_('usuario.idpessoal') . ':');
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
    public function getChapa(){

        $element = new ZendT_Form_Element_Text('chapa');
        $element->setLabel($this->_translate->_('usuario.chapa') . ':');
        $element->setAttribs(array('maxlength'=>'10','css-width'=>'15'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getCodccustodef(){

        $element = new ZendT_Form_Element_Text('codccustodef');
        $element->setLabel($this->_translate->_('usuario.codccustodef') . ':');
        $element->setAttribs(array('maxlength'=>'10','css-width'=>'15'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getCodeof(){

        $element = new ZendT_Form_Element_Text('codeof');
        $element->setLabel($this->_translate->_('usuario.codeof') . ':');
        $element->setAttribs(array('maxlength'=>'30','css-width'=>'35'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdempresa(){

        $element = new ZendT_Form_Element_Seeker('idempresa');
        $element->setSuffix('empresa');
        $element->setLabel($this->_translate->_('usuario.idempresa') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('sigla');
        $element->setSearchAttribs(array('css-width'=>'70px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
        $element->url()->setGrid('/ca/empresa/grid');
        $element->url()->setSearch('/ca/empresa/seeker-search');
        $element->url()->setRetrieve('/ca/empresa/retrive');
        $element->setMapperView('Ca_DataView_Empresa_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('nome_pessoa');
        $element->setDisplayAttribs(array('css-width'=>'170px'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdempresadef(){

        $element = new ZendT_Form_Element_Seeker('idempresadef');
        $element->setSuffix('empresadef');
        $element->setLabel($this->_translate->_('usuario.idempresadef') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('sigla');
        $element->setSearchAttribs(array('css-width'=>'70px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
        $element->url()->setGrid('/ca/empresa/grid');
        $element->url()->setSearch('/ca/empresa/seeker-search');
        $element->url()->setRetrieve('/ca/empresa/retrive');
        $element->setMapperView('Ca_DataView_Empresa_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('nome_pessoa');
        $element->setDisplayAttribs(array('css-width'=>'170px'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdfilial(){

        $element = new ZendT_Form_Element_Seeker('idfilial');
        $element->setSuffix('filial');
        $element->setLabel($this->_translate->_('usuario.idfilial') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('sigla');
        $element->setSearchAttribs(array('css-width'=>'70px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
        $element->url()->setGrid('/ca/filial/grid');
        $element->url()->setSearch('/ca/filial/seeker-search');
        $element->url()->setRetrieve('/ca/filial/retrive');
        $element->setMapperView('Ca_DataView_Filial_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('nome_cidade');
        $element->setDisplayAttribs(array('css-width'=>'200px'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdusuarioresp(){

        $element = new ZendT_Form_Element_Seeker('idusuarioresp');
        $element->setSuffix('usuarioresp');
        $element->setLabel($this->_translate->_('usuario.idusuarioresp') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('login');
        $element->setSearchAttribs(array('css-width'=>'100px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
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
    public function getIdPapel(){

        $element = new ZendT_Form_Element_Seeker('id_papel');
        $element->setSuffix('papel');
        $element->setLabel($this->_translate->_('usuario.id_papel') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('size'=>'40'));
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
     * @return \ZendT_Form_Element_Select
     */
    public function getSolicInfoAdic(){

        $element = new ZendT_Form_Element_Select('solic_info_adic');
        $element->setLabel($this->_translate->_('usuario.solic_info_adic') . ':');
        $element->addMultiOption('', '');
        $element->addMultiOption('S', 'Sim');
        $element->addMultiOption('N', 'Não');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Textarea
     */
    public function getObservacao(){

        $element = new ZendT_Form_Element_Textarea('observacao');
        $element->setLabel($this->_translate->_('usuario.observacao') . ':');
        $element->enableEditorHtml(0);
        $element->setAttribs(array('maxlength'=>'500','cols'=>'50','rows'=>'5'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEmpresa(){

        $element = new ZendT_Form_Element_Text('empresa');
        $element->setLabel($this->_translate->_('usuario.empresa') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_DateTime
     */
    public function getDhUltLogon(){

        $element = new ZendT_Form_Element_DateTime('dh_ult_logon');
        $element->setLabel($this->_translate->_('usuario.dh_ult_logon') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getNtry(){

        $element = new ZendT_Form_Element_Numeric('ntry');
        $element->setLabel($this->_translate->_('usuario.ntry') . ':');
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
    public function getAvatar(){

        $element = new ZendT_Form_Element_Numeric('avatar');
        $element->setLabel($this->_translate->_('usuario.avatar') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>