<?php
/**
 * Classe de mapeamento do registro da tabela ca_contrato
 */
class Ca_Model_Contrato_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','descricao','dt_vig_ini','id_cliente','status');
    protected $_model = 'Ca_Model_Contrato_Table';
    public static $table = 'mais.ca_contrato';
    /**
     *
     * @var Ca_Model_Contrato_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Ca_Model_Contrato_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Ca_Model_Contrato_Mapper){
            $this->_dataOld = new Ca_Model_Contrato_Mapper();
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
     * @return Ca_Model_Contrato_Crud_Mapper
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
     * @return Ca_Model_Contrato_Crud_Mapper
     */
    public function setDescricao($value,$options=array('required'=>true)){        
        $this->_data['descricao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['descricao']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'descricao');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 45, ) );
            $valueValid = $this->_data['descricao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dt_vig_ini
     *
     * @return string
     */
    public function getDtVigIni($instance=false){
        if ($instance && !is_object($this->_data['dt_vig_ini'])){
            $this->setDtVigIni('',array('required'=>false));
        }
        return $this->_data['dt_vig_ini'];
    }
    /**
     * Seta o valor da coluna dt_vig_ini
     *
     * @param string $value
     * @return Ca_Model_Contrato_Crud_Mapper
     */
    public function setDtVigIni($value,$options=array('required'=>true)){        
        $this->_data['dt_vig_ini'] = new ZendT_Type_Date($value,'Date');
         if ($options['db'])
            $this->_data['dt_vig_ini']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dt_vig_ini');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dt_vig_fim
     *
     * @return string
     */
    public function getDtVigFim($instance=false){
        if ($instance && !is_object($this->_data['dt_vig_fim'])){
            $this->setDtVigFim('',array('required'=>false));
        }
        return $this->_data['dt_vig_fim'];
    }
    /**
     * Seta o valor da coluna dt_vig_fim
     *
     * @param string $value
     * @return Ca_Model_Contrato_Crud_Mapper
     */
    public function setDtVigFim($value,$options=array('required'=>true)){        
        $this->_data['dt_vig_fim'] = new ZendT_Type_Date($value,'Date');
         if ($options['db'])
            $this->_data['dt_vig_fim']->setValueFromDb($value);
                    
        if (!$options['db']){
            
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
     * @return Ca_Model_Contrato_Crud_Mapper
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
     * @return Ca_Model_Contrato_Crud_Mapper
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
     * @return Ca_Model_Contrato_Crud_Mapper
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