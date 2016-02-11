<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela at_papel_empresa
 */
class Auth_Form_ContaEmpresa_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_auth');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Form_ContaEmpresa_Elements
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
        $element->setLabel($this->_translate->_('at_papel_empresa.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdPapel(){

        $element = new ZendT_Form_Element_Seeker('id_papel');
        $element->setSuffix('papel');
        $element->setLabel($this->_translate->_('at_papel_empresa.id_papel') . ':');
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
    public function getIdEmpresa(){

        $element = new ZendT_Form_Element_Seeker('id_empresa');
        $element->setSuffix('empresa');
        $element->setLabel($this->_translate->_('at_papel_empresa.id_empresa') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/pessoa/grid');
        $element->url()->setSearch('/ca/pessoa/seeker-search');
        $element->url()->setRetrieve('/ca/pessoa/retrieve');
        $element->setMapperView('Ca_DataView_Pessoa_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getStatus(){

        $element = new ZendT_Form_Element_Select('status');
        $element->setLabel($this->_translate->_('at_papel_empresa.status') . ':');
        $element->addMultiOption('A', 'Ativo');
        $element->addMultiOption('I', 'Inativo');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getPadrao(){

        $element = new ZendT_Form_Element_Select('padrao');
        $element->setLabel($this->_translate->_('at_papel_empresa.padrao') . ':');
        $element->addMultiOption('S', 'Sim');
        $element->addMultiOption('N', 'Não');        
                
        return $element;
    }
            
}
?>