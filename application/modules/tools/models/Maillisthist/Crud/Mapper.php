<?php
/**
 * Classe de mapeamento do registro da tabela maillisthist
 */
class Tools_Model_Maillisthist_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id_maillist','action','dh_action');
    protected $_model = 'Tools_Model_Maillisthist_Table';

    
    /**
     * Retorna os dados da coluna id_maillist
     *
     * @return string
     */
    public function getIdMaillist($instance=false){
        if ($instance && !is_object($this->_data['id_maillist'])){
            $this->setIdMaillist('',array('required'=>false));
        }
        return $this->_data['id_maillist'];
    }
    /**
     * Seta o valor da coluna id_maillist
     *
     * @param string $value
     * @return Tools_Model_Maillisthist_Crud_Mapper
     */
    public function setIdMaillist($value,$options=array('required'=>true)){        
        $this->_data['id_maillist'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
        if ($options['db'])
            $this->_data['id_maillist']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_maillist');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna action
     *
     * @return string
     */
    public function getAction($instance=false){
        if ($instance && !is_object($this->_data['action'])){
            $this->setAction('',array('required'=>false));
        }
        return $this->_data['action'];
    }
    /**
     * Seta o valor da coluna action
     *
     * @param string $value
     * @return Tools_Model_Maillisthist_Crud_Mapper
     */
    public function setAction($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('S'=>'Enviado','R'=>'Reativado');
        $this->_data['action'] = new ZendT_Type_Default($value,$options);
        if ($options['db'])
            $this->_data['action']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'action');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['action']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna dh_action
     *
     * @return string
     */
    public function getDhAction($instance=false){
        if ($instance && !is_object($this->_data['dh_action'])){
            $this->setDhAction('',array('required'=>false));
        }
        return $this->_data['dh_action'];
    }
    /**
     * Seta o valor da coluna dh_action
     *
     * @param string $value
     * @return Tools_Model_Maillisthist_Crud_Mapper
     */
    public function setDhAction($value,$options=array('required'=>true)){        
        $this->_data['dh_action'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_action']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dh_action');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna err_msg
     *
     * @return string
     */
    public function getErrMsg($instance=false){
        if ($instance && !is_object($this->_data['err_msg'])){
            $this->setErrMsg('',array('required'=>false));
        }
        return $this->_data['err_msg'];
    }
    /**
     * Seta o valor da coluna err_msg
     *
     * @param string $value
     * @return Tools_Model_Maillisthist_Crud_Mapper
     */
    public function setErrMsg($value,$options=array('required'=>true)){        
        $this->_data['err_msg'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['err_msg']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 4000, ) );
            $valueValid = $this->_data['err_msg']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
}
?>