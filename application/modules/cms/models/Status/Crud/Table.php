<?php
/**
 * Classe de mapeamento da tabela cms_status
 */
class Cms_Model_Status_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CMS_STATUS';
    protected $_sequence = 'SID_CMS_STATUS';
    protected $_required = array('ID','DESCRICAO','STATUS','ACAO','ID_CATEGORIA');
    protected $_primary = array('ID');
    protected $_unique = array('ID_CATEGORIA','DESCRICAO');
    protected $_cols = array('ID','DESCRICAO','STATUS','ACAO','ID_CATEGORIA');
    protected $_search = 'descricao';
    protected $_schema  = 'PHP';
    protected $_adapter = 'db.php';
    protected $_dependentTables = array(
                'Cms_Model_Conteudo_Table');
    protected $_referenceMap = array(
                'IdCategoria' => array(
                    'columns' => 'ID_CATEGORIA',
                    'refTableClass' => 'Cms_Model_Categoria_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array('status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo')
                                    ,'acao'=>array('P'=>'Pendente'
                                                    ,'A'=>'Aprovado'
                                                    ,'F'=>'Finalizado'
                                                    ,'C'=>'Cancelado'));
    protected $_mapper = 'Cms_Model_Status_Mapper';
    protected $_element = 'Cms_Form_Status_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Cms_Model_Status_Element
     */
    public function getElement($columnName){
        $_element = new Cms_Form_Status_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Cms_Model_Status_Mapper
     */
    public function getMapper(){    
        $mapper = new Cms_Model_Status_Mapper();
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