<?php
/**
 * Classe de mapeamento do registro da tabela ca_cliente_contrato
 */
class Ca_Model_ClienteContrato_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_cliente','id_contrato','dt_ini_vig','status');
    protected $_model = 'Ca_Model_ClienteContrato_Table';
    public static $table = 'mais.ca_cliente_contrato';
    /**
     *
     * @var Ca_Model_ClienteContrato_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Ca_Model_ClienteContrato_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Ca_Model_ClienteContrato_Mapper){
            $this->_dataOld = new Ca_Model_ClienteContrato_Mapper();
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
                'id_cliente' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
                    'column' => 'id'
                ),
                'id_contrato' => array(
                    'mapper' => 'Ca_DataView_Contrato_MapperView',
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
     * @return Ca_Model_ClienteContrato_Crud_Mapper
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
     * Retorna os dados da coluna id_cliente
     *
     * @return string
     */
    public function getIdCliente($instance=false){
        if ($instance && !is_object($this->_data['id_cliente'])){
            $this->setIdCliente('',array('required'=>false));
        }
        return $this->_data['id_cliente'];
    }
    /**
     * Seta o valor da coluna id_cliente
     *
     * @param string $value
     * @return Ca_Model_ClienteContrato_Crud_Mapper
     */
    public function setIdCliente($value,$options=array('required'=>true)){        
        $this->_data['id_cliente'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_cliente']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_cliente');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_contrato
     *
     * @return string
     */
    public function getIdContrato($instance=false){
        if ($instance && !is_object($this->_data['id_contrato'])){
            $this->setIdContrato('',array('required'=>false));
        }
        return $this->_data['id_contrato'];
    }
    /**
     * Seta o valor da coluna id_contrato
     *
     * @param string $value
     * @return Ca_Model_ClienteContrato_Crud_Mapper
     */
    public function setIdContrato($value,$options=array('required'=>true)){        
        $this->_data['id_contrato'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_contrato']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_contrato');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dt_ini_vig
     *
     * @return string
     */
    public function getDtIniVig($instance=false){
        if ($instance && !is_object($this->_data['dt_ini_vig'])){
            $this->setDtIniVig('',array('required'=>false));
        }
        return $this->_data['dt_ini_vig'];
    }
    /**
     * Seta o valor da coluna dt_ini_vig
     *
     * @param string $value
     * @return Ca_Model_ClienteContrato_Crud_Mapper
     */
    public function setDtIniVig($value,$options=array('required'=>true)){        
        $this->_data['dt_ini_vig'] = new ZendT_Type_Date($value,'Date');
         if ($options['db'])
            $this->_data['dt_ini_vig']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dt_ini_vig');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dt_fim_vig
     *
     * @return string
     */
    public function getDtFimVig($instance=false){
        if ($instance && !is_object($this->_data['dt_fim_vig'])){
            $this->setDtFimVig('',array('required'=>false));
        }
        return $this->_data['dt_fim_vig'];
    }
    /**
     * Seta o valor da coluna dt_fim_vig
     *
     * @param string $value
     * @return Ca_Model_ClienteContrato_Crud_Mapper
     */
    public function setDtFimVig($value,$options=array('required'=>true)){        
        $this->_data['dt_fim_vig'] = new ZendT_Type_Date($value,'Date');
         if ($options['db'])
            $this->_data['dt_fim_vig']->setValueFromDb($value);
                    
        if (!$options['db']){
            
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
     * @return Ca_Model_ClienteContrato_Crud_Mapper
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