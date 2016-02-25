<?php
/**
 * Classe de mapeamento da tabela cv_log_pedido
 */
class Vendas_Model_LogPedido_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'cv_log_pedido';
    protected $_alias = 'log_pedido';
    protected $_sequence = 'sid_cv_log_pedido';
    protected $_required = array('id','id_pedido','dh_log','mensagem');
    protected $_primary = array('id');
    protected $_unique = array();
    protected $_cols = array('id','id_pedido','dh_log','mensagem');
    protected $_search = 'message';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdPedido' => array(
                    'columns' => 'id_pedido',
                    'refTableClass' => 'Vendas_Model_Pedido_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Vendas_Model_LogPedido_Mapper';
    protected $_element = 'Vendas_Form_LogPedido_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Model_LogPedido_Element
     */
    public function getElement($columnName){
        $_element = new Vendas_Form_LogPedido_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Vendas_Model_LogPedido_Mapper
     */
    public function getMapper(){    
        $mapper = new Vendas_Model_LogPedido_Mapper();
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