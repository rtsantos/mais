<?php
/**
 * Classe de mapeamento da tabela img_arquivo
 */
class Ged_Model_Arquivo_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'IMG_ARQUIVO';
    protected $_sequence = 'SID_IMG_ARQUIVO';
    protected $_required = array('ID','CONTEUDO_NAME','CONTEUDO_TYPE','DH_INC');
    protected $_primary = array('ID');
    protected $_unique = array('HASHCODE');
    protected $_cols = array('ID','CONTEUDO_NAME','CONTEUDO_TYPE','DH_INC','HASHCODE','CONTEUDO','ID_PROP_DOCTO','PATH_ARQ','DT_EXPIRA');
    protected $_search = 'conteudo_name';
    protected $_schema  = 'IMAGE';
    protected $_adapter = 'db.image';
    protected $_dependentTables = array(
                'Ged_Model_Docto_Table');
    protected $_referenceMap = array(
                'IdPropDocto' => array(
                    'columns' => 'ID_PROP_DOCTO',
                    'refTableClass' => 'Ged_Model_PropDocto_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Ged_Model_Arquivo_Mapper';
    protected $_element = 'Ged_Form_Arquivo_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ged_Model_Arquivo_Element
     */
    public function getElement($columnName){
        $_element = new Ged_Form_Arquivo_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Ged_Model_Arquivo_Mapper
     */
    public function getMapper(){    
        $mapper = new Ged_Model_Arquivo_Mapper();
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