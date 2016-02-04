<?php
/**
 * Classe de mapeamento da tabela cv_parcela
 */
class Vendas_Model_Parcela_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'cv_parcela';
    protected $_sequence = 'sid_cv_parcela';
    protected $_required = array('id','descricao','status','qtd','id_empresa');
    protected $_primary = array('id');
    protected $_unique = array('id_empresa','descricao');
    protected $_cols = array('id','descricao','per_juro','status','qtd','id_empresa','dias_venc');
    protected $_search = 'descricao';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Vendas_Model_Pagamento_Table');
    protected $_referenceMap = array(
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'));
    protected $_mapper = 'Vendas_Model_Parcela_Mapper';
    protected $_element = 'Vendas_Form_Parcela_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Model_Parcela_Element
     */
    public function getElement($columnName){
        $_element = new Vendas_Form_Parcela_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Vendas_Model_Parcela_Mapper
     */
    public function getMapper(){    
        $mapper = new Vendas_Model_Parcela_Mapper();
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