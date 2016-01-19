<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela log_objeto
 */
class Log_Model_LogObjeto_Crud_Element
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_log');
    }

    
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('log_objeto.id') . ':');
        $element->setAttribs(array('css-width'=>'35','maxlength'=>'4'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getNome(){

        $element = new ZendT_Form_Element_Text('nome');
        $element->setLabel($this->_translate->_('log_objeto.nome') . ':');
        $element->setAttribs(array('maxlength'=>'30','css-width'=>'35'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getDescricao(){

        $element = new ZendT_Form_Element_Text('descricao');
        $element->setLabel($this->_translate->_('log_objeto.descricao') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getStatus(){

        $element = new ZendT_Form_Element_Select('status');
        $element->setLabel($this->_translate->_('log_objeto.status') . ':');
        $element->addMultiOption('A', 'Ativo');
        $element->addMultiOption('I', 'Inativo');        
                
        return $element;
    }
            
    public function getIdLogTabela(){

        $element = new ZendT_Form_Element_Seeker('id_log_tabela');
        $element->setSufix('log_tabela');
        $element->setLabel($this->_translate->_('log_objeto.id_log_tabela') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'200px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/log/log-tabela/grid');
        $element->url()->setSearch('/log/log-tabela/seeker-search');
        $element->url()->setRetrive('/log/log-tabela/retrive');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getTempoVida(){

        $element = new ZendT_Form_Element_Numeric('tempo_vida');
        $element->setLabel($this->_translate->_('log_objeto.tempo_vida') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','4');
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>