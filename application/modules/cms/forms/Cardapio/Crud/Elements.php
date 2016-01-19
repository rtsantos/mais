<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela cardapio
 */
class Cms_Form_Cardapio_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_cms');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Cms_Form_Cardapio_Elements
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
        $element->setLabel($this->_translate->_('cardapio.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Date
     */
    public function getDtExibe(){

        $element = new ZendT_Form_Element_Date('dt_exibe');
        $element->setLabel($this->_translate->_('cardapio.dt_exibe') . ':');
        $element->setAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getPtPrincipal(){

        $element = new ZendT_Form_Element_Text('pt_principal');
        $element->setLabel($this->_translate->_('cardapio.pt_principal') . ':');
        $element->setAttribs(array('maxlength'=>'150','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getOpcao(){

        $element = new ZendT_Form_Element_Text('opcao');
        $element->setLabel($this->_translate->_('cardapio.opcao') . ':');
        $element->setAttribs(array('maxlength'=>'150','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getGuarnicao(){

        $element = new ZendT_Form_Element_Text('guarnicao');
        $element->setLabel($this->_translate->_('cardapio.guarnicao') . ':');
        $element->setAttribs(array('maxlength'=>'150','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getArrozFeijao(){

        $element = new ZendT_Form_Element_Select('arroz_feijao');
        $element->setLabel($this->_translate->_('cardapio.arroz_feijao') . ':');
        $element->addMultiOption('A/F', 'Sim');
        $element->addMultiOption('', 'Não');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getSalada(){

        $element = new ZendT_Form_Element_Text('salada');
        $element->setLabel($this->_translate->_('cardapio.salada') . ':');
        $element->setAttribs(array('maxlength'=>'150','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getSobremesa(){

        $element = new ZendT_Form_Element_Text('sobremesa');
        $element->setLabel($this->_translate->_('cardapio.sobremesa') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getSuco(){

        $element = new ZendT_Form_Element_Text('suco');
        $element->setLabel($this->_translate->_('cardapio.suco') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getPtLight(){

        $element = new ZendT_Form_Element_Text('pt_light');
        $element->setLabel($this->_translate->_('cardapio.pt_light') . ':');
        $element->setAttribs(array('maxlength'=>'200','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdFilial(){

        $element = new ZendT_Form_Element_Seeker('id_filial');
        $element->setSuffix('filial');
        $element->setLabel($this->_translate->_('cardapio.id_filial') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('sigla');
        $element->setSearchAttribs(array('size'=>'5'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
        $element->url()->setGrid('/ca/filial/grid');
        $element->url()->setSearch('/ca/filial/seeker-search');
        $element->url()->setRetrieve('/ca/filial/retrive');
        $element->setMapperView('Ca_DataView_Filial_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('nome_cidade');
        $element->setDisplayAttribs(array('size'=>'30'));
        return $element;
    }
            
}
?>