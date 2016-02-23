<?php
/**
 * Classe de mapeamento da tabela ca_estado
 */
class Ca_Model_Estado_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'ca_estado';
    protected $_alias = 'estado';
    protected $_sequence = 'sid_ca_estado';
    protected $_required = array('id','uf','nome');
    protected $_primary = array('id');
    protected $_unique = array('uf');
    protected $_cols = array('id','uf','nome','cod_ibge','mascara_ie');
    protected $_search = 'uf';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Ca_Model_CaCidade_Table');
    protected $_referenceMap = array();
    protected $_listOptions = array();
    protected $_mapper = 'Ca_Model_Estado_Mapper';
    protected $_element = 'Ca_Form_Estado_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ca_Model_Estado_Element
     */
    public function getElement($columnName){
        $_element = new Ca_Form_Estado_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ca_Model_Estado_Mapper
     */
    public function getMapper(){    
        $mapper = new Ca_Model_Estado_Mapper();
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