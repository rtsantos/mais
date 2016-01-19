<?php
/**
 * Classe de mapeamento da tabela cms_notificacao
 */
class Cms_Model_Notificacao_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CMS_NOTIFICACAO';
    
    protected $_required = array('ID_CONTEUDO','ID_USUARIO');
    protected $_primary = array('ID_CONTEUDO','ID_USUARIO');
    protected $_unique = array();
    protected $_cols = array('ID_CONTEUDO','ID_USUARIO','ID_MAILLIST');
    protected $_search = '';
    protected $_schema  = 'PHP';
    protected $_adapter = 'db.php';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdMaillist' => array(
                    'columns' => 'ID_MAILLIST',
                    'refTableClass' => 'Tools_Model_Maillist_Table',
                    'refColumns' => 'ID'
                ),
                'IdUsuario' => array(
                    'columns' => 'ID_USUARIO',
                    'refTableClass' => 'Auth_Model_Usuario_Table',
                    'refColumns' => 'ID'
                ),
                'IdConteudo' => array(
                    'columns' => 'ID_CONTEUDO',
                    'refTableClass' => 'Cms_Model_Conteudo_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Cms_Model_Notificacao_Mapper';
    protected $_element = 'Cms_Form_Notificacao_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Cms_Model_Notificacao_Element
     */
    public function getElement($columnName){
        $_element = new Cms_Form_Notificacao_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Cms_Model_Notificacao_Mapper
     */
    public function getMapper(){    
        $mapper = new Cms_Model_Notificacao_Mapper();
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