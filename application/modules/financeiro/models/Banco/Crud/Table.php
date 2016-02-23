<?php
/**
 * Classe de mapeamento da tabela fc_banco
 */
class Financeiro_Model_Banco_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'fc_banco';
    protected $_alias = 'fc_banco';
    protected $_sequence = 'sid_fc_banco';
    protected $_required = array('id','nome','codigo','id_empresa');
    protected $_primary = array('id');
    protected $_unique = array('codigo','id_empresa');
    protected $_cols = array('id','nome','codigo','id_empresa');
    protected $_search = 'nome';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Ca_Model_Pessoa_Table');
    protected $_referenceMap = array(
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Financeiro_Model_Banco_Mapper';
    protected $_element = 'Financeiro_Form_Banco_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Financeiro_Model_Banco_Element
     */
    public function getElement($columnName){
        $_element = new Financeiro_Form_Banco_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Financeiro_Model_Banco_Mapper
     */
    public function getMapper(){    
        $mapper = new Financeiro_Model_Banco_Mapper();
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