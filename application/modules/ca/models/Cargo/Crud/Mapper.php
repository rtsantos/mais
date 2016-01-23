<?php
/**
 * Classe de mapeamento do registro da tabela ca_cargo
 */
class Ca_Model_Cargo_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id');
    protected $_model = 'Ca_Model_Cargo_Table';
    public static $table = 'mais.ca_cargo';
    /**
     *
     * @var Ca_Model_Cargo_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Ca_Model_Cargo_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Ca_Model_Cargo_Mapper){
            $this->_dataOld = new Ca_Model_Cargo_Mapper();
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
     * @return Ca_Model_Cargo_Crud_Mapper
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
     * @return Ca_Model_Cargo_Crud_Mapper
     */
    public function setDescricao($value,$options=array('required'=>true)){        
        $this->_data['descricao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['descricao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 60, ) );
            $valueValid = $this->_data['descricao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna sigla
     *
     * @return string
     */
    public function getSigla($instance=false){
        if ($instance && !is_object($this->_data['sigla'])){
            $this->setSigla('',array('required'=>false));
        }
        return $this->_data['sigla'];
    }
    /**
     * Seta o valor da coluna sigla
     *
     * @param string $value
     * @return Ca_Model_Cargo_Crud_Mapper
     */
    public function setSigla($value,$options=array('required'=>true)){        
        $this->_data['sigla'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['sigla']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 10, ) );
            $valueValid = $this->_data['sigla']->getValueToDb();
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
     * @return Ca_Model_Cargo_Crud_Mapper
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