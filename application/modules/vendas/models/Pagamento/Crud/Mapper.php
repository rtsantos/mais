<?php
/**
 * Classe de mapeamento do registro da tabela cv_pagto_pedido
 */
class Vendas_Model_Pagamento_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_pedido','forma','vlr_total');
    protected $_model = 'Vendas_Model_Pagamento_Table';
    public static $table = 'mais.cv_pagto_pedido';
    /**
     *
     * @var Vendas_Model_Pagamento_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Vendas_Model_Pagamento_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Vendas_Model_Pagamento_Mapper){
            $this->_dataOld = new Vendas_Model_Pagamento_Mapper();
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
     * @return Vendas_Model_Pagamento_Crud_Mapper
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
     * @return Vendas_Model_Pagamento_Crud_Mapper
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
     * Retorna os dados da coluna forma
     *
     * @return string
     */
    public function getForma($instance=false){
        if ($instance && !is_object($this->_data['forma'])){
            $this->setForma('',array('required'=>false));
        }
        return $this->_data['forma'];
    }
    /**
     * Seta o valor da coluna forma
     *
     * @param string $value
     * @return Vendas_Model_Pagamento_Crud_Mapper
     */
    public function setForma($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('D'=>'Crediário','C'=>'Cartão','Q'=>'Cheque','F'=>'Faturar');
        $this->_data['forma'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['forma']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'forma');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['forma']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_total
     *
     * @return string
     */
    public function getVlrTotal($instance=false){
        if ($instance && !is_object($this->_data['vlr_total'])){
            $this->setVlrTotal('',array('required'=>false));
        }
        return $this->_data['vlr_total'];
    }
    /**
     * Seta o valor da coluna vlr_total
     *
     * @param string $value
     * @return Vendas_Model_Pagamento_Crud_Mapper
     */
    public function setVlrTotal($value,$options=array('required'=>true)){        
        $this->_data['vlr_total'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['vlr_total']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'vlr_total');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_pago
     *
     * @return string
     */
    public function getVlrPago($instance=false){
        if ($instance && !is_object($this->_data['vlr_pago'])){
            $this->setVlrPago('',array('required'=>false));
        }
        return $this->_data['vlr_pago'];
    }
    /**
     * Seta o valor da coluna vlr_pago
     *
     * @param string $value
     * @return Vendas_Model_Pagamento_Crud_Mapper
     */
    public function setVlrPago($value,$options=array('required'=>true)){        
        $this->_data['vlr_pago'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['vlr_pago']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_desc
     *
     * @return string
     */
    public function getVlrDesc($instance=false){
        if ($instance && !is_object($this->_data['vlr_desc'])){
            $this->setVlrDesc('',array('required'=>false));
        }
        return $this->_data['vlr_desc'];
    }
    /**
     * Seta o valor da coluna vlr_desc
     *
     * @param string $value
     * @return Vendas_Model_Pagamento_Crud_Mapper
     */
    public function setVlrDesc($value,$options=array('required'=>true)){        
        $this->_data['vlr_desc'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['vlr_desc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_acrec
     *
     * @return string
     */
    public function getVlrAcrec($instance=false){
        if ($instance && !is_object($this->_data['vlr_acrec'])){
            $this->setVlrAcrec('',array('required'=>false));
        }
        return $this->_data['vlr_acrec'];
    }
    /**
     * Seta o valor da coluna vlr_acrec
     *
     * @param string $value
     * @return Vendas_Model_Pagamento_Crud_Mapper
     */
    public function setVlrAcrec($value,$options=array('required'=>true)){        
        $this->_data['vlr_acrec'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['vlr_acrec']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna nro_parc
     *
     * @return string
     */
    public function getNroParc($instance=false){
        if ($instance && !is_object($this->_data['nro_parc'])){
            $this->setNroParc('',array('required'=>false));
        }
        return $this->_data['nro_parc'];
    }
    /**
     * Seta o valor da coluna nro_parc
     *
     * @param string $value
     * @return Vendas_Model_Pagamento_Crud_Mapper
     */
    public function setNroParc($value,$options=array('required'=>true)){        
        $this->_data['nro_parc'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['nro_parc']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_parc
     *
     * @return string
     */
    public function getVlrParc($instance=false){
        if ($instance && !is_object($this->_data['vlr_parc'])){
            $this->setVlrParc('',array('required'=>false));
        }
        return $this->_data['vlr_parc'];
    }
    /**
     * Seta o valor da coluna vlr_parc
     *
     * @param string $value
     * @return Vendas_Model_Pagamento_Crud_Mapper
     */
    public function setVlrParc($value,$options=array('required'=>true)){        
        $this->_data['vlr_parc'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['vlr_parc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>