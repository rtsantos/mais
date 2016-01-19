<?php
/**
 * Classe de mapeamento do registro da tabela profile_object_view
 */
class Profile_Model_ObjectView_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','tipo','padrao','nome','objeto','id_usuario');
    protected $_model = 'Profile_Model_ObjectView_Table';
    /**
     *
     * @var Profile_Model_ObjectView_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Profile_Model_ObjectView_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Profile_Model_ObjectView_Mapper){
            $this->_dataOld = new Profile_Model_ObjectView_Mapper();
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
                'id_usuario' => array(
                    'mapper' => 'Auth_DataView_Conta_MapperView',
                    'column' => 'id'
                ));
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
     * @return Profile_Model_ObjectView_Crud_Mapper
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
     * @return Profile_Model_ObjectView_Crud_Mapper
     */
    public function setTipo($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('F'=>'Formulário','G'=>'Tabela','C'=>'Gráfico Dinâmico','D'=>'Tabela Dinâmica');
        $this->_data['tipo'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['tipo']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'tipo');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['tipo']->getValueToDb();
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
     * @return Profile_Model_ObjectView_Crud_Mapper
     */
    public function setPadrao($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('S'=>'Sim','N'=>'Não');
        $this->_data['padrao'] = new ZendT_Type_String($value,$options);
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
     * @return Profile_Model_ObjectView_Crud_Mapper
     */
    public function setNome($value,$options=array('required'=>true)){        
        $this->_data['nome'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['nome']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'nome');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 60, ) );
            $valueValid = $this->_data['nome']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna objeto
     *
     * @return string
     */
    public function getObjeto($instance=false){
        if ($instance && !is_object($this->_data['objeto'])){
            $this->setObjeto('',array('required'=>false));
        }
        return $this->_data['objeto'];
    }
    /**
     * Seta o valor da coluna objeto
     *
     * @param string $value
     * @return Profile_Model_ObjectView_Crud_Mapper
     */
    public function setObjeto($value,$options=array('required'=>true)){        
        $this->_data['objeto'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['objeto']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'objeto');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 60, ) );
            $valueValid = $this->_data['objeto']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna observacao
     *
     * @return string
     */
    public function getObservacao($instance=false){
        if ($instance && !is_object($this->_data['observacao'])){
            $this->setObservacao('',array('required'=>false));
        }
        return $this->_data['observacao'];
    }
    /**
     * Seta o valor da coluna observacao
     *
     * @param string $value
     * @return Profile_Model_ObjectView_Crud_Mapper
     */
    public function setObservacao($value,$options=array('required'=>true)){        
        $this->_data['observacao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['observacao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 4000, ) );
            $valueValid = $this->_data['observacao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna config
     *
     * @return string
     */
    public function getConfig($instance=false){
        if ($instance && !is_object($this->_data['config'])){
            $this->setConfig('',array('required'=>false));
        }
        return $this->_data['config'];
    }
    /**
     * Seta o valor da coluna config
     *
     * @param string $value
     * @return Profile_Model_ObjectView_Crud_Mapper
     */
    public function setConfig($value,$options=array('required'=>true)){        
        $this->_data['config'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['config']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_usuario
     *
     * @return string
     */
    public function getIdUsuario($instance=false){
        if ($instance && !is_object($this->_data['id_usuario'])){
            $this->setIdUsuario('',array('required'=>false));
        }
        return $this->_data['id_usuario'];
    }
    /**
     * Seta o valor da coluna id_usuario
     *
     * @param string $value
     * @return Profile_Model_ObjectView_Crud_Mapper
     */
    public function setIdUsuario($value,$options=array('required'=>true)){        
        $this->_data['id_usuario'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_usuario']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_usuario');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna uri
     *
     * @return string
     */
    public function getUri($instance=false){
        if ($instance && !is_object($this->_data['uri'])){
            $this->setUri('',array('required'=>false));
        }
        return $this->_data['uri'];
    }
    /**
     * Seta o valor da coluna uri
     *
     * @param string $value
     * @return Profile_Model_ObjectView_Crud_Mapper
     */
    public function setUri($value,$options=array('required'=>true)){        
        $this->_data['uri'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', )));
        if ($options['db'])
            $this->_data['uri']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['uri']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna chave
     *
     * @return string
     */
    public function getChave($instance=false){
        if ($instance && !is_object($this->_data['chave'])){
            $this->setChave('',array('required'=>false));
        }
        return $this->_data['chave'];
    }
    /**
     * Seta o valor da coluna chave
     *
     * @param string $value
     * @return Profile_Model_ObjectView_Crud_Mapper
     */
    public function setChave($value,$options=array('required'=>true)){        
        $this->_data['chave'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['chave']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 40, ) );
            $valueValid = $this->_data['chave']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
}
?>