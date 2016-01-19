<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela img_aplicacao
 */
class Ged_Form_Aplicacao_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_ged');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ged_Form_Aplicacao_Elements
     */
    public function getElement($columnName){
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $this->$method();
    }
     
    
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('img_aplicacao.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getIdAplicProuser(){

        $element = new ZendT_Form_Element_Seeker('id_aplic_prouser');
        $element->setSufix('aplic_prouser');
        $element->setLabel($this->_translate->_('img_aplicacao.id_aplic_prouser') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('sigla');
        $element->setSearchAttribs(array('width'=>'100px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
        $element->url()->setGrid('/auth/aplicacao/grid');
        $element->url()->setSearch('/auth/aplicacao/seeker-search');
        $element->url()->setRetrive('/auth/aplicacao/retrive');
        $element->enableAutoComplete();
        $element->addValidators(array());
                
        $element->setDisplayField('nome');
        $element->setDisplayAttribs(array('width'=>'170px'));
        return $element;
    }
            
}
?>