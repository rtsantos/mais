<?php
/**
 * Classe de mapeamento do registro da tabela ca_endereco
 */
class Ca_Model_Endereco_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','logradouro','id_empresa');
    protected $_model = 'Ca_Model_Endereco_Table';
    public static $table = 'mais.ca_endereco';
    /**
     *
     * @var Ca_Model_Endereco_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Ca_Model_Endereco_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Ca_Model_Endereco_Mapper){
            $this->_dataOld = new Ca_Model_Endereco_Mapper();
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
                'id_cidade' => array(
                    'mapper' => 'Ca_DataView_Cidade_MapperView',
                    'column' => 'id'
                ),
                'id_empresa' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
                    'column' => 'id'
                ));
    }
    /**
     * @retun array
     */
    public function getTabs(){
        return array (
  'ca_pessoa' => 
  array (
    'description' => 'Pessoa',
    'url' => '/ca/pessoa/form/grid/1',
    'column' => '',
    'message' => 'Necessário seleção ',
  ),
  'cv_pedido' => 
  array (
    'description' => 'Pedido',
    'url' => '/vendas/pedido/form/grid/1',
    'column' => '',
    'message' => 'Necessário seleção ',
  ),
);
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
     * @return Ca_Model_Endereco_Crud_Mapper
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
     * @return Ca_Model_Endereco_Crud_Mapper
     */
    public function setTipo($value,$options=array('required'=>true)){        
        $this->_data['tipo'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['tipo']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['tipo']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna logradouro
     *
     * @return string
     */
    public function getLogradouro($instance=false){
        if ($instance && !is_object($this->_data['logradouro'])){
            $this->setLogradouro('',array('required'=>false));
        }
        return $this->_data['logradouro'];
    }
    /**
     * Seta o valor da coluna logradouro
     *
     * @param string $value
     * @return Ca_Model_Endereco_Crud_Mapper
     */
    public function setLogradouro($value,$options=array('required'=>true)){        
        $this->_data['logradouro'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['logradouro']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'logradouro');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['logradouro']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna numero
     *
     * @return string
     */
    public function getNumero($instance=false){
        if ($instance && !is_object($this->_data['numero'])){
            $this->setNumero('',array('required'=>false));
        }
        return $this->_data['numero'];
    }
    /**
     * Seta o valor da coluna numero
     *
     * @param string $value
     * @return Ca_Model_Endereco_Crud_Mapper
     */
    public function setNumero($value,$options=array('required'=>true)){        
        $this->_data['numero'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['numero']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 20, ) );
            $valueValid = $this->_data['numero']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna complemento
     *
     * @return string
     */
    public function getComplemento($instance=false){
        if ($instance && !is_object($this->_data['complemento'])){
            $this->setComplemento('',array('required'=>false));
        }
        return $this->_data['complemento'];
    }
    /**
     * Seta o valor da coluna complemento
     *
     * @param string $value
     * @return Ca_Model_Endereco_Crud_Mapper
     */
    public function setComplemento($value,$options=array('required'=>true)){        
        $this->_data['complemento'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['complemento']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['complemento']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna bairro
     *
     * @return string
     */
    public function getBairro($instance=false){
        if ($instance && !is_object($this->_data['bairro'])){
            $this->setBairro('',array('required'=>false));
        }
        return $this->_data['bairro'];
    }
    /**
     * Seta o valor da coluna bairro
     *
     * @param string $value
     * @return Ca_Model_Endereco_Crud_Mapper
     */
    public function setBairro($value,$options=array('required'=>true)){        
        $this->_data['bairro'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['bairro']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['bairro']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_cidade
     *
     * @return string
     */
    public function getIdCidade($instance=false){
        if ($instance && !is_object($this->_data['id_cidade'])){
            $this->setIdCidade('',array('required'=>false));
        }
        return $this->_data['id_cidade'];
    }
    /**
     * Seta o valor da coluna id_cidade
     *
     * @param string $value
     * @return Ca_Model_Endereco_Crud_Mapper
     */
    public function setIdCidade($value,$options=array('required'=>true)){        
        $this->_data['id_cidade'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_cidade']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna cep
     *
     * @return string
     */
    public function getCep($instance=false){
        if ($instance && !is_object($this->_data['cep'])){
            $this->setCep('',array('required'=>false));
        }
        return $this->_data['cep'];
    }
    /**
     * Seta o valor da coluna cep
     *
     * @param string $value
     * @return Ca_Model_Endereco_Crud_Mapper
     */
    public function setCep($value,$options=array('required'=>true)){        
        $this->_data['cep'] = new ZendT_Type_String($value,array('mask'=>'99.999-999'
                                                                   ,'charMask'=>'9'
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['cep']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 20, ) );
            $valueValid = $this->_data['cep']->getValueToDb();
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
     * @return Ca_Model_Endereco_Crud_Mapper
     */
    public function setIdEmpresa($value,$options=array('required'=>true)){        
        $this->_data['id_empresa'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_empresa']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_empresa');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna cidade
     *
     * @return string
     */
    public function getCidade($instance=false){
        if ($instance && !is_object($this->_data['cidade'])){
            $this->setCidade('',array('required'=>false));
        }
        return $this->_data['cidade'];
    }
    /**
     * Seta o valor da coluna cidade
     *
     * @param string $value
     * @return Ca_Model_Endereco_Crud_Mapper
     */
    public function setCidade($value,$options=array('required'=>true)){        
        $this->_data['cidade'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['cidade']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['cidade']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna uf
     *
     * @return string
     */
    public function getUf($instance=false){
        if ($instance && !is_object($this->_data['uf'])){
            $this->setUf('',array('required'=>false));
        }
        return $this->_data['uf'];
    }
    /**
     * Seta o valor da coluna uf
     *
     * @param string $value
     * @return Ca_Model_Endereco_Crud_Mapper
     */
    public function setUf($value,$options=array('required'=>true)){        
        $this->_data['uf'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['uf']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 2, ) );
            $valueValid = $this->_data['uf']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
}
?>