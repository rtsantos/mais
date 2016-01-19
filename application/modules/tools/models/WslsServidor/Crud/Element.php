<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela wsls_servidor
 */
class Tools_Model_WslsServidor_Crud_Element
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_tools');
    }

    
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('wsls_servidor.id') . ':');
        $element->setAttribs(array('css-width'=>'87.5','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getIp(){

        $element = new ZendT_Form_Element_Text('ip');
        $element->setLabel($this->_translate->_('wsls_servidor.ip') . ':');
        $element->setAttribs(array('maxlength'=>'15','css-width'=>'20'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getPadrao(){

        $element = new ZendT_Form_Element_Select('padrao');
        $element->setLabel($this->_translate->_('wsls_servidor.padrao') . ':');
        $element->addMultiOption('S', 'Sim');
        $element->addMultiOption('N', 'Não');        
                
        return $element;
    }
            
    public function getStatus(){

        $element = new ZendT_Form_Element_Select('status');
        $element->setLabel($this->_translate->_('wsls_servidor.status') . ':');
        $element->addMultiOption('A', 'Ativo');
        $element->addMultiOption('I', 'Inativo');        
                
        return $element;
    }
            
    public function getIdFilial(){

        $element = new ZendT_Form_Element_Seeker('id_filial');
        $element->setSufix('filial');
        $element->setLabel($this->_translate->_('wsls_servidor.id_filial') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('sigla');
        $element->setSearchAttribs(array('size'=>'5'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
        $element->url()->setGrid('/ca/filial/grid');
        $element->url()->setSearch('/ca/filial/seeker-search');
        $element->url()->setRetrive('/ca/filial/retrive');
        $element->addValidators(array());
                
        $element->setDisplayField('nome_cidade');
        $element->setDisplayAttribs(array('size'=>'30'));
        return $element;
    }
            
    public function getIdPostoAvancado(){

        $element = new ZendT_Form_Element_Seeker('id_posto_avancado');
        $element->setSufix('posto_avancado');
        $element->setLabel($this->_translate->_('wsls_servidor.id_posto_avancado') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'200px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/posto-avancado/grid');
        $element->url()->setSearch('/ca/posto-avancado/seeker-search');
        $element->url()->setRetrive('/ca/posto-avancado/retrive');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getImpressoraPadrao(){

        $element = new ZendT_Form_Element_Text('impressora_padrao');
        $element->setLabel($this->_translate->_('wsls_servidor.impressora_padrao') . ':');
        $element->setAttribs(array('maxlength'=>'40','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
}
?>