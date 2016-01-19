<?php
/**
 * Classe de mapeamento do registro da tabela log_evento
 */
class Log_Model_LogEvento_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id_log_objeto','id_log_operac','id_objeto','dh_evento','chave');
    protected $_model = 'Log_Model_LogEvento_Table';
    /**
     *
     * @var Log_Model_LogEvento_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Log_Model_LogEvento_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Log_Model_LogEvento_Mapper){
            $this->_dataOld = new Log_Model_LogEvento_Mapper();
            $this->_dataOld->setId($this->getId());
            $this->_dataOld->retrive();
        }
        return $this->_dataOld;
    }
    
    
    /**
     * Retorna os dados da coluna id_log_objeto
     *
     * @return string
     */
    public function getIdLogObjeto($instance=false){
        if ($instance && !is_object($this->_data['id_log_objeto'])){
            $this->setIdLogObjeto('',array('required'=>false));
        }
        return $this->_data['id_log_objeto'];
    }
    /**
     * Seta o valor da coluna id_log_objeto
     *
     * @param string $value
     * @return Log_Model_LogEvento_Crud_Mapper
     */
    public function setIdLogObjeto($value,$options=array('required'=>true)){        
        $this->_data['id_log_objeto'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
         if ($options['db'])
            $this->_data['id_log_objeto']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_log_objeto');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna id_log_operac
     *
     * @return string
     */
    public function getIdLogOperac($instance=false){
        if ($instance && !is_object($this->_data['id_log_operac'])){
            $this->setIdLogOperac('',array('required'=>false));
        }
        return $this->_data['id_log_operac'];
    }
    /**
     * Seta o valor da coluna id_log_operac
     *
     * @param string $value
     * @return Log_Model_LogEvento_Crud_Mapper
     */
    public function setIdLogOperac($value,$options=array('required'=>true)){        
        $this->_data['id_log_operac'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
         if ($options['db'])
            $this->_data['id_log_operac']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_log_operac');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna id_objeto
     *
     * @return string
     */
    public function getIdObjeto($instance=false){
        if ($instance && !is_object($this->_data['id_objeto'])){
            $this->setIdObjeto('',array('required'=>false));
        }
        return $this->_data['id_objeto'];
    }
    /**
     * Seta o valor da coluna id_objeto
     *
     * @param string $value
     * @return Log_Model_LogEvento_Crud_Mapper
     */
    public function setIdObjeto($value,$options=array('required'=>true)){        
        $this->_data['id_objeto'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
         if ($options['db'])
            $this->_data['id_objeto']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_objeto');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna id_usuario
     *
     * @return string
     */
    public function getIdUsuario($instance=false){
        if ($instance && !is_object($this->_data['id_usuario'])){
            $this->setIdUsuario('',array('required'=>false));
        }
        return $this->_data['id_usuario'];
    }
    /**
     * Seta o valor da coluna id_usuario
     *
     * @param string $value
     * @return Log_Model_LogEvento_Crud_Mapper
     */
    public function setIdUsuario($value,$options=array('required'=>true)){        
        $this->_data['id_usuario'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
         if ($options['db'])
            $this->_data['id_usuario']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna dh_evento
     *
     * @return string
     */
    public function getDhEvento($instance=false){
        if ($instance && !is_object($this->_data['dh_evento'])){
            $this->setDhEvento('',array('required'=>false));
        }
        return $this->_data['dh_evento'];
    }
    /**
     * Seta o valor da coluna dh_evento
     *
     * @param string $value
     * @return Log_Model_LogEvento_Crud_Mapper
     */
    public function setDhEvento($value,$options=array('required'=>true)){        
        $this->_data['dh_evento'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_evento']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dh_evento');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna chave
     *
     * @return string
     */
    public function getChave($instance=false){
        if ($instance && !is_object($this->_data['chave'])){
            $this->setChave('',array('required'=>false));
        }
        return $this->_data['chave'];
    }
    /**
     * Seta o valor da coluna chave
     *
     * @param string $value
     * @return Log_Model_LogEvento_Crud_Mapper
     */
    public function setChave($value,$options=array('required'=>true)){        
        $this->_data['chave'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['chave']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'chave');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 30, ) );
            $valueValid = $this->_data['chave']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna observacao
     *
     * @return string
     */
    public function getObservacao($instance=false){
        if ($instance && !is_object($this->_data['observacao'])){
            $this->setObservacao('',array('required'=>false));
        }
        return $this->_data['observacao'];
    }
    /**
     * Seta o valor da coluna observacao
     *
     * @param string $value
     * @return Log_Model_LogEvento_Crud_Mapper
     */
    public function setObservacao($value,$options=array('required'=>true)){        
        $this->_data['observacao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['observacao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 250, ) );
            $valueValid = $this->_data['observacao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna id_log_tabela
     *
     * @return string
     */
    public function getIdLogTabela($instance=false){
        if ($instance && !is_object($this->_data['id_log_tabela'])){
            $this->setIdLogTabela('',array('required'=>false));
        }
        return $this->_data['id_log_tabela'];
    }
    /**
     * Seta o valor da coluna id_log_tabela
     *
     * @param string $value
     * @return Log_Model_LogEvento_Crud_Mapper
     */
    public function setIdLogTabela($value,$options=array('required'=>true)){        
        $this->_data['id_log_tabela'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
         if ($options['db'])
            $this->_data['id_log_tabela']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna o dado da coluna ID
     *
     * @return string
     */
    public function getId($instance=false,$retDataId=true){
        if ($retDataId && $this->_id){
            $string = $this->_id;
        }else{            
            $string = $this->_data['id_objeto'].'-'.$this->_data['id_log_tabela'];
            $this->_id = $string;
        }
        $result = new ZendT_Type_Default($string);
        return $result;
    }
    /**
     * Configura o dado na coluna ID
     *
     * @param string $value
     * @return Log_Model_LogEvento_Crud_Mapper
     */
    public function setId($value,$options=array('required'=>true)){
        #if (!$options['db']){
            
            $this->_id = $value;
            $values = explode('-',$value);

            $this->_data['id_objeto'] = $values[0];
            $this->_data['id_log_tabela'] = $values[1];
        #}
        return $this;
    }
    /**
     * Altera o registro da tabela
     *
     * @param ZendT_Db_Where
     * @return int|array
     */
    public function update($where=null){
        if ($where == null){
            $where = $this->getValueOld()->getWhere();
        }
        return parent::update($where);
    }
            
}
?>