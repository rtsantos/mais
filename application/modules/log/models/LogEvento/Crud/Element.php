<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela log_evento
 */
class Log_Model_LogEvento_Crud_Element
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_log');
    }

    
    public function getIdLogObjeto(){

        $element = new ZendT_Form_Element_Seeker('id_log_objeto');
        $element->setSufix('log_objeto');
        $element->setLabel($this->_translate->_('log_evento.id_log_objeto') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/log/log-objeto/grid');
        $element->url()->setSearch('/log/log-objeto/seeker-search');
        $element->url()->setRetrive('/log/log-objeto/retrive');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getIdLogOperac(){

        $element = new ZendT_Form_Element_Seeker('id_log_operac');
        $element->setSufix('log_operac');
        $element->setLabel($this->_translate->_('log_evento.id_log_operac') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('acao');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/log/log-operac/grid');
        $element->url()->setSearch('/log/log-operac/seeker-search');
        $element->url()->setRetrive('/log/log-operac/retrive');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getIdObjeto(){

        $element = new ZendT_Form_Element_Numeric('id_objeto');
        $element->setLabel($this->_translate->_('log_evento.id_objeto') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','10');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getIdUsuario(){

        $element = new ZendT_Form_Element_Seeker('id_usuario');
        $element->setSufix('usuario');
        $element->setLabel($this->_translate->_('log_evento.id_usuario') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('login');
        $element->setSearchAttribs(array('css-width'=>'70px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/auth/usuario/grid');
        $element->url()->setSearch('/auth/usuario/seeker-search');
        $element->url()->setRetrive('/auth/usuario/retrive');
        $element->addValidators(array());
                
        $element->setDisplayField('nome');
        $element->setDisplayAttribs(array('css-width'=>'200px'));
        return $element;
    }
            
    public function getDhEvento(){

        $element = new ZendT_Form_Element_DateTime('dh_evento');
        $element->setLabel($this->_translate->_('log_evento.dh_evento') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        $element->renderDateTime();
                
        return $element;
    }
            
    public function getChave(){

        $element = new ZendT_Form_Element_Text('chave');
        $element->setLabel($this->_translate->_('log_evento.chave') . ':');
        $element->setAttribs(array('maxlength'=>'30','css-width'=>'100px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getObservacao(){

        $element = new ZendT_Form_Element_Text('observacao');
        $element->setLabel($this->_translate->_('log_evento.observacao') . ':');
        $element->setAttribs(array('maxlength'=>'250','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getIdLogTabela(){

        $element = new ZendT_Form_Element_Seeker('id_log_tabela');
        $element->setSufix('log_tabela');
        $element->setLabel($this->_translate->_('log_evento.id_log_tabela') . ':');
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
            
}
?>