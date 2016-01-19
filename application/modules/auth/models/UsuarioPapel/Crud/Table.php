<?php
/**
 * Classe de mapeamento da tabela usuario_papel
 */
class Auth_Model_UsuarioPapel_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'USUARIO_PAPEL';
    protected $_sequence = 'SID_USUARIO_PAPEL';
    protected $_required = array('ID_USUARIO','ID_PAPEL','PRIORIDADE');
    protected $_primary = array('ID_USUARIO','ID_PAPEL');
    protected $_unique = array('ID_USUARIO','ID_PAPEL');
    protected $_cols = array('ID_USUARIO','ID_PAPEL','PRIORIDADE');
    protected $_search = '';
    protected $_schema  = 'PROUSER';
    protected $_adapter = 'db.prouser';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdPapel' => array(
                    'columns' => 'ID_PAPEL',
                    'refTableClass' => 'Auth_Model_Papel_Table',
                    'refColumns' => 'ID'
                ),
                'IdUsuario' => array(
                    'columns' => 'ID_USUARIO',
                    'refTableClass' => 'Auth_Model_Usuario_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Auth_Model_UsuarioPapel_Mapper';
    protected $_element = 'Auth_Form_UsuarioPapel_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Model_UsuarioPapel_Element
     */
    public function getElement($columnName){
        $_element = new Auth_Form_UsuarioPapel_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Auth_Model_UsuarioPapel_Mapper
     */
    public function getMapper(){    
        $mapper = new Auth_Model_UsuarioPapel_Mapper();
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