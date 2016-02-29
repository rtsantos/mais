<?php
/**
 * Classe de mapeamento do registro da tabela tl_job
 */
class Tools_Model_Job_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','descricao','dh_inc','dh_ini_exec','tp_frequencia','num_frequencia','forma_exec','procedimento','dh_pro_exec');
    protected $_model = 'Tools_Model_Job_Table';
    public static $table = 'mais.tl_job';
    /**
     *
     * @var Tools_Model_Job_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Tools_Model_Job_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Tools_Model_Job_Mapper){
            $this->_dataOld = new Tools_Model_Job_Mapper();
            $this->_dataOld->setId($this->getId());
            $this->_dataOld->retrive();
        }
        return $this->_dataOld;
    }
    /**
     * Retorna as referências do objeto
     */
    public function getReferenceMap(){
        return array();
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
     * @return Tools_Model_Job_Crud_Mapper
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
     * @return Tools_Model_Job_Crud_Mapper
     */
    public function setDescricao($value,$options=array('required'=>true)){        
        $this->_data['descricao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
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
     * Retorna os dados da coluna dh_inc
     *
     * @return string
     */
    public function getDhInc($instance=false){
        if ($instance && !is_object($this->_data['dh_inc'])){
            $this->setDhInc('',array('required'=>false));
        }
        return $this->_data['dh_inc'];
    }
    /**
     * Seta o valor da coluna dh_inc
     *
     * @param string $value
     * @return Tools_Model_Job_Crud_Mapper
     */
    public function setDhInc($value,$options=array('required'=>true)){        
        $this->_data['dh_inc'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_inc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dh_inc');
                    
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
     * @return Tools_Model_Job_Crud_Mapper
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
     * @return Tools_Model_Job_Crud_Mapper
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
     * Retorna os dados da coluna dh_fim_exec
     *
     * @return string
     */
    public function getDhFimExec($instance=false){
        if ($instance && !is_object($this->_data['dh_fim_exec'])){
            $this->setDhFimExec('',array('required'=>false));
        }
        return $this->_data['dh_fim_exec'];
    }
    /**
     * Seta o valor da coluna dh_fim_exec
     *
     * @param string $value
     * @return Tools_Model_Job_Crud_Mapper
     */
    public function setDhFimExec($value,$options=array('required'=>true)){        
        $this->_data['dh_fim_exec'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_fim_exec']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna tp_frequencia
     *
     * @return string
     */
    public function getTpFrequencia($instance=false){
        if ($instance && !is_object($this->_data['tp_frequencia'])){
            $this->setTpFrequencia('',array('required'=>false));
        }
        return $this->_data['tp_frequencia'];
    }
    /**
     * Seta o valor da coluna tp_frequencia
     *
     * @param string $value
     * @return Tools_Model_Job_Crud_Mapper
     */
    public function setTpFrequencia($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('M'=>'Mês','H'=>'Hora','D'=>'Dia');
        $this->_data['tp_frequencia'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['tp_frequencia']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'tp_frequencia');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['tp_frequencia']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna num_frequencia
     *
     * @return string
     */
    public function getNumFrequencia($instance=false){
        if ($instance && !is_object($this->_data['num_frequencia'])){
            $this->setNumFrequencia('',array('required'=>false));
        }
        return $this->_data['num_frequencia'];
    }
    /**
     * Seta o valor da coluna num_frequencia
     *
     * @param string $value
     * @return Tools_Model_Job_Crud_Mapper
     */
    public function setNumFrequencia($value,$options=array('required'=>true)){        
        $this->_data['num_frequencia'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['num_frequencia']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'num_frequencia');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna forma_exec
     *
     * @return string
     */
    public function getFormaExec($instance=false){
        if ($instance && !is_object($this->_data['forma_exec'])){
            $this->setFormaExec('',array('required'=>false));
        }
        return $this->_data['forma_exec'];
    }
    /**
     * Seta o valor da coluna forma_exec
     *
     * @param string $value
     * @return Tools_Model_Job_Crud_Mapper
     */
    public function setFormaExec($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('C'=>'Classe','U'=>'Url');
        $this->_data['forma_exec'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['forma_exec']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'forma_exec');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['forma_exec']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna procedimento
     *
     * @return string
     */
    public function getProcedimento($instance=false){
        if ($instance && !is_object($this->_data['procedimento'])){
            $this->setProcedimento('',array('required'=>false));
        }
        return $this->_data['procedimento'];
    }
    /**
     * Seta o valor da coluna procedimento
     *
     * @param string $value
     * @return Tools_Model_Job_Crud_Mapper
     */
    public function setProcedimento($value,$options=array('required'=>true)){        
        $this->_data['procedimento'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', )));
        if ($options['db'])
            $this->_data['procedimento']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'procedimento');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1000, ) );
            $valueValid = $this->_data['procedimento']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna parametro
     *
     * @return string
     */
    public function getParametro($instance=false){
        if ($instance && !is_object($this->_data['parametro'])){
            $this->setParametro('',array('required'=>false));
        }
        return $this->_data['parametro'];
    }
    /**
     * Seta o valor da coluna parametro
     *
     * @param string $value
     * @return Tools_Model_Job_Crud_Mapper
     */
    public function setParametro($value,$options=array('required'=>true)){        
        $this->_data['parametro'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', )));
        if ($options['db'])
            $this->_data['parametro']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1000, ) );
            $valueValid = $this->_data['parametro']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna tempo_ul_exec
     *
     * @return string
     */
    public function getTempoUlExec($instance=false){
        if ($instance && !is_object($this->_data['tempo_ul_exec'])){
            $this->setTempoUlExec('',array('required'=>false));
        }
        return $this->_data['tempo_ul_exec'];
    }
    /**
     * Seta o valor da coluna tempo_ul_exec
     *
     * @param string $value
     * @return Tools_Model_Job_Crud_Mapper
     */
    public function setTempoUlExec($value,$options=array('required'=>true)){        
        $this->_data['tempo_ul_exec'] = new ZendT_Type_Number($value,array('numDecimal'=>3));
         if ($options['db'])
            $this->_data['tempo_ul_exec']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dh_pro_exec
     *
     * @return string
     */
    public function getDhProExec($instance=false){
        if ($instance && !is_object($this->_data['dh_pro_exec'])){
            $this->setDhProExec('',array('required'=>false));
        }
        return $this->_data['dh_pro_exec'];
    }
    /**
     * Seta o valor da coluna dh_pro_exec
     *
     * @param string $value
     * @return Tools_Model_Job_Crud_Mapper
     */
    public function setDhProExec($value,$options=array('required'=>true)){        
        $this->_data['dh_pro_exec'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_pro_exec']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dh_pro_exec');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna status
     *
     * @return string
     */
    public function getStatus($instance=false){
        if ($instance && !is_object($this->_data['status'])){
            $this->setStatus('',array('required'=>false));
        }
        return $this->_data['status'];
    }
    /**
     * Seta o valor da coluna status
     *
     * @param string $value
     * @return Tools_Model_Job_Crud_Mapper
     */
    public function setStatus($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('A'=>'Aguardando','E'=>'Executando');
        $this->_data['status'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['status']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['status']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
}
?>