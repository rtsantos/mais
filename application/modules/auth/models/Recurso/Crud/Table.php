<?php
/**
 * Classe de mapeamento da tabela recurso
 */
class Auth_Model_Recurso_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'RECURSO';
    protected $_sequence = 'SID_RECURSO';
    protected $_required = array('ID','ID_TIPO_RECURSO','ID_APLICACAO','NOME','HIERARQUIA','STATUS');
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','ID_TIPO_RECURSO','ID_APLICACAO','ID_RECURSO_PAI','NOME','HIERARQUIA','DESCRICAO','STATUS','ICONE','OBSERVACAO','ORDEM','NIVEL');
    protected $_search = 'hierarquia';
    protected $_schema  = 'PROUSER';
    protected $_adapter = 'db.prouser';
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
    protected $_mapper = 'Auth_Model_Recurso_Mapper';
    protected $_element = 'Auth_Form_Recurso_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Model_Recurso_Element
     */
    public function getElement($columnName){
        $_element = new Auth_Form_Recurso_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Auth_Model_Recurso_Mapper
     */
    public function getMapper(){    
        $mapper = new Auth_Model_Recurso_Mapper();
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