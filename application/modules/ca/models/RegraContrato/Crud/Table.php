<?php
/**
 * Classe de mapeamento da tabela ca_regra_contrato
 */
class Ca_Model_RegraContrato_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CA_REGRA_CONTRATO';
    /*protected $_alias = 'REGRA_CONTRATO';*/
    protected $_sequence = 'SID_CA_REGRA_CONTRATO';
    protected $_required = array('ID','ID_CONTRATO','ID_PRODUTO','STATUS','TIPO');
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','ID_CONTRATO','ID_PRODUTO','STATUS','VLR_FIXO','VLR_MIN','VLR_PERC','TIPO','FAVORECIDO','ID_FAVORECIDO','DESC_LANC','PAGO');
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
                                                    ,'I'=>'Inativo')
                                    ,'tipo'=>array('PA'=>'Acréscimo de Preço'
                                                    ,'PD'=>'Desconto de Preço'
                                                    ,'CD'=>'Custeio de Débito')
                                    ,'favorecido'=>array('ca_pedido.id_cliente'=>'Cliente do Pedido'
                                                    ,'ca_pedido.id_cont_cli_resp'=>'Gerente do Cliente'
                                                    ,'ca_pedido.id_cont_cli_vend'=>'Vendedor do Cliente'
                                                    ,'ca_pedido.id_funcionario'=>'Funcionário'
                                                    ,'ca_pedido.especifico'=>'Específico')
                                    ,'pago'=>array('S'=>'Sim'
                                                    ,'N'=>'Não'));
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