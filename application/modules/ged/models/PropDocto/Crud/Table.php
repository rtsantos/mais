<?php
/**
 * Classe de mapeamento da tabela img_prop_docto
 */
class Ged_Model_PropDocto_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'IMG_PROP_DOCTO';
    protected $_sequence = 'SID_IMG_PROP_DOCTO';
    protected $_required = array('ID','ID_APLICACAO','NOME');
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','ID_APLICACAO','NOME','TABELA','SQL','CONFIG');
    protected $_search = 'nome';
    protected $_schema  = 'IMAGE';
    protected $_adapter = 'db.image';
    protected $_dependentTables = array(
                'Ged_Model_ImgPropGeral_Table',
                'Ged_Model_ImgPropSeeker_Table',
                'Ged_Model_TipoDocto_Table');
    protected $_referenceMap = array(
                'IdAplicacao' => array(
                    'columns' => 'ID_APLICACAO',
                    'refTableClass' => 'Ged_Model_Aplicacao_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Ged_Model_PropDocto_Mapper';
    protected $_element = 'Ged_Form_PropDocto_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ged_Model_PropDocto_Element
     */
    public function getElement($columnName){
        $_element = new Ged_Form_PropDocto_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ged_Model_PropDocto_Mapper
     */
    public function getMapper(){    
        $mapper = new Ged_Model_PropDocto_Mapper();
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