<?php
/**
 * Classe de mapeamento do registro da tabela cv_pagto_pedido
 */
class Vendas_Model_Pagamento_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_pedido','vlr_total');
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
                ),
                'id_forma_pagto' => array(
                    'mapper' => 'Vendas_DataView_FormaPagamento_MapperView',
                    'column' => 'id'
                ),
                'id_parcela' => array(
                    'mapper' => 'Vendas_DataView_Parcela_MapperView',
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
     * Retorna os dados da coluna per_acre
     *
     * @return string
     */
    public function getPerAcre($instance=false){
        if ($instance && !is_object($this->_data['per_acre'])){
            $this->setPerAcre('',array('required'=>false));
        }
        return $this->_data['per_acre'];
    }
    /**
     * Seta o valor da coluna per_acre
     *
     * @param string $value
     * @return Vendas_Model_Pagamento_Crud_Mapper
     */
    public function setPerAcre($value,$options=array('required'=>true)){        
        $this->_data['per_acre'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['per_acre']->setValueFromDb($value);
                    
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

            
    /**
     * Retorna os dados da coluna vlr_a_pagar
     *
     * @return string
     */
    public function getVlrAPagar($instance=false){
        if ($instance && !is_object($this->_data['vlr_a_pagar'])){
            $this->setVlrAPagar('',array('required'=>false));
        }
        return $this->_data['vlr_a_pagar'];
    }
    /**
     * Seta o valor da coluna vlr_a_pagar
     *
     * @param string $value
     * @return Vendas_Model_Pagamento_Crud_Mapper
     */
    public function setVlrAPagar($value,$options=array('required'=>true)){        
        $this->_data['vlr_a_pagar'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['vlr_a_pagar']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna per_desc
     *
     * @return string
     */
    public function getPerDesc($instance=false){
        if ($instance && !is_object($this->_data['per_desc'])){
            $this->setPerDesc('',array('required'=>false));
        }
        return $this->_data['per_desc'];
    }
    /**
     * Seta o valor da coluna per_desc
     *
     * @param string $value
     * @return Vendas_Model_Pagamento_Crud_Mapper
     */
    public function setPerDesc($value,$options=array('required'=>true)){        
        $this->_data['per_desc'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['per_desc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna nro_comprov
     *
     * @return string
     */
    public function getNroComprov($instance=false){
        if ($instance && !is_object($this->_data['nro_comprov'])){
            $this->setNroComprov('',array('required'=>false));
        }
        return $this->_data['nro_comprov'];
    }
    /**
     * Seta o valor da coluna nro_comprov
     *
     * @param string $value
     * @return Vendas_Model_Pagamento_Crud_Mapper
     */
    public function setNroComprov($value,$options=array('required'=>true)){        
        $this->_data['nro_comprov'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['nro_comprov']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 20, ) );
            $valueValid = $this->_data['nro_comprov']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_forma_pagto
     *
     * @return string
     */
    public function getIdFormaPagto($instance=false){
        if ($instance && !is_object($this->_data['id_forma_pagto'])){
            $this->setIdFormaPagto('',array('required'=>false));
        }
        return $this->_data['id_forma_pagto'];
    }
    /**
     * Seta o valor da coluna id_forma_pagto
     *
     * @param string $value
     * @return Vendas_Model_Pagamento_Crud_Mapper
     */
    public function setIdFormaPagto($value,$options=array('required'=>true)){        
        $this->_data['id_forma_pagto'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_forma_pagto']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_parcela
     *
     * @return string
     */
    public function getIdParcela($instance=false){
        if ($instance && !is_object($this->_data['id_parcela'])){
            $this->setIdParcela('',array('required'=>false));
        }
        return $this->_data['id_parcela'];
    }
    /**
     * Seta o valor da coluna id_parcela
     *
     * @param string $value
     * @return Vendas_Model_Pagamento_Crud_Mapper
     */
    public function setIdParcela($value,$options=array('required'=>true)){        
        $this->_data['id_parcela'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_parcela']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dt_venc_parc
     *
     * @return string
     */
    public function getDtVencParc($instance=false){
        if ($instance && !is_object($this->_data['dt_venc_parc'])){
            $this->setDtVencParc('',array('required'=>false));
        }
        return $this->_data['dt_venc_parc'];
    }
    /**
     * Seta o valor da coluna dt_venc_parc
     *
     * @param string $value
     * @return Vendas_Model_Pagamento_Crud_Mapper
     */
    public function setDtVencParc($value,$options=array('required'=>true)){        
        $this->_data['dt_venc_parc'] = new ZendT_Type_Date($value,'Date');
         if ($options['db'])
            $this->_data['dt_venc_parc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>