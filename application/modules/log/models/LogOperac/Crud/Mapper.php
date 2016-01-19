<?php
/**
 * Classe de mapeamento do registro da tabela log_operac
 */
class Log_Model_LogOperac_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','codigo');
    protected $_model = 'Log_Model_LogOperac_Table';
    /**
     *
     * @var Log_Model_LogOperac_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Log_Model_LogOperac_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Log_Model_LogOperac_Mapper){
            $this->_dataOld = new Log_Model_LogOperac_Mapper();
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
     * @return Log_Model_LogOperac_Crud_Mapper
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
     * Retorna os dados da coluna codigo
     *
     * @return string
     */
    public function getCodigo($instance=false){
        if ($instance && !is_object($this->_data['codigo'])){
            $this->setCodigo('',array('required'=>false));
        }
        return $this->_data['codigo'];
    }
    /**
     * Seta o valor da coluna codigo
     *
     * @param string $value
     * @return Log_Model_LogOperac_Crud_Mapper
     */
    public function setCodigo($value,$options=array('required'=>true)){        
        $this->_data['codigo'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['codigo']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'codigo');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 3, ) );
            $valueValid = $this->_data['codigo']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna operacao
     *
     * @return string
     */
    public function getOperacao($instance=false){
        if ($instance && !is_object($this->_data['operacao'])){
            $this->setOperacao('',array('required'=>false));
        }
        return $this->_data['operacao'];
    }
    /**
     * Seta o valor da coluna operacao
     *
     * @param string $value
     * @return Log_Model_LogOperac_Crud_Mapper
     */
    public function setOperacao($value,$options=array('required'=>true)){        
        $this->_data['operacao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['operacao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 20, ) );
            $valueValid = $this->_data['operacao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
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
     * @return Log_Model_LogOperac_Crud_Mapper
     */
    public function setStatus($value,$options=array('required'=>true)){        
        $this->_data['status'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['status']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 20, ) );
            $valueValid = $this->_data['status']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna acao
     *
     * @return string
     */
    public function getAcao($instance=false){
        if ($instance && !is_object($this->_data['acao'])){
            $this->setAcao('',array('required'=>false));
        }
        return $this->_data['acao'];
    }
    /**
     * Seta o valor da coluna acao
     *
     * @param string $value
     * @return Log_Model_LogOperac_Crud_Mapper
     */
    public function setAcao($value,$options=array('required'=>true)){        
        $this->_data['acao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['acao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 20, ) );
            $valueValid = $this->_data['acao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
}
?>