<?php
/**
 * Classe de mapeamento da tabela ca_contrato
 */
class Ca_Model_Contrato_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'ca_contrato';
    protected $_alias = 'ca_contrato';
    protected $_sequence = 'sid_ca_contrato';
    protected $_required = array('id','descricao','numero','status','id_empresa','id_cliente','dt_vig_ini');
    protected $_primary = array('id');
    protected $_unique = array('descricao','id_empresa');
    protected $_cols = array('id','descricao','numero','status','id_empresa','id_cliente','dt_vig_ini','dt_vig_fim');
    protected $_search = 'numero';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Ca_Model_RegraContrato_Table');
    protected $_referenceMap = array(
                'IdCliente' => array(
                    'columns' => 'id_cliente',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ),
                'IdEmpresa' => array(
                    'columns' => 'id_empresa',
                    'refTableClass' => 'Ca_Model_Pessoa_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'));
    protected $_mapper = 'Ca_Model_Contrato_Mapper';
    protected $_element = 'Ca_Form_Contrato_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ca_Model_Contrato_Element
     */
    public function getElement($columnName){
        $_element = new Ca_Form_Contrato_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ca_Model_Contrato_Mapper
     */
    public function getMapper(){    
        $mapper = new Ca_Model_Contrato_Mapper();
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