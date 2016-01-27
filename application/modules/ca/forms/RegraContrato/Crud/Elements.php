<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela ca_regra_contrato
 */
class Ca_Form_RegraContrato_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_ca');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ca_Form_RegraContrato_Elements
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
        $element->setLabel($this->_translate->_('ca_regra_contrato.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdContrato(){

        $element = new ZendT_Form_Element_Seeker('id_contrato');
        $element->setSuffix('contrato');
        $element->setLabel($this->_translate->_('ca_regra_contrato.id_contrato') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('descricao');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/contrato/grid');
        $element->url()->setSearch('/ca/contrato/seeker-search');
        $element->url()->setRetrieve('/ca/contrato/retrieve');
        $element->setMapperView('Ca_DataView_Contrato_MapperView');
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
        $element->setLabel($this->_translate->_('ca_regra_contrato.id_produto') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('codigo');
        $element->setSearchAttribs(array('css-width'=>'70px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/vendas/produto/grid/profile_key/produto');
        $element->url()->setSearch('/vendas/produto/seeker-search/profile_key/produto');
        $element->url()->setRetrieve('/vendas/produto/retrieve/profile_key/produto');
        $element->setMapperView('Vendas_DataView_Produto_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('nome');
        $element->setDisplayAttribs(array('css-width'=>'200px'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getStatus(){

        $element = new ZendT_Form_Element_Select('status');
        $element->setLabel($this->_translate->_('ca_regra_contrato.status') . ':');
        $element->addMultiOption('A', 'Ativo');
        $element->addMultiOption('I', 'Inativo');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getVlrFixo(){

        $element = new ZendT_Form_Element_Numeric('vlr_fixo');
        $element->setLabel($this->_translate->_('ca_regra_contrato.vlr_fixo') . ':');
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
    public function getVlrMin(){

        $element = new ZendT_Form_Element_Numeric('vlr_min');
        $element->setLabel($this->_translate->_('ca_regra_contrato.vlr_min') . ':');
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
    public function getVlrPerc(){

        $element = new ZendT_Form_Element_Numeric('vlr_perc');
        $element->setLabel($this->_translate->_('ca_regra_contrato.vlr_perc') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','4');
        $element->setJQueryParam('numInteger','4');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getTipo(){

        $element = new ZendT_Form_Element_Select('tipo');
        $element->setLabel($this->_translate->_('ca_regra_contrato.tipo') . ':');
        $element->addMultiOption('PA', 'Acréscimo de Preço');
        $element->addMultiOption('PD', 'Desconto de Preço');
        $element->addMultiOption('CD', 'Custeio de Débito');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getFavorecido(){

        $element = new ZendT_Form_Element_Select('favorecido');
        $element->setLabel($this->_translate->_('ca_regra_contrato.favorecido') . ':');
        $element->addMultiOption('ca_pedido.id_cliente', 'Cliente do Pedido');
        $element->addMultiOption('ca_pedido.id_cont_cli_resp', 'Gerente do Cliente');
        $element->addMultiOption('ca_pedido.id_cont_cli_vend', 'Vendedor do Cliente');        
                
        return $element;
    }
            
}
?>