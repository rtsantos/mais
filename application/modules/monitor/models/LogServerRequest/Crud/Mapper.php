<?php
/**
 * Classe de mapeamento do registro da tabela log_server_request
 */
class Monitor_Model_LogServerRequest_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_log_server','cpu','ss','req','conn','child','slot');
    protected $_model = 'Monitor_Model_LogServerRequest_Table';
    /**
     *
     * @var Monitor_Model_LogServerRequest_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Monitor_Model_LogServerRequest_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Monitor_Model_LogServerRequest_Mapper){
            $this->_dataOld = new Monitor_Model_LogServerRequest_Mapper();
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
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
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
     * Retorna os dados da coluna id_log_server
     *
     * @return string
     */
    public function getIdLogServer($instance=false){
        if ($instance && !is_object($this->_data['id_log_server'])){
            $this->setIdLogServer('',array('required'=>false));
        }
        return $this->_data['id_log_server'];
    }
    /**
     * Seta o valor da coluna id_log_server
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setIdLogServer($value,$options=array('required'=>true)){        
        $this->_data['id_log_server'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
        if ($options['db'])
            $this->_data['id_log_server']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_log_server');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna srv
     *
     * @return string
     */
    public function getSrv($instance=false){
        if ($instance && !is_object($this->_data['srv'])){
            $this->setSrv('',array('required'=>false));
        }
        return $this->_data['srv'];
    }
    /**
     * Seta o valor da coluna srv
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setSrv($value,$options=array('required'=>true)){        
        $this->_data['srv'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['srv']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 7, ) );
            $valueValid = $this->_data['srv']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna pid
     *
     * @return string
     */
    public function getPid($instance=false){
        if ($instance && !is_object($this->_data['pid'])){
            $this->setPid('',array('required'=>false));
        }
        return $this->_data['pid'];
    }
    /**
     * Seta o valor da coluna pid
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setPid($value,$options=array('required'=>true)){        
        $this->_data['pid'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['pid']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna acc
     *
     * @return string
     */
    public function getAcc($instance=false){
        if ($instance && !is_object($this->_data['acc'])){
            $this->setAcc('',array('required'=>false));
        }
        return $this->_data['acc'];
    }
    /**
     * Seta o valor da coluna acc
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setAcc($value,$options=array('required'=>true)){        
        $this->_data['acc'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['acc']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 12, ) );
            $valueValid = $this->_data['acc']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna m
     *
     * @return string
     */
    public function getM($instance=false){
        if ($instance && !is_object($this->_data['m'])){
            $this->setM('',array('required'=>false));
        }
        return $this->_data['m'];
    }
    /**
     * Seta o valor da coluna m
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setM($value,$options=array('required'=>true)){        
        $this->_data['m'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['m']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['m']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna cpu
     *
     * @return string
     */
    public function getCpu($instance=false){
        if ($instance && !is_object($this->_data['cpu'])){
            $this->setCpu('',array('required'=>false));
        }
        return $this->_data['cpu'];
    }
    /**
     * Seta o valor da coluna cpu
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setCpu($value,$options=array('required'=>true)){        
        $this->_data['cpu'] = new ZendT_Type_Number($value,array('numDecimal'=>2));
         if ($options['db'])
            $this->_data['cpu']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'cpu');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna ss
     *
     * @return string
     */
    public function getSs($instance=false){
        if ($instance && !is_object($this->_data['ss'])){
            $this->setSs('',array('required'=>false));
        }
        return $this->_data['ss'];
    }
    /**
     * Seta o valor da coluna ss
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setSs($value,$options=array('required'=>true)){        
        $this->_data['ss'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['ss']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'ss');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna req
     *
     * @return string
     */
    public function getReq($instance=false){
        if ($instance && !is_object($this->_data['req'])){
            $this->setReq('',array('required'=>false));
        }
        return $this->_data['req'];
    }
    /**
     * Seta o valor da coluna req
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setReq($value,$options=array('required'=>true)){        
        $this->_data['req'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['req']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'req');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna conn
     *
     * @return string
     */
    public function getConn($instance=false){
        if ($instance && !is_object($this->_data['conn'])){
            $this->setConn('',array('required'=>false));
        }
        return $this->_data['conn'];
    }
    /**
     * Seta o valor da coluna conn
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setConn($value,$options=array('required'=>true)){        
        $this->_data['conn'] = new ZendT_Type_Number($value,array('numDecimal'=>1));
         if ($options['db'])
            $this->_data['conn']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'conn');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna child
     *
     * @return string
     */
    public function getChild($instance=false){
        if ($instance && !is_object($this->_data['child'])){
            $this->setChild('',array('required'=>false));
        }
        return $this->_data['child'];
    }
    /**
     * Seta o valor da coluna child
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setChild($value,$options=array('required'=>true)){        
        $this->_data['child'] = new ZendT_Type_Number($value,array('numDecimal'=>2));
         if ($options['db'])
            $this->_data['child']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'child');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna slot
     *
     * @return string
     */
    public function getSlot($instance=false){
        if ($instance && !is_object($this->_data['slot'])){
            $this->setSlot('',array('required'=>false));
        }
        return $this->_data['slot'];
    }
    /**
     * Seta o valor da coluna slot
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setSlot($value,$options=array('required'=>true)){        
        $this->_data['slot'] = new ZendT_Type_Number($value,array('numDecimal'=>2));
         if ($options['db'])
            $this->_data['slot']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'slot');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna client
     *
     * @return string
     */
    public function getClient($instance=false){
        if ($instance && !is_object($this->_data['client'])){
            $this->setClient('',array('required'=>false));
        }
        return $this->_data['client'];
    }
    /**
     * Seta o valor da coluna client
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setClient($value,$options=array('required'=>true)){        
        $this->_data['client'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['client']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 15, ) );
            $valueValid = $this->_data['client']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna vhost
     *
     * @return string
     */
    public function getVhost($instance=false){
        if ($instance && !is_object($this->_data['vhost'])){
            $this->setVhost('',array('required'=>false));
        }
        return $this->_data['vhost'];
    }
    /**
     * Seta o valor da coluna vhost
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setVhost($value,$options=array('required'=>true)){        
        $this->_data['vhost'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['vhost']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['vhost']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna request
     *
     * @return string
     */
    public function getRequest($instance=false){
        if ($instance && !is_object($this->_data['request'])){
            $this->setRequest('',array('required'=>false));
        }
        return $this->_data['request'];
    }
    /**
     * Seta o valor da coluna request
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setRequest($value,$options=array('required'=>true)){        
        $this->_data['request'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['request']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 255, ) );
            $valueValid = $this->_data['request']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna perc_cpu
     *
     * @return string
     */
    public function getPercCpu($instance=false){
        if ($instance && !is_object($this->_data['perc_cpu'])){
            $this->setPercCpu('',array('required'=>false));
        }
        return $this->_data['perc_cpu'];
    }
    /**
     * Seta o valor da coluna perc_cpu
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setPercCpu($value,$options=array('required'=>true)){        
        $this->_data['perc_cpu'] = new ZendT_Type_Number($value,array('numDecimal'=>1));
         if ($options['db'])
            $this->_data['perc_cpu']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna perc_mem
     *
     * @return string
     */
    public function getPercMem($instance=false){
        if ($instance && !is_object($this->_data['perc_mem'])){
            $this->setPercMem('',array('required'=>false));
        }
        return $this->_data['perc_mem'];
    }
    /**
     * Seta o valor da coluna perc_mem
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setPercMem($value,$options=array('required'=>true)){        
        $this->_data['perc_mem'] = new ZendT_Type_Number($value,array('numDecimal'=>1));
         if ($options['db'])
            $this->_data['perc_mem']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna time
     *
     * @return string
     */
    public function getTime($instance=false){
        if ($instance && !is_object($this->_data['time'])){
            $this->setTime('',array('required'=>false));
        }
        return $this->_data['time'];
    }
    /**
     * Seta o valor da coluna time
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setTime($value,$options=array('required'=>true)){        
        $this->_data['time'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['time']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna system
     *
     * @return string
     */
    public function getSystem($instance=false){
        if ($instance && !is_object($this->_data['system'])){
            $this->setSystem('',array('required'=>false));
        }
        return $this->_data['system'];
    }
    /**
     * Seta o valor da coluna system
     *
     * @param string $value
     * @return Monitor_Model_LogServerRequest_Crud_Mapper
     */
    public function setSystem($value,$options=array('required'=>true)){        
        $this->_data['system'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['system']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['system']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
}
?>