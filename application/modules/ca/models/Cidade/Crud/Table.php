<?php
/**
 * Classe de mapeamento da tabela ca_cidade
 */
class Ca_Model_Cidade_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'ca_cidade';
    protected $_alias = 'ca_cidade';
    protected $_sequence = 'sid_ca_cidade';
    protected $_required = array('id','nome','polo','classificacao','id_estado');
    protected $_primary = array('id');
    protected $_unique = array('nome','id_estado');
    protected $_cols = array('id','nome','polo','classificacao','id_estado','cod_ibge','aliq_iss','cep');
    protected $_search = 'nome';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Ca_Model_CaEndereco_Table');
    protected $_referenceMap = array(
                'IdEstado' => array(
                    'columns' => 'id_estado',
                    'refTableClass' => 'Ca_Model_Estado_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('polo'=>array('S'=>'Sim'
                                                    ,'N'=>'Não')
                                    ,'classificacao'=>array('I'=>'Interior'
                                                    ,'C'=>'Capital'));
    protected $_mapper = 'Ca_Model_Cidade_Mapper';
    protected $_element = 'Ca_Form_Cidade_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ca_Model_Cidade_Element
     */
    public function getElement($columnName){
        $_element = new Ca_Form_Cidade_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ca_Model_Cidade_Mapper
     */
    public function getMapper(){    
        $mapper = new Ca_Model_Cidade_Mapper();
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