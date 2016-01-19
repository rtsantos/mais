<?php
/**
 * Classe de mapeamento da tabela cms_categoria
 */
class Cms_Model_Categoria_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CMS_CATEGORIA';
    protected $_sequence = 'SID_CMS_CATEGORIA';
    protected $_required = array('ID','DESCRICAO','TIPO','STATUS','PUBLICO','MENU','ORDEM','CHAVE','NIVEL');
    protected $_primary = array('ID');
    protected $_unique = array('TIPO','DESCRICAO');
    protected $_cols = array('ID','DESCRICAO','ID_CATEGORIA_PAI','TIPO','STATUS','PUBLICO','MENU','OBSERVACAO','ORDEM','THUMBNAIL','URL','CHAVE','NIVEL','URL_MACRO');
    protected $_search = 'descricao';
    protected $_schema  = 'PHP';
    protected $_adapter = 'db.php';
    protected $_dependentTables = array(
                'Cms_Model_Categoria_Table',
                'Cms_Model_Status_Table',
                'Cms_Model_PrivCateg_Table',
                'Cms_Model_Conteudo_Table');
    protected $_referenceMap = array(
                'IdCategoriaPai' => array(
                    'columns' => 'ID_CATEGORIA_PAI',
                    'refTableClass' => 'Cms_Model_Categoria_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array('tipo'=>array('C'=>'Categoria'
                                                    ,'S'=>'Seção'
                                                    ,'A'=>'Assunto')
                                    ,'status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo')
                                    ,'publico'=>array('S'=>'Sim'
                                                    ,'N'=>'Não')
                                    ,'menu'=>array('N'=>'Não'
                                                    ,'S'=>'Sim'));
    protected $_mapper = 'Cms_Model_Categoria_Mapper';
    protected $_element = 'Cms_Form_Categoria_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Cms_Model_Categoria_Element
     */
    public function getElement($columnName){
        $_element = new Cms_Form_Categoria_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Cms_Model_Categoria_Mapper
     */
    public function getMapper(){    
        $mapper = new Cms_Model_Categoria_Mapper();
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