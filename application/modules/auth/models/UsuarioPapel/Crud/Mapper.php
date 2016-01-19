<?php
/**
 * Classe de mapeamento do registro da tabela usuario_papel
 */
class Auth_Model_UsuarioPapel_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id_usuario','id_papel','prioridade');
    protected $_model = 'Auth_Model_UsuarioPapel_Table';
    /**
     *
     * @var Auth_Model_UsuarioPapel_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Auth_Model_UsuarioPapel_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Auth_Model_UsuarioPapel_Mapper){
            $this->_dataOld = new Auth_Model_UsuarioPapel_Mapper();
            $this->_dataOld->setId($this->getId());
            $this->_dataOld->retrive();
        }
        return $this->_dataOld;
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
     * @return Auth_Model_UsuarioPapel_Crud_Mapper
     */
    public function setIdUsuario($value,$options=array('required'=>true)){        
        $this->_data['id_usuario'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_usuario']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_usuario');
                    
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
     * @return Auth_Model_UsuarioPapel_Crud_Mapper
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
     * Retorna os dados da coluna prioridade
     *
     * @return string
     */
    public function getPrioridade($instance=false){
        if ($instance && !is_object($this->_data['prioridade'])){
            $this->setPrioridade('',array('required'=>false));
        }
        return $this->_data['prioridade'];
    }
    /**
     * Seta o valor da coluna prioridade
     *
     * @param string $value
     * @return Auth_Model_UsuarioPapel_Crud_Mapper
     */
    public function setPrioridade($value,$options=array('required'=>true)){        
        $this->_data['prioridade'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['prioridade']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'prioridade');
                    
        }
        return $this;
    }
            
    /**
     * Retorna o dado da coluna ID
     *
     * @return string
     */
    public function getId($instance=false,$retDataId=true){
        if ($retDataId && $this->_id){
            $string = $this->_id;
        }else{            
            $string = $this->_data['id_usuario'].'-'.$this->_data['id_papel'];
            $this->_id = $string;
        }
        $result = new ZendT_Type_Default($string);
        return $result;
    }
    /**
     * Configura o dado na coluna ID
     *
     * @param string $value
     * @return Auth_Model_UsuarioPapel_Crud_Mapper
     */
    public function setId($value,$options=array('required'=>true)){
        #if (!$options['db']){
            
            $this->_id = $value;
            $values = explode('-',$value);

            $this->_data['id_usuario'] = $values[0];
            $this->_data['id_papel'] = $values[1];
        #}
        return $this;
    }
    /**
     * Altera o registro da tabela
     *
     * @param ZendT_Db_Where
     * @return int|array
     */
    public function update($where=null){
        if ($where == null){
            $where = $this->getValueOld()->getWhere();
        }
        return parent::update($where);
    }
            
}
?>