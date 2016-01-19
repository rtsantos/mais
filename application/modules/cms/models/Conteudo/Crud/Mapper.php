<?php
/**
 * Classe de mapeamento do registro da tabela cms_conteudo
 */
class Cms_Model_Conteudo_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_categoria','titulo','dh_ini_pub','id_usuario_inc','id_status','publico','chave','chave_macro');
    protected $_model = 'Cms_Model_Conteudo_Table';
    /**
     *
     * @var Cms_Model_Conteudo_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Cms_Model_Conteudo_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Cms_Model_Conteudo_Mapper){
            $this->_dataOld = new Cms_Model_Conteudo_Mapper();
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
                'ID_USUARIO_APROV' => array(
                    'mapper' => 'Auth_DataView_Usuario_MapperView',
                    'column' => 'ID'
                ),
                'ID_FILIAL' => array(
                    'mapper' => 'Ca_DataView_Filial_MapperView',
                    'column' => 'ID'
                ),
                'ID_CATEGORIA' => array(
                    'mapper' => 'Cms_DataView_Categoria_MapperView',
                    'column' => 'ID'
                ),
                'ID_USUARIO_INC' => array(
                    'mapper' => 'Auth_DataView_Usuario_MapperView',
                    'column' => 'ID'
                ),
                'ID_STATUS' => array(
                    'mapper' => 'Cms_DataView_Status_MapperView',
                    'column' => 'ID'
                ),
                'ID_CONTEUDO_PAI' => array(
                    'mapper' => 'Cms_DataView_Conteudo_MapperView',
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
     * @return Cms_Model_Conteudo_Crud_Mapper
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
     * Retorna os dados da coluna id_categoria
     *
     * @return string
     */
    public function getIdCategoria($instance=false){
        if ($instance && !is_object($this->_data['id_categoria'])){
            $this->setIdCategoria('',array('required'=>false));
        }
        return $this->_data['id_categoria'];
    }
    /**
     * Seta o valor da coluna id_categoria
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setIdCategoria($value,$options=array('required'=>true)){        
        $this->_data['id_categoria'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_categoria']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_categoria');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_conteudo_pai
     *
     * @return string
     */
    public function getIdConteudoPai($instance=false){
        if ($instance && !is_object($this->_data['id_conteudo_pai'])){
            $this->setIdConteudoPai('',array('required'=>false));
        }
        return $this->_data['id_conteudo_pai'];
    }
    /**
     * Seta o valor da coluna id_conteudo_pai
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setIdConteudoPai($value,$options=array('required'=>true)){        
        $this->_data['id_conteudo_pai'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_conteudo_pai']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna titulo
     *
     * @return string
     */
    public function getTitulo($instance=false){
        if ($instance && !is_object($this->_data['titulo'])){
            $this->setTitulo('',array('required'=>false));
        }
        return $this->_data['titulo'];
    }
    /**
     * Seta o valor da coluna titulo
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setTitulo($value,$options=array('required'=>true)){        
        $this->_data['titulo'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['titulo']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'titulo');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['titulo']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna sub_titulo
     *
     * @return string
     */
    public function getSubTitulo($instance=false){
        if ($instance && !is_object($this->_data['sub_titulo'])){
            $this->setSubTitulo('',array('required'=>false));
        }
        return $this->_data['sub_titulo'];
    }
    /**
     * Seta o valor da coluna sub_titulo
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setSubTitulo($value,$options=array('required'=>true)){        
        $this->_data['sub_titulo'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['sub_titulo']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['sub_titulo']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dh_ini_pub
     *
     * @return string
     */
    public function getDhIniPub($instance=false){
        if ($instance && !is_object($this->_data['dh_ini_pub'])){
            $this->setDhIniPub('',array('required'=>false));
        }
        return $this->_data['dh_ini_pub'];
    }
    /**
     * Seta o valor da coluna dh_ini_pub
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setDhIniPub($value,$options=array('required'=>true)){        
        $this->_data['dh_ini_pub'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_ini_pub']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'dh_ini_pub');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dh_fim_pub
     *
     * @return string
     */
    public function getDhFimPub($instance=false){
        if ($instance && !is_object($this->_data['dh_fim_pub'])){
            $this->setDhFimPub('',array('required'=>false));
        }
        return $this->_data['dh_fim_pub'];
    }
    /**
     * Seta o valor da coluna dh_fim_pub
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setDhFimPub($value,$options=array('required'=>true)){        
        $this->_data['dh_fim_pub'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_fim_pub']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna corpo
     *
     * @return string
     */
    public function getCorpo($instance=false){
        if ($instance && !is_object($this->_data['corpo'])){
            $this->setCorpo('',array('required'=>false));
        }
        return $this->_data['corpo'];
    }
    /**
     * Seta o valor da coluna corpo
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setCorpo($value,$options=array('required'=>true)){        
        
         $this->_data['corpo'] = new ZendT_Type_Clob($value);
         if ($options['db'])
            $this->_data['corpo']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna arquivo
     *
     * @return string
     */
    public function getArquivo($instance=false){
        if ($instance && !is_object($this->_data['arquivo'])){
            $this->setArquivo('',array('required'=>false));
        }
        return $this->_data['arquivo'];
    }
    /**
     * Seta o valor da coluna arquivo
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setArquivo($value,$options=array('required'=>true)){        
        $this->_data['arquivo'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['arquivo']->setValueFromDb($value);
                    
        if (!$options['db']){
            
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
     * @return Cms_Model_Conteudo_Crud_Mapper
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
     * Retorna os dados da coluna id_usuario_inc
     *
     * @return string
     */
    public function getIdUsuarioInc($instance=false){
        if ($instance && !is_object($this->_data['id_usuario_inc'])){
            $this->setIdUsuarioInc('',array('required'=>false));
        }
        return $this->_data['id_usuario_inc'];
    }
    /**
     * Seta o valor da coluna id_usuario_inc
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setIdUsuarioInc($value,$options=array('required'=>true)){        
        $this->_data['id_usuario_inc'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_usuario_inc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_usuario_inc');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_status
     *
     * @return string
     */
    public function getIdStatus($instance=false){
        if ($instance && !is_object($this->_data['id_status'])){
            $this->setIdStatus('',array('required'=>false));
        }
        return $this->_data['id_status'];
    }
    /**
     * Seta o valor da coluna id_status
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setIdStatus($value,$options=array('required'=>true)){        
        $this->_data['id_status'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_status']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_status');
                    
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
     * @return Cms_Model_Conteudo_Crud_Mapper
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
     * Retorna os dados da coluna banner
     *
     * @return string
     */
    public function getBanner($instance=false){
        if ($instance && !is_object($this->_data['banner'])){
            $this->setBanner('',array('required'=>false));
        }
        return $this->_data['banner'];
    }
    /**
     * Seta o valor da coluna banner
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setBanner($value,$options=array('required'=>true)){        
        $this->_data['banner'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['banner']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna corpo_url
     *
     * @return string
     */
    public function getCorpoUrl($instance=false){
        if ($instance && !is_object($this->_data['corpo_url'])){
            $this->setCorpoUrl('',array('required'=>false));
        }
        return $this->_data['corpo_url'];
    }
    /**
     * Seta o valor da coluna corpo_url
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setCorpoUrl($value,$options=array('required'=>true)){        
        $this->_data['corpo_url'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['corpo_url']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 200, ) );
            $valueValid = $this->_data['corpo_url']->getValueToDb();
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
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setChave($value,$options=array('required'=>true)){        
        $this->_data['chave'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('removeAccent', 'strtolower', 'trim', 'replace' => array('Array','-'), )));
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
     * Retorna os dados da coluna chave_macro
     *
     * @return string
     */
    public function getChaveMacro($instance=false){
        if ($instance && !is_object($this->_data['chave_macro'])){
            $this->setChaveMacro('',array('required'=>false));
        }
        return $this->_data['chave_macro'];
    }
    /**
     * Seta o valor da coluna chave_macro
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setChaveMacro($value,$options=array('required'=>true)){        
        $this->_data['chave_macro'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtolower', 'trim', )));
        if ($options['db'])
            $this->_data['chave_macro']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'chave_macro');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['chave_macro']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_usuario_aprov
     *
     * @return string
     */
    public function getIdUsuarioAprov($instance=false){
        if ($instance && !is_object($this->_data['id_usuario_aprov'])){
            $this->setIdUsuarioAprov('',array('required'=>false));
        }
        return $this->_data['id_usuario_aprov'];
    }
    /**
     * Seta o valor da coluna id_usuario_aprov
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setIdUsuarioAprov($value,$options=array('required'=>true)){        
        $this->_data['id_usuario_aprov'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_usuario_aprov']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_filial
     *
     * @return string
     */
    public function getIdFilial($instance=false){
        if ($instance && !is_object($this->_data['id_filial'])){
            $this->setIdFilial('',array('required'=>false));
        }
        return $this->_data['id_filial'];
    }
    /**
     * Seta o valor da coluna id_filial
     *
     * @param string $value
     * @return Cms_Model_Conteudo_Crud_Mapper
     */
    public function setIdFilial($value,$options=array('required'=>true)){        
        $this->_data['id_filial'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_filial']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>