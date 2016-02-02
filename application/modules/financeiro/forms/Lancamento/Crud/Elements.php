<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela fc_lancamento
 */
class Financeiro_Form_Lancamento_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_financeiro');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Financeiro_Form_Lancamento_Elements
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
        $element->setLabel($this->_translate->_('fc_lancamento.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getIdEmpresa(){

        $element = new ZendT_Form_Element_Numeric('id_empresa');
        $element->setLabel($this->_translate->_('fc_lancamento.id_empresa') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getTipo(){

        $element = new ZendT_Form_Element_Select('tipo');
        $element->setLabel($this->_translate->_('fc_lancamento.tipo') . ':');
        $element->addMultiOption('D', 'Débito');
        $element->addMultiOption('C', 'Crédito');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getDescricao(){

        $element = new ZendT_Form_Element_Text('descricao');
        $element->setLabel($this->_translate->_('fc_lancamento.descricao') . ':');
        $element->setAttribs(array('maxlength'=>'100','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_DateTime
     */
    public function getIdUsuInc(){

        $element = new ZendT_Form_Element_DateTime('id_usu_inc');
        $element->setLabel($this->_translate->_('fc_lancamento.id_usu_inc') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px','maxlength'=>'5','id'=>''));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_DateTime
     */
    public function getDhInc(){

        $element = new ZendT_Form_Element_DateTime('dh_inc');
        $element->setLabel($this->_translate->_('fc_lancamento.dh_inc') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px','maxlength'=>'5','id'=>''));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Date
     */
    public function getDtLanc(){

        $element = new ZendT_Form_Element_Date('dt_lanc');
        $element->setLabel($this->_translate->_('fc_lancamento.dt_lanc') . ':');
        $element->setAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getVlrLanc(){

        $element = new ZendT_Form_Element_Numeric('vlr_lanc');
        $element->setLabel($this->_translate->_('fc_lancamento.vlr_lanc') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','4');
        $element->setJQueryParam('numInteger','11');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getVlrSaldo(){

        $element = new ZendT_Form_Element_Numeric('vlr_saldo');
        $element->setLabel($this->_translate->_('fc_lancamento.vlr_saldo') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','4');
        $element->setJQueryParam('numInteger','11');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getUltimo(){

        $element = new ZendT_Form_Element_Text('ultimo');
        $element->setLabel($this->_translate->_('fc_lancamento.ultimo') . ':');
        $element->setAttribs(array('maxlength'=>'1','css-width'=>'100px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getStatus(){

        $element = new ZendT_Form_Element_Select('status');
        $element->setLabel($this->_translate->_('fc_lancamento.status') . ':');
        $element->addMultiOption('A', 'Ativo');
        $element->addMultiOption('I', 'Inativo');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getIdFavorecido(){

        $element = new ZendT_Form_Element_Numeric('id_favorecido');
        $element->setLabel($this->_translate->_('fc_lancamento.id_favorecido') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','');
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>