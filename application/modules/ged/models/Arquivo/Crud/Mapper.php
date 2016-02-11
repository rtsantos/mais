<?php
/**
 * Classe de mapeamento do registro da tabela img_arquivo
 */
class Ged_Model_Arquivo_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','conteudo_name','conteudo_type','dh_inc');
    protected $_model = 'Ged_Model_Arquivo_Table';
    public static $table = 'mais.img_arquivo';
    /**
     *
     * @var Ged_Model_Arquivo_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Ged_Model_Arquivo_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Ged_Model_Arquivo_Mapper){
            $this->_dataOld = new Ged_Model_Arquivo_Mapper();
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
                'ID_PROP_DOCTO' => array(
                    'mapper' => 'Ged_DataView_PropDocto_MapperView',
                    'column' => 'ID'
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
     * @return Ged_Model_Arquivo_Crud_Mapper
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
     * Retorna os dados da coluna conteudo_name
     *
     * @return string
     */
    public function getConteudoName($instance=false){
        if ($instance && !is_object($this->_data['conteudo_name'])){
            $this->setConteudoName('',array('required'=>false));
        }
        return $this->_data['conteudo_name'];
    }
    /**
     * Seta o valor da coluna conteudo_name
     *
     * @param string $value
     * @return Ged_Model_Arquivo_Crud_Mapper
     */
    public function setConteudoName($value,$options=array('required'=>true)){        
        $this->_data['conteudo_name'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('removeAccent', )));
        if ($options['db'])
            $this->_data['conteudo_name']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'conteudo_name');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 60, ) );
            $valueValid = $this->_data['conteudo_name']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna conteudo_type
     *
     * @return string
     */
    public function getConteudoType($instance=false){
        if ($instance && !is_object($this->_data['conteudo_type'])){
            $this->setConteudoType('',array('required'=>false));
        }
        return $this->_data['conteudo_type'];
    }
    /**
     * Seta o valor da coluna conteudo_type
     *
     * @param string $value
     * @return Ged_Model_Arquivo_Crud_Mapper
     */
    public function setConteudoType($value,$options=array('required'=>true)){        
        $this->_data['conteudo_type'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('removeAccent', )));
        if ($options['db'])
            $this->_data['conteudo_type']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'conteudo_type');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 70, ) );
            $valueValid = $this->_data['conteudo_type']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dh_inc
     *
     * @return string
     */
    public function getDhInc($instance=false){
        if ($instance && !is_object($this->_data['dh_inc'])){
            $this->setDhInc('',array('required'=>false));
        }
        return $this->_data['dh_inc'];
    }
    /**
     * Seta o valor da coluna dh_inc
     *
     * @param string $value
     * @return Ged_Model_Arquivo_Crud_Mapper
     */
    public function setDhInc($value,$options=array('required'=>true)){        
        $this->_data['dh_inc'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_inc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dh_inc');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna hashcode
     *
     * @return string
     */
    public function getHashcode($instance=false){
        if ($instance && !is_object($this->_data['hashcode'])){
            $this->setHashcode('',array('required'=>false));
        }
        return $this->_data['hashcode'];
    }
    /**
     * Seta o valor da coluna hashcode
     *
     * @param string $value
     * @return Ged_Model_Arquivo_Crud_Mapper
     */
    public function setHashcode($value,$options=array('required'=>true)){        
        $this->_data['hashcode'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['hashcode']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 32, ) );
            $valueValid = $this->_data['hashcode']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna conteudo
     *
     * @return string
     */
    public function getConteudo($instance=false){
        if ($instance && !is_object($this->_data['conteudo'])){
            $this->setConteudo('',array('required'=>false));
        }
        return $this->_data['conteudo'];
    }
    /**
     * Seta o valor da coluna conteudo
     *
     * @param string $value
     * @return Ged_Model_Arquivo_Crud_Mapper
     */
    public function setConteudo($value,$options=array('required'=>true)){        
        $this->_data['conteudo'] = new ZendT_Type_Blob($value);
         if ($options['db'])
            $this->_data['conteudo']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_prop_docto
     *
     * @return string
     */
    public function getIdPropDocto($instance=false){
        if ($instance && !is_object($this->_data['id_prop_docto'])){
            $this->setIdPropDocto('',array('required'=>false));
        }
        return $this->_data['id_prop_docto'];
    }
    /**
     * Seta o valor da coluna id_prop_docto
     *
     * @param string $value
     * @return Ged_Model_Arquivo_Crud_Mapper
     */
    public function setIdPropDocto($value,$options=array('required'=>true)){        
        $this->_data['id_prop_docto'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_prop_docto']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna path_arq
     *
     * @return string
     */
    public function getPathArq($instance=false){
        if ($instance && !is_object($this->_data['path_arq'])){
            $this->setPathArq('',array('required'=>false));
        }
        return $this->_data['path_arq'];
    }
    /**
     * Seta o valor da coluna path_arq
     *
     * @param string $value
     * @return Ged_Model_Arquivo_Crud_Mapper
     */
    public function setPathArq($value,$options=array('required'=>true)){        
        $this->_data['path_arq'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['path_arq']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 40, ) );
            $valueValid = $this->_data['path_arq']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dt_expira
     *
     * @return string
     */
    public function getDtExpira($instance=false){
        if ($instance && !is_object($this->_data['dt_expira'])){
            $this->setDtExpira('',array('required'=>false));
        }
        return $this->_data['dt_expira'];
    }
    /**
     * Seta o valor da coluna dt_expira
     *
     * @param string $value
     * @return Ged_Model_Arquivo_Crud_Mapper
     */
    public function setDtExpira($value,$options=array('required'=>true)){        
        $this->_data['dt_expira'] = new ZendT_Type_Date($value,'Date');
         if ($options['db'])
            $this->_data['dt_expira']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>