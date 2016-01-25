<?php
/**
 * Classe de mapeamento do registro da tabela ca_regra_contrato
 */
class Ca_Model_RegraContrato_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_contrato','id_produto','status');
    protected $_model = 'Ca_Model_RegraContrato_Table';
    public static $table = 'mais.ca_regra_contrato';
    /**
     *
     * @var Ca_Model_RegraContrato_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Ca_Model_RegraContrato_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Ca_Model_RegraContrato_Mapper){
            $this->_dataOld = new Ca_Model_RegraContrato_Mapper();
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
                'id_contrato' => array(
                    'mapper' => 'Ca_DataView_Contrato_MapperView',
                    'column' => 'id'
                ),
                'id_produto' => array(
                    'mapper' => 'Vendas_DataView_Produto_MapperView',
                    'column' => 'id'
                ),
                'id_favorecido' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
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
     * @return Ca_Model_RegraContrato_Crud_Mapper
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
     * @return Ca_Model_RegraContrato_Crud_Mapper
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
     * @return Ca_Model_RegraContrato_Crud_Mapper
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
     * @return Ca_Model_RegraContrato_Crud_Mapper
     */
    public function setIdFavorecido($value,$options=array('required'=>true)){        
        $this->_data['id_favorecido'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_favorecido']->setValueFromDb($value);
                    
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
     * @return Ca_Model_RegraContrato_Crud_Mapper
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
     * Retorna os dados da coluna vlr_fixo
     *
     * @return string
     */
    public function getVlrFixo($instance=false){
        if ($instance && !is_object($this->_data['vlr_fixo'])){
            $this->setVlrFixo('',array('required'=>false));
        }
        return $this->_data['vlr_fixo'];
    }
    /**
     * Seta o valor da coluna vlr_fixo
     *
     * @param string $value
     * @return Ca_Model_RegraContrato_Crud_Mapper
     */
    public function setVlrFixo($value,$options=array('required'=>true)){        
        $this->_data['vlr_fixo'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['vlr_fixo']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_min
     *
     * @return string
     */
    public function getVlrMin($instance=false){
        if ($instance && !is_object($this->_data['vlr_min'])){
            $this->setVlrMin('',array('required'=>false));
        }
        return $this->_data['vlr_min'];
    }
    /**
     * Seta o valor da coluna vlr_min
     *
     * @param string $value
     * @return Ca_Model_RegraContrato_Crud_Mapper
     */
    public function setVlrMin($value,$options=array('required'=>true)){        
        $this->_data['vlr_min'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['vlr_min']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_perc
     *
     * @return string
     */
    public function getVlrPerc($instance=false){
        if ($instance && !is_object($this->_data['vlr_perc'])){
            $this->setVlrPerc('',array('required'=>false));
        }
        return $this->_data['vlr_perc'];
    }
    /**
     * Seta o valor da coluna vlr_perc
     *
     * @param string $value
     * @return Ca_Model_RegraContrato_Crud_Mapper
     */
    public function setVlrPerc($value,$options=array('required'=>true)){        
        $this->_data['vlr_perc'] = new ZendT_Type_Number($value,array('numDecimal'=>4));
         if ($options['db'])
            $this->_data['vlr_perc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>