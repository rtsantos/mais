<?php
/**
 * Classe de mapeamento do registro da tabela log_server
 */
class Monitor_Model_LogServer_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','dh_log','total_accesses','total_traffic','cpu_load','total_requests');
    protected $_model = 'Monitor_Model_LogServer_Table';
    /**
     *
     * @var Monitor_Model_LogServer_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Monitor_Model_LogServer_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Monitor_Model_LogServer_Mapper){
            $this->_dataOld = new Monitor_Model_LogServer_Mapper();
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
     * @return Monitor_Model_LogServer_Crud_Mapper
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
     * Retorna os dados da coluna dh_log
     *
     * @return string
     */
    public function getDhLog($instance=false){
        if ($instance && !is_object($this->_data['dh_log'])){
            $this->setDhLog('',array('required'=>false));
        }
        return $this->_data['dh_log'];
    }
    /**
     * Seta o valor da coluna dh_log
     *
     * @param string $value
     * @return Monitor_Model_LogServer_Crud_Mapper
     */
    public function setDhLog($value,$options=array('required'=>true)){        
        $this->_data['dh_log'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_log']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dh_log');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna total_accesses
     *
     * @return string
     */
    public function getTotalAccesses($instance=false){
        if ($instance && !is_object($this->_data['total_accesses'])){
            $this->setTotalAccesses('',array('required'=>false));
        }
        return $this->_data['total_accesses'];
    }
    /**
     * Seta o valor da coluna total_accesses
     *
     * @param string $value
     * @return Monitor_Model_LogServer_Crud_Mapper
     */
    public function setTotalAccesses($value,$options=array('required'=>true)){        
        $this->_data['total_accesses'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['total_accesses']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'total_accesses');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna total_traffic
     *
     * @return string
     */
    public function getTotalTraffic($instance=false){
        if ($instance && !is_object($this->_data['total_traffic'])){
            $this->setTotalTraffic('',array('required'=>false));
        }
        return $this->_data['total_traffic'];
    }
    /**
     * Seta o valor da coluna total_traffic
     *
     * @param string $value
     * @return Monitor_Model_LogServer_Crud_Mapper
     */
    public function setTotalTraffic($value,$options=array('required'=>true)){        
        $this->_data['total_traffic'] = new ZendT_Type_Number($value,array('numDecimal'=>2));
         if ($options['db'])
            $this->_data['total_traffic']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'total_traffic');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna cpu_usage
     *
     * @return string
     */
    public function getCpuUsage($instance=false){
        if ($instance && !is_object($this->_data['cpu_usage'])){
            $this->setCpuUsage('',array('required'=>false));
        }
        return $this->_data['cpu_usage'];
    }
    /**
     * Seta o valor da coluna cpu_usage
     *
     * @param string $value
     * @return Monitor_Model_LogServer_Crud_Mapper
     */
    public function setCpuUsage($value,$options=array('required'=>true)){        
        $this->_data['cpu_usage'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['cpu_usage']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['cpu_usage']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna cpu_load
     *
     * @return string
     */
    public function getCpuLoad($instance=false){
        if ($instance && !is_object($this->_data['cpu_load'])){
            $this->setCpuLoad('',array('required'=>false));
        }
        return $this->_data['cpu_load'];
    }
    /**
     * Seta o valor da coluna cpu_load
     *
     * @param string $value
     * @return Monitor_Model_LogServer_Crud_Mapper
     */
    public function setCpuLoad($value,$options=array('required'=>true)){        
        $this->_data['cpu_load'] = new ZendT_Type_Number($value,array('numDecimal'=>3));
         if ($options['db'])
            $this->_data['cpu_load']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'cpu_load');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna total_requests
     *
     * @return string
     */
    public function getTotalRequests($instance=false){
        if ($instance && !is_object($this->_data['total_requests'])){
            $this->setTotalRequests('',array('required'=>false));
        }
        return $this->_data['total_requests'];
    }
    /**
     * Seta o valor da coluna total_requests
     *
     * @param string $value
     * @return Monitor_Model_LogServer_Crud_Mapper
     */
    public function setTotalRequests($value,$options=array('required'=>true)){        
        $this->_data['total_requests'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['total_requests']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'total_requests');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna mem_total
     *
     * @return string
     */
    public function getMemTotal($instance=false){
        if ($instance && !is_object($this->_data['mem_total'])){
            $this->setMemTotal('',array('required'=>false));
        }
        return $this->_data['mem_total'];
    }
    /**
     * Seta o valor da coluna mem_total
     *
     * @param string $value
     * @return Monitor_Model_LogServer_Crud_Mapper
     */
    public function setMemTotal($value,$options=array('required'=>true)){        
        $this->_data['mem_total'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['mem_total']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna mem_used
     *
     * @return string
     */
    public function getMemUsed($instance=false){
        if ($instance && !is_object($this->_data['mem_used'])){
            $this->setMemUsed('',array('required'=>false));
        }
        return $this->_data['mem_used'];
    }
    /**
     * Seta o valor da coluna mem_used
     *
     * @param string $value
     * @return Monitor_Model_LogServer_Crud_Mapper
     */
    public function setMemUsed($value,$options=array('required'=>true)){        
        $this->_data['mem_used'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['mem_used']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna mem_cached
     *
     * @return string
     */
    public function getMemCached($instance=false){
        if ($instance && !is_object($this->_data['mem_cached'])){
            $this->setMemCached('',array('required'=>false));
        }
        return $this->_data['mem_cached'];
    }
    /**
     * Seta o valor da coluna mem_cached
     *
     * @param string $value
     * @return Monitor_Model_LogServer_Crud_Mapper
     */
    public function setMemCached($value,$options=array('required'=>true)){        
        $this->_data['mem_cached'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['mem_cached']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna swap_total
     *
     * @return string
     */
    public function getSwapTotal($instance=false){
        if ($instance && !is_object($this->_data['swap_total'])){
            $this->setSwapTotal('',array('required'=>false));
        }
        return $this->_data['swap_total'];
    }
    /**
     * Seta o valor da coluna swap_total
     *
     * @param string $value
     * @return Monitor_Model_LogServer_Crud_Mapper
     */
    public function setSwapTotal($value,$options=array('required'=>true)){        
        $this->_data['swap_total'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['swap_total']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna swap_used
     *
     * @return string
     */
    public function getSwapUsed($instance=false){
        if ($instance && !is_object($this->_data['swap_used'])){
            $this->setSwapUsed('',array('required'=>false));
        }
        return $this->_data['swap_used'];
    }
    /**
     * Seta o valor da coluna swap_used
     *
     * @param string $value
     * @return Monitor_Model_LogServer_Crud_Mapper
     */
    public function setSwapUsed($value,$options=array('required'=>true)){        
        $this->_data['swap_used'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['swap_used']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>