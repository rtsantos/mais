<?php
/**
 * Classe de mapeamento da tabela fc_lancamento
 */
class Financeiro_Model_Lancamento_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'FC_LANCAMENTO';
    protected $_sequence = 'SID_FC_LANCAMENTO';
    protected $_required = array('ID','ID_EMPRESA','TIPO','DESCRICAO','ID_USU_INC','DH_INC','DT_LANC','VLR_SALDO','ULTIMO','STATUS','ID_FAVORECIDO');
    protected $_primary = array('ID');
    protected $_unique = array('ID_EMPRESA','ULTIMO');
    protected $_cols = array('ID','ID_EMPRESA','TIPO','DESCRICAO','ID_USU_INC','DH_INC','DT_LANC','VLR_LANC','VLR_SALDO','ULTIMO','STATUS','ID_FAVORECIDO');
    protected $_search = 'tipo';
    protected $_schema  = 'MAIS';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Financeiro_Model_CvPagtoLanc_Table');
    protected $_referenceMap = array();
    protected $_listOptions = array('tipo'=>array('D'=>'Débito'
                                                    ,'C'=>'Crédito')
                                    ,'status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'));
    protected $_mapper = 'Financeiro_Model_Lancamento_Mapper';
    protected $_element = 'Financeiro_Form_Lancamento_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Financeiro_Model_Lancamento_Element
     */
    public function getElement($columnName){
        $_element = new Financeiro_Form_Lancamento_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Financeiro_Model_Lancamento_Mapper
     */
    public function getMapper(){    
        $mapper = new Financeiro_Model_Lancamento_Mapper();
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