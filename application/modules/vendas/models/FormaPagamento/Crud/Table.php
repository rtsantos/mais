<?php
/**
 * Classe de mapeamento da tabela cv_forma_pagto
 */
class Vendas_Model_FormaPagamento_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CV_FORMA_PAGTO';
    protected $_sequence = 'SID_CV_FORMA_PAGTO';
    protected $_required = array('ID','DESCRICAO','PARCELA','STATUS','ID_EMPRESA');
    protected $_primary = array('ID');
    protected $_unique = array('ID_EMPRESA','DESCRICAO');
    protected $_cols = array('ID','DESCRICAO','PARCELA','STATUS','ID_EMPRESA','PAGO');
    protected $_search = 'descricao';
    protected $_schema  = 'MAIS';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Vendas_Model_Pagamento_Table');
    protected $_referenceMap = array(
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('parcela'=>array('S'=>'Sim'
                                                    ,'N'=>'Não')
                                    ,'status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo')
                                    ,'pago'=>array('S'=>'Sim'
                                                    ,'N'=>'Não'));
    protected $_mapper = 'Vendas_Model_FormaPagamento_Mapper';
    protected $_element = 'Vendas_Form_FormaPagamento_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Model_FormaPagamento_Element
     */
    public function getElement($columnName){
        $_element = new Vendas_Form_FormaPagamento_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Vendas_Model_FormaPagamento_Mapper
     */
    public function getMapper(){    
        $mapper = new Vendas_Model_FormaPagamento_Mapper();
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