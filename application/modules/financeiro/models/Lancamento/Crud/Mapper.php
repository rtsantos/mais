<?php
/**
 * Classe de mapeamento do registro da tabela fc_lancamento
 */
class Financeiro_Model_Lancamento_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_empresa','tipo','descricao','id_usu_inc','dh_inc','dt_lanc','vlr_saldo','ultimo','status','id_favorecido');
    protected $_model = 'Financeiro_Model_Lancamento_Table';
    public static $table = 'mais.fc_lancamento';
    /**
     *
     * @var Financeiro_Model_Lancamento_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Financeiro_Model_Lancamento_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Financeiro_Model_Lancamento_Mapper){
            $this->_dataOld = new Financeiro_Model_Lancamento_Mapper();
            $this->_dataOld->setId($this->getId());
            $this->_dataOld->retrive();
        }
        return $this->_dataOld;
    }
    /**
     * Retorna as referências do objeto
     */
    public function getReferenceMap(){
        return array();
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
     * @return Financeiro_Model_Lancamento_Crud_Mapper
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
     * @return Financeiro_Model_Lancamento_Crud_Mapper
     */
    public function setIdEmpresa($value,$options=array('required'=>true)){        
        $this->_data['id_empresa'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['id_empresa']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_empresa');
                    
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
     * @return Financeiro_Model_Lancamento_Crud_Mapper
     */
    public function setTipo($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('D'=>'Débito','C'=>'Crédito');
        $this->_data['tipo'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['tipo']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'tipo');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['tipo']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
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
     * @return Financeiro_Model_Lancamento_Crud_Mapper
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
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['descricao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_usu_inc
     *
     * @return string
     */
    public function getIdUsuInc($instance=false){
        if ($instance && !is_object($this->_data['id_usu_inc'])){
            $this->setIdUsuInc('',array('required'=>false));
        }
        return $this->_data['id_usu_inc'];
    }
    /**
     * Seta o valor da coluna id_usu_inc
     *
     * @param string $value
     * @return Financeiro_Model_Lancamento_Crud_Mapper
     */
    public function setIdUsuInc($value,$options=array('required'=>true)){        
        $this->_data['id_usu_inc'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['id_usu_inc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_usu_inc');
                    
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
     * @return Financeiro_Model_Lancamento_Crud_Mapper
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
     * Retorna os dados da coluna dt_lanc
     *
     * @return string
     */
    public function getDtLanc($instance=false){
        if ($instance && !is_object($this->_data['dt_lanc'])){
            $this->setDtLanc('',array('required'=>false));
        }
        return $this->_data['dt_lanc'];
    }
    /**
     * Seta o valor da coluna dt_lanc
     *
     * @param string $value
     * @return Financeiro_Model_Lancamento_Crud_Mapper
     */
    public function setDtLanc($value,$options=array('required'=>true)){        
        $this->_data['dt_lanc'] = new ZendT_Type_Date($value,'Date');
         if ($options['db'])
            $this->_data['dt_lanc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dt_lanc');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_lanc
     *
     * @return string
     */
    public function getVlrLanc($instance=false){
        if ($instance && !is_object($this->_data['vlr_lanc'])){
            $this->setVlrLanc('',array('required'=>false));
        }
        return $this->_data['vlr_lanc'];
    }
    /**
     * Seta o valor da coluna vlr_lanc
     *
     * @param string $value
     * @return Financeiro_Model_Lancamento_Crud_Mapper
     */
    public function setVlrLanc($value,$options=array('required'=>true)){        
        $this->_data['vlr_lanc'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['vlr_lanc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_saldo
     *
     * @return string
     */
    public function getVlrSaldo($instance=false){
        if ($instance && !is_object($this->_data['vlr_saldo'])){
            $this->setVlrSaldo('',array('required'=>false));
        }
        return $this->_data['vlr_saldo'];
    }
    /**
     * Seta o valor da coluna vlr_saldo
     *
     * @param string $value
     * @return Financeiro_Model_Lancamento_Crud_Mapper
     */
    public function setVlrSaldo($value,$options=array('required'=>true)){        
        $this->_data['vlr_saldo'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['vlr_saldo']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'vlr_saldo');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ultimo
     *
     * @return string
     */
    public function getUltimo($instance=false){
        if ($instance && !is_object($this->_data['ultimo'])){
            $this->setUltimo('',array('required'=>false));
        }
        return $this->_data['ultimo'];
    }
    /**
     * Seta o valor da coluna ultimo
     *
     * @param string $value
     * @return Financeiro_Model_Lancamento_Crud_Mapper
     */
    public function setUltimo($value,$options=array('required'=>true)){        
        $this->_data['ultimo'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['ultimo']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'ultimo');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['ultimo']->getValueToDb();
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
     * @return Financeiro_Model_Lancamento_Crud_Mapper
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
     * Retorna os dados da coluna id_favorecido
     *
     * @return string
     */
    public function getIdFavorecido($instance=false){
        if ($instance && !is_object($this->_data['id_favorecido'])){
            $this->setIdFavorecido('',array('required'=>false));
        }
        return $this->_data['id_favorecido'];
    }
    /**
     * Seta o valor da coluna id_favorecido
     *
     * @param string $value
     * @return Financeiro_Model_Lancamento_Crud_Mapper
     */
    public function setIdFavorecido($value,$options=array('required'=>true)){        
        $this->_data['id_favorecido'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['id_favorecido']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_favorecido');
                    
        }
        return $this;
    }

            
}
?>