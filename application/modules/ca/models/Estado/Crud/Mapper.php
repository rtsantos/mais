<?php
/**
 * Classe de mapeamento do registro da tabela ca_estado
 */
class Ca_Model_Estado_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','uf','nome');
    protected $_model = 'Ca_Model_Estado_Table';
    public static $table = 'mais.ca_estado';
    /**
     *
     * @var Ca_Model_Estado_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Ca_Model_Estado_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Ca_Model_Estado_Mapper){
            $this->_dataOld = new Ca_Model_Estado_Mapper();
            $this->_dataOld->setId($this->getId());
            $this->_dataOld->retrive();
        }
        return $this->_dataOld;
    }
    /**
     * Retorna as referências do objeto
     */
    public function getReferenceMap(){
        return array();
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
     * @return Ca_Model_Estado_Crud_Mapper
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
     * @return Ca_Model_Estado_Crud_Mapper
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
            
         if ($options['required'])
            $this->isRequired($value,'uf');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 2, ) );
            $valueValid = $this->_data['uf']->getValueToDb();
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
     * @return Ca_Model_Estado_Crud_Mapper
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
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['nome']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
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
     * @return Ca_Model_Estado_Crud_Mapper
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
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 10, ) );
            $valueValid = $this->_data['cod_ibge']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna mascara_ie
     *
     * @return string
     */
    public function getMascaraIe($instance=false){
        if ($instance && !is_object($this->_data['mascara_ie'])){
            $this->setMascaraIe('',array('required'=>false));
        }
        return $this->_data['mascara_ie'];
    }
    /**
     * Seta o valor da coluna mascara_ie
     *
     * @param string $value
     * @return Ca_Model_Estado_Crud_Mapper
     */
    public function setMascaraIe($value,$options=array('required'=>true)){        
        $this->_data['mascara_ie'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['mascara_ie']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 20, ) );
            $valueValid = $this->_data['mascara_ie']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
}
?>