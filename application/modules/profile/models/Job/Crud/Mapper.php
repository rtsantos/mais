<?php
/**
 * Classe de mapeamento do registro da tabela pf_job
 */
class Profile_Model_Job_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_profile_object_view','descricao','dh_ini_exec','tipo','frequencia');
    protected $_model = 'Profile_Model_Job_Table';
    public static $table = 'mais.pf_job';
    /**
     *
     * @var Profile_Model_Job_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Profile_Model_Job_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Profile_Model_Job_Mapper){
            $this->_dataOld = new Profile_Model_Job_Mapper();
            $this->_dataOld->setId($this->getId());
            $this->_dataOld->retrive();
        }
        return $this->_dataOld;
    }
    /**
     * Retorna as referências do objeto
     */
    public function getReferenceMap(){
        return array(
                'ID_PROFILE_OBJECT_VIEW' => array(
                    'mapper' => 'Profile_DataView_ObjectView_MapperView',
                    'column' => 'ID'
                ));
    }
    /**
     * @retun array
     */
    public function getTabs(){
        return array (
);
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
     * @return Profile_Model_Job_Crud_Mapper
     */
    public function setId($value,$options=array('required'=>true)){        
        $this->_data['id'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_profile_object_view
     *
     * @return string
     */
    public function getIdProfileObjectView($instance=false){
        if ($instance && !is_object($this->_data['id_profile_object_view'])){
            $this->setIdProfileObjectView('',array('required'=>false));
        }
        return $this->_data['id_profile_object_view'];
    }
    /**
     * Seta o valor da coluna id_profile_object_view
     *
     * @param string $value
     * @return Profile_Model_Job_Crud_Mapper
     */
    public function setIdProfileObjectView($value,$options=array('required'=>true)){        
        $this->_data['id_profile_object_view'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_profile_object_view']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_profile_object_view');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna descricao
     *
     * @return string
     */
    public function getDescricao($instance=false){
        if ($instance && !is_object($this->_data['descricao'])){
            $this->setDescricao('',array('required'=>false));
        }
        return $this->_data['descricao'];
    }
    /**
     * Seta o valor da coluna descricao
     *
     * @param string $value
     * @return Profile_Model_Job_Crud_Mapper
     */
    public function setDescricao($value,$options=array('required'=>true)){        
        $this->_data['descricao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['descricao']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'descricao');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['descricao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dh_ini_exec
     *
     * @return string
     */
    public function getDhIniExec($instance=false){
        if ($instance && !is_object($this->_data['dh_ini_exec'])){
            $this->setDhIniExec('',array('required'=>false));
        }
        return $this->_data['dh_ini_exec'];
    }
    /**
     * Seta o valor da coluna dh_ini_exec
     *
     * @param string $value
     * @return Profile_Model_Job_Crud_Mapper
     */
    public function setDhIniExec($value,$options=array('required'=>true)){        
        $this->_data['dh_ini_exec'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_ini_exec']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dh_ini_exec');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dh_ult_exec
     *
     * @return string
     */
    public function getDhUltExec($instance=false){
        if ($instance && !is_object($this->_data['dh_ult_exec'])){
            $this->setDhUltExec('',array('required'=>false));
        }
        return $this->_data['dh_ult_exec'];
    }
    /**
     * Seta o valor da coluna dh_ult_exec
     *
     * @param string $value
     * @return Profile_Model_Job_Crud_Mapper
     */
    public function setDhUltExec($value,$options=array('required'=>true)){        
        $this->_data['dh_ult_exec'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_ult_exec']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna tipo
     *
     * @return string
     */
    public function getTipo($instance=false){
        if ($instance && !is_object($this->_data['tipo'])){
            $this->setTipo('',array('required'=>false));
        }
        return $this->_data['tipo'];
    }
    /**
     * Seta o valor da coluna tipo
     *
     * @param string $value
     * @return Profile_Model_Job_Crud_Mapper
     */
    public function setTipo($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('1'=>'Minuto','2'=>'Hora','3'=>'Dia','4'=>'Mês');
        $this->_data['tipo'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['tipo']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'tipo');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna frequencia
     *
     * @return string
     */
    public function getFrequencia($instance=false){
        if ($instance && !is_object($this->_data['frequencia'])){
            $this->setFrequencia('',array('required'=>false));
        }
        return $this->_data['frequencia'];
    }
    /**
     * Seta o valor da coluna frequencia
     *
     * @param string $value
     * @return Profile_Model_Job_Crud_Mapper
     */
    public function setFrequencia($value,$options=array('required'=>true)){        
        $this->_data['frequencia'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['frequencia']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'frequencia');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dt_fim_exec
     *
     * @return string
     */
    public function getDtFimExec($instance=false){
        if ($instance && !is_object($this->_data['dt_fim_exec'])){
            $this->setDtFimExec('',array('required'=>false));
        }
        return $this->_data['dt_fim_exec'];
    }
    /**
     * Seta o valor da coluna dt_fim_exec
     *
     * @param string $value
     * @return Profile_Model_Job_Crud_Mapper
     */
    public function setDtFimExec($value,$options=array('required'=>true)){        
        $this->_data['dt_fim_exec'] = new ZendT_Type_Date($value,'Date');
         if ($options['db'])
            $this->_data['dt_fim_exec']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>