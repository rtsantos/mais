<?php
/**
 * Classe de mapeamento da tabela at_recurso
 */
class Auth_Model_AtRecurso_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'at_recurso';
    protected $_sequence = 'sid_at_recurso';
    protected $_required = array('id','id_tipo_recurso','id_aplicacao','nome','hierarquia','status');
    protected $_primary = array('id');
    protected $_unique = array();
    protected $_cols = array('id','id_tipo_recurso','id_aplicacao','id_recurso_pai','nome','hierarquia','descricao','status','icone','observacao','ordem','nivel');
    protected $_search = 'hierarquia';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Auth_Model_PapelRecurso_Table',
                'Auth_Model_Recurso_Table');
    protected $_referenceMap = array(
                'IdTipoRecurso' => array(
                    'columns' => 'id_tipo_recurso',
                    'refTableClass' => 'Auth_Model_TipoRecurso_Table',
                    'refColumns' => 'id'
                ),
                'IdAplicacao' => array(
                    'columns' => 'id_aplicacao',
                    'refTableClass' => 'Auth_Model_Aplicacao_Table',
                    'refColumns' => 'id'
                ),
                'IdRecursoPai' => array(
                    'columns' => 'id_recurso_pai',
                    'refTableClass' => 'Auth_Model_Recurso_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'));
    protected $_mapper = 'Auth_Model_AtRecurso_Mapper';
    protected $_element = 'Auth_Form_AtRecurso_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Model_AtRecurso_Element
     */
    public function getElement($columnName){
        $_element = new Auth_Form_AtRecurso_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Auth_Model_AtRecurso_Mapper
     */
    public function getMapper(){    
        $mapper = new Auth_Model_AtRecurso_Mapper();
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