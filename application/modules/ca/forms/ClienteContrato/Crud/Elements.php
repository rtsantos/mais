<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela ca_cliente_contrato
 */
class Ca_Form_ClienteContrato_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_ca');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Ca_Form_ClienteContrato_Elements
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
        $element->setLabel($this->_translate->_('ca_cliente_contrato.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdCliente(){

        $element = new ZendT_Form_Element_Seeker('id_cliente');
        $element->setSuffix('cliente');
        $element->setLabel($this->_translate->_('ca_cliente_contrato.id_cliente') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/pessoa/grid/profile_key/cliente');
        $element->url()->setSearch('/ca/pessoa/seeker-search/profile_key/cliente');
        $element->url()->setRetrieve('/ca/pessoa/retrieve/profile_key/cliente');
        $element->setMapperView('Ca_DataView_Pessoa_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdContrato(){

        $element = new ZendT_Form_Element_Seeker('id_contrato');
        $element->setSuffix('contrato');
        $element->setLabel($this->_translate->_('ca_cliente_contrato.id_contrato') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('numero');
        $element->setSearchAttribs(array('css-width'=>'70px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/ca/contrato/grid');
        $element->url()->setSearch('/ca/contrato/seeker-search');
        $element->url()->setRetrieve('/ca/contrato/retrieve');
        $element->setMapperView('Ca_DataView_Contrato_MapperView');
        $element->addValidators(array());
                
        $element->setDisplayField('descricao');
        $element->setDisplayAttribs(array('css-width'=>'200px'));
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Date
     */
    public function getDtIniVig(){

        $element = new ZendT_Form_Element_Date('dt_ini_vig');
        $element->setLabel($this->_translate->_('ca_cliente_contrato.dt_ini_vig') . ':');
        $element->setAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Date
     */
    public function getDtFimVig(){

        $element = new ZendT_Form_Element_Date('dt_fim_vig');
        $element->setLabel($this->_translate->_('ca_cliente_contrato.dt_fim_vig') . ':');
        $element->setAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getStatus(){

        $element = new ZendT_Form_Element_Select('status');
        $element->setLabel($this->_translate->_('ca_cliente_contrato.status') . ':');
        $element->addMultiOption('A', 'Ativo');
        $element->addMultiOption('I', 'Inativo');        
                
        return $element;
    }
            
}
?>