<?php
/**
 * Classe de mapeamento da tabela pf_object_view_priv
 */
class Profile_Model_ObjectViewPriv_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'pf_object_view_priv';
    protected $_alias = 'profile_object_view_priv';
    protected $_sequence = 'sid_pf_object_view_priv';
    protected $_required = array('id','id_profile_object_view','id_papel');
    protected $_primary = array('id');
    protected $_unique = array('id_profile_object_view','id_papel','tipo');
    protected $_cols = array('id','id_profile_object_view','id_papel','tipo');
    protected $_search = '';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdPapel' => array(
                    'columns' => 'ID_PAPEL',
                    'refTableClass' => 'Auth_Model_Conta_Table',
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