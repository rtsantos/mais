<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela cv_item_pedido
 */
class Vendas_Form_ItemPedido_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_vendas');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Form_ItemPedido_Elements
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
        $element->setLabel($this->_translate->_('cv_item_pedido.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdPedido(){

        $element = new ZendT_Form_Element_Seeker('id_pedido');
        $element->setSuffix('pedido');
        $element->setLabel($this->_translate->_('cv_item_pedido.id_pedido') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('numero');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/vendas/pedido/grid');
        $element->url()->setSearch('/vendas/pedido/seeker-search');
        $element->url()->setRetrieve('/vendas/pedido/retrieve');
        $element->setMapperView('Vendas_DataView_Pedido_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdProduto(){

        $element = new ZendT_Form_Element_Seeker('id_produto');
        $element->setSuffix('produto');
        $element->setLabel($this->_translate->_('cv_item_pedido.id_produto') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('codigo');
        $element->setSearchAttribs(array('css-width'=>'70px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/vendas/produto/grid/mapper/produto-contrato/profile_key/vendas');
        $element->url()->setSearch('/vendas/produto/seeker-search/mapper/produto-contrato/profile_key/vendas');
        $element->url()->setRetrieve('/vendas/produto/retrieve/mapper/produto-contrato/profile_key/vendas');
        $element->setMapperView('Vendas_DataView_Produto_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('nome');
        $element->setDisplayAttribs(array('css-width'=>'200px'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdUsuInc(){

        $element = new ZendT_Form_Element_Seeker('id_usu_inc');
        $element->setSuffix('usu_inc');
        $element->setLabel($this->_translate->_('cv_item_pedido.id_usu_inc') . ':');
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
        $element->setLabel($this->_translate->_('cv_item_pedido.id_usu_alt') . ':');
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
     * @return \ZendT_Form_Element_Numeric
     */
    public function getQtdItem(){

        $element = new ZendT_Form_Element_Numeric('qtd_item');
        $element->setLabel($this->_translate->_('cv_item_pedido.qtd_item') . ':');
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
    public function getVlrItem(){

        $element = new ZendT_Form_Element_Numeric('vlr_item');
        $element->setLabel($this->_translate->_('cv_item_pedido.vlr_item') . ':');
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
    public function getPerDesc(){

        $element = new ZendT_Form_Element_Numeric('per_desc');
        $element->setLabel($this->_translate->_('cv_item_pedido.per_desc') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','4');
        $element->setJQueryParam('numInteger','11');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getCalculo(){

        $element = new ZendT_Form_Element_Text('calculo');
        $element->setLabel($this->_translate->_('cv_item_pedido.calculo') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getPerAcre(){

        $element = new ZendT_Form_Element_Numeric('per_acre');
        $element->setLabel($this->_translate->_('cv_item_pedido.per_acre') . ':');
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
    public function getVlrFinal(){

        $element = new ZendT_Form_Element_Numeric('vlr_final');
        $element->setLabel($this->_translate->_('cv_item_pedido.vlr_final') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','4');
        $element->setJQueryParam('numInteger','11');
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>