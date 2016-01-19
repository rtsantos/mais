<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela wf_transacao
 */
class Wf_Model_WfTransacao_Crud_Element
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_wf');
    }

    
    public function getIdWfFase(){

        $element = new ZendT_Form_Element_Seeker('id_wf_fase');
        $element->setSufix('wf_fase');
        $element->setLabel($this->_translate->_('wf_transacao.id_wf_fase') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('valor');
        $element->setSearchAttribs(array('css-width'=>'200px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/wf/wf-fase/grid');
        $element->url()->setSearch('/wf/wf-fase/seeker-search');
        $element->url()->setRetrive('/wf/wf-fase/retrive');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getIdObjeto(){

        $element = new ZendT_Form_Element_Numeric('id_objeto');
        $element->setLabel($this->_translate->_('wf_transacao.id_objeto') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getIdUsuarioAloc(){

        $element = new ZendT_Form_Element_Seeker('id_usuario_aloc');
        $element->setSufix('usuario_aloc');
        $element->setLabel($this->_translate->_('wf_transacao.id_usuario_aloc') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('login');
        $element->setSearchAttribs(array('css-width'=>'100px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/auth/usuario/grid');
        $element->url()->setSearch('/auth/usuario/seeker-search');
        $element->url()->setRetrive('/auth/usuario/retrive');
        $element->addValidators(array());
                
        $element->setDisplayField('nome');
        $element->setDisplayAttribs(array('css-width'=>'170px'));
        return $element;
    }
            
    public function getDhInc(){

        $element = new ZendT_Form_Element_DateTime('dh_inc');
        $element->setLabel($this->_translate->_('wf_transacao.dh_inc') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        $element->renderDateTime();
                
        return $element;
    }
            
    public function getObservacao(){

        $element = new ZendT_Form_Element_Textare('observacao');
        $element->setLabel($this->_translate->_('wf_transacao.observacao') . ':');
        $element->setAttribs(array('cols'=>'50','rows'=>'4'));
        $element->addValidators(array('Zend_Validate_StringLength'));
                
        return $element;
    }
            
}
?>