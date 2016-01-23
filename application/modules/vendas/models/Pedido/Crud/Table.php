<?php
/**
 * Classe de mapeamento da tabela cv_pedido
 */
class Vendas_Model_Pedido_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CV_PEDIDO';
    protected $_sequence = 'SID_CV_PEDIDO';
    protected $_required = array('ID','NUMERO','TIPO','ID_USU_INC','ID_EMPRESA','ID_FUNCIONARIO','ID_CLIENTE');
    protected $_primary = array('ID');
    protected $_unique = array('TIPO','NUMERO','ID_EMPRESA');
    protected $_cols = array('ID','NUMERO','TIPO','ID_USU_INC','ID_USU_ALT','ID_EMPRESA','ID_FUNCIONARIO','ID_CLIENTE','ID_CONT_CLI_RESP','ID_CONT_CLI_VEND','VLR_TOTAL','PAGAMENTO','VLR_PAGO','VLR_DESC','NRO_PARC','VLR_PARC');
    protected $_search = 'numero';
    protected $_schema  = 'MAIS';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdUsuInc' => array(
                    'columns' => 'id_usu_inc',
                    'refTableClass' => 'Auth_Model_Conta_Table',
                    'refColumns' => 'id'
                ),
                'IdUsuAlt' => array(
                    'columns' => 'id_usu_alt',
                    'refTableClass' => 'Auth_Model_Conta_Table',
                    'refColumns' => 'id'
                ),
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdFuncionario' => array(
                    'columns' => 'id_funcionario',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdCliente' => array(
                    'columns' => 'id_cliente',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdContCliResp' => array(
                    'columns' => 'id_cont_cli_resp',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdContCliVend' => array(
                    'columns' => 'id_cont_cli_vend',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('tipo'=>array('V'=>'Venda'
                                                    ,'C'=>'Compra'
                                                    ,'O'=>'Orçamento')
                                    ,'pagamento'=>array('D'=>'Crediário'
                                                    ,'C'=>'Cartão'
                                                    ,'Q'=>'Cheque'
                                                    ,'F'=>'Faturar'));
    protected $_mapper = 'Vendas_Model_Pedido_Mapper';
    protected $_element = 'Vendas_Form_Pedido_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Model_Pedido_Element
     */
    public function getElement($columnName){
        $_element = new Vendas_Form_Pedido_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Vendas_Model_Pedido_Mapper
     */
    public function getMapper(){    
        $mapper = new Vendas_Model_Pedido_Mapper();
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