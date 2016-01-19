<?php
/**
 * Classe de mapeamento do registro da tabela cms_status
 */
class Cms_Model_Status_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','descricao','status','acao','id_categoria');
    protected $_model = 'Cms_Model_Status_Table';
    /**
     *
     * @var Cms_Model_Status_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Cms_Model_Status_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Cms_Model_Status_Mapper){
            $this->_dataOld = new Cms_Model_Status_Mapper();
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
                'ID_CATEGORIA' => array(
                    'mapper' => 'Cms_DataView_Categoria_MapperView',
                    'column' => 'ID'
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
     * @return Cms_Model_Status_Crud_Mapper
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
     * @return Cms_Model_Status_Crud_Mapper
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
            
         if ($options['required'])
            $this->isRequired($value,'descricao');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['descricao']->getValueToDb();
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
     * @return Cms_Model_Status_Crud_Mapper
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
     * Retorna os dados da coluna acao
     *
     * @return string
     */
    public function getAcao($instance=false){
        if ($instance && !is_object($this->_data['acao'])){
            $this->setAcao('',array('required'=>false));
        }
        return $this->_data['acao'];
    }
    /**
     * Seta o valor da coluna acao
     *
     * @param string $value
     * @return Cms_Model_Status_Crud_Mapper
     */
    public function setAcao($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('P'=>'Pendente','A'=>'Aprovado','F'=>'Finalizado','C'=>'Cancelado');
        $this->_data['acao'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['acao']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'acao');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['acao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_categoria
     *
     * @return string
     */
    public function getIdCategoria($instance=false){
        if ($instance && !is_object($this->_data['id_categoria'])){
            $this->setIdCategoria('',array('required'=>false));
        }
        return $this->_data['id_categoria'];
    }
    /**
     * Seta o valor da coluna id_categoria
     *
     * @param string $value
     * @return Cms_Model_Status_Crud_Mapper
     */
    public function setIdCategoria($value,$options=array('required'=>true)){        
        $this->_data['id_categoria'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_categoria']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_categoria');
                    
        }
        return $this;
    }

            
}
?>