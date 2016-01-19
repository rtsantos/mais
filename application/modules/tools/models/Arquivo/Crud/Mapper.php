<?php
/**
 * Classe de mapeamento do registro da tabela arquivo
 */
class Tools_Model_Arquivo_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','tipo','tempo_vida','dh_inc','nome');
    protected $_model = 'Tools_Model_Arquivo_Table';
    /**
     *
     * @var Tools_Model_Arquivo_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Tools_Model_Arquivo_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Tools_Model_Arquivo_Mapper){
            $this->_dataOld = new Tools_Model_Arquivo_Mapper();
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
     * @return Tools_Model_Arquivo_Crud_Mapper
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
     * Retorna os dados da coluna tipo
     *
     * @return string
     */
    public function getTipo($instance=false){
        if ($instance && !is_object($this->_data['tipo'])){
            $this->setTipo('',array('required'=>false));
        }
        return $this->_data['tipo'];
    }
    /**
     * Seta o valor da coluna tipo
     *
     * @param string $value
     * @return Tools_Model_Arquivo_Crud_Mapper
     */
    public function setTipo($value,$options=array('required'=>true)){        
        $this->_data['tipo'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['tipo']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'tipo');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna tempo_vida
     *
     * @return string
     */
    public function getTempoVida($instance=false){
        if ($instance && !is_object($this->_data['tempo_vida'])){
            $this->setTempoVida('',array('required'=>false));
        }
        return $this->_data['tempo_vida'];
    }
    /**
     * Seta o valor da coluna tempo_vida
     *
     * @param string $value
     * @return Tools_Model_Arquivo_Crud_Mapper
     */
    public function setTempoVida($value,$options=array('required'=>true)){        
        $this->_data['tempo_vida'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['tempo_vida']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'tempo_vida');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna dh_inc
     *
     * @return string
     */
    public function getDhInc($instance=false){
        if ($instance && !is_object($this->_data['dh_inc'])){
            $this->setDhInc('',array('required'=>false));
        }
        return $this->_data['dh_inc'];
    }
    /**
     * Seta o valor da coluna dh_inc
     *
     * @param string $value
     * @return Tools_Model_Arquivo_Crud_Mapper
     */
    public function setDhInc($value,$options=array('required'=>true)){        
        $this->_data['dh_inc'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_inc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dh_inc');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna hashcode
     *
     * @return string
     */
    public function getHashcode($instance=false){
        if ($instance && !is_object($this->_data['hashcode'])){
            $this->setHashcode('',array('required'=>false));
        }
        return $this->_data['hashcode'];
    }
    /**
     * Seta o valor da coluna hashcode
     *
     * @param string $value
     * @return Tools_Model_Arquivo_Crud_Mapper
     */
    public function setHashcode($value,$options=array('required'=>true)){        
        $this->_data['hashcode'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['hashcode']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 32, ) );
            $valueValid = $this->_data['hashcode']->getValueToDb();
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
     * @return Tools_Model_Arquivo_Crud_Mapper
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
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 75, ) );
            $valueValid = $this->_data['nome']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna arq_clob
     *
     * @return string
     */
    public function getArqClob($instance=false){
        if ($instance && !is_object($this->_data['arq_clob'])){
            $this->setArqClob('',array('required'=>false));
        }
        return $this->_data['arq_clob'];
    }
    /**
     * Seta o valor da coluna arq_clob
     *
     * @param string $value
     * @return Tools_Model_Arquivo_Crud_Mapper
     */
    public function setArqClob($value,$options=array('required'=>true)){        
        
         $this->_data['arq_clob'] = new ZendT_Type_Clob($value);
         if ($options['db'])
            $this->_data['arq_clob']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna chave_acesso
     *
     * @return string
     */
    public function getChaveAcesso($instance=false){
        if ($instance && !is_object($this->_data['chave_acesso'])){
            $this->setChaveAcesso('',array('required'=>false));
        }
        return $this->_data['chave_acesso'];
    }
    /**
     * Seta o valor da coluna chave_acesso
     *
     * @param string $value
     * @return Tools_Model_Arquivo_Crud_Mapper
     */
    public function setChaveAcesso($value,$options=array('required'=>true)){        
        $this->_data['chave_acesso'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['chave_acesso']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 44, ) );
            $valueValid = $this->_data['chave_acesso']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna arq_blob
     *
     * @return string
     */
    public function getArqBlob($instance=false){
        if ($instance && !is_object($this->_data['arq_blob'])){
            $this->setArqBlob('',array('required'=>false));
        }
        return $this->_data['arq_blob'];
    }
    /**
     * Seta o valor da coluna arq_blob
     *
     * @param string $value
     * @return Tools_Model_Arquivo_Crud_Mapper
     */
    public function setArqBlob($value,$options=array('required'=>true)){        
        $this->_data['arq_blob'] = new ZendT_Type_Blob($value);
         if ($options['db'])
            $this->_data['arq_blob']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }
            
}
?>