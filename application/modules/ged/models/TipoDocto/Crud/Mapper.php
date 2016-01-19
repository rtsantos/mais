<?php
/**
 * Classe de mapeamento do registro da tabela img_tipo_docto
 */
class Ged_Model_TipoDocto_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_prop_docto','nome','status');
    protected $_model = 'Ged_Model_TipoDocto_Table';
    /**
     *
     * @var Ged_Model_TipoDocto_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Ged_Model_TipoDocto_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Ged_Model_TipoDocto_Mapper){
            $this->_dataOld = new Ged_Model_TipoDocto_Mapper();
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
     * @return Ged_Model_TipoDocto_Crud_Mapper
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
     * Retorna os dados da coluna id_prop_docto
     *
     * @return string
     */
    public function getIdPropDocto($instance=false){
        if ($instance && !is_object($this->_data['id_prop_docto'])){
            $this->setIdPropDocto('',array('required'=>false));
        }
        return $this->_data['id_prop_docto'];
    }
    /**
     * Seta o valor da coluna id_prop_docto
     *
     * @param string $value
     * @return Ged_Model_TipoDocto_Crud_Mapper
     */
    public function setIdPropDocto($value,$options=array('required'=>true)){        
        $this->_data['id_prop_docto'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
         if ($options['db'])
            $this->_data['id_prop_docto']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_prop_docto');
                    
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
     * @return Ged_Model_TipoDocto_Crud_Mapper
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
     * @return Ged_Model_TipoDocto_Crud_Mapper
     */
    public function setStatus($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('A'=>'Ativo','I'=>'Inativo','1'=>'Ativo (1)');
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
            
}
?>