<?php
/**
 * Classe de mapeamento da tabela ca_regra_contrato
 */
class Ca_Model_RegraContrato_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CA_REGRA_CONTRATO';
    protected $_sequence = 'SID_CA_REGRA_CONTRATO';
    protected $_required = array('ID','ID_CONTRATO','ID_PRODUTO','STATUS');
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','ID_CONTRATO','ID_PRODUTO','ID_FAVORECIDO','STATUS','VLR_FIXO','VLR_MIN','VLR_PERC');
    protected $_search = 'status';
    protected $_schema  = 'MAIS';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdContrato' => array(
                    'columns' => 'id_contrato',
                    'refTableClass' => 'Ca_Model_Contrato_Table',
                    'refColumns' => 'id'
                ),
                'IdProduto' => array(
                    'columns' => 'id_produto',
                    'refTableClass' => 'Vendas_Model_Produto_Table',
                    'refColumns' => 'id'
                ),
                'IdFavorecido' => array(
                    'columns' => 'id_favorecido',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'));
    protected $_mapper = 'Ca_Model_RegraContrato_Mapper';
    protected $_element = 'Ca_Form_RegraContrato_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ca_Model_RegraContrato_Element
     */
    public function getElement($columnName){
        $_element = new Ca_Form_RegraContrato_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ca_Model_RegraContrato_Mapper
     */
    public function getMapper(){    
        $mapper = new Ca_Model_RegraContrato_Mapper();
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