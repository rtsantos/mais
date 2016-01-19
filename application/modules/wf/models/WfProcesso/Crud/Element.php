<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela wf_processo
 */
class Wf_Model_WfProcesso_Crud_Element
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_wf');
    }

    
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('wf_processo.id') . ':');
        $element->setAttribs(array('size'=>'27','maxlength'=>'22'));        
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getDescricao(){

        $element = new ZendT_Form_Element_Text('descricao');
        $element->setLabel($this->_translate->_('wf_processo.descricao') . ':');
        $element->setAttribs(array('maxlength'=>'50','size'=>'40'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
                
        return $element;
    }
            
    public function getIdAplicacao(){

        $element = new ZendT_Form_Element_Seeker('aplicacao');
        $element->setLabel($this->_translate->_('wf_processo.id_aplicacao') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('sigla');
        $element->setSearchAttribs(array('css-width'=>'100'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(360);
        $element->url()->setGrid('/auth/aplicacao/grid');
        $element->url()->setSearch('/auth/aplicacao/seeker-search');
        $element->url()->setRetrive('/auth/aplicacao/retrive');
        $element->addValidators(array());
                
        $element->setDisplayField('nome');
        $element->setDisplayAttribs(array('css-width'=>'170'));
        $element->renderSeeker();
        return $element;
    }
            
}
?>