<?php
/**
 * Classe de mapeamento da tabela at_privilegio
 */
class Auth_Model_Privilegio_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'at_privilegio';
    protected $_sequence = 'sid_at_privilegio';
    protected $_required = array('id');
    protected $_primary = array('id');
    protected $_unique = array('id_papel','id_recurso');
    protected $_cols = array('id','id_papel','id_recurso','acesso');
    protected $_search = 'acesso';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdPapel' => array(
                    'columns' => 'id_papel',
                    'refTableClass' => 'Auth_Model_Conta_Table',
                    'refColumns' => 'id'
                ),
                'IdRecurso' => array(
                    'columns' => 'id_recurso',
                    'refTableClass' => 'Auth_Model_Recurso_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('acesso'=>array('P'=>'Permitido'
                                                    ,'N'=>'Negado'));
    protected $_mapper = 'Auth_Model_Privilegio_Mapper';
    protected $_element = 'Auth_Form_Privilegio_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Model_Privilegio_Element
     */
    public function getElement($columnName){
        $_element = new Auth_Form_Privilegio_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Auth_Model_Privilegio_Mapper
     */
    public function getMapper(){    
        $mapper = new Auth_Model_Privilegio_Mapper();
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