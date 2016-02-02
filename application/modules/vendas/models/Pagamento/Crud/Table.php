<?php
/**
 * Classe de mapeamento da tabela cv_pagto_pedido
 */
class Vendas_Model_Pagamento_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CV_PAGTO_PEDIDO';
    protected $_sequence = 'SID_CV_PAGTO_PEDIDO';
    protected $_required = array('ID','ID_PEDIDO','VLR_TOTAL');
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','ID_PEDIDO','VLR_TOTAL','VLR_PAGO','PER_ACRE','VLR_PARC','VLR_A_PAGAR','PER_DESC','NRO_COMPROV','ID_FORMA_PAGTO','ID_PARCELA','DT_VENC_PARC');
    protected $_search = 'forma';
    protected $_schema  = 'MAIS';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdPedido' => array(
                    'columns' => 'id_pedido',
                    'refTableClass' => 'Vendas_Model_Pedido_Table',
                    'refColumns' => 'id'
                ),
                'IdFormaPagto' => array(
                    'columns' => 'id_forma_pagto',
                    'refTableClass' => 'Vendas_Model_FormaPagamento_Table',
                    'refColumns' => 'id'
                ),
                'IdParcela' => array(
                    'columns' => 'id_parcela',
                    'refTableClass' => 'Vendas_Model_Parcela_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Vendas_Model_Pagamento_Mapper';
    protected $_element = 'Vendas_Form_Pagamento_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Model_Pagamento_Element
     */
    public function getElement($columnName){
        $_element = new Vendas_Form_Pagamento_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Vendas_Model_Pagamento_Mapper
     */
    public function getMapper(){    
        $mapper = new Vendas_Model_Pagamento_Mapper();
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