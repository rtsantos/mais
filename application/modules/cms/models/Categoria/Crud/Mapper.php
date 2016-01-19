<?php
/**
 * Classe de mapeamento do registro da tabela cms_categoria
 */
class Cms_Model_Categoria_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','descricao','tipo','status','publico','menu','ordem','chave','nivel');
    protected $_model = 'Cms_Model_Categoria_Table';
    /**
     *
     * @var Cms_Model_Categoria_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Cms_Model_Categoria_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Cms_Model_Categoria_Mapper){
            $this->_dataOld = new Cms_Model_Categoria_Mapper();
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
                'ID_CATEGORIA_PAI' => array(
                    'mapper' => 'Cms_DataView_Categoria_MapperView',
                    'column' => 'ID'
                ));
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
     * @return Cms_Model_Categoria_Crud_Mapper
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
     * Retorna os dados da coluna descricao
     *
     * @return string
     */
    public function getDescricao($instance=false){
        if ($instance && !is_object($this->_data['descricao'])){
            $this->setDescricao('',array('required'=>false));
        }
        return $this->_data['descricao'];
    }
    /**
     * Seta o valor da coluna descricao
     *
     * @param string $value
     * @return Cms_Model_Categoria_Crud_Mapper
     */
    public function setDescricao($value,$options=array('required'=>true)){        
        $this->_data['descricao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['descricao']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'descricao');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['descricao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_categoria_pai
     *
     * @return string
     */
    public function getIdCategoriaPai($instance=false){
        if ($instance && !is_object($this->_data['id_categoria_pai'])){
            $this->setIdCategoriaPai('',array('required'=>false));
        }
        return $this->_data['id_categoria_pai'];
    }
    /**
     * Seta o valor da coluna id_categoria_pai
     *
     * @param string $value
     * @return Cms_Model_Categoria_Crud_Mapper
     */
    public function setIdCategoriaPai($value,$options=array('required'=>true)){        
        $this->_data['id_categoria_pai'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_categoria_pai']->setValueFromDb($value);
                    
        if (!$options['db']){
            
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
     * @return Cms_Model_Categoria_Crud_Mapper
     */
    public function setTipo($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('C'=>'Categoria','S'=>'Seção','A'=>'Assunto');
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
     * Retorna os dados da coluna status
     *
     * @return string
     */
    public function getStatus($instance=false){
        if ($instance && !is_object($this->_data['status'])){
            $this->setStatus('',array('required'=>false));
        }
        return $this->_data['status'];
    }
    /**
     * Seta o valor da coluna status
     *
     * @param string $value
     * @return Cms_Model_Categoria_Crud_Mapper
     */
    public function setStatus($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('A'=>'Ativo','I'=>'Inativo');
        $this->_data['status'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['status']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'status');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['status']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna publico
     *
     * @return string
     */
    public function getPublico($instance=false){
        if ($instance && !is_object($this->_data['publico'])){
            $this->setPublico('',array('required'=>false));
        }
        return $this->_data['publico'];
    }
    /**
     * Seta o valor da coluna publico
     *
     * @param string $value
     * @return Cms_Model_Categoria_Crud_Mapper
     */
    public function setPublico($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('S'=>'Sim','N'=>'Não');
        $this->_data['publico'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['publico']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'publico');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['publico']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna menu
     *
     * @return string
     */
    public function getMenu($instance=false){
        if ($instance && !is_object($this->_data['menu'])){
            $this->setMenu('',array('required'=>false));
        }
        return $this->_data['menu'];
    }
    /**
     * Seta o valor da coluna menu
     *
     * @param string $value
     * @return Cms_Model_Categoria_Crud_Mapper
     */
    public function setMenu($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('N'=>'Não','S'=>'Sim');
        $this->_data['menu'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['menu']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'menu');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['menu']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna observacao
     *
     * @return string
     */
    public function getObservacao($instance=false){
        if ($instance && !is_object($this->_data['observacao'])){
            $this->setObservacao('',array('required'=>false));
        }
        return $this->_data['observacao'];
    }
    /**
     * Seta o valor da coluna observacao
     *
     * @param string $value
     * @return Cms_Model_Categoria_Crud_Mapper
     */
    public function setObservacao($value,$options=array('required'=>true)){        
        $this->_data['observacao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['observacao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['observacao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna ordem
     *
     * @return string
     */
    public function getOrdem($instance=false){
        if ($instance && !is_object($this->_data['ordem'])){
            $this->setOrdem('',array('required'=>false));
        }
        return $this->_data['ordem'];
    }
    /**
     * Seta o valor da coluna ordem
     *
     * @param string $value
     * @return Cms_Model_Categoria_Crud_Mapper
     */
    public function setOrdem($value,$options=array('required'=>true)){        
        $this->_data['ordem'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['ordem']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'ordem');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna thumbnail
     *
     * @return string
     */
    public function getThumbnail($instance=false){
        if ($instance && !is_object($this->_data['thumbnail'])){
            $this->setThumbnail('',array('required'=>false));
        }
        return $this->_data['thumbnail'];
    }
    /**
     * Seta o valor da coluna thumbnail
     *
     * @param string $value
     * @return Cms_Model_Categoria_Crud_Mapper
     */
    public function setThumbnail($value,$options=array('required'=>true)){        
        $this->_data['thumbnail'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['thumbnail']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna url
     *
     * @return string
     */
    public function getUrl($instance=false){
        if ($instance && !is_object($this->_data['url'])){
            $this->setUrl('',array('required'=>false));
        }
        return $this->_data['url'];
    }
    /**
     * Seta o valor da coluna url
     *
     * @param string $value
     * @return Cms_Model_Categoria_Crud_Mapper
     */
    public function setUrl($value,$options=array('required'=>true)){        
        $this->_data['url'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', )));
        if ($options['db'])
            $this->_data['url']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 200, ) );
            $valueValid = $this->_data['url']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna chave
     *
     * @return string
     */
    public function getChave($instance=false){
        if ($instance && !is_object($this->_data['chave'])){
            $this->setChave('',array('required'=>false));
        }
        return $this->_data['chave'];
    }
    /**
     * Seta o valor da coluna chave
     *
     * @param string $value
     * @return Cms_Model_Categoria_Crud_Mapper
     */
    public function setChave($value,$options=array('required'=>true)){        
        $this->_data['chave'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('removeAccent', 'strtolower', 'trim', 'replace' => array(' ','-'), )));
        if ($options['db'])
            $this->_data['chave']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'chave');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['chave']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna nivel
     *
     * @return string
     */
    public function getNivel($instance=false){
        if ($instance && !is_object($this->_data['nivel'])){
            $this->setNivel('',array('required'=>false));
        }
        return $this->_data['nivel'];
    }
    /**
     * Seta o valor da coluna nivel
     *
     * @param string $value
     * @return Cms_Model_Categoria_Crud_Mapper
     */
    public function setNivel($value,$options=array('required'=>true)){        
        $this->_data['nivel'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['nivel']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'nivel');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna url_macro
     *
     * @return string
     */
    public function getUrlMacro($instance=false){
        if ($instance && !is_object($this->_data['url_macro'])){
            $this->setUrlMacro('',array('required'=>false));
        }
        return $this->_data['url_macro'];
    }
    /**
     * Seta o valor da coluna url_macro
     *
     * @param string $value
     * @return Cms_Model_Categoria_Crud_Mapper
     */
    public function setUrlMacro($value,$options=array('required'=>true)){        
        $this->_data['url_macro'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('removeAccent', )));
        if ($options['db'])
            $this->_data['url_macro']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 200, ) );
            $valueValid = $this->_data['url_macro']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
}
?>