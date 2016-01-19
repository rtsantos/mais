<?php
/**
 * Classe de mapeamento da tabela log_operac
 */
class Log_Model_LogOperac_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'LOG_OPERAC';
    protected $_sequence = 'SID_LOG_OPERAC';
    protected $_required = array('ID','CODIGO');
    protected $_primary = array('ID');
    protected $_unique = array('CODIGO');
    protected $_cols = array('ID','CODIGO','OPERACAO','STATUS','ACAO');
    protected $_search = 'codigo';
    protected $_schema  = 'LOG';
    protected $_adapter = 'db.log';
    protected $_dependentTables = array(
                'Log_Model_LogEvento_Table');
    protected $_referenceMap = array();
    protected $_listOptions = array();
    protected $_mapper = 'Log_Model_LogOperac_Mapper';
    protected $_element = 'Log_Form_LogOperac_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Log_Model_LogOperac_Element
     */
    public function getElement($columnName){
        $_element = new Log_Form_LogOperac_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Log_Model_LogOperac_Mapper
     */
    public function getMapper(){    
        $mapper = new Log_Model_LogOperac_Mapper();
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