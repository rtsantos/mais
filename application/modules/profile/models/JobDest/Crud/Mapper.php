<?php
/**
 * Classe de mapeamento do registro da tabela profile_job_dest
 */
class Profile_Model_JobDest_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_profile_job','id_papel');
    protected $_model = 'Profile_Model_JobDest_Table';
    /**
     *
     * @var Profile_Model_JobDest_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Profile_Model_JobDest_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Profile_Model_JobDest_Mapper){
            $this->_dataOld = new Profile_Model_JobDest_Mapper();
            $this->_dataOld->setId($this->getId());
            $this->_dataOld->retrive();
        }
        return $this->_dataOld;
    }
    
    
    /**
     * Retorna os dados da coluna id
     *
     * @return string
     */
    public function getId($instance=false){
        if ($instance && !is_object($this->_data['id'])){
            $this->setId('',array('required'=>false));
        }
        return $this->_data['id'];
    }
    /**
     * Seta o valor da coluna id
     *
     * @param string $value
     * @return Profile_Model_JobDest_Crud_Mapper
     */
    public function setId($value,$options=array('required'=>true)){        
        $this->_data['id'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
        if ($options['db'])
            $this->_data['id']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna id_profile_job
     *
     * @return string
     */
    public function getIdProfileJob($instance=false){
        if ($instance && !is_object($this->_data['id_profile_job'])){
            $this->setIdProfileJob('',array('required'=>false));
        }
        return $this->_data['id_profile_job'];
    }
    /**
     * Seta o valor da coluna id_profile_job
     *
     * @param string $value
     * @return Profile_Model_JobDest_Crud_Mapper
     */
    public function setIdProfileJob($value,$options=array('required'=>true)){        
        $this->_data['id_profile_job'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
        if ($options['db'])
            $this->_data['id_profile_job']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_profile_job');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna id_papel
     *
     * @return string
     */
    public function getIdPapel($instance=false){
        if ($instance && !is_object($this->_data['id_papel'])){
            $this->setIdPapel('',array('required'=>false));
        }
        return $this->_data['id_papel'];
    }
    /**
     * Seta o valor da coluna id_papel
     *
     * @param string $value
     * @return Profile_Model_JobDest_Crud_Mapper
     */
    public function setIdPapel($value,$options=array('required'=>true)){        
        $this->_data['id_papel'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
        if ($options['db'])
            $this->_data['id_papel']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_papel');
                    
        }
        return $this;
    }
            
}
?>