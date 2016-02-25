<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela cv_log_pedido
 */
class Vendas_Form_LogPedido_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_vendas');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Vendas_Form_LogPedido_Elements
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
        $element->setLabel($this->_translate->_('cv_log_pedido.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdPedido(){

        $element = new ZendT_Form_Element_Seeker('id_pedido');
        $element->setSuffix('pedido');
        $element->setLabel($this->_translate->_('cv_log_pedido.id_pedido') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('numero');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/vendas/pedido/grid');
        $element->url()->setSearch('/vendas/pedido/seeker-search');
        $element->url()->setRetrieve('/vendas/pedido/retrieve');
        $element->setMapperView('Vendas_DataView_Pedido_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_DateTime
     */
    public function getDhLog(){

        $element = new ZendT_Form_Element_DateTime('dh_log');
        $element->setLabel($this->_translate->_('cv_log_pedido.dh_log') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px','maxlength'=>'5','id'=>''));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getMensagem(){

        $element = new ZendT_Form_Element_Text('mensagem');
        $element->setLabel($this->_translate->_('cv_log_pedido.mensagem') . ':');
        $element->setAttribs(array('maxlength'=>'1000','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);");
        return $element;
    }
            
}
?>