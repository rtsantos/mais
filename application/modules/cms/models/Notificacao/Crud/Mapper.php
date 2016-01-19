<?php
/**
 * Classe de mapeamento do registro da tabela cms_notificacao
 */
class Cms_Model_Notificacao_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id_conteudo','id_usuario');
    protected $_model = 'Cms_Model_Notificacao_Table';
    /**
     *
     * @var Cms_Model_Notificacao_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Cms_Model_Notificacao_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Cms_Model_Notificacao_Mapper){
            $this->_dataOld = new Cms_Model_Notificacao_Mapper();
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
                'ID_MAILLIST' => array(
                    'mapper' => 'Tools_DataView_Maillist_MapperView',
                    'column' => 'ID'
                ),
                'ID_USUARIO' => array(
                    'mapper' => 'Auth_DataView_Usuario_MapperView',
                    'column' => 'ID'
                ),
                'ID_CONTEUDO' => array(
                    'mapper' => 'Cms_DataView_Conteudo_MapperView',
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
     * @return Cms_Model_Notificacao_Crud_Mapper
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
     * @return Cms_Model_Notificacao_Crud_Mapper
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
     * Retorna os dados da coluna id_maillist
     *
     * @return string
     */
    public function getIdMaillist($instance=false){
        if ($instance && !is_object($this->_data['id_maillist'])){
            $this->setIdMaillist('',array('required'=>false));
        }
        return $this->_data['id_maillist'];
    }
    /**
     * Seta o valor da coluna id_maillist
     *
     * @param string $value
     * @return Cms_Model_Notificacao_Crud_Mapper
     */
    public function setIdMaillist($value,$options=array('required'=>true)){        
        $this->_data['id_maillist'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_maillist']->setValueFromDb($value);
                    
        if (!$options['db']){
            
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
            $string = $this->_data['id_conteudo'].'-'.$this->_data['id_usuario'];
            $this->_id = $string;
        }
        $result = new ZendT_Type_Default($string);
        return $result;
    }
    /**
     * Configura o dado na coluna ID
     *
     * @param string $value
     * @return Cms_Model_Notificacao_Crud_Mapper
     */
    public function setId($value,$options=array('required'=>true)){
        #if (!$options['db']){
            
            $this->_id = $value;
            $values = explode('-',$value);

            $this->_data['id_conteudo'] = $values[0];
            $this->_data['id_usuario'] = $values[1];
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