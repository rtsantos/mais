<?php
/**
 * Classe de mapeamento da tabela ca_contrato
 */
class Ca_Model_Contrato_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CA_CONTRATO';
    protected $_sequence = 'SID_CA_CONTRATO';
    protected $_required = array('ID','DESCRICAO','NUMERO','STATUS','ID_EMPRESA','ID_CLIENTE','DT_VIG_INI');
    protected $_primary = array('ID');
    protected $_unique = array('DESCRICAO','ID_EMPRESA');
    protected $_cols = array('ID','DESCRICAO','NUMERO','STATUS','ID_EMPRESA','ID_CLIENTE','DT_VIG_INI','DT_VIG_FIM');
    protected $_search = 'numero';
    protected $_schema  = 'MAIS';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Ca_Model_RegraContrato_Table');
    protected $_referenceMap = array(
                'IdCliente' => array(
                    'columns' => 'id_cliente',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'));
    protected $_mapper = 'Ca_Model_Contrato_Mapper';
    protected $_element = 'Ca_Form_Contrato_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ca_Model_Contrato_Element
     */
    public function getElement($columnName){
        $_element = new Ca_Form_Contrato_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ca_Model_Contrato_Mapper
     */
    public function getMapper(){    
        $mapper = new Ca_Model_Contrato_Mapper();
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