<?php
/**
 * Classe de mapeamento do registro da tabela recurso
 */
class Auth_Model_Recurso_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_tipo_recurso','id_aplicacao','nome','hierarquia','status');
    protected $_model = 'Auth_Model_Recurso_Table';
    public static $table = 'prouser.recurso';
    /**
     *
     * @var Auth_Model_Recurso_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Auth_Model_Recurso_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Auth_Model_Recurso_Mapper){
            $this->_dataOld = new Auth_Model_Recurso_Mapper();
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
                'id_tipo_recurso' => array(
                    'mapper' => 'Auth_DataView_TipoRecurso_MapperView',
                    'column' => 'id'
                ),
                'id_aplicacao' => array(
                    'mapper' => 'Auth_DataView_Aplicacao_MapperView',
                    'column' => 'id'
                ),
                'id_recurso_pai' => array(
                    'mapper' => 'Auth_DataView_Recurso_MapperView',
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
     * @return Auth_Model_Recurso_Crud_Mapper
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
     * Retorna os dados da coluna id_tipo_recurso
     *
     * @return string
     */
    public function getIdTipoRecurso($instance=false){
        if ($instance && !is_object($this->_data['id_tipo_recurso'])){
            $this->setIdTipoRecurso('',array('required'=>false));
        }
        return $this->_data['id_tipo_recurso'];
    }
    /**
     * Seta o valor da coluna id_tipo_recurso
     *
     * @param string $value
     * @return Auth_Model_Recurso_Crud_Mapper
     */
    public function setIdTipoRecurso($value,$options=array('required'=>true)){        
        $this->_data['id_tipo_recurso'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_tipo_recurso']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_tipo_recurso');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_aplicacao
     *
     * @return string
     */
    public function getIdAplicacao($instance=false){
        if ($instance && !is_object($this->_data['id_aplicacao'])){
            $this->setIdAplicacao('',array('required'=>false));
        }
        return $this->_data['id_aplicacao'];
    }
    /**
     * Seta o valor da coluna id_aplicacao
     *
     * @param string $value
     * @return Auth_Model_Recurso_Crud_Mapper
     */
    public function setIdAplicacao($value,$options=array('required'=>true)){        
        $this->_data['id_aplicacao'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_aplicacao']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_aplicacao');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_recurso_pai
     *
     * @return string
     */
    public function getIdRecursoPai($instance=false){
        if ($instance && !is_object($this->_data['id_recurso_pai'])){
            $this->setIdRecursoPai('',array('required'=>false));
        }
        return $this->_data['id_recurso_pai'];
    }
    /**
     * Seta o valor da coluna id_recurso_pai
     *
     * @param string $value
     * @return Auth_Model_Recurso_Crud_Mapper
     */
    public function setIdRecursoPai($value,$options=array('required'=>true)){        
        $this->_data['id_recurso_pai'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_recurso_pai']->setValueFromDb($value);
                    
        if (!$options['db']){
            
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
     * @return Auth_Model_Recurso_Crud_Mapper
     */
    public function setNome($value,$options=array('required'=>true)){        
        $this->_data['nome'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', )));
        if ($options['db'])
            $this->_data['nome']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'nome');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 80, ) );
            $valueValid = $this->_data['nome']->getValueToDb();
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
     * @return Auth_Model_Recurso_Crud_Mapper
     */
    public function setHierarquia($value,$options=array('required'=>true)){        
        $this->_data['hierarquia'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtolower', 'removeAccent', )));
        if ($options['db'])
            $this->_data['hierarquia']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'hierarquia');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['hierarquia']->getValueToDb();
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
     * @return Auth_Model_Recurso_Crud_Mapper
     */
    public function setDescricao($value,$options=array('required'=>true)){        
        $this->_data['descricao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', )));
        if ($options['db'])
            $this->_data['descricao']->setValueFromDb($value);
                
        if (!$options['db']){
            
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
     * @return Auth_Model_Recurso_Crud_Mapper
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
     * Retorna os dados da coluna icone
     *
     * @return string
     */
    public function getIcone($instance=false){
        if ($instance && !is_object($this->_data['icone'])){
            $this->setIcone('',array('required'=>false));
        }
        return $this->_data['icone'];
    }
    /**
     * Seta o valor da coluna icone
     *
     * @param string $value
     * @return Auth_Model_Recurso_Crud_Mapper
     */
    public function setIcone($value,$options=array('required'=>true)){        
        $this->_data['icone'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['icone']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 30, ) );
            $valueValid = $this->_data['icone']->getValueToDb();
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
     * @return Auth_Model_Recurso_Crud_Mapper
     */
    public function setObservacao($value,$options=array('required'=>true)){        
        $this->_data['observacao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', )));
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
     * Retorna os dados da coluna ordem
     *
     * @return string
     */
    public function getOrdem($instance=false){
        if ($instance && !is_object($this->_data['ordem'])){
            $this->setOrdem('',array('required'=>false));
        }
        return $this->_data['ordem'];
    }
    /**
     * Seta o valor da coluna ordem
     *
     * @param string $value
     * @return Auth_Model_Recurso_Crud_Mapper
     */
    public function setOrdem($value,$options=array('required'=>true)){        
        $this->_data['ordem'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['ordem']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna nivel
     *
     * @return string
     */
    public function getNivel($instance=false){
        if ($instance && !is_object($this->_data['nivel'])){
            $this->setNivel('',array('required'=>false));
        }
        return $this->_data['nivel'];
    }
    /**
     * Seta o valor da coluna nivel
     *
     * @param string $value
     * @return Auth_Model_Recurso_Crud_Mapper
     */
    public function setNivel($value,$options=array('required'=>true)){        
        $this->_data['nivel'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['nivel']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>