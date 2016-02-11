<?php
/**
 * Classe de mapeamento do registro da tabela pf_object_view_priv
 */
class Profile_Model_ObjectViewPriv_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_profile_object_view','id_papel');
    protected $_model = 'Profile_Model_ObjectViewPriv_Table';
    public static $table = 'mais.pf_object_view_priv';
    /**
     *
     * @var Profile_Model_ObjectViewPriv_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Profile_Model_ObjectViewPriv_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Profile_Model_ObjectViewPriv_Mapper){
            $this->_dataOld = new Profile_Model_ObjectViewPriv_Mapper();
            $this->_dataOld->setId($this->getId());
            $this->_dataOld->retrive();
        }
        return $this->_dataOld;
    }
    /**
     * Retorna as referências do objeto
     */
    public function getReferenceMap(){
        return array(
                'ID_PAPEL' => array(
                    'mapper' => 'Auth_DataView_Conta_MapperView',
                    'column' => 'ID'
                ),
                'ID_PROFILE_OBJECT_VIEW' => array(
                    'mapper' => 'Profile_DataView_ObjectView_MapperView',
                    'column' => 'ID'
                ));
    }
    /**
     * @retun array
     */
    public function getTabs(){
        return array (
);
    }
    
    
    /**
     * Retorna os dados da coluna id
     *
     * @return string
     */
    public function getId($instance=false){
        if ($instance && !is_object($this->_data['id'])){
            $this->setId('',array('required'=>false));
        }
        return $this->_data['id'];
    }
    /**
     * Seta o valor da coluna id
     *
     * @param string $value
     * @return Profile_Model_ObjectViewPriv_Crud_Mapper
     */
    public function setId($value,$options=array('required'=>true)){        
        $this->_data['id'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_profile_object_view
     *
     * @return string
     */
    public function getIdProfileObjectView($instance=false){
        if ($instance && !is_object($this->_data['id_profile_object_view'])){
            $this->setIdProfileObjectView('',array('required'=>false));
        }
        return $this->_data['id_profile_object_view'];
    }
    /**
     * Seta o valor da coluna id_profile_object_view
     *
     * @param string $value
     * @return Profile_Model_ObjectViewPriv_Crud_Mapper
     */
    public function setIdProfileObjectView($value,$options=array('required'=>true)){        
        $this->_data['id_profile_object_view'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_profile_object_view']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_profile_object_view');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_papel
     *
     * @return string
     */
    public function getIdPapel($instance=false){
        if ($instance && !is_object($this->_data['id_papel'])){
            $this->setIdPapel('',array('required'=>false));
        }
        return $this->_data['id_papel'];
    }
    /**
     * Seta o valor da coluna id_papel
     *
     * @param string $value
     * @return Profile_Model_ObjectViewPriv_Crud_Mapper
     */
    public function setIdPapel($value,$options=array('required'=>true)){        
        $this->_data['id_papel'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_papel']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_papel');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna tipo
     *
     * @return string
     */
    public function getTipo($instance=false){
        if ($instance && !is_object($this->_data['tipo'])){
            $this->setTipo('',array('required'=>false));
        }
        return $this->_data['tipo'];
    }
    /**
     * Seta o valor da coluna tipo
     *
     * @param string $value
     * @return Profile_Model_ObjectViewPriv_Crud_Mapper
     */
    public function setTipo($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('O'=>'Administração','S'=>'Visualização');
        $this->_data['tipo'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['tipo']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>