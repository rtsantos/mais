<?php
/**
 * Classe de mapeamento do registro da tabela img_docto
 */
class Ged_Model_Docto_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_tipo_docto','id_prop_relac','dh_inclusao');
    protected $_model = 'Ged_Model_Docto_Table';
    /**
     *
     * @var Ged_Model_Docto_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Ged_Model_Docto_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Ged_Model_Docto_Mapper){
            $this->_dataOld = new Ged_Model_Docto_Mapper();
            $this->_dataOld->setId($this->getId());
            $this->_dataOld->retrive();
        }
        return $this->_dataOld;
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
     * @return Ged_Model_Docto_Crud_Mapper
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
     * Retorna os dados da coluna id_tipo_docto
     *
     * @return string
     */
    public function getIdTipoDocto($instance=false){
        if ($instance && !is_object($this->_data['id_tipo_docto'])){
            $this->setIdTipoDocto('',array('required'=>false));
        }
        return $this->_data['id_tipo_docto'];
    }
    /**
     * Seta o valor da coluna id_tipo_docto
     *
     * @param string $value
     * @return Ged_Model_Docto_Crud_Mapper
     */
    public function setIdTipoDocto($value,$options=array('required'=>true)){        
        $this->_data['id_tipo_docto'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_tipo_docto']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_tipo_docto');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna id_prop_relac
     *
     * @return string
     */
    public function getIdPropRelac($instance=false){
        if ($instance && !is_object($this->_data['id_prop_relac'])){
            $this->setIdPropRelac('',array('required'=>false));
        }
        return $this->_data['id_prop_relac'];
    }
    /**
     * Seta o valor da coluna id_prop_relac
     *
     * @param string $value
     * @return Ged_Model_Docto_Crud_Mapper
     */
    public function setIdPropRelac($value,$options=array('required'=>true)){        
        $this->_data['id_prop_relac'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['id_prop_relac']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_prop_relac');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna dh_inclusao
     *
     * @return string
     */
    public function getDhInclusao($instance=false){
        if ($instance && !is_object($this->_data['dh_inclusao'])){
            $this->setDhInclusao('',array('required'=>false));
        }
        return $this->_data['dh_inclusao'];
    }
    /**
     * Seta o valor da coluna dh_inclusao
     *
     * @param string $value
     * @return Ged_Model_Docto_Crud_Mapper
     */
    public function setDhInclusao($value,$options=array('required'=>true)){        
        $this->_data['dh_inclusao'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_inclusao']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dh_inclusao');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna id_usu_incl
     *
     * @return string
     */
    public function getIdUsuIncl($instance=false){
        if ($instance && !is_object($this->_data['id_usu_incl'])){
            $this->setIdUsuIncl('',array('required'=>false));
        }
        return $this->_data['id_usu_incl'];
    }
    /**
     * Seta o valor da coluna id_usu_incl
     *
     * @param string $value
     * @return Ged_Model_Docto_Crud_Mapper
     */
    public function setIdUsuIncl($value,$options=array('required'=>true)){        
        $this->_data['id_usu_incl'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_usu_incl']->setValueFromDb($value);
                    
        if (!$options['db']){
            
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
     * @return Ged_Model_Docto_Crud_Mapper
     */
    public function setDescricao($value,$options=array('required'=>true)){        
        $this->_data['descricao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['descricao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['descricao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna id_arquivo
     *
     * @return string
     */
    public function getIdArquivo($instance=false){
        if ($instance && !is_object($this->_data['id_arquivo'])){
            $this->setIdArquivo('',array('required'=>false));
        }
        return $this->_data['id_arquivo'];
    }
    /**
     * Seta o valor da coluna id_arquivo
     *
     * @param string $value
     * @return Ged_Model_Docto_Crud_Mapper
     */
    public function setIdArquivo($value,$options=array('required'=>true)){        
        $this->_data['id_arquivo'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_arquivo']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
}
?>