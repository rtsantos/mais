<?php
/**
 * Classe de mapeamento da tabela pf_object_view
 */
class Profile_Model_ObjectView_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'pf_object_view';
    protected $_alias = 'profile_object_view';
    protected $_sequence = 'sid_pf_object_view';
    protected $_required = array('id','tipo','padrao','nome','objeto','id_usuario');
    protected $_primary = array('id');
    protected $_unique = array('objeto','id_usuario','nome');
    protected $_cols = array('id','tipo','padrao','nome','objeto','observacao','config','id_usuario','uri','chave');
    protected $_search = 'nome';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Profile_Model_Job_Table',
                'Profile_Model_ObjectViewPriv_Table');
    protected $_referenceMap = array(
                'IdUsuario' => array(
                    'columns' => 'id_usuario',
                    'refTableClass' => 'Auth_Model_Conta_Table',
                    'refColumns' => 'id'
                ));
    protected $_listOptions = array('tipo'=>array('F'=>'Formulário'
                                                    ,'G'=>'Tabela'
                                                    ,'C'=>'Gráfico Dinâmico'
                                                    ,'D'=>'Tabela Dinâmica'
                                                    ,'I'=>'Impressão Dinâmica')
                                    ,'padrao'=>array('S'=>'Sim'
                                                    ,'N'=>'Não'));
    protected $_mapper = 'Profile_Model_ObjectView_Mapper';
    protected $_element = 'Profile_Form_ObjectView_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Profile_Model_ObjectView_Element
     */
    public function getElement($columnName){
        $_element = new Profile_Form_ObjectView_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Profile_Model_ObjectView_Mapper
     */
    public function getMapper(){    
        $mapper = new Profile_Model_ObjectView_Mapper();
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