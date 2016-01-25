<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela cv_pedido
 */
class Vendas_Form_Pedido_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_vendas');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Form_Pedido_Elements
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
        $element->setLabel($this->_translate->_('cv_pedido.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getNumero(){

        $element = new ZendT_Form_Element_Text('numero');
        $element->setLabel($this->_translate->_('cv_pedido.numero') . ':');
        $element->setAttribs(array('maxlength'=>'10','css-width'=>'100px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getTipo(){

        $element = new ZendT_Form_Element_Select('tipo');
        $element->setLabel($this->_translate->_('cv_pedido.tipo') . ':');
        $element->addMultiOption('V', 'Venda');
        $element->addMultiOption('C', 'Compra');
        $element->addMultiOption('O', 'Orçamento');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdUsuInc(){

        $element = new ZendT_Form_Element_Seeker('id_usu_inc');
        $element->setSuffix('usu_inc');
        $element->setLabel($this->_translate->_('cv_pedido.id_usu_inc') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/auth/conta/grid/profile_key/usuario');
        $element->url()->setSearch('/auth/conta/seeker-search/profile_key/usuario');
        $element->url()->setRetrieve('/auth/conta/retrieve/profile_key/usuario');
        $element->setMapperView('Auth_DataView_Conta_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdUsuAlt(){

        $element = new ZendT_Form_Element_Seeker('id_usu_alt');
        $element->setSuffix('usu_alt');
        $element->setLabel($this->_translate->_('cv_pedido.id_usu_alt') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/auth/conta/grid/profile_key/usuario');
        $element->url()->setSearch('/auth/conta/seeker-search/profile_key/usuario');
        $element->url()->setRetrieve('/auth/conta/retrieve/profile_key/usuario');
        $element->setMapperView('Auth_DataView_Conta_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdEmpresa(){

        $element = new ZendT_Form_Element_Seeker('id_empresa');
        $element->setSuffix('empresa');
        $element->setLabel($this->_translate->_('cv_pedido.id_empresa') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/pessoa/grid/profile_key/empresa');
        $element->url()->setSearch('/ca/pessoa/seeker-search/profile_key/empresa');
        $element->url()->setRetrieve('/ca/pessoa/retrieve/profile_key/empresa');
        $element->setMapperView('Ca_DataView_Pessoa_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdFuncionario(){

        $element = new ZendT_Form_Element_Seeker('id_funcionario');
        $element->setSuffix('funcionario');
        $element->setLabel($this->_translate->_('cv_pedido.id_funcionario') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/pessoa/grid/profile_key/funcionario');
        $element->url()->setSearch('/ca/pessoa/seeker-search/profile_key/funcionario');
        $element->url()->setRetrieve('/ca/pessoa/retrieve/profile_key/funcionario');
        $element->setMapperView('Ca_DataView_Pessoa_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdCliente(){

        $element = new ZendT_Form_Element_Seeker('id_cliente');
        $element->setSuffix('cliente');
        $element->setLabel($this->_translate->_('cv_pedido.id_cliente') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/pessoa/grid/profile_key/cliente');
        $element->url()->setSearch('/ca/pessoa/seeker-search/profile_key/cliente');
        $element->url()->setRetrieve('/ca/pessoa/retrieve/profile_key/cliente');
        $element->setMapperView('Ca_DataView_Pessoa_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdContCliResp(){

        $element = new ZendT_Form_Element_Seeker('id_cont_cli_resp');
        $element->setSuffix('cont_cli_resp');
        $element->setLabel($this->_translate->_('cv_pedido.id_cont_cli_resp') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/pessoa/grid/profile_key/cont_resp');
        $element->url()->setSearch('/ca/pessoa/seeker-search/profile_key/cont_resp');
        $element->url()->setRetrieve('/ca/pessoa/retrieve/profile_key/cont_resp');
        $element->setMapperView('Ca_DataView_Pessoa_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdContCliVend(){

        $element = new ZendT_Form_Element_Seeker('id_cont_cli_vend');
        $element->setSuffix('cont_cli_vend');
        $element->setLabel($this->_translate->_('cv_pedido.id_cont_cli_vend') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/pessoa/grid/profile_key/cont_vend');
        $element->url()->setSearch('/ca/pessoa/seeker-search/profile_key/cont_vend');
        $element->url()->setRetrieve('/ca/pessoa/retrieve/profile_key/cont_vend');
        $element->setMapperView('Ca_DataView_Pessoa_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getStatus(){

        $element = new ZendT_Form_Element_Select('status');
        $element->setLabel($this->_translate->_('cv_pedido.status') . ':');
        $element->addMultiOption('A', 'Aberto');
        $element->addMultiOption('C', 'Confirmado');
        $element->addMultiOption('E', 'Efetivado');        
                
        return $element;
    }
            
}
?>