<?php
/**
 * Classe de mapeamento do registro da tabela wf_transacao
 */
class Wf_Model_WfTransacao_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id_wf_fase','id_objeto','id_usuario_aloc','dh_inc');
    protected $_model = 'Wf_Model_WfTransacao_Table';

    
    /**
     * Retorna os dados da coluna id_wf_fase
     *
     * @return string
     */
    public function getIdWfFase($instance=false){
        if ($instance && !is_object($this->_data['id_wf_fase'])){
            $this->setIdWfFase('',array('required'=>false));
        }
        return $this->_data['id_wf_fase'];
    }
    /**
     * Seta o valor da coluna id_wf_fase
     *
     * @param string $value
     * @return Wf_Model_WfTransacao_Crud_Mapper
     */
    public function setIdWfFase($value,$options=array('required'=>true)){        
        $this->_data['id_wf_fase'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
        if ($options['db'])
            $this->_data['id_wf_fase']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_wf_fase');
                    
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
     * @return Wf_Model_WfTransacao_Crud_Mapper
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
     * Retorna os dados da coluna id_usuario_aloc
     *
     * @return string
     */
    public function getIdUsuarioAloc($instance=false){
        if ($instance && !is_object($this->_data['id_usuario_aloc'])){
            $this->setIdUsuarioAloc('',array('required'=>false));
        }
        return $this->_data['id_usuario_aloc'];
    }
    /**
     * Seta o valor da coluna id_usuario_aloc
     *
     * @param string $value
     * @return Wf_Model_WfTransacao_Crud_Mapper
     */
    public function setIdUsuarioAloc($value,$options=array('required'=>true)){        
        $this->_data['id_usuario_aloc'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
        if ($options['db'])
            $this->_data['id_usuario_aloc']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_usuario_aloc');
                    
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
     * @return Wf_Model_WfTransacao_Crud_Mapper
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
     * @return Wf_Model_WfTransacao_Crud_Mapper
     */
    public function setObservacao($value,$options=array('required'=>true)){        
        $this->_data['observacao'] = new ZendT_Type_Default($value);
        if ($options['db'])
            $this->_data['observacao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 300, ) );
            $valueValid = $this->_data['observacao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna o dado da coluna ID
     *
     * @return string
     */
    public function getId($instance=false){
        $string = $this->_data['id_wf_fase'].'-'.$this->_data['id_objeto'];
        $result = new ZendT_Type_Default($string);
        return $result;
    }
    /**
     * Configura o dado na coluna ID
     *
     * @param string $value
     * @return Wf_Model_WfTransacao_Crud_Mapper
     */
    public function setId($value,$options=array('required'=>true)){
        #if (!$options['db']){
            
            $values = explode('-',$value);

            $this->_data['id_wf_fase'] = $values[0];
            $this->_data['id_objeto'] = $values[1];
        #}
        return $this;
    }
            
}
?>