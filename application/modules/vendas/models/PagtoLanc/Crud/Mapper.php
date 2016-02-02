<?php
/**
 * Classe de mapeamento do registro da tabela cv_pagto_lanc
 */
class Vendas_Model_PagtoLanc_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id');
    protected $_model = 'Vendas_Model_PagtoLanc_Table';
    public static $table = 'mais.cv_pagto_lanc';
    /**
     *
     * @var Vendas_Model_PagtoLanc_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Vendas_Model_PagtoLanc_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Vendas_Model_PagtoLanc_Mapper){
            $this->_dataOld = new Vendas_Model_PagtoLanc_Mapper();
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
                'id_pagto_pedido' => array(
                    'mapper' => 'Vendas_DataView_Pagamento_MapperView',
                    'column' => 'id'
                ),
                'id_lancamento' => array(
                    'mapper' => 'Financeiro_DataView_Lancamento_MapperView',
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
     * @return Vendas_Model_PagtoLanc_Crud_Mapper
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
     * Retorna os dados da coluna id_pagto_pedido
     *
     * @return string
     */
    public function getIdPagtoPedido($instance=false){
        if ($instance && !is_object($this->_data['id_pagto_pedido'])){
            $this->setIdPagtoPedido('',array('required'=>false));
        }
        return $this->_data['id_pagto_pedido'];
    }
    /**
     * Seta o valor da coluna id_pagto_pedido
     *
     * @param string $value
     * @return Vendas_Model_PagtoLanc_Crud_Mapper
     */
    public function setIdPagtoPedido($value,$options=array('required'=>true)){        
        $this->_data['id_pagto_pedido'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_pagto_pedido']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_lancamento
     *
     * @return string
     */
    public function getIdLancamento($instance=false){
        if ($instance && !is_object($this->_data['id_lancamento'])){
            $this->setIdLancamento('',array('required'=>false));
        }
        return $this->_data['id_lancamento'];
    }
    /**
     * Seta o valor da coluna id_lancamento
     *
     * @param string $value
     * @return Vendas_Model_PagtoLanc_Crud_Mapper
     */
    public function setIdLancamento($value,$options=array('required'=>true)){        
        $this->_data['id_lancamento'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_lancamento']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>