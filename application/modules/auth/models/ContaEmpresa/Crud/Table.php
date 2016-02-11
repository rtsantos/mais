<?php
/**
 * Classe de mapeamento da tabela at_papel_empresa
 */
class Auth_Model_ContaEmpresa_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'at_papel_empresa';
    protected $_sequence = 'sid_at_papel_empresa';
    protected $_required = array('id','id_papel','id_empresa','status','padrao');
    protected $_primary = array('id');
    protected $_unique = array('id_papel','id_empresa');
    protected $_cols = array('id','id_papel','id_empresa','status','padrao');
    protected $_search = 'status';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdPapel' => array(
                    'columns' => 'id_papel',
                    'refTableClass' => 'Auth_Model_Conta_Table',
                    'refColumns' => 'id'
                ),
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo')
                                    ,'padrao'=>array('S'=>'Sim'
                                                    ,'N'=>'Não'));
    protected $_mapper = 'Auth_Model_ContaEmpresa_Mapper';
    protected $_element = 'Auth_Form_ContaEmpresa_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Model_ContaEmpresa_Element
     */
    public function getElement($columnName){
        $_element = new Auth_Form_ContaEmpresa_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Auth_Model_ContaEmpresa_Mapper
     */
    public function getMapper(){    
        $mapper = new Auth_Model_ContaEmpresa_Mapper();
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