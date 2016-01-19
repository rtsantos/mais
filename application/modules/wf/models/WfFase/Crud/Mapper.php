<?php
/**
 * Classe de mapeamento do registro da tabela wf_fase
 */
class Wf_Model_WfFase_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_wf_processo','valor','descricao','proc_prox_fase','proc_prox_usuario');
    protected $_model = 'Wf_Model_WfFase_Table';

    
    /**
     * Retorna os dados da coluna id
     *
     * @return string
     */
    public function getId(){
        return $this->_data['id'];
    }
    /**
     * Seta o valor da coluna id
     *
     * @param string $value
     * @return Wf_Model_WfFase_Crud_Mapper
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
     * Retorna os dados da coluna id_wf_processo
     *
     * @return string
     */
    public function getIdWfProcesso(){
        return $this->_data['id_wf_processo'];
    }
    /**
     * Seta o valor da coluna id_wf_processo
     *
     * @param string $value
     * @return Wf_Model_WfFase_Crud_Mapper
     */
    public function setIdWfProcesso($value,$options=array('required'=>true)){        
        $this->_data['id_wf_processo'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
        if ($options['db'])
            $this->_data['id_wf_processo']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_wf_processo');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna valor
     *
     * @return string
     */
    public function getValor(){
        return $this->_data['valor'];
    }
    /**
     * Seta o valor da coluna valor
     *
     * @param string $value
     * @return Wf_Model_WfFase_Crud_Mapper
     */
    public function setValor($value,$options=array('required'=>true)){        
        $this->_data['valor'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['valor']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'valor');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 2, ) );
            $valueValid = $this->_data['valor']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna descricao
     *
     * @return string
     */
    public function getDescricao(){
        return $this->_data['descricao'];
    }
    /**
     * Seta o valor da coluna descricao
     *
     * @param string $value
     * @return Wf_Model_WfFase_Crud_Mapper
     */
    public function setDescricao($value,$options=array('required'=>true)){        
        $this->_data['descricao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filter'=>array('strtoupper', )));
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
     * Retorna os dados da coluna proc_prox_fase
     *
     * @return string
     */
    public function getProcProxFase(){
        return $this->_data['proc_prox_fase'];
    }
    /**
     * Seta o valor da coluna proc_prox_fase
     *
     * @param string $value
     * @return Wf_Model_WfFase_Crud_Mapper
     */
    public function setProcProxFase($value,$options=array('required'=>true)){        
        $this->_data['proc_prox_fase'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['proc_prox_fase']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'proc_prox_fase');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 2, ) );
            $valueValid = $this->_data['proc_prox_fase']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna proc_prox_usuario
     *
     * @return string
     */
    public function getProcProxUsuario(){
        return $this->_data['proc_prox_usuario'];
    }
    /**
     * Seta o valor da coluna proc_prox_usuario
     *
     * @param string $value
     * @return Wf_Model_WfFase_Crud_Mapper
     */
    public function setProcProxUsuario($value,$options=array('required'=>true)){        
        $this->_data['proc_prox_usuario'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['proc_prox_usuario']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'proc_prox_usuario');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 60, ) );
            $valueValid = $this->_data['proc_prox_usuario']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna proc_notif
     *
     * @return string
     */
    public function getProcNotif(){
        return $this->_data['proc_notif'];
    }
    /**
     * Seta o valor da coluna proc_notif
     *
     * @param string $value
     * @return Wf_Model_WfFase_Crud_Mapper
     */
    public function setProcNotif($value,$options=array('required'=>true)){        
        $this->_data['proc_notif'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['proc_notif']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['proc_notif']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
}
?>