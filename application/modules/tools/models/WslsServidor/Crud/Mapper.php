<?php
/**
 * Classe de mapeamento do registro da tabela wsls_servidor
 */
class Tools_Model_WslsServidor_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','ip','padrao','status','id_filial');
    protected $_model = 'Tools_Model_WslsServidor_Table';

    
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
     * @return Tools_Model_WslsServidor_Crud_Mapper
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
     * Retorna os dados da coluna ip
     *
     * @return string
     */
    public function getIp($instance=false){
        if ($instance && !is_object($this->_data['ip'])){
            $this->setIp('',array('required'=>false));
        }
        return $this->_data['ip'];
    }
    /**
     * Seta o valor da coluna ip
     *
     * @param string $value
     * @return Tools_Model_WslsServidor_Crud_Mapper
     */
    public function setIp($value,$options=array('required'=>true)){        
        $this->_data['ip'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ip']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'ip');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 15, ) );
            $valueValid = $this->_data['ip']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna padrao
     *
     * @return string
     */
    public function getPadrao($instance=false){
        if ($instance && !is_object($this->_data['padrao'])){
            $this->setPadrao('',array('required'=>false));
        }
        return $this->_data['padrao'];
    }
    /**
     * Seta o valor da coluna padrao
     *
     * @param string $value
     * @return Tools_Model_WslsServidor_Crud_Mapper
     */
    public function setPadrao($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('S'=>'Sim','N'=>'Não');
        $this->_data['padrao'] = new ZendT_Type_Default($value,$options);
        if ($options['db'])
            $this->_data['padrao']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'padrao');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['padrao']->getValueToDb();
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
     * @return Tools_Model_WslsServidor_Crud_Mapper
     */
    public function setStatus($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('S'=>'Sim','N'=>'Não','A'=>'Ativo','I'=>'Inativo');
        $this->_data['status'] = new ZendT_Type_Default($value,$options);
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
     * Retorna os dados da coluna id_filial
     *
     * @return string
     */
    public function getIdFilial($instance=false){
        if ($instance && !is_object($this->_data['id_filial'])){
            $this->setIdFilial('',array('required'=>false));
        }
        return $this->_data['id_filial'];
    }
    /**
     * Seta o valor da coluna id_filial
     *
     * @param string $value
     * @return Tools_Model_WslsServidor_Crud_Mapper
     */
    public function setIdFilial($value,$options=array('required'=>true)){        
        $this->_data['id_filial'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
        if ($options['db'])
            $this->_data['id_filial']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_filial');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna id_posto_avancado
     *
     * @return string
     */
    public function getIdPostoAvancado($instance=false){
        if ($instance && !is_object($this->_data['id_posto_avancado'])){
            $this->setIdPostoAvancado('',array('required'=>false));
        }
        return $this->_data['id_posto_avancado'];
    }
    /**
     * Seta o valor da coluna id_posto_avancado
     *
     * @param string $value
     * @return Tools_Model_WslsServidor_Crud_Mapper
     */
    public function setIdPostoAvancado($value,$options=array('required'=>true)){        
        $this->_data['id_posto_avancado'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
        if ($options['db'])
            $this->_data['id_posto_avancado']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna impressora_padrao
     *
     * @return string
     */
    public function getImpressoraPadrao($instance=false){
        if ($instance && !is_object($this->_data['impressora_padrao'])){
            $this->setImpressoraPadrao('',array('required'=>false));
        }
        return $this->_data['impressora_padrao'];
    }
    /**
     * Seta o valor da coluna impressora_padrao
     *
     * @param string $value
     * @return Tools_Model_WslsServidor_Crud_Mapper
     */
    public function setImpressoraPadrao($value,$options=array('required'=>true)){        
        $this->_data['impressora_padrao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['impressora_padrao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 40, ) );
            $valueValid = $this->_data['impressora_padrao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
}
?>