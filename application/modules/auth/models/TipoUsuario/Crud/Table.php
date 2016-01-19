<?php
/**
 * Classe de mapeamento da tabela tipo_usuario
 */
class Auth_Model_TipoUsuario_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'TIPO_USUARIO';
    protected $_sequence = 'SID_TIPO_USUARIO';
    protected $_required = array('ID');
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','CODIGO','DESCRICAO');
    protected $_search = 'descricao';
    protected $_schema  = 'PROUSER';
    protected $_adapter = 'db.prouser';
    protected $_dependentTables = array(
                'Auth_Model_Usuario_Table');
    protected $_referenceMap = array();
    protected $_listOptions = array();
    protected $_mapper = 'Auth_Model_TipoUsuario_Mapper';
    protected $_element = 'Auth_Form_TipoUsuario_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Model_TipoUsuario_Element
     */
    public function getElement($columnName){
        $_element = new Auth_Form_TipoUsuario_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Auth_Model_TipoUsuario_Mapper
     */
    public function getMapper(){    
        $mapper = new Auth_Model_TipoUsuario_Mapper();
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