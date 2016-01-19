<?php
/**
 * Classe de mapeamento da tabela log_web_relat
 */
class Log_Model_Relatorio_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'LOG_WEB_RELAT';
    protected $_sequence = 'SID_LOG_WEB_RELAT';
    protected $_required = array('ID','IMPRESSO');
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','ID_USUARIO','SESSAO','ARQUIVO','TITULO','DH_INI_EXEC','DH_FIM_EXEC','DH_FIM_RELAT','QTD_REG','IMPRESSO');
    protected $_search = 'sessao';
    protected $_schema  = 'LOG';
    protected $_adapter = 'db.log';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdUsuario' => array(
                    'columns' => 'ID_USUARIO',
                    'refTableClass' => 'Auth_Model_Usuario_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array('impresso'=>array('S'=>'Sim'
                                                    ,'N'=>'Não'));
    protected $_mapper = 'Log_Model_Relatorio_Mapper';
    protected $_element = 'Log_Form_Relatorio_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Log_Model_Relatorio_Element
     */
    public function getElement($columnName){
        $_element = new Log_Form_Relatorio_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Log_Model_Relatorio_Mapper
     */
    public function getMapper(){    
        $mapper = new Log_Model_Relatorio_Mapper();
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