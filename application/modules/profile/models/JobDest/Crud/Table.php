<?php
/**
 * Classe de mapeamento da tabela profile_job_dest
 */
class Profile_Model_JobDest_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'profile_job_dest';
    
    protected $_required = array('id','id_profile_job','id_papel');
    protected $_primary = array('id');
    protected $_unique = array('id_profile_job','id_papel');
    protected $_cols = array('id','id_profile_job','id_papel');
    protected $_search = '';
    protected $_schema  = 'prouser';
    protected $_adapter = 'db.prouser';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdProfileJob' => array(
                    'columns' => 'ID_PROFILE_JOB',
                    'refTableClass' => 'Profile_Model_Job_Table',
                    'refColumns' => 'ID'
                ),
                'IdPapel' => array(
                    'columns' => 'ID_PAPEL',
                    'refTableClass' => 'Auth_Model_Papel_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Profile_Model_JobDest_Mapper';
    protected $_element = 'Profile_Form_JobDest_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Profile_Model_JobDest_Element
     */
    public function getElement($columnName){
        $_element = new Profile_Form_JobDest_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Profile_Model_JobDest_Mapper
     */
    public function getMapper(){    
        $mapper = new Profile_Model_JobDest_Mapper();
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