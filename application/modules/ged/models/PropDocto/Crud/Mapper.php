<?php
/**
 * Classe de mapeamento do registro da tabela img_prop_docto
 */
class Ged_Model_PropDocto_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_aplicacao','nome');
    protected $_model = 'Ged_Model_PropDocto_Table';
    /**
     *
     * @var Ged_Model_PropDocto_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Ged_Model_PropDocto_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Ged_Model_PropDocto_Mapper){
            $this->_dataOld = new Ged_Model_PropDocto_Mapper();
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
     * @return Ged_Model_PropDocto_Crud_Mapper
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
     * @return Ged_Model_PropDocto_Crud_Mapper
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
     * @return Ged_Model_PropDocto_Crud_Mapper
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
     * Retorna os dados da coluna tabela
     *
     * @return string
     */
    public function getTabela($instance=false){
        if ($instance && !is_object($this->_data['tabela'])){
            $this->setTabela('',array('required'=>false));
        }
        return $this->_data['tabela'];
    }
    /**
     * Seta o valor da coluna tabela
     *
     * @param string $value
     * @return Ged_Model_PropDocto_Crud_Mapper
     */
    public function setTabela($value,$options=array('required'=>true)){        
        $this->_data['tabela'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['tabela']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['tabela']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna sql
     *
     * @return string
     */
    public function getSql($instance=false){
        if ($instance && !is_object($this->_data['sql'])){
            $this->setSql('',array('required'=>false));
        }
        return $this->_data['sql'];
    }
    /**
     * Seta o valor da coluna sql
     *
     * @param string $value
     * @return Ged_Model_PropDocto_Crud_Mapper
     */
    public function setSql($value,$options=array('required'=>true)){        
        $this->_data['sql'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['sql']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 500, ) );
            $valueValid = $this->_data['sql']->getValueToDb();
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
     * @return Ged_Model_PropDocto_Crud_Mapper
     */
    public function setConfig($value,$options=array('required'=>true)){        
        $this->_data['config'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['config']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1000, ) );
            $valueValid = $this->_data['config']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
}
?>