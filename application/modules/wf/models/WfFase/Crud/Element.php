<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela wf_fase
 */
class Wf_Model_WfFase_Crud_Element
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_wf');
    }

    
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('wf_fase.id') . ':');
        $element->setAttribs(array('css-width'=>'87.5','maxlength'=>'10'));        
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getIdWfProcesso(){

        $element = new ZendT_Form_Element_Seeker('wf_processo');
        $element->setLabel($this->_translate->_('wf_fase.id_wf_processo') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('descricao');
        $element->setSearchAttribs(array('size'=>'40'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
        $element->url()->setGrid('/wf/wf-processo/grid');
        $element->url()->setSearch('/wf/wf-processo/seeker-search');
        $element->url()->setRetrive('/wf/wf-processo/retrive');
        $element->addValidators(array());
                
        $element->renderSeeker();
        return $element;
    }
            
    public function getValor(){

        $element = new ZendT_Form_Element_Text('valor');
        $element->setLabel($this->_translate->_('wf_fase.valor') . ':');
        $element->setAttribs(array('maxlength'=>'2','css-width'=>'7'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
                
        return $element;
    }
            
    public function getDescricao(){

        $element = new ZendT_Form_Element_Text('descricao');
        $element->setLabel($this->_translate->_('wf_fase.descricao') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
                
        return $element;
    }
            
    public function getProcProxFase(){

        $element = new ZendT_Form_Element_Text('proc_prox_fase');
        $element->setLabel($this->_translate->_('wf_fase.proc_prox_fase') . ':');
        $element->setAttribs(array('maxlength'=>'2','css-width'=>'7'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
                
        return $element;
    }
            
    public function getProcProxUsuario(){

        $element = new ZendT_Form_Element_Text('proc_prox_usuario');
        $element->setLabel($this->_translate->_('wf_fase.proc_prox_usuario') . ':');
        $element->setAttribs(array('maxlength'=>'60','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
                
        return $element;
    }
            
    public function getProcNotif(){

        $element = new ZendT_Form_Element_Text('proc_notif');
        $element->setLabel($this->_translate->_('wf_fase.proc_notif') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
                
        return $element;
    }
            
}
?>