<?php
/**
 * Classe de mapeamento do registro da tabela cms_priv_conteudo
 */
class Cms_Model_PrivConteudo_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id_conteudo','id','tipo','env_email');
    protected $_model = 'Cms_Model_PrivConteudo_Table';
    /**
     *
     * @var Cms_Model_PrivConteudo_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Cms_Model_PrivConteudo_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Cms_Model_PrivConteudo_Mapper){
            $this->_dataOld = new Cms_Model_PrivConteudo_Mapper();
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
                'ID_USUARIO' => array(
                    'mapper' => 'Auth_DataView_Usuario_MapperView',
                    'column' => 'ID'
                ),
                'ID_CONTEUDO' => array(
                    'mapper' => 'Cms_DataView_Conteudo_MapperView',
                    'column' => 'ID'
                ),
                'ID_PAPEL' => array(
                    'mapper' => 'Auth_DataView_Papel_MapperView',
                    'column' => 'ID'
                ));
    }
    
    
    /**
     * Retorna os dados da coluna id_conteudo
     *
     * @return string
     */
    public function getIdConteudo($instance=false){
        if ($instance && !is_object($this->_data['id_conteudo'])){
            $this->setIdConteudo('',array('required'=>false));
        }
        return $this->_data['id_conteudo'];
    }
    /**
     * Seta o valor da coluna id_conteudo
     *
     * @param string $value
     * @return Cms_Model_PrivConteudo_Crud_Mapper
     */
    public function setIdConteudo($value,$options=array('required'=>true)){        
        $this->_data['id_conteudo'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_conteudo']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_conteudo');
                    
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
     * @return Cms_Model_PrivConteudo_Crud_Mapper
     */
    public function setIdPapel($value,$options=array('required'=>true)){        
        $this->_data['id_papel'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_papel']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
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
     * @return Cms_Model_PrivConteudo_Crud_Mapper
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
     * @return Cms_Model_PrivConteudo_Crud_Mapper
     */
    public function setTipo($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('A'=>'Administração','V'=>'Visualização');
        $this->_data['tipo'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['tipo']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'tipo');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['tipo']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna env_email
     *
     * @return string
     */
    public function getEnvEmail($instance=false){
        if ($instance && !is_object($this->_data['env_email'])){
            $this->setEnvEmail('',array('required'=>false));
        }
        return $this->_data['env_email'];
    }
    /**
     * Seta o valor da coluna env_email
     *
     * @param string $value
     * @return Cms_Model_PrivConteudo_Crud_Mapper
     */
    public function setEnvEmail($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('S'=>'Sim','N'=>'Não');
        $this->_data['env_email'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['env_email']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'env_email');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['env_email']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_usuario
     *
     * @return string
     */
    public function getIdUsuario($instance=false){
        if ($instance && !is_object($this->_data['id_usuario'])){
            $this->setIdUsuario('',array('required'=>false));
        }
        return $this->_data['id_usuario'];
    }
    /**
     * Seta o valor da coluna id_usuario
     *
     * @param string $value
     * @return Cms_Model_PrivConteudo_Crud_Mapper
     */
    public function setIdUsuario($value,$options=array('required'=>true)){        
        $this->_data['id_usuario'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_usuario']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>