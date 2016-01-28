<?php
/**
 * Classe de mapeamento do registro da tabela papel_rel
 */
class Auth_Model_ContaRel_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_papel','id_papel_rel','status');
    protected $_model = 'Auth_Model_ContaRel_Table';
    public static $table = 'prouser.papel_rel';
    /**
     *
     * @var Auth_Model_ContaRel_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Auth_Model_ContaRel_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Auth_Model_ContaRel_Mapper){
            $this->_dataOld = new Auth_Model_ContaRel_Mapper();
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
                'id_papel' => array(
                    'mapper' => 'Auth_DataView_Conta_MapperView',
                    'column' => 'id'
                ),
                'id_papel_rel' => array(
                    'mapper' => 'Auth_DataView_Conta_MapperView',
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
     * @return Auth_Model_ContaRel_Crud_Mapper
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
     * @return Auth_Model_ContaRel_Crud_Mapper
     */
    public function setIdPapel($value,$options=array('required'=>true)){        
        $this->_data['id_papel'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_papel']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_papel');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_papel_rel
     *
     * @return string
     */
    public function getIdPapelRel($instance=false){
        if ($instance && !is_object($this->_data['id_papel_rel'])){
            $this->setIdPapelRel('',array('required'=>false));
        }
        return $this->_data['id_papel_rel'];
    }
    /**
     * Seta o valor da coluna id_papel_rel
     *
     * @param string $value
     * @return Auth_Model_ContaRel_Crud_Mapper
     */
    public function setIdPapelRel($value,$options=array('required'=>true)){        
        $this->_data['id_papel_rel'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_papel_rel']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_papel_rel');
                    
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
     * @return Auth_Model_ContaRel_Crud_Mapper
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

            
}
?>