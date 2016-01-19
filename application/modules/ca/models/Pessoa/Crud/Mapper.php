<?php
/**
 * Classe de mapeamento do registro da tabela ca_pessoa
 */
class Ca_Model_Pessoa_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id');
    protected $_model = 'Ca_Model_Pessoa_Table';
    /**
     *
     * @var Ca_Model_Pessoa_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Ca_Model_Pessoa_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Ca_Model_Pessoa_Mapper){
            $this->_dataOld = new Ca_Model_Pessoa_Mapper();
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
                'id_pessoa_resp' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
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
     * @return Ca_Model_Pessoa_Crud_Mapper
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
     * @return Ca_Model_Pessoa_Crud_Mapper
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
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 60, ) );
            $valueValid = $this->_data['nome']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna apelido
     *
     * @return string
     */
    public function getApelido($instance=false){
        if ($instance && !is_object($this->_data['apelido'])){
            $this->setApelido('',array('required'=>false));
        }
        return $this->_data['apelido'];
    }
    /**
     * Seta o valor da coluna apelido
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setApelido($value,$options=array('required'=>true)){        
        $this->_data['apelido'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['apelido']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 45, ) );
            $valueValid = $this->_data['apelido']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
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
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setCodigo($value,$options=array('required'=>true)){        
        $this->_data['codigo'] = new ZendT_Type_String($value,array('mask'=>array (
  0 => '999.999.999-99',
  1 => '99.999.999/9999-99',
)
                                                                   ,'charMask'=>'9'
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['codigo']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 20, ) );
            $valueValid = $this->_data['codigo']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
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
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEmail($value,$options=array('required'=>true)){        
        $this->_data['email'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtolower', 'removeAccent', )));
        if ($options['db'])
            $this->_data['email']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 70, ) );
            $valueValid = $this->_data['email']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_pessoa_resp
     *
     * @return string
     */
    public function getIdPessoaResp($instance=false){
        if ($instance && !is_object($this->_data['id_pessoa_resp'])){
            $this->setIdPessoaResp('',array('required'=>false));
        }
        return $this->_data['id_pessoa_resp'];
    }
    /**
     * Seta o valor da coluna id_pessoa_resp
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setIdPessoaResp($value,$options=array('required'=>true)){        
        $this->_data['id_pessoa_resp'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_pessoa_resp']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna telefone
     *
     * @return string
     */
    public function getTelefone($instance=false){
        if ($instance && !is_object($this->_data['telefone'])){
            $this->setTelefone('',array('required'=>false));
        }
        return $this->_data['telefone'];
    }
    /**
     * Seta o valor da coluna telefone
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setTelefone($value,$options=array('required'=>true)){        
        $this->_data['telefone'] = new ZendT_Type_String($value,array('mask'=>'99 9999-9999'
                                                                   ,'charMask'=>'9'
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['telefone']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 45, ) );
            $valueValid = $this->_data['telefone']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna celular
     *
     * @return string
     */
    public function getCelular($instance=false){
        if ($instance && !is_object($this->_data['celular'])){
            $this->setCelular('',array('required'=>false));
        }
        return $this->_data['celular'];
    }
    /**
     * Seta o valor da coluna celular
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setCelular($value,$options=array('required'=>true)){        
        $this->_data['celular'] = new ZendT_Type_String($value,array('mask'=>array (
  0 => '99 9999-9999',
  1 => '99 9.9999-9999',
)
                                                                   ,'charMask'=>'9'
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['celular']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 45, ) );
            $valueValid = $this->_data['celular']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna fax
     *
     * @return string
     */
    public function getFax($instance=false){
        if ($instance && !is_object($this->_data['fax'])){
            $this->setFax('',array('required'=>false));
        }
        return $this->_data['fax'];
    }
    /**
     * Seta o valor da coluna fax
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setFax($value,$options=array('required'=>true)){        
        $this->_data['fax'] = new ZendT_Type_String($value,array('mask'=>'99 9999-9999'
                                                                   ,'charMask'=>'9'
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['fax']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 45, ) );
            $valueValid = $this->_data['fax']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ed_logr
     *
     * @return string
     */
    public function getEdLogr($instance=false){
        if ($instance && !is_object($this->_data['ed_logr'])){
            $this->setEdLogr('',array('required'=>false));
        }
        return $this->_data['ed_logr'];
    }
    /**
     * Seta o valor da coluna ed_logr
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEdLogr($value,$options=array('required'=>true)){        
        $this->_data['ed_logr'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ed_logr']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['ed_logr']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ed_numero
     *
     * @return string
     */
    public function getEdNumero($instance=false){
        if ($instance && !is_object($this->_data['ed_numero'])){
            $this->setEdNumero('',array('required'=>false));
        }
        return $this->_data['ed_numero'];
    }
    /**
     * Seta o valor da coluna ed_numero
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEdNumero($value,$options=array('required'=>true)){        
        $this->_data['ed_numero'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ed_numero']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 30, ) );
            $valueValid = $this->_data['ed_numero']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ed_compl
     *
     * @return string
     */
    public function getEdCompl($instance=false){
        if ($instance && !is_object($this->_data['ed_compl'])){
            $this->setEdCompl('',array('required'=>false));
        }
        return $this->_data['ed_compl'];
    }
    /**
     * Seta o valor da coluna ed_compl
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEdCompl($value,$options=array('required'=>true)){        
        $this->_data['ed_compl'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ed_compl']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 60, ) );
            $valueValid = $this->_data['ed_compl']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ed_bairro
     *
     * @return string
     */
    public function getEdBairro($instance=false){
        if ($instance && !is_object($this->_data['ed_bairro'])){
            $this->setEdBairro('',array('required'=>false));
        }
        return $this->_data['ed_bairro'];
    }
    /**
     * Seta o valor da coluna ed_bairro
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEdBairro($value,$options=array('required'=>true)){        
        $this->_data['ed_bairro'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ed_bairro']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['ed_bairro']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ed_cidade
     *
     * @return string
     */
    public function getEdCidade($instance=false){
        if ($instance && !is_object($this->_data['ed_cidade'])){
            $this->setEdCidade('',array('required'=>false));
        }
        return $this->_data['ed_cidade'];
    }
    /**
     * Seta o valor da coluna ed_cidade
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEdCidade($value,$options=array('required'=>true)){        
        $this->_data['ed_cidade'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ed_cidade']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 60, ) );
            $valueValid = $this->_data['ed_cidade']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ed_estado
     *
     * @return string
     */
    public function getEdEstado($instance=false){
        if ($instance && !is_object($this->_data['ed_estado'])){
            $this->setEdEstado('',array('required'=>false));
        }
        return $this->_data['ed_estado'];
    }
    /**
     * Seta o valor da coluna ed_estado
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEdEstado($value,$options=array('required'=>true)){        
        $this->_data['ed_estado'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ed_estado']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 2, ) );
            $valueValid = $this->_data['ed_estado']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ed_cep
     *
     * @return string
     */
    public function getEdCep($instance=false){
        if ($instance && !is_object($this->_data['ed_cep'])){
            $this->setEdCep('',array('required'=>false));
        }
        return $this->_data['ed_cep'];
    }
    /**
     * Seta o valor da coluna ed_cep
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEdCep($value,$options=array('required'=>true)){        
        $this->_data['ed_cep'] = new ZendT_Type_String($value,array('mask'=>'99.999-999'
                                                                   ,'charMask'=>'9'
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ed_cep']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 10, ) );
            $valueValid = $this->_data['ed_cep']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ed_cob_logr
     *
     * @return string
     */
    public function getEdCobLogr($instance=false){
        if ($instance && !is_object($this->_data['ed_cob_logr'])){
            $this->setEdCobLogr('',array('required'=>false));
        }
        return $this->_data['ed_cob_logr'];
    }
    /**
     * Seta o valor da coluna ed_cob_logr
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEdCobLogr($value,$options=array('required'=>true)){        
        $this->_data['ed_cob_logr'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ed_cob_logr']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['ed_cob_logr']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ed_cob_numero
     *
     * @return string
     */
    public function getEdCobNumero($instance=false){
        if ($instance && !is_object($this->_data['ed_cob_numero'])){
            $this->setEdCobNumero('',array('required'=>false));
        }
        return $this->_data['ed_cob_numero'];
    }
    /**
     * Seta o valor da coluna ed_cob_numero
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEdCobNumero($value,$options=array('required'=>true)){        
        $this->_data['ed_cob_numero'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ed_cob_numero']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 30, ) );
            $valueValid = $this->_data['ed_cob_numero']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ed_cob_compl
     *
     * @return string
     */
    public function getEdCobCompl($instance=false){
        if ($instance && !is_object($this->_data['ed_cob_compl'])){
            $this->setEdCobCompl('',array('required'=>false));
        }
        return $this->_data['ed_cob_compl'];
    }
    /**
     * Seta o valor da coluna ed_cob_compl
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEdCobCompl($value,$options=array('required'=>true)){        
        $this->_data['ed_cob_compl'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ed_cob_compl']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 60, ) );
            $valueValid = $this->_data['ed_cob_compl']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ed_cob_bairro
     *
     * @return string
     */
    public function getEdCobBairro($instance=false){
        if ($instance && !is_object($this->_data['ed_cob_bairro'])){
            $this->setEdCobBairro('',array('required'=>false));
        }
        return $this->_data['ed_cob_bairro'];
    }
    /**
     * Seta o valor da coluna ed_cob_bairro
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEdCobBairro($value,$options=array('required'=>true)){        
        $this->_data['ed_cob_bairro'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ed_cob_bairro']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['ed_cob_bairro']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ed_cob_cidade
     *
     * @return string
     */
    public function getEdCobCidade($instance=false){
        if ($instance && !is_object($this->_data['ed_cob_cidade'])){
            $this->setEdCobCidade('',array('required'=>false));
        }
        return $this->_data['ed_cob_cidade'];
    }
    /**
     * Seta o valor da coluna ed_cob_cidade
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEdCobCidade($value,$options=array('required'=>true)){        
        $this->_data['ed_cob_cidade'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ed_cob_cidade']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 60, ) );
            $valueValid = $this->_data['ed_cob_cidade']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ed_cob_estado
     *
     * @return string
     */
    public function getEdCobEstado($instance=false){
        if ($instance && !is_object($this->_data['ed_cob_estado'])){
            $this->setEdCobEstado('',array('required'=>false));
        }
        return $this->_data['ed_cob_estado'];
    }
    /**
     * Seta o valor da coluna ed_cob_estado
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEdCobEstado($value,$options=array('required'=>true)){        
        $this->_data['ed_cob_estado'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ed_cob_estado']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 2, ) );
            $valueValid = $this->_data['ed_cob_estado']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ed_cob_cep
     *
     * @return string
     */
    public function getEdCobCep($instance=false){
        if ($instance && !is_object($this->_data['ed_cob_cep'])){
            $this->setEdCobCep('',array('required'=>false));
        }
        return $this->_data['ed_cob_cep'];
    }
    /**
     * Seta o valor da coluna ed_cob_cep
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEdCobCep($value,$options=array('required'=>true)){        
        $this->_data['ed_cob_cep'] = new ZendT_Type_String($value,array('mask'=>'99.999-999'
                                                                   ,'charMask'=>'9'
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ed_cob_cep']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 10, ) );
            $valueValid = $this->_data['ed_cob_cep']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna cliente
     *
     * @return string
     */
    public function getCliente($instance=false){
        if ($instance && !is_object($this->_data['cliente'])){
            $this->setCliente('',array('required'=>false));
        }
        return $this->_data['cliente'];
    }
    /**
     * Seta o valor da coluna cliente
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setCliente($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('1'=>'Sim','0'=>'Não');
        $this->_data['cliente'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['cliente']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['cliente']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna cont_cli_resp
     *
     * @return string
     */
    public function getContCliResp($instance=false){
        if ($instance && !is_object($this->_data['cont_cli_resp'])){
            $this->setContCliResp('',array('required'=>false));
        }
        return $this->_data['cont_cli_resp'];
    }
    /**
     * Seta o valor da coluna cont_cli_resp
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setContCliResp($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('1'=>'Sim','0'=>'Não');
        $this->_data['cont_cli_resp'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['cont_cli_resp']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['cont_cli_resp']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna cont_cli_vend
     *
     * @return string
     */
    public function getContCliVend($instance=false){
        if ($instance && !is_object($this->_data['cont_cli_vend'])){
            $this->setContCliVend('',array('required'=>false));
        }
        return $this->_data['cont_cli_vend'];
    }
    /**
     * Seta o valor da coluna cont_cli_vend
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setContCliVend($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('1'=>'Sim','0'=>'Não');
        $this->_data['cont_cli_vend'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['cont_cli_vend']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['cont_cli_vend']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna funcionario
     *
     * @return string
     */
    public function getFuncionario($instance=false){
        if ($instance && !is_object($this->_data['funcionario'])){
            $this->setFuncionario('',array('required'=>false));
        }
        return $this->_data['funcionario'];
    }
    /**
     * Seta o valor da coluna funcionario
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setFuncionario($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('1'=>'Sim','0'=>'Não');
        $this->_data['funcionario'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['funcionario']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['funcionario']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna usuario
     *
     * @return string
     */
    public function getUsuario($instance=false){
        if ($instance && !is_object($this->_data['usuario'])){
            $this->setUsuario('',array('required'=>false));
        }
        return $this->_data['usuario'];
    }
    /**
     * Seta o valor da coluna usuario
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setUsuario($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('1'=>'Sim','0'=>'Não');
        $this->_data['usuario'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['usuario']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['usuario']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna empresa
     *
     * @return string
     */
    public function getEmpresa($instance=false){
        if ($instance && !is_object($this->_data['empresa'])){
            $this->setEmpresa('',array('required'=>false));
        }
        return $this->_data['empresa'];
    }
    /**
     * Seta o valor da coluna empresa
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEmpresa($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('1'=>'Sim','0'=>'Não');
        $this->_data['empresa'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['empresa']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['empresa']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna registro
     *
     * @return string
     */
    public function getRegistro($instance=false){
        if ($instance && !is_object($this->_data['registro'])){
            $this->setRegistro('',array('required'=>false));
        }
        return $this->_data['registro'];
    }
    /**
     * Seta o valor da coluna registro
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setRegistro($value,$options=array('required'=>true)){        
        $this->_data['registro'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['registro']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 45, ) );
            $valueValid = $this->_data['registro']->getValueToDb();
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
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setIdEmpresa($value,$options=array('required'=>true)){        
        $this->_data['id_empresa'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_empresa']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna email_cob
     *
     * @return string
     */
    public function getEmailCob($instance=false){
        if ($instance && !is_object($this->_data['email_cob'])){
            $this->setEmailCob('',array('required'=>false));
        }
        return $this->_data['email_cob'];
    }
    /**
     * Seta o valor da coluna email_cob
     *
     * @param string $value
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setEmailCob($value,$options=array('required'=>true)){        
        $this->_data['email_cob'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['email_cob']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 60, ) );
            $valueValid = $this->_data['email_cob']->getValueToDb();
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
     * @return Ca_Model_Pessoa_Crud_Mapper
     */
    public function setHierarquia($value,$options=array('required'=>true)){        
        $this->_data['hierarquia'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['hierarquia']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 150, ) );
            $valueValid = $this->_data['hierarquia']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
}
?>