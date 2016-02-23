<?php
/**
 * Classe de mapeamento do registro da tabela ca_cidade
 */
class Ca_Model_Cidade_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','nome','polo','classificacao','id_estado');
    protected $_model = 'Ca_Model_Cidade_Table';
    public static $table = 'mais.ca_cidade';
    /**
     *
     * @var Ca_Model_Cidade_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Ca_Model_Cidade_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Ca_Model_Cidade_Mapper){
            $this->_dataOld = new Ca_Model_Cidade_Mapper();
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
                'id_estado' => array(
                    'mapper' => 'Ca_DataView_Estado_MapperView',
                    'column' => 'id'
                ));
    }
    /**
     * @retun array
     */
    public function getTabs(){
        return array (
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
     * @return Ca_Model_Cidade_Crud_Mapper
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
     * @return Ca_Model_Cidade_Crud_Mapper
     */
    public function setNome($value,$options=array('required'=>true)){        
        $this->_data['nome'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['nome']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'nome');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['nome']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna polo
     *
     * @return string
     */
    public function getPolo($instance=false){
        if ($instance && !is_object($this->_data['polo'])){
            $this->setPolo('',array('required'=>false));
        }
        return $this->_data['polo'];
    }
    /**
     * Seta o valor da coluna polo
     *
     * @param string $value
     * @return Ca_Model_Cidade_Crud_Mapper
     */
    public function setPolo($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('S'=>'Sim','N'=>'Não');
        $this->_data['polo'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['polo']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'polo');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['polo']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna classificacao
     *
     * @return string
     */
    public function getClassificacao($instance=false){
        if ($instance && !is_object($this->_data['classificacao'])){
            $this->setClassificacao('',array('required'=>false));
        }
        return $this->_data['classificacao'];
    }
    /**
     * Seta o valor da coluna classificacao
     *
     * @param string $value
     * @return Ca_Model_Cidade_Crud_Mapper
     */
    public function setClassificacao($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('I'=>'Interior','C'=>'Capital');
        $this->_data['classificacao'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['classificacao']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'classificacao');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['classificacao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_estado
     *
     * @return string
     */
    public function getIdEstado($instance=false){
        if ($instance && !is_object($this->_data['id_estado'])){
            $this->setIdEstado('',array('required'=>false));
        }
        return $this->_data['id_estado'];
    }
    /**
     * Seta o valor da coluna id_estado
     *
     * @param string $value
     * @return Ca_Model_Cidade_Crud_Mapper
     */
    public function setIdEstado($value,$options=array('required'=>true)){        
        $this->_data['id_estado'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_estado']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_estado');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna cod_ibge
     *
     * @return string
     */
    public function getCodIbge($instance=false){
        if ($instance && !is_object($this->_data['cod_ibge'])){
            $this->setCodIbge('',array('required'=>false));
        }
        return $this->_data['cod_ibge'];
    }
    /**
     * Seta o valor da coluna cod_ibge
     *
     * @param string $value
     * @return Ca_Model_Cidade_Crud_Mapper
     */
    public function setCodIbge($value,$options=array('required'=>true)){        
        $this->_data['cod_ibge'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['cod_ibge']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 20, ) );
            $valueValid = $this->_data['cod_ibge']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna aliq_iss
     *
     * @return string
     */
    public function getAliqIss($instance=false){
        if ($instance && !is_object($this->_data['aliq_iss'])){
            $this->setAliqIss('',array('required'=>false));
        }
        return $this->_data['aliq_iss'];
    }
    /**
     * Seta o valor da coluna aliq_iss
     *
     * @param string $value
     * @return Ca_Model_Cidade_Crud_Mapper
     */
    public function setAliqIss($value,$options=array('required'=>true)){        
        $this->_data['aliq_iss'] = new ZendT_Type_Number($value,array('numDecimal'=>3));
         if ($options['db'])
            $this->_data['aliq_iss']->setValueFromDb($value);
                    
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
     * @return Ca_Model_Cidade_Crud_Mapper
     */
    public function setCep($value,$options=array('required'=>true)){        
        $this->_data['cep'] = new ZendT_Type_String($value,array('mask'=>'99.999-99'
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

            
}
?>