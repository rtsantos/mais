<?php
/**
 * Classe de mapeamento da tabela cv_pedido
 */
class Vendas_Model_Pedido_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'cv_pedido';
    protected $_alias = 'pedido';
    protected $_sequence = 'sid_cv_pedido';
    protected $_required = array('id','numero','tipo','id_usu_inc','id_empresa','id_funcionario','id_cliente','status');
    protected $_primary = array('id');
    protected $_unique = array('tipo','numero','id_empresa');
    protected $_cols = array('id','numero','tipo','id_usu_inc','id_usu_alt','id_empresa','id_funcionario','id_cliente','id_cont_cli_resp','id_cont_cli_vend','status','id_cliente_con','sinistro','id_veiculo','dh_inc','dt_emis','id_endereco','telefone','status_edi');
    protected $_search = 'numero';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Vendas_Model_ItemPedido_Table',
                'Vendas_Model_Pagamento_Table',
                'Vendas_Model_Vistoria_Table');
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
                ),
                'IdClienteCon' => array(
                    'columns' => 'id_cliente_con',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdVeiculo' => array(
                    'columns' => 'id_veiculo',
                    'refTableClass' => 'Frota_Model_Veiculo_Table',
                    'refColumns' => 'id'
                ),
                'IdEndereco' => array(
                    'columns' => 'id_endereco',
                    'refTableClass' => 'Ca_Model_Endereco_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('tipo'=>array('V'=>'Venda'
                                                    ,'C'=>'Compra'
                                                    ,'O'=>'Orçamento')
                                    ,'status'=>array('A'=>'Aberto'
                                                    ,'P'=>'Pago'
                                                    ,'E'=>'Efetivado'
                                                    ,'C'=>'Cancelado')
                                    ,'status_edi'=>array('N'=>'Não transmitido'
                                                    ,'T'=>'Transmitido'
                                                    ,'E'=>'Erro na transmissão'));
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