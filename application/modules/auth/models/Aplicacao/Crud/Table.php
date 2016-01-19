<?php
/**
 * Classe de mapeamento da tabela aplicacao
 */
class Auth_Model_Aplicacao_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'APLICACAO';
    protected $_sequence = 'SID_APLICACAO';
    protected $_required = array('ID','SIGLA','NOME','STATUS');
    protected $_primary = array('ID');
    protected $_unique = array('SIGLA');
    protected $_cols = array('ID','SIGLA','NOME','STATUS','OBSERVACAO','ICONE','URL','DH_INC');
    protected $_search = 'sigla';
    protected $_schema  = 'PROUSER';
    protected $_adapter = 'db.prouser';
    protected $_dependentTables = array(
                'Auth_Model_Recurso_Table');
    protected $_referenceMap = array();
    protected $_listOptions = array('status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'));
    protected $_mapper = 'Auth_Model_Aplicacao_Mapper';
    protected $_element = 'Auth_Form_Aplicacao_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Model_Aplicacao_Element
     */
    public function getElement($columnName){
        $_element = new Auth_Form_Aplicacao_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Auth_Model_Aplicacao_Mapper
     */
    public function getMapper(){    
        $mapper = new Auth_Model_Aplicacao_Mapper();
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