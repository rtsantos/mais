<?php
/**
 * Classe de mapeamento do registro da tabela cv_item_pedido
 */
class Vendas_Model_ItemPedido_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_pedido','id_produto','id_usu_inc','id_usu_alt');
    protected $_model = 'Vendas_Model_ItemPedido_Table';
    public static $table = 'mais.cv_item_pedido';
    /**
     *
     * @var Vendas_Model_ItemPedido_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Vendas_Model_ItemPedido_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Vendas_Model_ItemPedido_Mapper){
            $this->_dataOld = new Vendas_Model_ItemPedido_Mapper();
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
                'id_produto' => array(
                    'mapper' => 'Vendas_DataView_Produto_MapperView',
                    'column' => 'id'
                ),
                'id_usu_inc' => array(
                    'mapper' => 'Auth_DataView_Conta_MapperView',
                    'column' => 'id'
                ),
                'id_usu_alt' => array(
                    'mapper' => 'Auth_DataView_Conta_MapperView',
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
     * @return Vendas_Model_ItemPedido_Crud_Mapper
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
     * @return Vendas_Model_ItemPedido_Crud_Mapper
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
     * Retorna os dados da coluna id_produto
     *
     * @return string
     */
    public function getIdProduto($instance=false){
        if ($instance && !is_object($this->_data['id_produto'])){
            $this->setIdProduto('',array('required'=>false));
        }
        return $this->_data['id_produto'];
    }
    /**
     * Seta o valor da coluna id_produto
     *
     * @param string $value
     * @return Vendas_Model_ItemPedido_Crud_Mapper
     */
    public function setIdProduto($value,$options=array('required'=>true)){        
        $this->_data['id_produto'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_produto']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_produto');
                    
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
     * @return Vendas_Model_ItemPedido_Crud_Mapper
     */
    public function setIdUsuInc($value,$options=array('required'=>true)){        
        $this->_data['id_usu_inc'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_usu_inc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_usu_inc');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_usu_alt
     *
     * @return string
     */
    public function getIdUsuAlt($instance=false){
        if ($instance && !is_object($this->_data['id_usu_alt'])){
            $this->setIdUsuAlt('',array('required'=>false));
        }
        return $this->_data['id_usu_alt'];
    }
    /**
     * Seta o valor da coluna id_usu_alt
     *
     * @param string $value
     * @return Vendas_Model_ItemPedido_Crud_Mapper
     */
    public function setIdUsuAlt($value,$options=array('required'=>true)){        
        $this->_data['id_usu_alt'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_usu_alt']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_usu_alt');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna qtd_item
     *
     * @return string
     */
    public function getQtdItem($instance=false){
        if ($instance && !is_object($this->_data['qtd_item'])){
            $this->setQtdItem('',array('required'=>false));
        }
        return $this->_data['qtd_item'];
    }
    /**
     * Seta o valor da coluna qtd_item
     *
     * @param string $value
     * @return Vendas_Model_ItemPedido_Crud_Mapper
     */
    public function setQtdItem($value,$options=array('required'=>true)){        
        $this->_data['qtd_item'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['qtd_item']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_item
     *
     * @return string
     */
    public function getVlrItem($instance=false){
        if ($instance && !is_object($this->_data['vlr_item'])){
            $this->setVlrItem('',array('required'=>false));
        }
        return $this->_data['vlr_item'];
    }
    /**
     * Seta o valor da coluna vlr_item
     *
     * @param string $value
     * @return Vendas_Model_ItemPedido_Crud_Mapper
     */
    public function setVlrItem($value,$options=array('required'=>true)){        
        $this->_data['vlr_item'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['vlr_item']->setValueFromDb($value);
                    
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
     * @return Vendas_Model_ItemPedido_Crud_Mapper
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
     * Retorna os dados da coluna calculo
     *
     * @return string
     */
    public function getCalculo($instance=false){
        if ($instance && !is_object($this->_data['calculo'])){
            $this->setCalculo('',array('required'=>false));
        }
        return $this->_data['calculo'];
    }
    /**
     * Seta o valor da coluna calculo
     *
     * @param string $value
     * @return Vendas_Model_ItemPedido_Crud_Mapper
     */
    public function setCalculo($value,$options=array('required'=>true)){        
        $this->_data['calculo'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['calculo']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['calculo']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
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
     * @return Vendas_Model_ItemPedido_Crud_Mapper
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
     * Retorna os dados da coluna vlr_final
     *
     * @return string
     */
    public function getVlrFinal($instance=false){
        if ($instance && !is_object($this->_data['vlr_final'])){
            $this->setVlrFinal('',array('required'=>false));
        }
        return $this->_data['vlr_final'];
    }
    /**
     * Seta o valor da coluna vlr_final
     *
     * @param string $value
     * @return Vendas_Model_ItemPedido_Crud_Mapper
     */
    public function setVlrFinal($value,$options=array('required'=>true)){        
        $this->_data['vlr_final'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['vlr_final']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>