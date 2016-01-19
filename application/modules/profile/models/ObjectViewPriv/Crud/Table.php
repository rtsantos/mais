<?php
/**
 * Classe de mapeamento da tabela profile_object_view_priv
 */
class Profile_Model_ObjectViewPriv_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'PROFILE_OBJECT_VIEW_PRIV';
    protected $_sequence = 'SID_PROFILE_OBJECT_VIEW_PRIV';
    protected $_required = array('ID','ID_PROFILE_OBJECT_VIEW','ID_PAPEL');
    protected $_primary = array('ID');
    protected $_unique = array('ID_PROFILE_OBJECT_VIEW','ID_PAPEL','TIPO');
    protected $_cols = array('ID','ID_PROFILE_OBJECT_VIEW','ID_PAPEL','TIPO');
    protected $_search = '';
    protected $_schema  = 'PROUSER';
    protected $_adapter = 'db.prouser';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdPapel' => array(
                    'columns' => 'ID_PAPEL',
                    'refTableClass' => 'Auth_Model_Papel_Table',
                    'refColumns' => 'ID'
                ),
                'IdProfileObjectView' => array(
                    'columns' => 'ID_PROFILE_OBJECT_VIEW',
                    'refTableClass' => 'Profile_Model_ObjectView_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array('tipo'=>array('O'=>'Administração'
                                                    ,'S'=>'Visualização'));
    protected $_mapper = 'Profile_Model_ObjectViewPriv_Mapper';
    protected $_element = 'Profile_Form_ObjectViewPriv_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Profile_Model_ObjectViewPriv_Element
     */
    public function getElement($columnName){
        $_element = new Profile_Form_ObjectViewPriv_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Profile_Model_ObjectViewPriv_Mapper
     */
    public function getMapper(){    
        $mapper = new Profile_Model_ObjectViewPriv_Mapper();
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