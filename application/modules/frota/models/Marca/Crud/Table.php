<?php
/**
 * Classe de mapeamento da tabela fr_marca
 */
class Frota_Model_Marca_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'fr_marca';
    protected $_sequence = 'sid_fr_marca';
    protected $_required = array('id','descricao','status','id_empresa');
    protected $_primary = array('id');
    protected $_unique = array('descricao','id_empresa');
    protected $_cols = array('id','descricao','status','id_empresa');
    protected $_search = 'descricao';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Frota_Model_Modelo_Table');
    protected $_referenceMap = array(
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'));
    protected $_mapper = 'Frota_Model_Marca_Mapper';
    protected $_element = 'Frota_Form_Marca_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Frota_Model_Marca_Element
     */
    public function getElement($columnName){
        $_element = new Frota_Form_Marca_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Frota_Model_Marca_Mapper
     */
    public function getMapper(){    
        $mapper = new Frota_Model_Marca_Mapper();
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