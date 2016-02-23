<?php
/**
 * Classe de mapeamento da tabela ca_endereco
 */
class Ca_Model_Endereco_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'ca_endereco';
    protected $_alias = 'endereco';
    protected $_sequence = 'sid_ca_endereco';
    protected $_required = array('id','logradouro','id_empresa');
    protected $_primary = array('id');
    protected $_unique = array();
    protected $_cols = array('id','tipo','logradouro','numero','complemento','bairro','id_cidade','cep','id_empresa','cidade','uf');
    protected $_search = 'logradouro';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Ca_Model_Pessoa_Table',
                'Vendas_Model_Pedido_Table');
    protected $_referenceMap = array(
                'IdCidade' => array(
                    'columns' => 'id_cidade',
                    'refTableClass' => 'Ca_Model_Cidade_Table',
                    'refColumns' => 'id'
                ),
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Ca_Model_Endereco_Mapper';
    protected $_element = 'Ca_Form_Endereco_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ca_Model_Endereco_Element
     */
    public function getElement($columnName){
        $_element = new Ca_Form_Endereco_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ca_Model_Endereco_Mapper
     */
    public function getMapper(){    
        $mapper = new Ca_Model_Endereco_Mapper();
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