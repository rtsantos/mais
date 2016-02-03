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
    protected $_unique = array();
    protected $_cols = array('ID','ID_EMPRESA','TIPO','DESCRICAO','ID_USU_INC','DH_INC','DT_LANC','VLR_LANC','VLR_SALDO','ULTIMO','STATUS','ID_FAVORECIDO','ID_CONTRATO','ID_FORMA_PAGTO','PAGO','OBSERVACAO','ID_LANCAMENTO_ORIG');
    protected $_search = 'tipo';
    protected $_schema  = 'MAIS';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Vendas_Model_ItemLanc_Table',
                'Vendas_Model_PagtoLanc_Table',
                'Financeiro_Model_Lancamento_Table');
    protected $_referenceMap = array(
                'IdLancamentoOrig' => array(
                    'columns' => 'id_lancamento_orig',
                    'refTableClass' => 'Financeiro_Model_Lancamento_Table',
                    'refColumns' => 'id'
                ),
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdFavorecido' => array(
                    'columns' => 'id_favorecido',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdContrato' => array(
                    'columns' => 'id_contrato',
                    'refTableClass' => 'Ca_Model_Contrato_Table',
                    'refColumns' => 'id'
                ),
                'IdFormaPagto' => array(
                    'columns' => 'id_forma_pagto',
                    'refTableClass' => 'Vendas_Model_FormaPagamento_Table',
                    'refColumns' => 'id'
                ),
                'IdUsuInc' => array(
                    'columns' => 'id_usu_inc',
                    'refTableClass' => 'Auth_Model_Conta_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('tipo'=>array('D'=>'Débito'
                                                    ,'C'=>'Crédito')
                                    ,'status'=>array('A'=>'Aberto'
                                                    ,'E'=>'Efetivado'
                                                    ,'C'=>'Cancelado')
                                    ,'pago'=>array('S'=>'Sim'
                                                    ,'N'=>'Não'));
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