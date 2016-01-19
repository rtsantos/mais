<?php
/**
 * Classe de mapeamento do registro da tabela cardapio
 */
class Cms_Model_Cardapio_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_filial');
    protected $_model = 'Cms_Model_Cardapio_Table';
    /**
     *
     * @var Cms_Model_Cardapio_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Cms_Model_Cardapio_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Cms_Model_Cardapio_Mapper){
            $this->_dataOld = new Cms_Model_Cardapio_Mapper();
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
                'ID_FILIAL' => array(
                    'mapper' => 'Ca_DataView_Filial_MapperView',
                    'column' => 'ID'
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
     * @return Cms_Model_Cardapio_Crud_Mapper
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
     * Retorna os dados da coluna dt_exibe
     *
     * @return string
     */
    public function getDtExibe($instance=false){
        if ($instance && !is_object($this->_data['dt_exibe'])){
            $this->setDtExibe('',array('required'=>false));
        }
        return $this->_data['dt_exibe'];
    }
    /**
     * Seta o valor da coluna dt_exibe
     *
     * @param string $value
     * @return Cms_Model_Cardapio_Crud_Mapper
     */
    public function setDtExibe($value,$options=array('required'=>true)){        
        $this->_data['dt_exibe'] = new ZendT_Type_Date($value,'Date');
         if ($options['db'])
            $this->_data['dt_exibe']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna pt_principal
     *
     * @return string
     */
    public function getPtPrincipal($instance=false){
        if ($instance && !is_object($this->_data['pt_principal'])){
            $this->setPtPrincipal('',array('required'=>false));
        }
        return $this->_data['pt_principal'];
    }
    /**
     * Seta o valor da coluna pt_principal
     *
     * @param string $value
     * @return Cms_Model_Cardapio_Crud_Mapper
     */
    public function setPtPrincipal($value,$options=array('required'=>true)){        
        $this->_data['pt_principal'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['pt_principal']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 150, ) );
            $valueValid = $this->_data['pt_principal']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna opcao
     *
     * @return string
     */
    public function getOpcao($instance=false){
        if ($instance && !is_object($this->_data['opcao'])){
            $this->setOpcao('',array('required'=>false));
        }
        return $this->_data['opcao'];
    }
    /**
     * Seta o valor da coluna opcao
     *
     * @param string $value
     * @return Cms_Model_Cardapio_Crud_Mapper
     */
    public function setOpcao($value,$options=array('required'=>true)){        
        $this->_data['opcao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['opcao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 150, ) );
            $valueValid = $this->_data['opcao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna guarnicao
     *
     * @return string
     */
    public function getGuarnicao($instance=false){
        if ($instance && !is_object($this->_data['guarnicao'])){
            $this->setGuarnicao('',array('required'=>false));
        }
        return $this->_data['guarnicao'];
    }
    /**
     * Seta o valor da coluna guarnicao
     *
     * @param string $value
     * @return Cms_Model_Cardapio_Crud_Mapper
     */
    public function setGuarnicao($value,$options=array('required'=>true)){        
        $this->_data['guarnicao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['guarnicao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 150, ) );
            $valueValid = $this->_data['guarnicao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna arroz_feijao
     *
     * @return string
     */
    public function getArrozFeijao($instance=false){
        if ($instance && !is_object($this->_data['arroz_feijao'])){
            $this->setArrozFeijao('',array('required'=>false));
        }
        return $this->_data['arroz_feijao'];
    }
    /**
     * Seta o valor da coluna arroz_feijao
     *
     * @param string $value
     * @return Cms_Model_Cardapio_Crud_Mapper
     */
    public function setArrozFeijao($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('A/F'=>'Sim');
        $this->_data['arroz_feijao'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['arroz_feijao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 10, ) );
            $valueValid = $this->_data['arroz_feijao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna salada
     *
     * @return string
     */
    public function getSalada($instance=false){
        if ($instance && !is_object($this->_data['salada'])){
            $this->setSalada('',array('required'=>false));
        }
        return $this->_data['salada'];
    }
    /**
     * Seta o valor da coluna salada
     *
     * @param string $value
     * @return Cms_Model_Cardapio_Crud_Mapper
     */
    public function setSalada($value,$options=array('required'=>true)){        
        $this->_data['salada'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['salada']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 150, ) );
            $valueValid = $this->_data['salada']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna sobremesa
     *
     * @return string
     */
    public function getSobremesa($instance=false){
        if ($instance && !is_object($this->_data['sobremesa'])){
            $this->setSobremesa('',array('required'=>false));
        }
        return $this->_data['sobremesa'];
    }
    /**
     * Seta o valor da coluna sobremesa
     *
     * @param string $value
     * @return Cms_Model_Cardapio_Crud_Mapper
     */
    public function setSobremesa($value,$options=array('required'=>true)){        
        $this->_data['sobremesa'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['sobremesa']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['sobremesa']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna suco
     *
     * @return string
     */
    public function getSuco($instance=false){
        if ($instance && !is_object($this->_data['suco'])){
            $this->setSuco('',array('required'=>false));
        }
        return $this->_data['suco'];
    }
    /**
     * Seta o valor da coluna suco
     *
     * @param string $value
     * @return Cms_Model_Cardapio_Crud_Mapper
     */
    public function setSuco($value,$options=array('required'=>true)){        
        $this->_data['suco'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['suco']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['suco']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna pt_light
     *
     * @return string
     */
    public function getPtLight($instance=false){
        if ($instance && !is_object($this->_data['pt_light'])){
            $this->setPtLight('',array('required'=>false));
        }
        return $this->_data['pt_light'];
    }
    /**
     * Seta o valor da coluna pt_light
     *
     * @param string $value
     * @return Cms_Model_Cardapio_Crud_Mapper
     */
    public function setPtLight($value,$options=array('required'=>true)){        
        $this->_data['pt_light'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['pt_light']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 200, ) );
            $valueValid = $this->_data['pt_light']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_filial
     *
     * @return string
     */
    public function getIdFilial($instance=false){
        if ($instance && !is_object($this->_data['id_filial'])){
            $this->setIdFilial('',array('required'=>false));
        }
        return $this->_data['id_filial'];
    }
    /**
     * Seta o valor da coluna id_filial
     *
     * @param string $value
     * @return Cms_Model_Cardapio_Crud_Mapper
     */
    public function setIdFilial($value,$options=array('required'=>true)){        
        $this->_data['id_filial'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_filial']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_filial');
                    
        }
        return $this;
    }

            
}
?>