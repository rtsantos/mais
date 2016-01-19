<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela profile_job
 */
class Profile_Form_Job_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_profile');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Profile_Form_Job_Elements
     */
    public function getElement($columnName){
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $this->$method();
    }
     
    
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('profile_job.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getIdProfileObjectView(){

        $element = new ZendT_Form_Element_Seeker('id_profile_object_view');
        $element->setSufix('profile_object_view');
        $element->setLabel($this->_translate->_('profile_job.id_profile_object_view') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'270px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/profile/object-view/grid');
        $element->url()->setSearch('/profile/object-view/seeker-search');
        $element->url()->setRetrive('/profile/object-view/retrive');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getDescricao(){

        $element = new ZendT_Form_Element_Text('descricao');
        $element->setLabel($this->_translate->_('profile_job.descricao') . ':');
        $element->setAttribs(array('maxlength'=>'50','css-width'=>'524px'));        
        $element->addValidators(array('Zend_Validate_StringLength'));
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getDhIniExec(){

        $element = new ZendT_Form_Element_DateTime('dh_ini_exec');
        $element->setLabel($this->_translate->_('profile_job.dh_ini_exec') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    public function getDhUltExec(){

        $element = new ZendT_Form_Element_DateTime('dh_ult_exec');
        $element->setLabel($this->_translate->_('profile_job.dh_ult_exec') . ':');
        $element->setDateAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->setTimeAttribs(array('css-width'=>'43.75px;','maxlength'=>'5'));
        $element->addValidators(array());
        /*$element->renderDateTime();*/
                
        return $element;
    }
            
    public function getTipo(){

        $element = new ZendT_Form_Element_Select('tipo');
        $element->setLabel($this->_translate->_('profile_job.tipo') . ':');
        $element->addMultiOption('1', 'Minuto');
        $element->addMultiOption('2', 'Hora');
        $element->addMultiOption('3', 'Dia');
        $element->addMultiOption('4', 'Mês');        
                
        return $element;
    }
            
    public function getFrequencia(){

        $element = new ZendT_Form_Element_Numeric('frequencia');
        $element->setLabel($this->_translate->_('profile_job.frequencia') . ':');
        $element->setAttribs(array());
        $element->setJQueryParam('numDecimal','');
        $element->setJQueryParam('numInteger','4');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getDtFimExec(){

        $element = new ZendT_Form_Element_Date('dt_fim_exec');
        $element->setLabel($this->_translate->_('profile_job.dt_fim_exec') . ':');
        $element->setAttribs(array('css-width'=>'87.5px','maxlength'=>'10'));
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>