<?php
/**
 * Classe de mapeamento da tabela ca_numeracao
 */
class Ca_Model_Numeracao_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CA_NUMERACAO';
    protected $_sequence = 'SID_CA_NUMERACAO';
    protected $_required = array('ID','NOME','NUMERO','TAMANHO','ID_EMPRESA');
    protected $_primary = array('ID');
    protected $_unique = array('NOME','ID_EMPRESA');
    protected $_cols = array('ID','NOME','NUMERO','TAMANHO','ID_EMPRESA');
    protected $_search = 'nome';
    protected $_schema  = 'MAIS';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Ca_Model_Numeracao_Mapper';
    protected $_element = 'Ca_Form_Numeracao_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ca_Model_Numeracao_Element
     */
    public function getElement($columnName){
        $_element = new Ca_Form_Numeracao_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ca_Model_Numeracao_Mapper
     */
    public function getMapper(){    
        $mapper = new Ca_Model_Numeracao_Mapper();
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