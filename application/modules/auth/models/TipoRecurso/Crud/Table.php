<?php
/**
 * Classe de mapeamento da tabela tipo_recurso
 */
class Auth_Model_TipoRecurso_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'TIPO_RECURSO';
    protected $_sequence = 'SID_TIPO_RECURSO';
    protected $_required = array('ID','NOME','DESCRICAO');
    protected $_primary = array('ID');
    protected $_unique = array('NOME');
    protected $_cols = array('ID','NOME','DESCRICAO');
    protected $_search = 'nome';
    protected $_schema  = 'PROUSER';
    protected $_adapter = 'db.prouser';
    protected $_dependentTables = array(
                'Auth_Model_Recurso_Table');
    protected $_referenceMap = array();
    protected $_listOptions = array();
    protected $_mapper = 'Auth_Model_TipoRecurso_Mapper';
    protected $_element = 'Auth_Form_TipoRecurso_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Model_TipoRecurso_Element
     */
    public function getElement($columnName){
        $_element = new Auth_Form_TipoRecurso_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Auth_Model_TipoRecurso_Mapper
     */
    public function getMapper(){    
        $mapper = new Auth_Model_TipoRecurso_Mapper();
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