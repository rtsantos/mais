<?php
/**
 * Classe de mapeamento da tabela cv_item_pedido
 */
class Vendas_Model_ItemPedido_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CV_ITEM_PEDIDO';
    protected $_sequence = 'SID_ITEM_PEDIDO';
    protected $_required = array('ID','ID_PEDIDO','ID_PRODUTO','ID_USU_INC','ID_USU_ALT');
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','ID_PEDIDO','ID_PRODUTO','ID_USU_INC','ID_USU_ALT','QTD_ITEM','VLR_ITEM','PER_DESC','CALCULO','PER_ACRE','VLR_FINAL');
    protected $_search = 'calculo';
    protected $_schema  = 'MAIS';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdPedido' => array(
                    'columns' => 'id_pedido',
                    'refTableClass' => 'Vendas_Model_Pedido_Table',
                    'refColumns' => 'id'
                ),
                'IdProduto' => array(
                    'columns' => 'id_produto',
                    'refTableClass' => 'Vendas_Model_Produto_Table',
                    'refColumns' => 'id'
                ),
                'IdUsuInc' => array(
                    'columns' => 'id_usu_inc',
                    'refTableClass' => 'Auth_Model_Conta_Table',
                    'refColumns' => 'id'
                ),
                'IdUsuAlt' => array(
                    'columns' => 'id_usu_alt',
                    'refTableClass' => 'Auth_Model_Conta_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Vendas_Model_ItemPedido_Mapper';
    protected $_element = 'Vendas_Form_ItemPedido_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Model_ItemPedido_Element
     */
    public function getElement($columnName){
        $_element = new Vendas_Form_ItemPedido_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Vendas_Model_ItemPedido_Mapper
     */
    public function getMapper(){    
        $mapper = new Vendas_Model_ItemPedido_Mapper();
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