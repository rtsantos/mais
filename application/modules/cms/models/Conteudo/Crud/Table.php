<?php
/**
 * Classe de mapeamento da tabela cms_conteudo
 */
class Cms_Model_Conteudo_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CMS_CONTEUDO';
    protected $_sequence = 'SID_CMS_CONTEUDO';
    protected $_required = array('ID','ID_CATEGORIA','TITULO','DH_INI_PUB','ID_USUARIO_INC','ID_STATUS','PUBLICO','CHAVE','CHAVE_MACRO');
    protected $_primary = array('ID');
    protected $_unique = array('ID_CATEGORIA','TITULO','ID_CONTEUDO_PAI','ID_USUARIO_INC','SUB_TITULO');
    protected $_cols = array('ID','ID_CATEGORIA','ID_CONTEUDO_PAI','TITULO','SUB_TITULO','DH_INI_PUB','DH_FIM_PUB','CORPO','ARQUIVO','THUMBNAIL','ID_USUARIO_INC','ID_STATUS','PUBLICO','BANNER','CORPO_URL','CHAVE','CHAVE_MACRO','ID_USUARIO_APROV','ID_FILIAL');
    protected $_search = 'titulo';
    protected $_schema  = 'PHP';
    protected $_adapter = 'db.php';
    protected $_dependentTables = array(
                'Cms_Model_PrivConteudo_Table',
                'Cms_Model_CmsNotificacao_Table',
                'Cms_Model_Conteudo_Table');
    protected $_referenceMap = array(
                'IdUsuarioAprov' => array(
                    'columns' => 'ID_USUARIO_APROV',
                    'refTableClass' => 'Auth_Model_Usuario_Table',
                    'refColumns' => 'ID'
                ),
                'IdFilial' => array(
                    'columns' => 'ID_FILIAL',
                    'refTableClass' => 'Ca_Model_Filial_Table',
                    'refColumns' => 'ID'
                ),
                'IdCategoria' => array(
                    'columns' => 'ID_CATEGORIA',
                    'refTableClass' => 'Cms_Model_Categoria_Table',
                    'refColumns' => 'ID'
                ),
                'IdUsuarioInc' => array(
                    'columns' => 'ID_USUARIO_INC',
                    'refTableClass' => 'Auth_Model_Usuario_Table',
                    'refColumns' => 'ID'
                ),
                'IdStatus' => array(
                    'columns' => 'ID_STATUS',
                    'refTableClass' => 'Cms_Model_Status_Table',
                    'refColumns' => 'ID'
                ),
                'IdConteudoPai' => array(
                    'columns' => 'ID_CONTEUDO_PAI',
                    'refTableClass' => 'Cms_Model_Conteudo_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array('publico'=>array('S'=>'Sim'
                                                    ,'N'=>'Não'));
    protected $_mapper = 'Cms_Model_Conteudo_Mapper';
    protected $_element = 'Cms_Form_Conteudo_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Cms_Model_Conteudo_Element
     */
    public function getElement($columnName){
        $_element = new Cms_Form_Conteudo_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Cms_Model_Conteudo_Mapper
     */
    public function getMapper(){    
        $mapper = new Cms_Model_Conteudo_Mapper();
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