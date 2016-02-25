<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela tl_job
 */
class Tools_Form_Job_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_tools');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Tools_Form_Job_Elements
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
        $element->setLabel($this->_translate->_('tl_job.id') . ':');
        $element->setAttribs(array('css-width'=>'100px'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getDescricao(){

        $element = new ZendT_Form_Element_Text('descricao');
        $element->setLabel($this->_translate->_('tl_job.descricao') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_DateTime
     */
    public function getDhInc(){

        $element = new ZendT_Form_Element_DateTime('dh_inc');
        $element->setLabel($this->_translate->_('tl_job.dh_inc') . ':');
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
    public function getDhIniExec(){

        $element = new ZendT_Form_Element_DateTime('dh_ini_exec');
        $element->setLabel($this->_translate->_('tl_job.dh_ini_exec') . ':');
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
    public function getDhUltExec(){

        $element = new ZendT_Form_Element_DateTime('dh_ult_exec');
        $element->setLabel($this->_translate->_('tl_job.dh_ult_exec') . ':');
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
    public function getDhFimExec(){

        $element = new ZendT_Form_Element_DateTime('dh_fim_exec');
        $element->setLabel($this->_translate->_('tl_job.dh_fim_exec') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px','maxlength'=>'5','id'=>''));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getTpFrequencia(){

        $element = new ZendT_Form_Element_Select('tp_frequencia');
        $element->setLabel($this->_translate->_('tl_job.tp_frequencia') . ':');
        $element->addMultiOption('M', 'Mês');
        $element->addMultiOption('H', 'Hora');
        $element->addMultiOption('D', 'Dia');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getNumFrequencia(){

        $element = new ZendT_Form_Element_Numeric('num_frequencia');
        $element->setLabel($this->_translate->_('tl_job.num_frequencia') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','3');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Select
     */
    public function getFormaExec(){

        $element = new ZendT_Form_Element_Select('forma_exec');
        $element->setLabel($this->_translate->_('tl_job.forma_exec') . ':');
        $element->addMultiOption('C', 'Classe');
        $element->addMultiOption('U', 'Url');        
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getProcedimento(){

        $element = new ZendT_Form_Element_Text('procedimento');
        $element->setLabel($this->_translate->_('tl_job.procedimento') . ':');
        $element->setAttribs(array('maxlength'=>'1000','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getParametro(){

        $element = new ZendT_Form_Element_Text('parametro');
        $element->setLabel($this->_translate->_('tl_job.parametro') . ':');
        $element->setAttribs(array('maxlength'=>'1000','css-width'=>'200px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=trim(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Numeric
     */
    public function getTempoUlExec(){

        $element = new ZendT_Form_Element_Numeric('tempo_ul_exec');
        $element->setLabel($this->_translate->_('tl_job.tempo_ul_exec') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','3');
        $element->setJQueryParam('numInteger','5');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_DateTime
     */
    public function getDhProExec(){

        $element = new ZendT_Form_Element_DateTime('dh_pro_exec');
        $element->setLabel($this->_translate->_('tl_job.dh_pro_exec') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px','maxlength'=>'5','id'=>''));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
}
?>