<?php
/**
 * Classe de mapeamento do registro da tabela maillist
 */
class Tools_Model_Maillist_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','mail_from','mail_to','mail_subject','send_alert','status','html','dh_request','discard_attachment');
    protected $_model = 'Tools_Model_Maillist_Table';

    
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
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setId($value,$options=array('required'=>true)){        
        $this->_data['id'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
        if ($options['db'])
            $this->_data['id']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna mail_from
     *
     * @return string
     */
    public function getMailFrom($instance=false){
        if ($instance && !is_object($this->_data['mail_from'])){
            $this->setMailFrom('',array('required'=>false));
        }
        return $this->_data['mail_from'];
    }
    /**
     * Seta o valor da coluna mail_from
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setMailFrom($value,$options=array('required'=>true)){        
        $this->_data['mail_from'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['mail_from']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'mail_from');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['mail_from']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna mail_to
     *
     * @return string
     */
    public function getMailTo($instance=false){
        if ($instance && !is_object($this->_data['mail_to'])){
            $this->setMailTo('',array('required'=>false));
        }
        return $this->_data['mail_to'];
    }
    /**
     * Seta o valor da coluna mail_to
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setMailTo($value,$options=array('required'=>true)){        
        $this->_data['mail_to'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['mail_to']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'mail_to');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 2000, ) );
            $valueValid = $this->_data['mail_to']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna mail_subject
     *
     * @return string
     */
    public function getMailSubject($instance=false){
        if ($instance && !is_object($this->_data['mail_subject'])){
            $this->setMailSubject('',array('required'=>false));
        }
        return $this->_data['mail_subject'];
    }
    /**
     * Seta o valor da coluna mail_subject
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setMailSubject($value,$options=array('required'=>true)){        
        $this->_data['mail_subject'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['mail_subject']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'mail_subject');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 150, ) );
            $valueValid = $this->_data['mail_subject']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna mail_cc
     *
     * @return string
     */
    public function getMailCc($instance=false){
        if ($instance && !is_object($this->_data['mail_cc'])){
            $this->setMailCc('',array('required'=>false));
        }
        return $this->_data['mail_cc'];
    }
    /**
     * Seta o valor da coluna mail_cc
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setMailCc($value,$options=array('required'=>true)){        
        $this->_data['mail_cc'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['mail_cc']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1500, ) );
            $valueValid = $this->_data['mail_cc']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna mail_bcc
     *
     * @return string
     */
    public function getMailBcc($instance=false){
        if ($instance && !is_object($this->_data['mail_bcc'])){
            $this->setMailBcc('',array('required'=>false));
        }
        return $this->_data['mail_bcc'];
    }
    /**
     * Seta o valor da coluna mail_bcc
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setMailBcc($value,$options=array('required'=>true)){        
        $this->_data['mail_bcc'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['mail_bcc']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1500, ) );
            $valueValid = $this->_data['mail_bcc']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna mail_alert
     *
     * @return string
     */
    public function getMailAlert($instance=false){
        if ($instance && !is_object($this->_data['mail_alert'])){
            $this->setMailAlert('',array('required'=>false));
        }
        return $this->_data['mail_alert'];
    }
    /**
     * Seta o valor da coluna mail_alert
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setMailAlert($value,$options=array('required'=>true)){        
        $this->_data['mail_alert'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['mail_alert']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['mail_alert']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna send_alert
     *
     * @return string
     */
    public function getSendAlert($instance=false){
        if ($instance && !is_object($this->_data['send_alert'])){
            $this->setSendAlert('',array('required'=>false));
        }
        return $this->_data['send_alert'];
    }
    /**
     * Seta o valor da coluna send_alert
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setSendAlert($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('N'=>'Não','S'=>'Sim');
        $this->_data['send_alert'] = new ZendT_Type_Default($value,$options);
        if ($options['db'])
            $this->_data['send_alert']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'send_alert');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['send_alert']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
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
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setStatus($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('N'=>'Não','S'=>'Sim','S'=>'S','E'=>'E','N'=>'N','Z'=>'Z');
        $this->_data['status'] = new ZendT_Type_Default($value,$options);
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
     * Retorna os dados da coluna html
     *
     * @return string
     */
    public function getHtml($instance=false){
        if ($instance && !is_object($this->_data['html'])){
            $this->setHtml('',array('required'=>false));
        }
        return $this->_data['html'];
    }
    /**
     * Seta o valor da coluna html
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setHtml($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('N'=>'Não','S'=>'Sim','S'=>'S','E'=>'E','N'=>'N','Z'=>'Z','N'=>'Não','S'=>'Sim');
        $this->_data['html'] = new ZendT_Type_Default($value,$options);
        if ($options['db'])
            $this->_data['html']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'html');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['html']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna ntry
     *
     * @return string
     */
    public function getNtry($instance=false){
        if ($instance && !is_object($this->_data['ntry'])){
            $this->setNtry('',array('required'=>false));
        }
        return $this->_data['ntry'];
    }
    /**
     * Seta o valor da coluna ntry
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setNtry($value,$options=array('required'=>true)){        
        $this->_data['ntry'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['ntry']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna life_time
     *
     * @return string
     */
    public function getLifeTime($instance=false){
        if ($instance && !is_object($this->_data['life_time'])){
            $this->setLifeTime('',array('required'=>false));
        }
        return $this->_data['life_time'];
    }
    /**
     * Seta o valor da coluna life_time
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setLifeTime($value,$options=array('required'=>true)){        
        $this->_data['life_time'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['life_time']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna dh_send
     *
     * @return string
     */
    public function getDhSend($instance=false){
        if ($instance && !is_object($this->_data['dh_send'])){
            $this->setDhSend('',array('required'=>false));
        }
        return $this->_data['dh_send'];
    }
    /**
     * Seta o valor da coluna dh_send
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setDhSend($value,$options=array('required'=>true)){        
        $this->_data['dh_send'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_send']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna dh_request
     *
     * @return string
     */
    public function getDhRequest($instance=false){
        if ($instance && !is_object($this->_data['dh_request'])){
            $this->setDhRequest('',array('required'=>false));
        }
        return $this->_data['dh_request'];
    }
    /**
     * Seta o valor da coluna dh_request
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setDhRequest($value,$options=array('required'=>true)){        
        $this->_data['dh_request'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_request']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dh_request');
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna discard_attachment
     *
     * @return string
     */
    public function getDiscardAttachment($instance=false){
        if ($instance && !is_object($this->_data['discard_attachment'])){
            $this->setDiscardAttachment('',array('required'=>false));
        }
        return $this->_data['discard_attachment'];
    }
    /**
     * Seta o valor da coluna discard_attachment
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setDiscardAttachment($value,$options=array('required'=>true)){        
        $this->_data['discard_attachment'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['discard_attachment']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'discard_attachment');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['discard_attachment']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna attachment
     *
     * @return string
     */
    public function getAttachment($instance=false){
        if ($instance && !is_object($this->_data['attachment'])){
            $this->setAttachment('',array('required'=>false));
        }
        return $this->_data['attachment'];
    }
    /**
     * Seta o valor da coluna attachment
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setAttachment($value,$options=array('required'=>true)){        
        $this->_data['attachment'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['attachment']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 4000, ) );
            $valueValid = $this->_data['attachment']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna mail_body
     *
     * @return string
     */
    public function getMailBody($instance=false){
        if ($instance && !is_object($this->_data['mail_body'])){
            $this->setMailBody('',array('required'=>false));
        }
        return $this->_data['mail_body'];
    }
    /**
     * Seta o valor da coluna mail_body
     *
     * @param string $value
     * @return Tools_Model_Maillist_Crud_Mapper
     */
    public function setMailBody($value,$options=array('required'=>true)){        
        
         $this->_data['mail_body'] = new ZendT_Type_Clob($value);
         if ($options['db'])
            $this->_data['mail_body']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }
            
}
?>