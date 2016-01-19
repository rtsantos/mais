<?php
/**
 * Classe de mapeamento do registro da tabela log_objeto
 */
class Log_Model_LogObjeto_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','nome','descricao','status');
    protected $_model = 'Log_Model_LogObjeto_Table';
    /**
     *
     * @var Log_Model_LogObjeto_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Log_Model_LogObjeto_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Log_Model_LogObjeto_Mapper){
            $this->_dataOld = new Log_Model_LogObjeto_Mapper();
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
     * @return Log_Model_LogObjeto_Crud_Mapper
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
     * Retorna os dados da coluna nome
     *
     * @return string
     */
    public function getNome($instance=false){
        if ($instance && !is_object($this->_data['nome'])){
            $this->setNome('',array('required'=>false));
        }
        return $this->_data['nome'];
    }
    /**
     * Seta o valor da coluna nome
     *
     * @param string $value
     * @return Log_Model_LogObjeto_Crud_Mapper
     */
    public function setNome($value,$options=array('required'=>true)){        
        $this->_data['nome'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['nome']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'nome');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 30, ) );
            $valueValid = $this->_data['nome']->getValueToDb();
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
     * @return Log_Model_LogObjeto_Crud_Mapper
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
     * @return Log_Model_LogObjeto_Crud_Mapper
     */
    public function setStatus($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('A'=>'Ativo','I'=>'Inativo');
        $this->_data['status'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['status']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'status');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['status']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna id_log_tabela
     *
     * @return string
     */
    public function getIdLogTabela($instance=false){
        if ($instance && !is_object($this->_data['id_log_tabela'])){
            $this->setIdLogTabela('',array('required'=>false));
        }
        return $this->_data['id_log_tabela'];
    }
    /**
     * Seta o valor da coluna id_log_tabela
     *
     * @param string $value
     * @return Log_Model_LogObjeto_Crud_Mapper
     */
    public function setIdLogTabela($value,$options=array('required'=>true)){        
        $this->_data['id_log_tabela'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
         if ($options['db'])
            $this->_data['id_log_tabela']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna tempo_vida
     *
     * @return string
     */
    public function getTempoVida($instance=false){
        if ($instance && !is_object($this->_data['tempo_vida'])){
            $this->setTempoVida('',array('required'=>false));
        }
        return $this->_data['tempo_vida'];
    }
    /**
     * Seta o valor da coluna tempo_vida
     *
     * @param string $value
     * @return Log_Model_LogObjeto_Crud_Mapper
     */
    public function setTempoVida($value,$options=array('required'=>true)){        
        $this->_data['tempo_vida'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['tempo_vida']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
}
?>