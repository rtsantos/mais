<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela ca_cidade
 */
class Ca_Form_Cidade_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_ca');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ca_Form_Cidade_Elements
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
        $element->setLabel($this->_translate->_('ca_cidade.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getNome(){

        $element = new ZendT_Form_Element_Text('nome');
        $element->setLabel($this->_translate->_('ca_cidade.nome') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getPolo(){

        $element = new ZendT_Form_Element_Select('polo');
        $element->setLabel($this->_translate->_('ca_cidade.polo') . ':');
        $element->addMultiOption('S', 'Sim');
        $element->addMultiOption('N', 'Não');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getClassificacao(){

        $element = new ZendT_Form_Element_Select('classificacao');
        $element->setLabel($this->_translate->_('ca_cidade.classificacao') . ':');
        $element->addMultiOption('I', 'Interior');
        $element->addMultiOption('C', 'Capital');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdEstado(){

        $element = new ZendT_Form_Element_Seeker('id_estado');
        $element->setSuffix('estado');
        $element->setLabel($this->_translate->_('ca_cidade.id_estado') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('uf');
        $element->setSearchAttribs(array('css-width'=>'70px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/estado/grid');
        $element->url()->setSearch('/ca/estado/seeker-search');
        $element->url()->setRetrieve('/ca/estado/retrieve');
        $element->setMapperView('Ca_DataView_Estado_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('nome');
        $element->setDisplayAttribs(array('css-width'=>'200px'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getCodIbge(){

        $element = new ZendT_Form_Element_Text('cod_ibge');
        $element->setLabel($this->_translate->_('ca_cidade.cod_ibge') . ':');
        $element->setAttribs(array('maxlength'=>'20','css-width'=>'175px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getAliqIss(){

        $element = new ZendT_Form_Element_Numeric('aliq_iss');
        $element->setLabel($this->_translate->_('ca_cidade.aliq_iss') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','3');
        $element->setJQueryParam('numInteger','7');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getCep(){

        $element = new ZendT_Form_Element_Text('cep');
        $element->setLabel($this->_translate->_('ca_cidade.cep') . ':');
        $element->setAttribs(array('maxlength'=>'20','css-width'=>'175px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        $element->setMask(array (
  0 => '99.999-99',
));
        $element->setCharMask('9');
        return $element;
    }
            
}
?>