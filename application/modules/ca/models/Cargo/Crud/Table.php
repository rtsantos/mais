<?php
/**
 * Classe de mapeamento da tabela ca_cargo
 */
class Ca_Model_Cargo_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'ca_cargo';
    protected $_alias = 'ca_cargo';
    protected $_sequence = 'sid_ca_cargo';
    protected $_required = array('id');
    protected $_primary = array('id');
    protected $_unique = array('descricao','id_empresa');
    protected $_cols = array('id','descricao','sigla','id_empresa');
    protected $_search = 'descricao';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Ca_Model_Cargo_Mapper';
    protected $_element = 'Ca_Form_Cargo_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ca_Model_Cargo_Element
     */
    public function getElement($columnName){
        $_element = new Ca_Form_Cargo_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ca_Model_Cargo_Mapper
     */
    public function getMapper(){    
        $mapper = new Ca_Model_Cargo_Mapper();
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