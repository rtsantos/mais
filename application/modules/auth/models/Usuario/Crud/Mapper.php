<?php
/**
 * Classe de mapeamento do registro da tabela usuario
 */
class Auth_Model_Usuario_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','idtipousuario','login','senha','nome','trocasenha','dhtrocasenha','status','nerroslogin','usuarioadmin','datahora','solic_info_adic');
    protected $_model = 'Auth_Model_Usuario_Table';
    /**
     *
     * @var Auth_Model_Usuario_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Auth_Model_Usuario_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Auth_Model_Usuario_Mapper){
            $this->_dataOld = new Auth_Model_Usuario_Mapper();
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
                'ID_PAPEL' => array(
                    'mapper' => 'Auth_DataView_Papel_MapperView',
                    'column' => 'ID'
                ),
                'IDFILIAL' => array(
                    'mapper' => 'Ca_DataView_Filial_MapperView',
                    'column' => 'ID'
                ),
                'IDEMPRESA' => array(
                    'mapper' => 'Ca_DataView_Empresa_MapperView',
                    'column' => 'ID'
                ),
                'IDEMPRESADEF' => array(
                    'mapper' => 'Ca_DataView_Empresa_MapperView',
                    'column' => 'ID'
                ),
                'IDTIPOUSUARIO' => array(
                    'mapper' => 'Auth_DataView_TipoUsuario_MapperView',
                    'column' => 'ID'
                ),
                'IDUSUARIORESP' => array(
                    'mapper' => 'Auth_DataView_Usuario_MapperView',
                    'column' => 'ID'
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
     * @return Auth_Model_Usuario_Crud_Mapper
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
     * Retorna os dados da coluna idtipousuario
     *
     * @return string
     */
    public function getIdtipousuario($instance=false){
        if ($instance && !is_object($this->_data['idtipousuario'])){
            $this->setIdtipousuario('',array('required'=>false));
        }
        return $this->_data['idtipousuario'];
    }
    /**
     * Seta o valor da coluna idtipousuario
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setIdtipousuario($value,$options=array('required'=>true)){        
        $this->_data['idtipousuario'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['idtipousuario']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'idtipousuario');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna login
     *
     * @return string
     */
    public function getLogin($instance=false){
        if ($instance && !is_object($this->_data['login'])){
            $this->setLogin('',array('required'=>false));
        }
        return $this->_data['login'];
    }
    /**
     * Seta o valor da coluna login
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setLogin($value,$options=array('required'=>true)){        
        $this->_data['login'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['login']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'login');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['login']->getValueToDb();
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
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setSenha($value,$options=array('required'=>true)){        
        $this->_data['senha'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['senha']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'senha');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 10, ) );
            $valueValid = $this->_data['senha']->getValueToDb();
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
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setNome($value,$options=array('required'=>true)){        
        $this->_data['nome'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', )));
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
     * Retorna os dados da coluna validadesenha
     *
     * @return string
     */
    public function getValidadesenha($instance=false){
        if ($instance && !is_object($this->_data['validadesenha'])){
            $this->setValidadesenha('',array('required'=>false));
        }
        return $this->_data['validadesenha'];
    }
    /**
     * Seta o valor da coluna validadesenha
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setValidadesenha($value,$options=array('required'=>true)){        
        $this->_data['validadesenha'] = new ZendT_Type_Date($value,'Date');
         if ($options['db'])
            $this->_data['validadesenha']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna trocasenha
     *
     * @return string
     */
    public function getTrocasenha($instance=false){
        if ($instance && !is_object($this->_data['trocasenha'])){
            $this->setTrocasenha('',array('required'=>false));
        }
        return $this->_data['trocasenha'];
    }
    /**
     * Seta o valor da coluna trocasenha
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setTrocasenha($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('S'=>'Sim','N'=>'Não');
        $this->_data['trocasenha'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['trocasenha']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'trocasenha');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['trocasenha']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dhtrocasenha
     *
     * @return string
     */
    public function getDhtrocasenha($instance=false){
        if ($instance && !is_object($this->_data['dhtrocasenha'])){
            $this->setDhtrocasenha('',array('required'=>false));
        }
        return $this->_data['dhtrocasenha'];
    }
    /**
     * Seta o valor da coluna dhtrocasenha
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setDhtrocasenha($value,$options=array('required'=>true)){        
        $this->_data['dhtrocasenha'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dhtrocasenha']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dhtrocasenha');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna expiracaosenha
     *
     * @return string
     */
    public function getExpiracaosenha($instance=false){
        if ($instance && !is_object($this->_data['expiracaosenha'])){
            $this->setExpiracaosenha('',array('required'=>false));
        }
        return $this->_data['expiracaosenha'];
    }
    /**
     * Seta o valor da coluna expiracaosenha
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setExpiracaosenha($value,$options=array('required'=>true)){        
        $this->_data['expiracaosenha'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['expiracaosenha']->setValueFromDb($value);
                    
        if (!$options['db']){
            
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
     * @return Auth_Model_Usuario_Crud_Mapper
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
     * Retorna os dados da coluna nerroslogin
     *
     * @return string
     */
    public function getNerroslogin($instance=false){
        if ($instance && !is_object($this->_data['nerroslogin'])){
            $this->setNerroslogin('',array('required'=>false));
        }
        return $this->_data['nerroslogin'];
    }
    /**
     * Seta o valor da coluna nerroslogin
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setNerroslogin($value,$options=array('required'=>true)){        
        $this->_data['nerroslogin'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['nerroslogin']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'nerroslogin');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna usuarioadmin
     *
     * @return string
     */
    public function getUsuarioadmin($instance=false){
        if ($instance && !is_object($this->_data['usuarioadmin'])){
            $this->setUsuarioadmin('',array('required'=>false));
        }
        return $this->_data['usuarioadmin'];
    }
    /**
     * Seta o valor da coluna usuarioadmin
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setUsuarioadmin($value,$options=array('required'=>true)){        
        $this->_data['usuarioadmin'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['usuarioadmin']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'usuarioadmin');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['usuarioadmin']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna cgccpf
     *
     * @return string
     */
    public function getCgccpf($instance=false){
        if ($instance && !is_object($this->_data['cgccpf'])){
            $this->setCgccpf('',array('required'=>false));
        }
        return $this->_data['cgccpf'];
    }
    /**
     * Seta o valor da coluna cgccpf
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setCgccpf($value,$options=array('required'=>true)){        
        $this->_data['cgccpf'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['cgccpf']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 20, ) );
            $valueValid = $this->_data['cgccpf']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna endereco
     *
     * @return string
     */
    public function getEndereco($instance=false){
        if ($instance && !is_object($this->_data['endereco'])){
            $this->setEndereco('',array('required'=>false));
        }
        return $this->_data['endereco'];
    }
    /**
     * Seta o valor da coluna endereco
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setEndereco($value,$options=array('required'=>true)){        
        $this->_data['endereco'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['endereco']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['endereco']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
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
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setTelefone($value,$options=array('required'=>true)){        
        $this->_data['telefone'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['telefone']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 20, ) );
            $valueValid = $this->_data['telefone']->getValueToDb();
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
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setEmail($value,$options=array('required'=>true)){        
        $this->_data['email'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtolower', )));
        if ($options['db'])
            $this->_data['email']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['email']->getValueToDb();
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
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setUsuario($value,$options=array('required'=>true)){        
        $this->_data['usuario'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['usuario']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 20, ) );
            $valueValid = $this->_data['usuario']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna datahora
     *
     * @return string
     */
    public function getDatahora($instance=false){
        if ($instance && !is_object($this->_data['datahora'])){
            $this->setDatahora('',array('required'=>false));
        }
        return $this->_data['datahora'];
    }
    /**
     * Seta o valor da coluna datahora
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setDatahora($value,$options=array('required'=>true)){        
        $this->_data['datahora'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['datahora']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'datahora');
                    
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
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setFax($value,$options=array('required'=>true)){        
        $this->_data['fax'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['fax']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 20, ) );
            $valueValid = $this->_data['fax']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna idpessoal
     *
     * @return string
     */
    public function getIdpessoal($instance=false){
        if ($instance && !is_object($this->_data['idpessoal'])){
            $this->setIdpessoal('',array('required'=>false));
        }
        return $this->_data['idpessoal'];
    }
    /**
     * Seta o valor da coluna idpessoal
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setIdpessoal($value,$options=array('required'=>true)){        
        $this->_data['idpessoal'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['idpessoal']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna chapa
     *
     * @return string
     */
    public function getChapa($instance=false){
        if ($instance && !is_object($this->_data['chapa'])){
            $this->setChapa('',array('required'=>false));
        }
        return $this->_data['chapa'];
    }
    /**
     * Seta o valor da coluna chapa
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setChapa($value,$options=array('required'=>true)){        
        $this->_data['chapa'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['chapa']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 10, ) );
            $valueValid = $this->_data['chapa']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna codccustodef
     *
     * @return string
     */
    public function getCodccustodef($instance=false){
        if ($instance && !is_object($this->_data['codccustodef'])){
            $this->setCodccustodef('',array('required'=>false));
        }
        return $this->_data['codccustodef'];
    }
    /**
     * Seta o valor da coluna codccustodef
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setCodccustodef($value,$options=array('required'=>true)){        
        $this->_data['codccustodef'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['codccustodef']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 10, ) );
            $valueValid = $this->_data['codccustodef']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna codeof
     *
     * @return string
     */
    public function getCodeof($instance=false){
        if ($instance && !is_object($this->_data['codeof'])){
            $this->setCodeof('',array('required'=>false));
        }
        return $this->_data['codeof'];
    }
    /**
     * Seta o valor da coluna codeof
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setCodeof($value,$options=array('required'=>true)){        
        $this->_data['codeof'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['codeof']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 30, ) );
            $valueValid = $this->_data['codeof']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna idempresa
     *
     * @return string
     */
    public function getIdempresa($instance=false){
        if ($instance && !is_object($this->_data['idempresa'])){
            $this->setIdempresa('',array('required'=>false));
        }
        return $this->_data['idempresa'];
    }
    /**
     * Seta o valor da coluna idempresa
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setIdempresa($value,$options=array('required'=>true)){        
        $this->_data['idempresa'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['idempresa']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna idempresadef
     *
     * @return string
     */
    public function getIdempresadef($instance=false){
        if ($instance && !is_object($this->_data['idempresadef'])){
            $this->setIdempresadef('',array('required'=>false));
        }
        return $this->_data['idempresadef'];
    }
    /**
     * Seta o valor da coluna idempresadef
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setIdempresadef($value,$options=array('required'=>true)){        
        $this->_data['idempresadef'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['idempresadef']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna idfilial
     *
     * @return string
     */
    public function getIdfilial($instance=false){
        if ($instance && !is_object($this->_data['idfilial'])){
            $this->setIdfilial('',array('required'=>false));
        }
        return $this->_data['idfilial'];
    }
    /**
     * Seta o valor da coluna idfilial
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setIdfilial($value,$options=array('required'=>true)){        
        $this->_data['idfilial'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['idfilial']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna idusuarioresp
     *
     * @return string
     */
    public function getIdusuarioresp($instance=false){
        if ($instance && !is_object($this->_data['idusuarioresp'])){
            $this->setIdusuarioresp('',array('required'=>false));
        }
        return $this->_data['idusuarioresp'];
    }
    /**
     * Seta o valor da coluna idusuarioresp
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setIdusuarioresp($value,$options=array('required'=>true)){        
        $this->_data['idusuarioresp'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['idusuarioresp']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_papel
     *
     * @return string
     */
    public function getIdPapel($instance=false){
        if ($instance && !is_object($this->_data['id_papel'])){
            $this->setIdPapel('',array('required'=>false));
        }
        return $this->_data['id_papel'];
    }
    /**
     * Seta o valor da coluna id_papel
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setIdPapel($value,$options=array('required'=>true)){        
        $this->_data['id_papel'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_papel']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna solic_info_adic
     *
     * @return string
     */
    public function getSolicInfoAdic($instance=false){
        if ($instance && !is_object($this->_data['solic_info_adic'])){
            $this->setSolicInfoAdic('',array('required'=>false));
        }
        return $this->_data['solic_info_adic'];
    }
    /**
     * Seta o valor da coluna solic_info_adic
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setSolicInfoAdic($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('S'=>'Sim','N'=>'Não');
        $this->_data['solic_info_adic'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['solic_info_adic']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'solic_info_adic');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['solic_info_adic']->getValueToDb();
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
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setObservacao($value,$options=array('required'=>true)){        
        $this->_data['observacao'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['observacao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 500, ) );
            $valueValid = $this->_data['observacao']->getValueToDb();
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
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setEmpresa($value,$options=array('required'=>true)){        
        $this->_data['empresa'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['empresa']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['empresa']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dh_ult_logon
     *
     * @return string
     */
    public function getDhUltLogon($instance=false){
        if ($instance && !is_object($this->_data['dh_ult_logon'])){
            $this->setDhUltLogon('',array('required'=>false));
        }
        return $this->_data['dh_ult_logon'];
    }
    /**
     * Seta o valor da coluna dh_ult_logon
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setDhUltLogon($value,$options=array('required'=>true)){        
        $this->_data['dh_ult_logon'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_ult_logon']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ntry
     *
     * @return string
     */
    public function getNtry($instance=false){
        if ($instance && !is_object($this->_data['ntry'])){
            $this->setNtry('',array('required'=>false));
        }
        return $this->_data['ntry'];
    }
    /**
     * Seta o valor da coluna ntry
     *
     * @param string $value
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setNtry($value,$options=array('required'=>true)){        
        $this->_data['ntry'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['ntry']->setValueFromDb($value);
                    
        if (!$options['db']){
            
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
     * @return Auth_Model_Usuario_Crud_Mapper
     */
    public function setAvatar($value,$options=array('required'=>true)){        
        $this->_data['avatar'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['avatar']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>