<?php
/**
 * Classe de mapeamento da tabela cv_item_lanc
 */
class Vendas_Model_ItemLanc_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CV_ITEM_LANC';
    protected $_sequence = 'SID_CV_ITEM_LANC';
    protected $_required = array('ID','ID_ITEM_PEDIDO','ID_LANCAMENTO');
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','ID_ITEM_PEDIDO','ID_LANCAMENTO');
    protected $_search = '';
    protected $_schema  = 'MAIS';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdItemPedido' => array(
                    'columns' => 'id_item_pedido',
                    'refTableClass' => 'Vendas_Model_ItemPedido_Table',
                    'refColumns' => 'id'
                ),
                'IdLancamento' => array(
                    'columns' => 'id_lancamento',
                    'refTableClass' => 'Financeiro_Model_Lancamento_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Vendas_Model_ItemLanc_Mapper';
    protected $_element = 'Vendas_Form_ItemLanc_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Model_ItemLanc_Element
     */
    public function getElement($columnName){
        $_element = new Vendas_Form_ItemLanc_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Vendas_Model_ItemLanc_Mapper
     */
    public function getMapper(){    
        $mapper = new Vendas_Model_ItemLanc_Mapper();
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