<?php
/**
 * Classe de mapeamento da tabela at_aplicacao
 */
class Auth_Model_Aplicacao_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'at_aplicacao';
    protected $_sequence = 'sid_at_aplicacao';
    protected $_required = array('id','sigla','nome','status');
    protected $_primary = array('id');
    protected $_unique = array('sigla');
    protected $_cols = array('id','sigla','nome','status','observacao','icone','url','dh_inc');
    protected $_search = 'sigla';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Auth_Model_Recurso_Table');
    protected $_referenceMap = array();
    protected $_listOptions = array('status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'));
    protected $_mapper = 'Auth_Model_Aplicacao_Mapper';
    protected $_element = 'Auth_Form_Aplicacao_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Model_Aplicacao_Element
     */
    public function getElement($columnName){
        $_element = new Auth_Form_Aplicacao_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Auth_Model_Aplicacao_Mapper
     */
    public function getMapper(){    
        $mapper = new Auth_Model_Aplicacao_Mapper();
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