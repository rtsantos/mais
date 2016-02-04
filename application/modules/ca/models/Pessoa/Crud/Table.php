<?php
/**
 * Classe de mapeamento da tabela ca_pessoa
 */
class Ca_Model_Pessoa_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'ca_pessoa';
    protected $_sequence = 'sid_ca_pessoa';
    protected $_required = array('id','nome');
    protected $_primary = array('id');
    protected $_unique = array('id_empresa','nome','apelido');
    protected $_cols = array('id','nome','apelido','codigo','email','id_pessoa_resp','telefone','celular','fax','ed_logr','ed_numero','ed_compl','ed_bairro','ed_cidade','ed_estado','ed_cep','ed_cob_logr','ed_cob_numero','ed_cob_compl','ed_cob_bairro','ed_cob_cidade','ed_cob_estado','ed_cob_cep','papel_cliente','papel_funcionario','papel_usuario','papel_empresa','registro','id_empresa','email_cob','hierarquia','papel_contato','id_cargo','papel_fornecedor');
    protected $_search = 'nome';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Ca_Model_Cargo_Table',
                'Ca_Model_CaContrato_Table',
                'Ca_Model_Pessoa_Table',
                'Ca_Model_CaRegraContrato_Table',
                'Ca_Model_CvPedido_Table',
                'Ca_Model_CvProduto_Table');
    protected $_referenceMap = array(
                'IdPessoaResp' => array(
                    'columns' => 'id_pessoa_resp',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdCargo' => array(
                    'columns' => 'id_cargo',
                    'refTableClass' => 'Ca_Model_Cargo_Table',
                    'refColumns' => 'id'
                ),
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('papel_cliente'=>array('1'=>'Sim'
                                                    ,'0'=>'Não')
                                    ,'papel_funcionario'=>array('1'=>'Sim'
                                                    ,'0'=>'Não')
                                    ,'papel_usuario'=>array('1'=>'Sim'
                                                    ,'0'=>'Não')
                                    ,'papel_empresa'=>array('1'=>'Sim'
                                                    ,'0'=>'Não')
                                    ,'papel_contato'=>array('1'=>'Sim'
                                                    ,'0'=>'Não')
                                    ,'papel_fornecedor'=>array('1'=>'Sim'
                                                    ,'0'=>'Não'));
    protected $_mapper = 'Ca_Model_Pessoa_Mapper';
    protected $_element = 'Ca_Form_Pessoa_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ca_Model_Pessoa_Element
     */
    public function getElement($columnName){
        $_element = new Ca_Form_Pessoa_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ca_Model_Pessoa_Mapper
     */
    public function getMapper(){    
        $mapper = new Ca_Model_Pessoa_Mapper();
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