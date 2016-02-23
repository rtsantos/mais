<?php
/**
 * Classe de mapeamento da tabela cv_pagto_lanc
 */
class Vendas_Model_PagtoLanc_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'cv_pagto_lanc';
    protected $_alias = 'cv_pagto_lanc';
    protected $_sequence = 'sid_cv_pagto_lanc';
    protected $_required = array('id');
    protected $_primary = array('id');
    protected $_unique = array('id_pagto_pedido','id_lancamento');
    protected $_cols = array('id','id_pagto_pedido','id_lancamento');
    protected $_search = '';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdPagtoPedido' => array(
                    'columns' => 'id_pagto_pedido',
                    'refTableClass' => 'Vendas_Model_Pagamento_Table',
                    'refColumns' => 'id'
                ),
                'IdLancamento' => array(
                    'columns' => 'id_lancamento',
                    'refTableClass' => 'Financeiro_Model_Lancamento_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Vendas_Model_PagtoLanc_Mapper';
    protected $_element = 'Vendas_Form_PagtoLanc_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Model_PagtoLanc_Element
     */
    public function getElement($columnName){
        $_element = new Vendas_Form_PagtoLanc_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Vendas_Model_PagtoLanc_Mapper
     */
    public function getMapper(){    
        $mapper = new Vendas_Model_PagtoLanc_Mapper();
        return $mapper;
    }
    
    /**
     * Retorna um array contendo todas as colunas obrigatórias
     *
     * @return array
     */
    public function getRequired() {
        return $this->_required;
    }
    
    /**
     * Informa se a coluna é obrigatória
     *
     * @param string $field
     * @return boolean
     */
    public function isRequired($field) {
        return in_array($field, $this->_required);
    }
    
}
?>