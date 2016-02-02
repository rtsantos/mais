<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela cv_pagto_lanc
 */
class Vendas_Form_PagtoLanc_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_vendas');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Form_PagtoLanc_Elements
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
        $element->setLabel($this->_translate->_('cv_pagto_lanc.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdPagtoPedido(){

        $element = new ZendT_Form_Element_Seeker('id_pagto_pedido');
        $element->setSuffix('pagto_pedido');
        $element->setLabel($this->_translate->_('cv_pagto_lanc.id_pagto_pedido') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('forma');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/vendas/pagamento/grid');
        $element->url()->setSearch('/vendas/pagamento/seeker-search');
        $element->url()->setRetrieve('/vendas/pagamento/retrieve');
        $element->setMapperView('Vendas_DataView_Pagamento_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdLancamento(){

        $element = new ZendT_Form_Element_Seeker('id_lancamento');
        $element->setSuffix('lancamento');
        $element->setLabel($this->_translate->_('cv_pagto_lanc.id_lancamento') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('tipo');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/financeiro/lancamento/grid');
        $element->url()->setSearch('/financeiro/lancamento/seeker-search');
        $element->url()->setRetrieve('/financeiro/lancamento/retrieve');
        $element->setMapperView('Financeiro_DataView_Lancamento_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>