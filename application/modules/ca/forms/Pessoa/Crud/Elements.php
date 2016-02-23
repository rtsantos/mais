<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela ca_pessoa
 */
class Ca_Form_Pessoa_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_ca');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ca_Form_Pessoa_Elements
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
        $element->setLabel($this->_translate->_('ca_pessoa.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getNome(){

        $element = new ZendT_Form_Element_Text('nome');
        $element->setLabel($this->_translate->_('ca_pessoa.nome') . ':');
        $element->setAttribs(array('maxlength'=>'60','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getApelido(){

        $element = new ZendT_Form_Element_Text('apelido');
        $element->setLabel($this->_translate->_('ca_pessoa.apelido') . ':');
        $element->setAttribs(array('maxlength'=>'45','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getCodigo(){

        $element = new ZendT_Form_Element_Text('codigo');
        $element->setLabel($this->_translate->_('ca_pessoa.codigo') . ':');
        $element->setAttribs(array('maxlength'=>'20','css-width'=>'175px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        $element->setMask(array (
  0 => '999.999.999-99',
  1 => '99.999.999/9999-99',
));
        $element->setCharMask('9');
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEmail(){

        $element = new ZendT_Form_Element_Text('email');
        $element->setLabel($this->_translate->_('ca_pessoa.email') . ':');
        $element->setAttribs(array('maxlength'=>'70','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtolower(this.value);this.value=removeAccent(this.value);this.value=trim(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdPessoaResp(){

        $element = new ZendT_Form_Element_Seeker('id_pessoa_resp');
        $element->setSuffix('pessoa_resp');
        $element->setLabel($this->_translate->_('ca_pessoa.id_pessoa_resp') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/pessoa/grid');
        $element->url()->setSearch('/ca/pessoa/seeker-search');
        $element->url()->setRetrieve('/ca/pessoa/retrieve');
        $element->setMapperView('Ca_DataView_Pessoa_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getTelefone(){

        $element = new ZendT_Form_Element_Text('telefone');
        $element->setLabel($this->_translate->_('ca_pessoa.telefone') . ':');
        $element->setAttribs(array('maxlength'=>'45','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        $element->setMask(array (
  0 => '99 9999-9999',
));
        $element->setCharMask('9');
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getCelular(){

        $element = new ZendT_Form_Element_Text('celular');
        $element->setLabel($this->_translate->_('ca_pessoa.celular') . ':');
        $element->setAttribs(array('maxlength'=>'45','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        $element->setMask(array (
  0 => '99 9999-9999',
  1 => '99 9.9999-9999',
));
        $element->setCharMask('9');
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getFax(){

        $element = new ZendT_Form_Element_Text('fax');
        $element->setLabel($this->_translate->_('ca_pessoa.fax') . ':');
        $element->setAttribs(array('maxlength'=>'45','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        $element->setMask(array (
  0 => '99 9999-9999',
));
        $element->setCharMask('9');
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEdLogr(){

        $element = new ZendT_Form_Element_Text('ed_logr');
        $element->setLabel($this->_translate->_('ca_pessoa.ed_logr') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEdNumero(){

        $element = new ZendT_Form_Element_Text('ed_numero');
        $element->setLabel($this->_translate->_('ca_pessoa.ed_numero') . ':');
        $element->setAttribs(array('maxlength'=>'30','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEdCompl(){

        $element = new ZendT_Form_Element_Text('ed_compl');
        $element->setLabel($this->_translate->_('ca_pessoa.ed_compl') . ':');
        $element->setAttribs(array('maxlength'=>'60','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEdBairro(){

        $element = new ZendT_Form_Element_Text('ed_bairro');
        $element->setLabel($this->_translate->_('ca_pessoa.ed_bairro') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEdCidade(){

        $element = new ZendT_Form_Element_Text('ed_cidade');
        $element->setLabel($this->_translate->_('ca_pessoa.ed_cidade') . ':');
        $element->setAttribs(array('maxlength'=>'60','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEdEstado(){

        $element = new ZendT_Form_Element_Text('ed_estado');
        $element->setLabel($this->_translate->_('ca_pessoa.ed_estado') . ':');
        $element->setAttribs(array('maxlength'=>'2','css-width'=>'100px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEdCep(){

        $element = new ZendT_Form_Element_Text('ed_cep');
        $element->setLabel($this->_translate->_('ca_pessoa.ed_cep') . ':');
        $element->setAttribs(array('maxlength'=>'10','css-width'=>'100px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        $element->setMask(array (
  0 => '99.999-999',
));
        $element->setCharMask('9');
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEdCobLogr(){

        $element = new ZendT_Form_Element_Text('ed_cob_logr');
        $element->setLabel($this->_translate->_('ca_pessoa.ed_cob_logr') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEdCobNumero(){

        $element = new ZendT_Form_Element_Text('ed_cob_numero');
        $element->setLabel($this->_translate->_('ca_pessoa.ed_cob_numero') . ':');
        $element->setAttribs(array('maxlength'=>'30','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEdCobCompl(){

        $element = new ZendT_Form_Element_Text('ed_cob_compl');
        $element->setLabel($this->_translate->_('ca_pessoa.ed_cob_compl') . ':');
        $element->setAttribs(array('maxlength'=>'60','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEdCobBairro(){

        $element = new ZendT_Form_Element_Text('ed_cob_bairro');
        $element->setLabel($this->_translate->_('ca_pessoa.ed_cob_bairro') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEdCobCidade(){

        $element = new ZendT_Form_Element_Text('ed_cob_cidade');
        $element->setLabel($this->_translate->_('ca_pessoa.ed_cob_cidade') . ':');
        $element->setAttribs(array('maxlength'=>'60','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEdCobEstado(){

        $element = new ZendT_Form_Element_Text('ed_cob_estado');
        $element->setLabel($this->_translate->_('ca_pessoa.ed_cob_estado') . ':');
        $element->setAttribs(array('maxlength'=>'2','css-width'=>'100px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEdCobCep(){

        $element = new ZendT_Form_Element_Text('ed_cob_cep');
        $element->setLabel($this->_translate->_('ca_pessoa.ed_cob_cep') . ':');
        $element->setAttribs(array('maxlength'=>'10','css-width'=>'100px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        $element->setMask(array (
  0 => '99.999-999',
));
        $element->setCharMask('9');
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getPapelCliente(){

        $element = new ZendT_Form_Element_Select('papel_cliente');
        $element->setLabel($this->_translate->_('ca_pessoa.papel_cliente') . ':');
        $element->addMultiOption('1', 'Sim');
        $element->addMultiOption('0', 'Não');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getPapelFuncionario(){

        $element = new ZendT_Form_Element_Select('papel_funcionario');
        $element->setLabel($this->_translate->_('ca_pessoa.papel_funcionario') . ':');
        $element->addMultiOption('1', 'Sim');
        $element->addMultiOption('0', 'Não');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getPapelUsuario(){

        $element = new ZendT_Form_Element_Select('papel_usuario');
        $element->setLabel($this->_translate->_('ca_pessoa.papel_usuario') . ':');
        $element->addMultiOption('1', 'Sim');
        $element->addMultiOption('0', 'Não');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getPapelEmpresa(){

        $element = new ZendT_Form_Element_Select('papel_empresa');
        $element->setLabel($this->_translate->_('ca_pessoa.papel_empresa') . ':');
        $element->addMultiOption('1', 'Sim');
        $element->addMultiOption('0', 'Não');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getRegistro(){

        $element = new ZendT_Form_Element_Text('registro');
        $element->setLabel($this->_translate->_('ca_pessoa.registro') . ':');
        $element->setAttribs(array('maxlength'=>'45','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdEmpresa(){

        $element = new ZendT_Form_Element_Seeker('id_empresa');
        $element->setSuffix('empresa');
        $element->setLabel($this->_translate->_('ca_pessoa.id_empresa') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/pessoa/grid');
        $element->url()->setSearch('/ca/pessoa/seeker-search');
        $element->url()->setRetrieve('/ca/pessoa/retrieve');
        $element->setMapperView('Ca_DataView_Pessoa_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getEmailCob(){

        $element = new ZendT_Form_Element_Text('email_cob');
        $element->setLabel($this->_translate->_('ca_pessoa.email_cob') . ':');
        $element->setAttribs(array('maxlength'=>'60','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getHierarquia(){

        $element = new ZendT_Form_Element_Text('hierarquia');
        $element->setLabel($this->_translate->_('ca_pessoa.hierarquia') . ':');
        $element->setAttribs(array('maxlength'=>'150','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getPapelContato(){

        $element = new ZendT_Form_Element_Select('papel_contato');
        $element->setLabel($this->_translate->_('ca_pessoa.papel_contato') . ':');
        $element->addMultiOption('1', 'Sim');
        $element->addMultiOption('0', 'Não');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdCargo(){

        $element = new ZendT_Form_Element_Seeker('id_cargo');
        $element->setSuffix('cargo');
        $element->setLabel($this->_translate->_('ca_pessoa.id_cargo') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('descricao');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/cargo/grid');
        $element->url()->setSearch('/ca/cargo/seeker-search');
        $element->url()->setRetrieve('/ca/cargo/retrieve');
        $element->setMapperView('Ca_DataView_Cargo_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getPapelFornecedor(){

        $element = new ZendT_Form_Element_Select('papel_fornecedor');
        $element->setLabel($this->_translate->_('ca_pessoa.papel_fornecedor') . ':');
        $element->addMultiOption('1', 'Sim');
        $element->addMultiOption('0', 'Não');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdEndereco(){

        $element = new ZendT_Form_Element_Seeker('id_endereco');
        $element->setSuffix('endereco');
        $element->setLabel($this->_translate->_('ca_pessoa.id_endereco') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('logradouro');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/endereco/grid');
        $element->url()->setSearch('/ca/endereco/seeker-search');
        $element->url()->setRetrieve('/ca/endereco/retrieve');
        $element->setMapperView('Ca_DataView_Endereco_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdEnderecoCob(){

        $element = new ZendT_Form_Element_Seeker('id_endereco_cob');
        $element->setSuffix('endereco_cob');
        $element->setLabel($this->_translate->_('ca_pessoa.id_endereco_cob') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('logradouro');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/endereco/grid');
        $element->url()->setSearch('/ca/endereco/seeker-search');
        $element->url()->setRetrieve('/ca/endereco/retrieve');
        $element->setMapperView('Ca_DataView_Endereco_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdBanco(){

        $element = new ZendT_Form_Element_Seeker('id_banco');
        $element->setSuffix('banco');
        $element->setLabel($this->_translate->_('ca_pessoa.id_banco') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/financeiro/banco/grid');
        $element->url()->setSearch('/financeiro/banco/seeker-search');
        $element->url()->setRetrieve('/financeiro/banco/retrieve');
        $element->setMapperView('Financeiro_DataView_Banco_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getAgBanco(){

        $element = new ZendT_Form_Element_Text('ag_banco');
        $element->setLabel($this->_translate->_('ca_pessoa.ag_banco') . ':');
        $element->setAttribs(array('maxlength'=>'10','css-width'=>'100px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getAgDigBanco(){

        $element = new ZendT_Form_Element_Text('ag_dig_banco');
        $element->setLabel($this->_translate->_('ca_pessoa.ag_dig_banco') . ':');
        $element->setAttribs(array('maxlength'=>'2','css-width'=>'100px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getContaBanco(){

        $element = new ZendT_Form_Element_Text('conta_banco');
        $element->setLabel($this->_translate->_('ca_pessoa.conta_banco') . ':');
        $element->setAttribs(array('maxlength'=>'20','css-width'=>'175px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getContaDigBanco(){

        $element = new ZendT_Form_Element_Text('conta_dig_banco');
        $element->setLabel($this->_translate->_('ca_pessoa.conta_dig_banco') . ':');
        $element->setAttribs(array('maxlength'=>'2','css-width'=>'100px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getCodTitBanco(){

        $element = new ZendT_Form_Element_Text('cod_tit_banco');
        $element->setLabel($this->_translate->_('ca_pessoa.cod_tit_banco') . ':');
        $element->setAttribs(array('maxlength'=>'20','css-width'=>'175px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
}
?>