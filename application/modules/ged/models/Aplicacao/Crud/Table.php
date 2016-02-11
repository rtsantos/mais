<?php
/**
 * Classe de mapeamento da tabela img_aplicacao
 */
class Ged_Model_Aplicacao_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'img_aplicacao';
    protected $_sequence = 'sid_img_aplicacao';
    protected $_required = array('id','id_aplic_prouser');
    protected $_primary = array('id');
    protected $_unique = array();
    protected $_cols = array('id','id_aplic_prouser');
    protected $_search = 'sigla_aplic_prouser';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Ged_Model_ImgPropDocto_Table');
    protected $_referenceMap = array(
                'IdAplicProuser' => array(
                    'columns' => 'ID_APLIC_PROUSER',
                    'refTableClass' => 'Auth_Model_Aplicacao_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Ged_Model_Aplicacao_Mapper';
    protected $_element = 'Ged_Form_Aplicacao_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ged_Model_Aplicacao_Element
     */
    public function getElement($columnName){
        $_element = new Ged_Form_Aplicacao_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ged_Model_Aplicacao_Mapper
     */
    public function getMapper(){    
        $mapper = new Ged_Model_Aplicacao_Mapper();
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