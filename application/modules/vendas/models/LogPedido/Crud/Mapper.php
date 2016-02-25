<?php
/**
 * Classe de mapeamento do registro da tabela cv_log_pedido
 */
class Vendas_Model_LogPedido_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_pedido','dh_log','mensagem');
    protected $_model = 'Vendas_Model_LogPedido_Table';
    public static $table = 'mais.cv_log_pedido';
    /**
     *
     * @var Vendas_Model_LogPedido_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Vendas_Model_LogPedido_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Vendas_Model_LogPedido_Mapper){
            $this->_dataOld = new Vendas_Model_LogPedido_Mapper();
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
     * @return Vendas_Model_LogPedido_Crud_Mapper
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
     * @return Vendas_Model_LogPedido_Crud_Mapper
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
     * Retorna os dados da coluna dh_log
     *
     * @return string
     */
    public function getDhLog($instance=false){
        if ($instance && !is_object($this->_data['dh_log'])){
            $this->setDhLog('',array('required'=>false));
        }
        return $this->_data['dh_log'];
    }
    /**
     * Seta o valor da coluna dh_log
     *
     * @param string $value
     * @return Vendas_Model_LogPedido_Crud_Mapper
     */
    public function setDhLog($value,$options=array('required'=>true)){        
        $this->_data['dh_log'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_log']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dh_log');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna mensagem
     *
     * @return string
     */
    public function getMensagem($instance=false){
        if ($instance && !is_object($this->_data['mensagem'])){
            $this->setMensagem('',array('required'=>false));
        }
        return $this->_data['mensagem'];
    }
    /**
     * Seta o valor da coluna mensagem
     *
     * @param string $value
     * @return Vendas_Model_LogPedido_Crud_Mapper
     */
    public function setMensagem($value,$options=array('required'=>true)){        
        $this->_data['mensagem'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', )));
        if ($options['db'])
            $this->_data['mensagem']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'mensagem');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1000, ) );
            $valueValid = $this->_data['mensagem']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
}
?>