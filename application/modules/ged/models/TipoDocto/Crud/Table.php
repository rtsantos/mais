<?php
/**
 * Classe de mapeamento da tabela img_tipo_docto
 */
class Ged_Model_TipoDocto_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'IMG_TIPO_DOCTO';
    protected $_sequence = 'SID_IMG_TIPO_DOCTO';
    protected $_required = array('ID','ID_PROP_DOCTO','NOME','STATUS');
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','ID_PROP_DOCTO','NOME','STATUS');
    protected $_search = 'nome';
    protected $_schema  = 'IMAGE';
    protected $_adapter = 'db.image';
    protected $_dependentTables = array(
                'Ged_Model_ImgDocto_Table');
    protected $_referenceMap = array(
                'IdPropDocto' => array(
                    'columns' => 'ID_PROP_DOCTO',
                    'refTableClass' => 'Ged_Model_PropDocto_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array('status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'
                                                    ,'1'=>'Ativo (1)'));
    protected $_mapper = 'Ged_Model_TipoDocto_Mapper';
    protected $_element = 'Ged_Form_TipoDocto_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ged_Model_TipoDocto_Element
     */
    public function getElement($columnName){
        $_element = new Ged_Form_TipoDocto_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ged_Model_TipoDocto_Mapper
     */
    public function getMapper(){    
        $mapper = new Ged_Model_TipoDocto_Mapper();
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