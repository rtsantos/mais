<?php
/**
 * Classe de mapeamento da tabela log_server_request
 */
class Monitor_Model_LogServerRequest_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'LOG_SERVER_REQUEST';
    
    protected $_required = array('ID','ID_LOG_SERVER','CPU','SS','REQ','CONN','CHILD','SLOT');
    protected $_primary = array('ID');
    protected $_unique = array('');
    protected $_cols = array('ID','ID_LOG_SERVER','SRV','PID','ACC','M','CPU','SS','REQ','CONN','CHILD','SLOT','CLIENT','VHOST','REQUEST','PERC_CPU','PERC_MEM','TIME','SYSTEM');
    protected $_search = 'srv';
    protected $_schema  = 'LOG';
    protected $_adapter = 'db.log';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdLogServer' => array(
                    'columns' => 'ID_LOG_SERVER',
                    'refTableClass' => 'Monitor_Model_LogServer_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Monitor_Model_LogServerRequest_Mapper';
    protected $_element = 'Monitor_Form_LogServerRequest_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Monitor_Model_LogServerRequest_Element
     */
    public function getElement($columnName){
        $_element = new Monitor_Form_LogServerRequest_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Monitor_Model_LogServerRequest_Mapper
     */
    public function getMapper(){    
        $mapper = new Monitor_Model_LogServerRequest_Mapper();
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