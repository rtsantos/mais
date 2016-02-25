<?php
/**
 * Classe de mapeamento da tabela tl_log_erro
 */
class Tools_Model_LogErro_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'tl_log_erro';
    protected $_alias = 'log_erro';
    protected $_sequence = 'sid_tl_log_erro';
    protected $_required = array('id','procedimento','dh_log','mensagem');
    protected $_primary = array('id');
    protected $_unique = array();
    protected $_cols = array('id','procedimento','dh_log','mensagem');
    protected $_search = 'procedimento';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array();
    protected $_listOptions = array();
    protected $_mapper = 'Tools_Model_LogErro_Mapper';
    protected $_element = 'Tools_Form_LogErro_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Tools_Model_LogErro_Element
     */
    public function getElement($columnName){
        $_element = new Tools_Form_LogErro_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Tools_Model_LogErro_Mapper
     */
    public function getMapper(){    
        $mapper = new Tools_Model_LogErro_Mapper();
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