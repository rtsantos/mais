<?php
/**
 * Classe de mapeamento do registro da tabela cv_vistoria
 */
class Vendas_Model_Vistoria_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_pedido','id_veiculo');
    protected $_model = 'Vendas_Model_Vistoria_Table';
    public static $table = 'mais.cv_vistoria';
    /**
     *
     * @var Vendas_Model_Vistoria_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Vendas_Model_Vistoria_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Vendas_Model_Vistoria_Mapper){
            $this->_dataOld = new Vendas_Model_Vistoria_Mapper();
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
                'id_pedido' => array(
                    'mapper' => 'Vendas_DataView_Pedido_MapperView',
                    'column' => 'id'
                ),
                'id_veiculo' => array(
                    'mapper' => 'Frota_DataView_Veiculo_MapperView',
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
     * @return Vendas_Model_Vistoria_Crud_Mapper
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
     * Retorna os dados da coluna id_pedido
     *
     * @return string
     */
    public function getIdPedido($instance=false){
        if ($instance && !is_object($this->_data['id_pedido'])){
            $this->setIdPedido('',array('required'=>false));
        }
        return $this->_data['id_pedido'];
    }
    /**
     * Seta o valor da coluna id_pedido
     *
     * @param string $value
     * @return Vendas_Model_Vistoria_Crud_Mapper
     */
    public function setIdPedido($value,$options=array('required'=>true)){        
        $this->_data['id_pedido'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_pedido']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_pedido');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_veiculo
     *
     * @return string
     */
    public function getIdVeiculo($instance=false){
        if ($instance && !is_object($this->_data['id_veiculo'])){
            $this->setIdVeiculo('',array('required'=>false));
        }
        return $this->_data['id_veiculo'];
    }
    /**
     * Seta o valor da coluna id_veiculo
     *
     * @param string $value
     * @return Vendas_Model_Vistoria_Crud_Mapper
     */
    public function setIdVeiculo($value,$options=array('required'=>true)){        
        $this->_data['id_veiculo'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_veiculo']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_veiculo');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna sinistro
     *
     * @return string
     */
    public function getSinistro($instance=false){
        if ($instance && !is_object($this->_data['sinistro'])){
            $this->setSinistro('',array('required'=>false));
        }
        return $this->_data['sinistro'];
    }
    /**
     * Seta o valor da coluna sinistro
     *
     * @param string $value
     * @return Vendas_Model_Vistoria_Crud_Mapper
     */
    public function setSinistro($value,$options=array('required'=>true)){        
        $this->_data['sinistro'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['sinistro']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['sinistro']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna numero
     *
     * @return string
     */
    public function getNumero($instance=false){
        if ($instance && !is_object($this->_data['numero'])){
            $this->setNumero('',array('required'=>false));
        }
        return $this->_data['numero'];
    }
    /**
     * Seta o valor da coluna numero
     *
     * @param string $value
     * @return Vendas_Model_Vistoria_Crud_Mapper
     */
    public function setNumero($value,$options=array('required'=>true)){        
        $this->_data['numero'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['numero']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['numero']->getValueToDb();
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
     * @return Vendas_Model_Vistoria_Crud_Mapper
     */
    public function setStatus($value,$options=array('required'=>true)){        
        $this->_data['status'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'removeAccent', 'strtoupper', )));
        if ($options['db'])
            $this->_data['status']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['status']->getValueToDb();
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
     * @return Vendas_Model_Vistoria_Crud_Mapper
     */
    public function setObservacao($value,$options=array('required'=>true)){        
        $this->_data['observacao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'removeAccent', 'strtoupper', )));
        if ($options['db'])
            $this->_data['observacao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 2000, ) );
            $valueValid = $this->_data['observacao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dt_emis
     *
     * @return string
     */
    public function getDtEmis($instance=false){
        if ($instance && !is_object($this->_data['dt_emis'])){
            $this->setDtEmis('',array('required'=>false));
        }
        return $this->_data['dt_emis'];
    }
    /**
     * Seta o valor da coluna dt_emis
     *
     * @param string $value
     * @return Vendas_Model_Vistoria_Crud_Mapper
     */
    public function setDtEmis($value,$options=array('required'=>true)){        
        $this->_data['dt_emis'] = new ZendT_Type_Date($value,'Date');
         if ($options['db'])
            $this->_data['dt_emis']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna local
     *
     * @return string
     */
    public function getLocal($instance=false){
        if ($instance && !is_object($this->_data['local'])){
            $this->setLocal('',array('required'=>false));
        }
        return $this->_data['local'];
    }
    /**
     * Seta o valor da coluna local
     *
     * @param string $value
     * @return Vendas_Model_Vistoria_Crud_Mapper
     */
    public function setLocal($value,$options=array('required'=>true)){        
        $this->_data['local'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['local']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 250, ) );
            $valueValid = $this->_data['local']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna laudo
     *
     * @return string
     */
    public function getLaudo($instance=false){
        if ($instance && !is_object($this->_data['laudo'])){
            $this->setLaudo('',array('required'=>false));
        }
        return $this->_data['laudo'];
    }
    /**
     * Seta o valor da coluna laudo
     *
     * @param string $value
     * @return Vendas_Model_Vistoria_Crud_Mapper
     */
    public function setLaudo($value,$options=array('required'=>true)){        
        $this->_data['laudo'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['laudo']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>