<?php
/**
 * Classe de mapeamento da tabela fr_veiculo
 */
class Frota_Model_Veiculo_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'fr_veiculo';
    protected $_sequence = 'sid_fr_veiculo';
    protected $_required = array('id','placa','descricao','id_empresa');
    protected $_primary = array('id');
    protected $_unique = array('placa','id_empresa');
    protected $_cols = array('id','id_modelo','placa','descricao','chassi','renavam','id_empresa');
    protected $_search = 'placa';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Vendas_Model_Pedido_Table');
    protected $_referenceMap = array(
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdModelo' => array(
                    'columns' => 'id_modelo',
                    'refTableClass' => 'Frota_Model_Modelo_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Frota_Model_Veiculo_Mapper';
    protected $_element = 'Frota_Form_Veiculo_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Frota_Model_Veiculo_Element
     */
    public function getElement($columnName){
        $_element = new Frota_Form_Veiculo_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Frota_Model_Veiculo_Mapper
     */
    public function getMapper(){    
        $mapper = new Frota_Model_Veiculo_Mapper();
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