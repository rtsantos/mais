<?php
/**
 * Classe de mapeamento da tabela log_tabela
 */
class Log_Model_LogTabela_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'LOG_TABELA';
    protected $_sequence = 'SID_LOG_TABELA';
    protected $_required = array('ID','NOME','OWNER','TABLE_NAME');
    protected $_primary = array('ID');
    protected $_unique = array('NOME');
    protected $_cols = array('ID','NOME','OWNER','TABLE_NAME');
    protected $_search = 'nome';
    protected $_schema  = 'LOG';
    protected $_adapter = 'db.log';
    protected $_dependentTables = array(
                'Log_Model_LogObjeto_Table',
                'Log_Model_LogEvento_Table');
    protected $_referenceMap = array();
    protected $_listOptions = array();
    protected $_mapper = 'Log_Model_LogTabela_Mapper';
    protected $_element = 'Log_Form_LogTabela_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Log_Model_LogTabela_Element
     */
    public function getElement($columnName){
        $_element = new Log_Form_LogTabela_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Log_Model_LogTabela_Mapper
     */
    public function getMapper(){    
        $mapper = new Log_Model_LogTabela_Mapper();
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