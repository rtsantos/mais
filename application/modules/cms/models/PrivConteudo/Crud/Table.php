<?php
/**
 * Classe de mapeamento da tabela cms_priv_conteudo
 */
class Cms_Model_PrivConteudo_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CMS_PRIV_CONTEUDO';
    protected $_sequence = 'SID_CMS_PRIV_CONTEUDO';
    protected $_required = array('ID_CONTEUDO','ID','TIPO','ENV_EMAIL');
    protected $_primary = array('ID');
    protected $_unique = array('ID_CONTEUDO','ID_PAPEL','ID_USUARIO');
    protected $_cols = array('ID_CONTEUDO','ID_PAPEL','ID','TIPO','ENV_EMAIL','ID_USUARIO');
    protected $_search = 'tipo';
    protected $_schema  = 'PHP';
    protected $_adapter = 'db.php';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdUsuario' => array(
                    'columns' => 'ID_USUARIO',
                    'refTableClass' => 'Auth_Model_Usuario_Table',
                    'refColumns' => 'ID'
                ),
                'IdConteudo' => array(
                    'columns' => 'ID_CONTEUDO',
                    'refTableClass' => 'Cms_Model_Conteudo_Table',
                    'refColumns' => 'ID'
                ),
                'IdPapel' => array(
                    'columns' => 'ID_PAPEL',
                    'refTableClass' => 'Auth_Model_Papel_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array('tipo'=>array('A'=>'Administração'
                                                    ,'V'=>'Visualização')
                                    ,'env_email'=>array('S'=>'Sim'
                                                    ,'N'=>'Não'));
    protected $_mapper = 'Cms_Model_PrivConteudo_Mapper';
    protected $_element = 'Cms_Form_PrivConteudo_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Cms_Model_PrivConteudo_Element
     */
    public function getElement($columnName){
        $_element = new Cms_Form_PrivConteudo_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Cms_Model_PrivConteudo_Mapper
     */
    public function getMapper(){    
        $mapper = new Cms_Model_PrivConteudo_Mapper();
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