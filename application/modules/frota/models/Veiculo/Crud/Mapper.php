<?php
/**
 * Classe de mapeamento do registro da tabela fr_veiculo
 */
class Frota_Model_Veiculo_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','placa','descricao','id_empresa');
    protected $_model = 'Frota_Model_Veiculo_Table';
    public static $table = 'mais.fr_veiculo';
    /**
     *
     * @var Frota_Model_Veiculo_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Frota_Model_Veiculo_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Frota_Model_Veiculo_Mapper){
            $this->_dataOld = new Frota_Model_Veiculo_Mapper();
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
                'id_empresa' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
                    'column' => 'id'
                ),
                'id_modelo' => array(
                    'mapper' => 'Frota_DataView_Modelo_MapperView',
                    'column' => 'id'
                ));
    }
    /**
     * @retun array
     */
    public function getTabs(){
        return array (
  'cv_pedido' => 
  array (
    'description' => 'Pedido',
    'url' => '/vendas/pedido/form/grid/1',
    'column' => 'id_veiculo',
    'message' => 'Necessário seleção Veículo',
  ),
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
     * @return Frota_Model_Veiculo_Crud_Mapper
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
     * Retorna os dados da coluna id_modelo
     *
     * @return string
     */
    public function getIdModelo($instance=false){
        if ($instance && !is_object($this->_data['id_modelo'])){
            $this->setIdModelo('',array('required'=>false));
        }
        return $this->_data['id_modelo'];
    }
    /**
     * Seta o valor da coluna id_modelo
     *
     * @param string $value
     * @return Frota_Model_Veiculo_Crud_Mapper
     */
    public function setIdModelo($value,$options=array('required'=>true)){        
        $this->_data['id_modelo'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_modelo']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna placa
     *
     * @return string
     */
    public function getPlaca($instance=false){
        if ($instance && !is_object($this->_data['placa'])){
            $this->setPlaca('',array('required'=>false));
        }
        return $this->_data['placa'];
    }
    /**
     * Seta o valor da coluna placa
     *
     * @param string $value
     * @return Frota_Model_Veiculo_Crud_Mapper
     */
    public function setPlaca($value,$options=array('required'=>true)){        
        $this->_data['placa'] = new ZendT_Type_String($value,array('mask'=>'@@@-@@@@'
                                                                   ,'charMask'=>'@'
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['placa']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'placa');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 10, ) );
            $valueValid = $this->_data['placa']->getValueToDb();
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
     * @return Frota_Model_Veiculo_Crud_Mapper
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
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['descricao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna chassi
     *
     * @return string
     */
    public function getChassi($instance=false){
        if ($instance && !is_object($this->_data['chassi'])){
            $this->setChassi('',array('required'=>false));
        }
        return $this->_data['chassi'];
    }
    /**
     * Seta o valor da coluna chassi
     *
     * @param string $value
     * @return Frota_Model_Veiculo_Crud_Mapper
     */
    public function setChassi($value,$options=array('required'=>true)){        
        $this->_data['chassi'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['chassi']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['chassi']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna renavam
     *
     * @return string
     */
    public function getRenavam($instance=false){
        if ($instance && !is_object($this->_data['renavam'])){
            $this->setRenavam('',array('required'=>false));
        }
        return $this->_data['renavam'];
    }
    /**
     * Seta o valor da coluna renavam
     *
     * @param string $value
     * @return Frota_Model_Veiculo_Crud_Mapper
     */
    public function setRenavam($value,$options=array('required'=>true)){        
        $this->_data['renavam'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['renavam']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 40, ) );
            $valueValid = $this->_data['renavam']->getValueToDb();
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
     * @return Frota_Model_Veiculo_Crud_Mapper
     */
    public function setIdEmpresa($value,$options=array('required'=>true)){        
        $this->_data['id_empresa'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_empresa']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_empresa');
                    
        }
        return $this;
    }

            
}
?>