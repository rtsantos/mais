<?php
/**
 * Classe de mapeamento do registro da tabela papel
 */
class Auth_Model_Conta_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','nome','descricao','hierarquia','tipo','status');
    protected $_model = 'Auth_Model_Conta_Table';
    public static $table = 'prouser.papel';
    /**
     *
     * @var Auth_Model_Conta_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Auth_Model_Conta_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Auth_Model_Conta_Mapper){
            $this->_dataOld = new Auth_Model_Conta_Mapper();
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
                'id_papel_pai' => array(
                    'mapper' => 'Auth_DataView_Conta_MapperView',
                    'column' => 'id'
                ),
                'id_empresa' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
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
     * @return Auth_Model_Conta_Crud_Mapper
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
     * @return Auth_Model_Conta_Crud_Mapper
     */
    public function setNome($value,$options=array('required'=>true)){        
        $this->_data['nome'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', 'trim', )));
        if ($options['db'])
            $this->_data['nome']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'nome');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
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
     * @return Auth_Model_Conta_Crud_Mapper
     */
    public function setDescricao($value,$options=array('required'=>true)){        
        $this->_data['descricao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'trim', )));
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
     * Retorna os dados da coluna hierarquia
     *
     * @return string
     */
    public function getHierarquia($instance=false){
        if ($instance && !is_object($this->_data['hierarquia'])){
            $this->setHierarquia('',array('required'=>false));
        }
        return $this->_data['hierarquia'];
    }
    /**
     * Seta o valor da coluna hierarquia
     *
     * @param string $value
     * @return Auth_Model_Conta_Crud_Mapper
     */
    public function setHierarquia($value,$options=array('required'=>true)){        
        $this->_data['hierarquia'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', 'trim', )));
        if ($options['db'])
            $this->_data['hierarquia']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'hierarquia');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1000, ) );
            $valueValid = $this->_data['hierarquia']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_papel_pai
     *
     * @return string
     */
    public function getIdPapelPai($instance=false){
        if ($instance && !is_object($this->_data['id_papel_pai'])){
            $this->setIdPapelPai('',array('required'=>false));
        }
        return $this->_data['id_papel_pai'];
    }
    /**
     * Seta o valor da coluna id_papel_pai
     *
     * @param string $value
     * @return Auth_Model_Conta_Crud_Mapper
     */
    public function setIdPapelPai($value,$options=array('required'=>true)){        
        $this->_data['id_papel_pai'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_papel_pai']->setValueFromDb($value);
                    
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
     * @return Auth_Model_Conta_Crud_Mapper
     */
    public function setTipo($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('U'=>'Usuário','G'=>'Grupo');
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
     * @return Auth_Model_Conta_Crud_Mapper
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
     * Retorna os dados da coluna senha
     *
     * @return string
     */
    public function getSenha($instance=false){
        if ($instance && !is_object($this->_data['senha'])){
            $this->setSenha('',array('required'=>false));
        }
        return $this->_data['senha'];
    }
    /**
     * Seta o valor da coluna senha
     *
     * @param string $value
     * @return Auth_Model_Conta_Crud_Mapper
     */
    public function setSenha($value,$options=array('required'=>true)){        
        $this->_data['senha'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['senha']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 20, ) );
            $valueValid = $this->_data['senha']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna avatar
     *
     * @return string
     */
    public function getAvatar($instance=false){
        if ($instance && !is_object($this->_data['avatar'])){
            $this->setAvatar('',array('required'=>false));
        }
        return $this->_data['avatar'];
    }
    /**
     * Seta o valor da coluna avatar
     *
     * @param string $value
     * @return Auth_Model_Conta_Crud_Mapper
     */
    public function setAvatar($value,$options=array('required'=>true)){        
        $this->_data['avatar'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['avatar']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna email
     *
     * @return string
     */
    public function getEmail($instance=false){
        if ($instance && !is_object($this->_data['email'])){
            $this->setEmail('',array('required'=>false));
        }
        return $this->_data['email'];
    }
    /**
     * Seta o valor da coluna email
     *
     * @param string $value
     * @return Auth_Model_Conta_Crud_Mapper
     */
    public function setEmail($value,$options=array('required'=>true)){        
        $this->_data['email'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtolower', 'removeAccent', 'trim', )));
        if ($options['db'])
            $this->_data['email']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 60, ) );
            $valueValid = $this->_data['email']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_empresa
     *
     * @return string
     */
    public function getIdEmpresa($instance=false){
        if ($instance && !is_object($this->_data['id_empresa'])){
            $this->setIdEmpresa('',array('required'=>false));
        }
        return $this->_data['id_empresa'];
    }
    /**
     * Seta o valor da coluna id_empresa
     *
     * @param string $value
     * @return Auth_Model_Conta_Crud_Mapper
     */
    public function setIdEmpresa($value,$options=array('required'=>true)){        
        $this->_data['id_empresa'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_empresa']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>