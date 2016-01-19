<?php
/**
 * Classe de mapeamento do registro da tabela papel_recurso
 */
class Auth_Model_PapelRecurso_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id');
    protected $_model = 'Auth_Model_PapelRecurso_Table';
    /**
     *
     * @var Auth_Model_PapelRecurso_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Auth_Model_PapelRecurso_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Auth_Model_PapelRecurso_Mapper){
            $this->_dataOld = new Auth_Model_PapelRecurso_Mapper();
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
                    'mapper' => 'Auth_DataView_Papel_MapperView',
                    'column' => 'id'
                ),
                'id_recurso' => array(
                    'mapper' => 'Auth_DataView_Recurso_MapperView',
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
     * @return Auth_Model_PapelRecurso_Crud_Mapper
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
     * @return Auth_Model_PapelRecurso_Crud_Mapper
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
     * Retorna os dados da coluna id_recurso
     *
     * @return string
     */
    public function getIdRecurso($instance=false){
        if ($instance && !is_object($this->_data['id_recurso'])){
            $this->setIdRecurso('',array('required'=>false));
        }
        return $this->_data['id_recurso'];
    }
    /**
     * Seta o valor da coluna id_recurso
     *
     * @param string $value
     * @return Auth_Model_PapelRecurso_Crud_Mapper
     */
    public function setIdRecurso($value,$options=array('required'=>true)){        
        $this->_data['id_recurso'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_recurso']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna acesso
     *
     * @return string
     */
    public function getAcesso($instance=false){
        if ($instance && !is_object($this->_data['acesso'])){
            $this->setAcesso('',array('required'=>false));
        }
        return $this->_data['acesso'];
    }
    /**
     * Seta o valor da coluna acesso
     *
     * @param string $value
     * @return Auth_Model_PapelRecurso_Crud_Mapper
     */
    public function setAcesso($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('P'=>'Permitido','N'=>'Negado');
        $this->_data['acesso'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['acesso']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['acesso']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
}
?>