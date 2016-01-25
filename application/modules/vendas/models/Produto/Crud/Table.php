<?php
/**
 * Classe de mapeamento da tabela cv_produto
 */
class Vendas_Model_Produto_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CV_PRODUTO';
    protected $_sequence = 'SID_CV_PRODUTO';
    protected $_required = array('ID','CODIGO','NOME','TIPO','VLR_VENDA','ID_EMPRESA');
    protected $_primary = array('ID');
    protected $_unique = array('CODIGO','ID_EMPRESA');
    protected $_cols = array('ID','CODIGO','NOME','TIPO','APELIDO','VLR_VENDA','VLR_COMPRA','MEDIDA','QTD_ESTOQUE','ID_CLIENTE','ID_PRODUTO_RESP','ID_EMPRESA');
    protected $_search = 'codigo';
    protected $_schema  = 'MAIS';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Ca_Model_RegraContrato_Table',
                'Vendas_Model_ItemPedido_Table',
                'Vendas_Model_Produto_Table');
    protected $_referenceMap = array(
                'IdCliente' => array(
                    'columns' => 'id_cliente',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdProdutoResp' => array(
                    'columns' => 'id_produto_resp',
                    'refTableClass' => 'Vendas_Model_Produto_Table',
                    'refColumns' => 'id'
                ),
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('tipo'=>array('S'=>'Serviço'
                                                    ,'P'=>'Produto')
                                    ,'medida'=>array('Q'=>'Quantidade'
                                                    ,'M'=>'Metro'
                                                    ,'K'=>'Kilo'
                                                    ,'L'=>'Litro'));
    protected $_mapper = 'Vendas_Model_Produto_Mapper';
    protected $_element = 'Vendas_Form_Produto_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Model_Produto_Element
     */
    public function getElement($columnName){
        $_element = new Vendas_Form_Produto_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Vendas_Model_Produto_Mapper
     */
    public function getMapper(){    
        $mapper = new Vendas_Model_Produto_Mapper();
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