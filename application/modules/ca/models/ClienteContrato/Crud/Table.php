<?php
/**
 * Classe de mapeamento da tabela ca_cliente_contrato
 */
class Ca_Model_ClienteContrato_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CA_CLIENTE_CONTRATO';
    protected $_sequence = 'SID_CA_CLIENTE_CONTRATO';
    protected $_required = array('ID','ID_CLIENTE','ID_CONTRATO','DT_INI_VIG','STATUS');
    protected $_primary = array('ID');
    protected $_unique = array('ID_CONTRATO','ID_CLIENTE','DT_INI_VIG');
    protected $_cols = array('ID','ID_CLIENTE','ID_CONTRATO','DT_INI_VIG','DT_FIM_VIG','STATUS');
    protected $_search = 'status';
    protected $_schema  = 'MAIS';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdCliente' => array(
                    'columns' => 'id_cliente',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdContrato' => array(
                    'columns' => 'id_contrato',
                    'refTableClass' => 'Ca_Model_Contrato_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'));
    protected $_mapper = 'Ca_Model_ClienteContrato_Mapper';
    protected $_element = 'Ca_Form_ClienteContrato_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ca_Model_ClienteContrato_Element
     */
    public function getElement($columnName){
        $_element = new Ca_Form_ClienteContrato_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ca_Model_ClienteContrato_Mapper
     */
    public function getMapper(){    
        $mapper = new Ca_Model_ClienteContrato_Mapper();
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