<?php
/**
 * Classe de mapeamento da tabela fr_modelo
 */
class Frota_Model_Modelo_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'FR_MODELO';
    protected $_sequence = 'SID_FR_MODELO';
    protected $_required = array('ID','ID_MARCA','DESCRICAO','STATUS','ID_EMPRESA');
    protected $_primary = array('ID');
    protected $_unique = array('DESCRICAO','ID_EMPRESA');
    protected $_cols = array('ID','ID_MARCA','DESCRICAO','STATUS','ID_EMPRESA');
    protected $_search = 'descricao';
    protected $_schema  = 'MAIS';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Frota_Model_Veiculo_Table');
    protected $_referenceMap = array(
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdMarca' => array(
                    'columns' => 'id_marca',
                    'refTableClass' => 'Frota_Model_Marca_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'));
    protected $_mapper = 'Frota_Model_Modelo_Mapper';
    protected $_element = 'Frota_Form_Modelo_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Frota_Model_Modelo_Element
     */
    public function getElement($columnName){
        $_element = new Frota_Form_Modelo_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Frota_Model_Modelo_Mapper
     */
    public function getMapper(){    
        $mapper = new Frota_Model_Modelo_Mapper();
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