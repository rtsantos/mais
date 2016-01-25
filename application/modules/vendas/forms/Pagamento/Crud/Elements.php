<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela cv_pagto_pedido
 */
class Vendas_Form_Pagamento_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_vendas');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Form_Pagamento_Elements
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
        $element->setLabel($this->_translate->_('cv_pagto_pedido.id') . ':');
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
        $element->setLabel($this->_translate->_('cv_pagto_pedido.id_pedido') . ':');
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
     * @return \ZendT_Form_Element_Select
     */
    public function getForma(){

        $element = new ZendT_Form_Element_Select('forma');
        $element->setLabel($this->_translate->_('cv_pagto_pedido.forma') . ':');
        $element->addMultiOption('D', 'Crediário');
        $element->addMultiOption('C', 'Cartão');
        $element->addMultiOption('Q', 'Cheque');
        $element->addMultiOption('F', 'Faturar');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getVlrTotal(){

        $element = new ZendT_Form_Element_Numeric('vlr_total');
        $element->setLabel($this->_translate->_('cv_pagto_pedido.vlr_total') . ':');
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
    public function getVlrPago(){

        $element = new ZendT_Form_Element_Numeric('vlr_pago');
        $element->setLabel($this->_translate->_('cv_pagto_pedido.vlr_pago') . ':');
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
    public function getVlrDesc(){

        $element = new ZendT_Form_Element_Numeric('vlr_desc');
        $element->setLabel($this->_translate->_('cv_pagto_pedido.vlr_desc') . ':');
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
    public function getVlrAcrec(){

        $element = new ZendT_Form_Element_Numeric('vlr_acrec');
        $element->setLabel($this->_translate->_('cv_pagto_pedido.vlr_acrec') . ':');
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
    public function getNroParc(){

        $element = new ZendT_Form_Element_Numeric('vlr_acrec');
        $element->setLabel($this->_translate->_('cv_pagto_pedido.vlr_acrec') . ':');
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
    public function getVlrParc(){

        $element = new ZendT_Form_Element_Numeric('vlr_parc');
        $element->setLabel($this->_translate->_('cv_pagto_pedido.vlr_parc') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','4');
        $element->setJQueryParam('numInteger','11');
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>