<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela cms_status
 */
class Cms_Form_Status_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_cms');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Cms_Form_Status_Elements
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
        $element->setLabel($this->_translate->_('cms_status.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getDescricao(){

        $element = new ZendT_Form_Element_Text('descricao');
        $element->setLabel($this->_translate->_('cms_status.descricao') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getStatus(){

        $element = new ZendT_Form_Element_Select('status');
        $element->setLabel($this->_translate->_('cms_status.status') . ':');
        $element->addMultiOption('A', 'Ativo');
        $element->addMultiOption('I', 'Inativo');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getAcao(){

        $element = new ZendT_Form_Element_Select('acao');
        $element->setLabel($this->_translate->_('cms_status.acao') . ':');
        $element->addMultiOption('P', 'Pendente');
        $element->addMultiOption('A', 'Aprovado');
        $element->addMultiOption('F', 'Finalizado');
        $element->addMultiOption('C', 'Cancelado');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdCategoria(){

        $element = new ZendT_Form_Element_Seeker('id_categoria');
        $element->setSuffix('categoria');
        $element->setLabel($this->_translate->_('cms_status.id_categoria') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('descricao');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/cms/categoria/grid');
        $element->url()->setSearch('/cms/categoria/seeker-search');
        $element->url()->setRetrieve('/cms/categoria/retrieve');
        $element->setMapperView('Cms_DataView_Categoria_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>