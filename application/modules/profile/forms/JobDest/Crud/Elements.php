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
     
    
    /**
     *
     * @return \ZendT_Form_Element_Text
     */
    public function getId(){

        $element = new ZendT_Form_Element_Text('id');
        $element->setLabel($this->_translate->_('profile_job_dest.id') . ':');
        $element->setAttribs(array('css-width'=>'100px','maxlength'=>'10'));        
        $element->addValidators(array());
        $element->addAttr('onBlur',"this.value=strtoupper(this.value);this.value=removeAccent(this.value);");
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdProfileJob(){

        $element = new ZendT_Form_Element_Seeker('id_profile_job');
        $element->setSuffix('profile_job');
        $element->setLabel($this->_translate->_('profile_job_dest.id_profile_job') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('descricao');
        $element->setSearchAttribs(array('css-width'=>'400px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(450);
        $element->url()->setGrid('/profile/job/grid');
        $element->url()->setSearch('/profile/job/seeker-search');
        $element->url()->setRetrieve('/profile/job/retrive');
        $element->setMapperView('Profile_DataView_Job_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
    /**
     *
     * @return \ZendT_Form_Element_Seeker
     */
    public function getIdPapel(){

        $element = new ZendT_Form_Element_Seeker('id_papel');
        $element->setSuffix('papel');
        $element->setLabel($this->_translate->_('profile_job_dest.id_papel') . ':');
        $element->setIdField('id');
        $element->setIdAttribs(array());
        $element->setSearchField('nome');
        $element->setSearchAttribs(array('css-width'=>'400px'));
        $element->modal()->setWidth(800);
        $element->modal()->setHeight(400);
        $element->url()->setGrid('/auth/conta/grid');
        $element->url()->setSearch('/auth/conta/seeker-search');
        $element->url()->setRetrieve('/auth/conta/retrive');
        $element->setMapperView('Auth_DataView_Conta_MapperView');
        $element->addValidators(array());
                
        return $element;
    }
            
}
?>