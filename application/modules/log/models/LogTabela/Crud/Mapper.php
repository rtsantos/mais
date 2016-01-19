<?php
/**
 * Classe de mapeamento do registro da tabela log_tabela
 */
class Log_Model_LogTabela_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','nome','owner','table_name');
    protected $_model = 'Log_Model_LogTabela_Table';
    /**
     *
     * @var Log_Model_LogTabela_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Log_Model_LogTabela_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Log_Model_LogTabela_Mapper){
            $this->_dataOld = new Log_Model_LogTabela_Mapper();
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
     * @return Log_Model_LogTabela_Crud_Mapper
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
     * @return Log_Model_LogTabela_Crud_Mapper
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
     * Retorna os dados da coluna owner
     *
     * @return string
     */
    public function getOwner($instance=false){
        if ($instance && !is_object($this->_data['owner'])){
            $this->setOwner('',array('required'=>false));
        }
        return $this->_data['owner'];
    }
    /**
     * Seta o valor da coluna owner
     *
     * @param string $value
     * @return Log_Model_LogTabela_Crud_Mapper
     */
    public function setOwner($value,$options=array('required'=>true)){        
        $this->_data['owner'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['owner']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'owner');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 30, ) );
            $valueValid = $this->_data['owner']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna table_name
     *
     * @return string
     */
    public function getTableName($instance=false){
        if ($instance && !is_object($this->_data['table_name'])){
            $this->setTableName('',array('required'=>false));
        }
        return $this->_data['table_name'];
    }
    /**
     * Seta o valor da coluna table_name
     *
     * @param string $value
     * @return Log_Model_LogTabela_Crud_Mapper
     */
    public function setTableName($value,$options=array('required'=>true)){        
        $this->_data['table_name'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['table_name']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'table_name');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 30, ) );
            $valueValid = $this->_data['table_name']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
}
?>