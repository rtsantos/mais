<?php
/**
 * Classe de mapeamento da tabela at_papel
 */
class Auth_Model_Conta_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'at_papel';
    protected $_sequence = 'sid_at_papel';
    protected $_required = array('id','nome','descricao','hierarquia','tipo','status');
    protected $_primary = array('id');
    protected $_unique = array('hierarquia');
    protected $_cols = array('id','nome','descricao','hierarquia','id_papel_pai','tipo','status','senha','avatar','email','id_empresa');
    protected $_search = 'hierarquia';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Auth_Model_Conta_Table',
                'Auth_Model_PapelEmpresa_Table',
                'Auth_Model_PapelRecurso_Table',
                'Auth_Model_ContaRel_Table',
                'Profile_Model_JobDest_Table',
                'Profile_Model_ObjectViewPriv_Table',
                'Auth_Model_Usuario_Table',
                'Auth_Model_UsuarioPapel_Table');
    protected $_referenceMap = array(
                'IdPapelPai' => array(
                    'columns' => 'id_papel_pai',
                    'refTableClass' => 'Auth_Model_Conta_Table',
                    'refColumns' => 'id'
                ),
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('tipo'=>array('U'=>'Usuário'
                                                    ,'G'=>'Grupo')
                                    ,'status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'));
    protected $_mapper = 'Auth_Model_Conta_Mapper';
    protected $_element = 'Auth_Form_Conta_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Model_Conta_Element
     */
    public function getElement($columnName){
        $_element = new Auth_Form_Conta_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Auth_Model_Conta_Mapper
     */
    public function getMapper(){    
        $mapper = new Auth_Model_Conta_Mapper();
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