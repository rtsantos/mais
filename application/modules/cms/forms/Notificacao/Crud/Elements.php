<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela cms_notificacao
 */
class Cms_Form_Notificacao_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_cms');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Cms_Form_Notificacao_Elements
     */
    public function getElement($columnName){
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $this->$method();
    }
     
    
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getIdConteudo(){

        $element = new ZendT_Form_Element_Text('id_conteudo');
        $element->setLabel($this->_translate->_('cms_notificacao.id_conteudo') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getIdUsuario(){

        $element = new ZendT_Form_Element_Text('id_usuario');
        $element->setLabel($this->_translate->_('cms_notificacao.id_usuario') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdMaillist(){

        $element = new ZendT_Form_Element_Seeker('id_maillist');
        $element->setSuffix('maillist');
        $element->setLabel($this->_translate->_('cms_notificacao.id_maillist') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('mail_from');
        $element->setSearchAttribs(array('css-width'=>'200px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/tools/maillist/grid');
        $element->url()->setSearch('/tools/maillist/seeker-search');
        $element->url()->setRetrieve('/tools/maillist/retrive');
        $element->setMapperView('Tools_DataView_Maillist_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>