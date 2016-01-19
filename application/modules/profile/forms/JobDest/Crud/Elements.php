<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela profile_job_dest
 */
class Profile_Form_JobDest_Crud_Elements
{
    protected $_translate;

    public function __construct(){
        $this->_translate = Zend_Registry::get('translate_profile');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Profile_Form_JobDest_Elements
     */
    public function getElement($columnName){
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $this->$method();
    }
     
    
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('profile_job_dest.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);");
        $element->addAttr('onBlur',"this.value=removeAccent(this.value);");
        return $element;
    }
            
    public function getIdProfileJob(){

        $element = new ZendT_Form_Element_Seeker('id_profile_job');
        $element->setSufix('profile_job');
        $element->setLabel($this->_translate->_('profile_job_dest.id_profile_job') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('descricao');
        $element->setSearchAttribs(array('css-width'=>'400px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/profile/job/grid');
        $element->url()->setSearch('/profile/job/seeker-search');
        $element->url()->setRetrive('/profile/job/retrive');
        $element->addValidators(array());
                
        return $element;
    }
            
    public function getIdPapel(){

        $element = new ZendT_Form_Element_Seeker('id_papel');
        $element->setSufix('papel');
        $element->setLabel($this->_translate->_('profile_job_dest.id_papel') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'400px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
        $element->url()->setGrid('/auth/papel/grid');
        $element->url()->setSearch('/auth/papel/seeker-search');
        $element->url()->setRetrive('/auth/papel/retrive');
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>