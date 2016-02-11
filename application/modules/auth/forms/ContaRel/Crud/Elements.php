<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela at_papel_rel
 */
class Auth_Form_ContaRel_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_auth');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Form_ContaRel_Elements
     */
    public function getElement($columnName){
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $this->$method();
    }
     
    
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('at_papel_rel.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdPapel(){

        $element = new ZendT_Form_Element_Seeker('id_papel');
        $element->setSuffix('papel');
        $element->setLabel($this->_translate->_('at_papel_rel.id_papel') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('hierarquia');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/auth/conta/grid');
        $element->url()->setSearch('/auth/conta/seeker-search');
        $element->url()->setRetrieve('/auth/conta/retrieve');
        $element->setMapperView('Auth_DataView_Conta_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdPapelRel(){

        $element = new ZendT_Form_Element_Seeker('id_papel_rel');
        $element->setSuffix('papel_rel');
        $element->setLabel($this->_translate->_('at_papel_rel.id_papel_rel') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('hierarquia');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/auth/conta/grid');
        $element->url()->setSearch('/auth/conta/seeker-search');
        $element->url()->setRetrieve('/auth/conta/retrieve');
        $element->setMapperView('Auth_DataView_Conta_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getStatus(){

        $element = new ZendT_Form_Element_Select('status');
        $element->setLabel($this->_translate->_('at_papel_rel.status') . ':');
        $element->addMultiOption('A', 'Ativo');
        $element->addMultiOption('I', 'Inativo');        
                
        return $element;
    }
            
}
?>