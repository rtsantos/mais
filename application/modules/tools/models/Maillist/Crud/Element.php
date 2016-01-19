<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela maillist
 */
class Tools_Model_Maillist_Crud_Element
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_tools');
    }

    
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('maillist.id') . ':');
        $element->setAttribs(array('css-width'=>'87.5','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getMailFrom(){

        $element = new ZendT_Form_Element_Text('mail_from');
        $element->setLabel($this->_translate->_('maillist.mail_from') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getMailTo(){

        $element = new ZendT_Form_Element_Text('mail_to');
        $element->setLabel($this->_translate->_('maillist.mail_to') . ':');
        $element->setAttribs(array('maxlength'=>'2000','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getMailSubject(){

        $element = new ZendT_Form_Element_Text('mail_subject');
        $element->setLabel($this->_translate->_('maillist.mail_subject') . ':');
        $element->setAttribs(array('maxlength'=>'150','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getMailCc(){

        $element = new ZendT_Form_Element_Text('mail_cc');
        $element->setLabel($this->_translate->_('maillist.mail_cc') . ':');
        $element->setAttribs(array('maxlength'=>'1500','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getMailBcc(){

        $element = new ZendT_Form_Element_Text('mail_bcc');
        $element->setLabel($this->_translate->_('maillist.mail_bcc') . ':');
        $element->setAttribs(array('maxlength'=>'1500','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getMailAlert(){

        $element = new ZendT_Form_Element_Text('mail_alert');
        $element->setLabel($this->_translate->_('maillist.mail_alert') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getSendAlert(){

        $element = new ZendT_Form_Element_Select('send_alert');
        $element->setLabel($this->_translate->_('maillist.send_alert') . ':');
        $element->addMultiOption('', '');
        $element->addMultiOption('N', 'Não');
        $element->addMultiOption('S', 'Sim');        
                
        return $element;
    }
            
    public function getStatus(){

        $element = new ZendT_Form_Element_Select('status');
        $element->setLabel($this->_translate->_('maillist.status') . ':');
        $element->addMultiOption('', '');
        $element->addMultiOption('S', 'S');
        $element->addMultiOption('E', 'E');
        $element->addMultiOption('N', 'N');
        $element->addMultiOption('Z', 'Z');        
                
        return $element;
    }
            
    public function getHtml(){

        $element = new ZendT_Form_Element_Select('html');
        $element->setLabel($this->_translate->_('maillist.html') . ':');
        $element->addMultiOption('', '');
        $element->addMultiOption('N', 'Não');
        $element->addMultiOption('S', 'Sim');        
                
        return $element;
    }
            
    public function getNtry(){

        $element = new ZendT_Form_Element_Numeric('ntry');
        $element->setLabel($this->_translate->_('maillist.ntry') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','3');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getLifeTime(){

        $element = new ZendT_Form_Element_Numeric('life_time');
        $element->setLabel($this->_translate->_('maillist.life_time') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','4');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getDhSend(){

        $element = new ZendT_Form_Element_DateTime('dh_send');
        $element->setLabel($this->_translate->_('maillist.dh_send') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        $element->renderDateTime();
                
        return $element;
    }
            
    public function getDhRequest(){

        $element = new ZendT_Form_Element_DateTime('dh_request');
        $element->setLabel($this->_translate->_('maillist.dh_request') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        $element->renderDateTime();
                
        return $element;
    }
            
    public function getDiscardAttachment(){

        $element = new ZendT_Form_Element_Text('discard_attachment');
        $element->setLabel($this->_translate->_('maillist.discard_attachment') . ':');
        $element->setAttribs(array('maxlength'=>'1','css-width'=>'6'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getAttachment(){

        $element = new ZendT_Form_Element_Text('attachment');
        $element->setLabel($this->_translate->_('maillist.attachment') . ':');
        $element->setAttribs(array('maxlength'=>'4000','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getMailBody(){

        $element = new ZendT_Form_Element_Textare('mail_body');
        $element->setLabel($this->_translate->_('maillist.mail_body') . ':');
        $element->setAttribs(array('cols'=>'50','rows'=>'10'));
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>