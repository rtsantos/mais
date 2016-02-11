<?php
/**
 * Classe de mapeamento do registro da tabela at_papel_empresa
 */
class Auth_Model_ContaEmpresa_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_papel','id_empresa','status','padrao');
    protected $_model = 'Auth_Model_ContaEmpresa_Table';
    public static $table = 'mais.at_papel_empresa';
    /**
     *
     * @var Auth_Model_ContaEmpresa_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Auth_Model_ContaEmpresa_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Auth_Model_ContaEmpresa_Mapper){
            $this->_dataOld = new Auth_Model_ContaEmpresa_Mapper();
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
     * @return Auth_Model_ContaEmpresa_Crud_Mapper
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
     * @return Auth_Model_ContaEmpresa_Crud_Mapper
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
     * @return Auth_Model_ContaEmpresa_Crud_Mapper
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
     * @return Auth_Model_ContaEmpresa_Crud_Mapper
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
     * Retorna os dados da coluna padrao
     *
     * @return string
     */
    public function getPadrao($instance=false){
        if ($instance && !is_object($this->_data['padrao'])){
            $this->setPadrao('',array('required'=>false));
        }
        return $this->_data['padrao'];
    }
    /**
     * Seta o valor da coluna padrao
     *
     * @param string $value
     * @return Auth_Model_ContaEmpresa_Crud_Mapper
     */
    public function setPadrao($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('S'=>'Sim','N'=>'Não');
        $this->_data['padrao'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['padrao']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'padrao');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['padrao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
}
?>