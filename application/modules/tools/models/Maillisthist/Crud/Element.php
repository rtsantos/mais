<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela maillisthist
 */
class Tools_Model_Maillisthist_Crud_Element
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_tools');
    }

    
    public function getIdMaillist(){

        $element = new ZendT_Form_Element_Seeker('id_maillist');
        $element->setSufix('maillist');
        $element->setLabel($this->_translate->_('maillisthist.id_maillist') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('mail_from');
        $element->setSearchAttribs(array('css-width'=>'200px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/tools/maillist/grid');
        $element->url()->setSearch('/tools/maillist/seeker-search');
        $element->url()->setRetrive('/tools/maillist/retrive');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getAction(){

        $element = new ZendT_Form_Element_Select('action');
        $element->setLabel($this->_translate->_('maillisthist.action') . ':');
        $element->addMultiOption('S', 'Enviado');
        $element->addMultiOption('R', 'Reativado');        
                
        return $element;
    }
            
    public function getDhAction(){

        $element = new ZendT_Form_Element_DateTime('dh_action');
        $element->setLabel($this->_translate->_('maillisthist.dh_action') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        $element->renderDateTime();
                
        return $element;
    }
            
    public function getErrMsg(){

        $element = new ZendT_Form_Element_Text('err_msg');
        $element->setLabel($this->_translate->_('maillisthist.err_msg') . ':');
        $element->setAttribs(array('maxlength'=>'4000','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
}
?>