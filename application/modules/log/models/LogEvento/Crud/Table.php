<?php
/**
 * Classe de mapeamento da tabela log_evento
 */
class Log_Model_LogEvento_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'LOG_EVENTO';
    protected $_sequence = 'SID_LOG_EVENTO';
    protected $_required = array('ID_LOG_OBJETO','ID_LOG_OPERAC','ID_OBJETO','DH_EVENTO','CHAVE');
    protected $_primary = array('ID_OBJETO','ID_LOG_TABELA');
    protected $_unique = array('CHAVE');
    protected $_cols = array('ID_LOG_OBJETO','ID_LOG_OPERAC','ID_OBJETO','ID_USUARIO','DH_EVENTO','CHAVE','OBSERVACAO','ID_LOG_TABELA');
    protected $_search = 'chave';
    protected $_schema  = 'LOG';
    protected $_adapter = 'db.log';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdLogObjeto' => array(
                    'columns' => 'ID_LOG_OBJETO',
                    'refTableClass' => 'Log_Model_LogObjeto_Table',
                    'refColumns' => 'ID'
                ),
                'IdLogOperac' => array(
                    'columns' => 'ID_LOG_OPERAC',
                    'refTableClass' => 'Log_Model_LogOperac_Table',
                    'refColumns' => 'ID'
                ),
                'IdLogTabela' => array(
                    'columns' => 'ID_LOG_TABELA',
                    'refTableClass' => 'Log_Model_LogTabela_Table',
                    'refColumns' => 'ID'
                ),
                'IdUsuario' => array(
                    'columns' => 'ID_USUARIO',
                    'refTableClass' => 'Auth_Model_Usuario_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Log_Model_LogEvento_Mapper';
    protected $_element = 'Log_Form_LogEvento_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Log_Model_LogEvento_Element
     */
    public function getElement($columnName){
        $_element = new Log_Form_LogEvento_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Log_Model_LogEvento_Mapper
     */
    public function getMapper(){    
        $mapper = new Log_Model_LogEvento_Mapper();
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