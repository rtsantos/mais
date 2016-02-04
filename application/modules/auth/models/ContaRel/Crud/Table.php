<?php
/**
 * Classe de mapeamento da tabela papel_rel
 */
class Auth_Model_ContaRel_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'papel_rel';
    protected $_sequence = 'sid_papel_rel';
    protected $_required = array('id','id_papel','id_papel_rel','status');
    protected $_primary = array('id');
    protected $_unique = array('id_papel','id_papel_rel');
    protected $_cols = array('id','id_papel','id_papel_rel','status');
    protected $_search = 'status';
    protected $_schema  = 'prouser';
    protected $_adapter = 'db.prouser';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdPapel' => array(
                    'columns' => 'id_papel',
                    'refTableClass' => 'Auth_Model_Conta_Table',
                    'refColumns' => 'id'
                ),
                'IdPapelRel' => array(
                    'columns' => 'id_papel_rel',
                    'refTableClass' => 'Auth_Model_Conta_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'));
    protected $_mapper = 'Auth_Model_ContaRel_Mapper';
    protected $_element = 'Auth_Form_ContaRel_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Model_ContaRel_Element
     */
    public function getElement($columnName){
        $_element = new Auth_Form_ContaRel_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Auth_Model_ContaRel_Mapper
     */
    public function getMapper(){    
        $mapper = new Auth_Model_ContaRel_Mapper();
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