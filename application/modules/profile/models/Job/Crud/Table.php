<?php
/**
 * Classe de mapeamento da tabela pf_job
 */
class Profile_Model_Job_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'pf_job';
    protected $_alias = 'profile_job';
    protected $_sequence = 'sid_pf_job';
    protected $_required = array('id','id_profile_object_view','descricao','dh_ini_exec','tipo','frequencia');
    protected $_primary = array('id');
    protected $_unique = array('');
    protected $_cols = array('id','id_profile_object_view','descricao','dh_ini_exec','dh_ult_exec','tipo','frequencia','dt_fim_exec');
    protected $_search = 'descricao';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array(
                'Profile_Model_JobDest_Table');
    protected $_referenceMap = array(
                'IdProfileObjectView' => array(
                    'columns' => 'ID_PROFILE_OBJECT_VIEW',
                    'refTableClass' => 'Profile_Model_ObjectView_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array('tipo'=>array('1'=>'Minuto'
                                                    ,'2'=>'Hora'
                                                    ,'3'=>'Dia'
                                                    ,'4'=>'Mês'));
    protected $_mapper = 'Profile_Model_Job_Mapper';
    protected $_element = 'Profile_Form_Job_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Profile_Model_Job_Element
     */
    public function getElement($columnName){
        $_element = new Profile_Form_Job_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Profile_Model_Job_Mapper
     */
    public function getMapper(){    
        $mapper = new Profile_Model_Job_Mapper();
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