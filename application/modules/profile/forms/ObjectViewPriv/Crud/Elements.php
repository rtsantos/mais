<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela profile_object_view_priv
 */
class Profile_Form_ObjectViewPriv_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_profile');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Profile_Form_ObjectViewPriv_Elements
     */
    public function getElement($columnName){
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $this->$method();
    }
     
    
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('profile_object_view_priv.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getIdProfileObjectView(){

        $element = new ZendT_Form_Element_Seeker('id_profile_object_view');
        $element->setSufix('profile_object_view');
        $element->setLabel($this->_translate->_('profile_object_view_priv.id_profile_object_view') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/profile/object-view/grid');
        $element->url()->setSearch('/profile/object-view/seeker-search');
        $element->url()->setRetrive('/profile/object-view/retrive');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getIdPapel(){

        $element = new ZendT_Form_Element_Seeker('id_papel');
        $element->setSufix('papel');
        $element->setLabel($this->_translate->_('profile_object_view_priv.id_papel') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
        $element->url()->setGrid('/auth/papel/grid');
        $element->url()->setSearch('/auth/papel/seeker-search');
        $element->url()->setRetrive('/auth/papel/retrive');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getTipo(){

        $element = new ZendT_Form_Element_Select('tipo');
        $element->setLabel($this->_translate->_('profile_object_view_priv.tipo') . ':');
        $element->addMultiOption('O', 'Administração');
        $element->addMultiOption('S', 'Visualização');        
                
        return $element;
    }
            
}
?>