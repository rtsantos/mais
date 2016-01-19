<?php
/**
 * Classe de mapeamento da tabela log_server
 */
class Monitor_Model_LogServer_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'LOG_SERVER';
    protected $_sequence = 'SID_LOG_SERVER';
    protected $_required = array('ID','DH_LOG','TOTAL_ACCESSES','TOTAL_TRAFFIC','CPU_LOAD','TOTAL_REQUESTS');
    protected $_primary = array('ID');
    protected $_unique = array('');
    protected $_cols = array('ID','DH_LOG','TOTAL_ACCESSES','TOTAL_TRAFFIC','CPU_USAGE','CPU_LOAD','TOTAL_REQUESTS','MEM_TOTAL','MEM_USED','MEM_CACHED','SWAP_TOTAL','SWAP_USED');
    protected $_search = 'dh_log';
    protected $_schema  = 'LOG';
    protected $_adapter = 'db.log';
    protected $_dependentTables = array(
                'Monitor_Model_LogServerProcess_Table',
                'Monitor_Model_LogServerRequest_Table');
    protected $_referenceMap = array();
    protected $_listOptions = array();
    protected $_mapper = 'Monitor_Model_LogServer_Mapper';
    protected $_element = 'Monitor_Form_LogServer_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Monitor_Model_LogServer_Element
     */
    public function getElement($columnName){
        $_element = new Monitor_Form_LogServer_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Monitor_Model_LogServer_Mapper
     */
    public function getMapper(){    
        $mapper = new Monitor_Model_LogServer_Mapper();
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