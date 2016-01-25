<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela cv_produto
 */
class Vendas_Form_Produto_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_vendas');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Form_Produto_Elements
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
        $element->setLabel($this->_translate->_('cv_produto.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getCodigo(){

        $element = new ZendT_Form_Element_Text('codigo');
        $element->setLabel($this->_translate->_('cv_produto.codigo') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getNome(){

        $element = new ZendT_Form_Element_Text('nome');
        $element->setLabel($this->_translate->_('cv_produto.nome') . ':');
        $element->setAttribs(array('maxlength'=>'60','css-width'=>'200px'));        
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
        $element->setLabel($this->_translate->_('cv_produto.tipo') . ':');
        $element->addMultiOption('S', 'Serviço');
        $element->addMultiOption('P', 'Produto');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getApelido(){

        $element = new ZendT_Form_Element_Text('apelido');
        $element->setLabel($this->_translate->_('cv_produto.apelido') . ':');
        $element->setAttribs(array('maxlength'=>'45','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getVlrVenda(){

        $element = new ZendT_Form_Element_Numeric('vlr_venda');
        $element->setLabel($this->_translate->_('cv_produto.vlr_venda') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','4');
        $element->setJQueryParam('numInteger','11');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getVlrCompra(){

        $element = new ZendT_Form_Element_Numeric('vlr_compra');
        $element->setLabel($this->_translate->_('cv_produto.vlr_compra') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','4');
        $element->setJQueryParam('numInteger','11');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getMedida(){

        $element = new ZendT_Form_Element_Select('medida');
        $element->setLabel($this->_translate->_('cv_produto.medida') . ':');
        $element->addMultiOption('Q', 'Quantidade');
        $element->addMultiOption('M', 'Metro');
        $element->addMultiOption('K', 'Kilo');
        $element->addMultiOption('L', 'Litro');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getQtdEstoque(){

        $element = new ZendT_Form_Element_Numeric('qtd_estoque');
        $element->setLabel($this->_translate->_('cv_produto.qtd_estoque') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','4');
        $element->setJQueryParam('numInteger','11');
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
        $element->setLabel($this->_translate->_('cv_produto.id_cliente') . ':');
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
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdProdutoResp(){

        $element = new ZendT_Form_Element_Seeker('id_produto_resp');
        $element->setSuffix('produto_resp');
        $element->setLabel($this->_translate->_('cv_produto.id_produto_resp') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('codigo');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/vendas/produto/grid');
        $element->url()->setSearch('/vendas/produto/seeker-search');
        $element->url()->setRetrieve('/vendas/produto/retrieve');
        $element->setMapperView('Vendas_DataView_Produto_MapperView');
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
        $element->setLabel($this->_translate->_('cv_produto.id_empresa') . ':');
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
            
}
?>