<?php
/**
 * Classe de mapeamento da tabela ca_pessoa
 */
class Ca_Model_Pessoa_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CA_PESSOA';
    /*protected $_alias = 'PESSOA';*/
    protected $_sequence = 'SID_CA_PESSOA';
    protected $_required = array('ID');
    protected $_primary = array('ID');
    protected $_unique = array('CODIGO');
    protected $_cols = array('ID','NOME','APELIDO','CODIGO','EMAIL','ID_PESSOA_RESP','TELEFONE','CELULAR','FAX','ED_LOGR','ED_NUMERO','ED_COMPL','ED_BAIRRO','ED_CIDADE','ED_ESTADO','ED_CEP','ED_COB_LOGR','ED_COB_NUMERO','ED_COB_COMPL','ED_COB_BAIRRO','ED_COB_CIDADE','ED_COB_ESTADO','ED_COB_CEP','CLIENTE','CONT_CLI_RESP','CONT_CLI_VEND','FUNCIONARIO','USUARIO','EMPRESA','REGISTRO','ID_EMPRESA','EMAIL_COB','HIERARQUIA');
    protected $_search = 'nome';
    protected $_schema  = 'MAIS';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Ca_Model_CaContrato_Table',
                'Ca_Model_Pessoa_Table',
                'Ca_Model_CaRegraContrato_Table');
    protected $_referenceMap = array(
                'IdPessoaResp' => array(
                    'columns' => 'id_pessoa_resp',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('cliente'=>array('1'=>'Sim'
                                                    ,'0'=>'Não')
                                    ,'cont_cli_resp'=>array('1'=>'Sim'
                                                    ,'0'=>'Não')
                                    ,'cont_cli_vend'=>array('1'=>'Sim'
                                                    ,'0'=>'Não')
                                    ,'funcionario'=>array('1'=>'Sim'
                                                    ,'0'=>'Não')
                                    ,'usuario'=>array('1'=>'Sim'
                                                    ,'0'=>'Não')
                                    ,'empresa'=>array('1'=>'Sim'
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