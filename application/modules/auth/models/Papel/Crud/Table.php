<?php
/**
 * Classe de mapeamento da tabela papel
 */
class Auth_Model_Papel_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'PAPEL';
    protected $_sequence = 'SID_PAPEL';
    protected $_required = array('ID','NOME','DESCRICAO','HIERARQUIA');
    protected $_primary = array('ID');
    protected $_unique = array('HIERARQUIA');
    protected $_cols = array('ID','NOME','DESCRICAO','HIERARQUIA','ID_PAPEL_PAI');
    protected $_search = 'hierarquia';
    protected $_schema  = 'PROUSER';
    protected $_adapter = 'db.prouser';
    protected $_dependentTables = array(
                'Auth_Model_Papel_Table',
                'Auth_Model_PapelRecurso_Table',
                'Profile_Model_JobDest_Table',
                'Profile_Model_ObjectViewPriv_Table',
                'Auth_Model_Usuario_Table',
                'Auth_Model_UsuarioPapel_Table');
    protected $_referenceMap = array(
                'IdPapelPai' => array(
                    'columns' => 'id_papel_pai',
                    'refTableClass' => 'Auth_Model_Papel_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Auth_Model_Papel_Mapper';
    protected $_element = 'Auth_Form_Papel_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Model_Papel_Element
     */
    public function getElement($columnName){
        $_element = new Auth_Form_Papel_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Auth_Model_Papel_Mapper
     */
    public function getMapper(){    
        $mapper = new Auth_Model_Papel_Mapper();
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