<?php
/**
 * Classe de mapeamento da tabela img_docto
 */
class Ged_Model_Docto_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'IMG_DOCTO';
    protected $_sequence = 'SID_IMG_DOCTO';
    protected $_required = array('ID','ID_TIPO_DOCTO','ID_PROP_RELAC','DH_INCLUSAO');
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','ID_TIPO_DOCTO','ID_PROP_RELAC','DH_INCLUSAO','ID_USU_INCL','DESCRICAO','ID_ARQUIVO');
    protected $_search = 'descricao';
    protected $_schema  = 'IMAGE';
    protected $_adapter = 'db.image';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdTipoDocto' => array(
                    'columns' => 'ID_TIPO_DOCTO',
                    'refTableClass' => 'Ged_Model_TipoDocto_Table',
                    'refColumns' => 'ID'
                ),
                'IdArquivo' => array(
                    'columns' => 'ID_ARQUIVO',
                    'refTableClass' => 'Ged_Model_Arquivo_Table',
                    'refColumns' => 'ID'
                ),
                'IdUsuIncl' => array(
                    'columns' => 'ID_USU_INCL',
                    'refTableClass' => 'Auth_Model_Usuario_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Ged_Model_Docto_Mapper';
    protected $_element = 'Ged_Form_Docto_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ged_Model_Docto_Element
     */
    public function getElement($columnName){
        $_element = new Ged_Form_Docto_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ged_Model_Docto_Mapper
     */
    public function getMapper(){    
        $mapper = new Ged_Model_Docto_Mapper();
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