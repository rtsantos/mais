<?php
/**
 * Classe de mapeamento da tabela papel_recurso
 */
class Auth_Model_PapelRecurso_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'PAPEL_RECURSO';
    protected $_sequence = 'SID_PAPEL_RECURSO';
    protected $_required = array('ID');
    protected $_primary = array('ID');
    protected $_unique = array('ID_PAPEL','ID_RECURSO');
    protected $_cols = array('ID','ID_PAPEL','ID_RECURSO','ACESSO');
    protected $_search = 'acesso';
    protected $_schema  = 'PROUSER';
    protected $_adapter = 'db.prouser';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdPapel' => array(
                    'columns' => 'id_papel',
                    'refTableClass' => 'Auth_Model_Papel_Table',
                    'refColumns' => 'id'
                ),
                'IdRecurso' => array(
                    'columns' => 'id_recurso',
                    'refTableClass' => 'Auth_Model_Recurso_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('acesso'=>array('P'=>'Permitido'
                                                    ,'N'=>'Negado'));
    protected $_mapper = 'Auth_Model_PapelRecurso_Mapper';
    protected $_element = 'Auth_Form_PapelRecurso_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Model_PapelRecurso_Element
     */
    public function getElement($columnName){
        $_element = new Auth_Form_PapelRecurso_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Auth_Model_PapelRecurso_Mapper
     */
    public function getMapper(){    
        $mapper = new Auth_Model_PapelRecurso_Mapper();
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