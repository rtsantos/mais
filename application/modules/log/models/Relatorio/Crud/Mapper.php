<?php
/**
 * Classe de mapeamento do registro da tabela log_web_relat
 */
class Log_Model_Relatorio_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','impresso');
    protected $_model = 'Log_Model_Relatorio_Table';
    /**
     *
     * @var Log_Model_Relatorio_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Log_Model_Relatorio_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Log_Model_Relatorio_Mapper){
            $this->_dataOld = new Log_Model_Relatorio_Mapper();
            $this->_dataOld->setId($this->getId());
            $this->_dataOld->retrive();
        }
        return $this->_dataOld;
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
     * @return Log_Model_Relatorio_Crud_Mapper
     */
    public function setId($value,$options=array('required'=>true)){        
        $this->_data['id'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
        if ($options['db'])
            $this->_data['id']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id');
                    
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
     * @return Log_Model_Relatorio_Crud_Mapper
     */
    public function setIdUsuario($value,$options=array('required'=>true)){        
        $this->_data['id_usuario'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
        if ($options['db'])
            $this->_data['id_usuario']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna sessao
     *
     * @return string
     */
    public function getSessao($instance=false){
        if ($instance && !is_object($this->_data['sessao'])){
            $this->setSessao('',array('required'=>false));
        }
        return $this->_data['sessao'];
    }
    /**
     * Seta o valor da coluna sessao
     *
     * @param string $value
     * @return Log_Model_Relatorio_Crud_Mapper
     */
    public function setSessao($value,$options=array('required'=>true)){        
        $this->_data['sessao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['sessao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 40, ) );
            $valueValid = $this->_data['sessao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
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
     * @return Log_Model_Relatorio_Crud_Mapper
     */
    public function setArquivo($value,$options=array('required'=>true)){        
        $this->_data['arquivo'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['arquivo']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['arquivo']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
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
     * @return Log_Model_Relatorio_Crud_Mapper
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
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['titulo']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna dh_ini_exec
     *
     * @return string
     */
    public function getDhIniExec($instance=false){
        if ($instance && !is_object($this->_data['dh_ini_exec'])){
            $this->setDhIniExec('',array('required'=>false));
        }
        return $this->_data['dh_ini_exec'];
    }
    /**
     * Seta o valor da coluna dh_ini_exec
     *
     * @param string $value
     * @return Log_Model_Relatorio_Crud_Mapper
     */
    public function setDhIniExec($value,$options=array('required'=>true)){        
        $this->_data['dh_ini_exec'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_ini_exec']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna dh_fim_exec
     *
     * @return string
     */
    public function getDhFimExec($instance=false){
        if ($instance && !is_object($this->_data['dh_fim_exec'])){
            $this->setDhFimExec('',array('required'=>false));
        }
        return $this->_data['dh_fim_exec'];
    }
    /**
     * Seta o valor da coluna dh_fim_exec
     *
     * @param string $value
     * @return Log_Model_Relatorio_Crud_Mapper
     */
    public function setDhFimExec($value,$options=array('required'=>true)){        
        $this->_data['dh_fim_exec'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_fim_exec']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna dh_fim_relat
     *
     * @return string
     */
    public function getDhFimRelat($instance=false){
        if ($instance && !is_object($this->_data['dh_fim_relat'])){
            $this->setDhFimRelat('',array('required'=>false));
        }
        return $this->_data['dh_fim_relat'];
    }
    /**
     * Seta o valor da coluna dh_fim_relat
     *
     * @param string $value
     * @return Log_Model_Relatorio_Crud_Mapper
     */
    public function setDhFimRelat($value,$options=array('required'=>true)){        
        $this->_data['dh_fim_relat'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_fim_relat']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna qtd_reg
     *
     * @return string
     */
    public function getQtdReg($instance=false){
        if ($instance && !is_object($this->_data['qtd_reg'])){
            $this->setQtdReg('',array('required'=>false));
        }
        return $this->_data['qtd_reg'];
    }
    /**
     * Seta o valor da coluna qtd_reg
     *
     * @param string $value
     * @return Log_Model_Relatorio_Crud_Mapper
     */
    public function setQtdReg($value,$options=array('required'=>true)){        
        $this->_data['qtd_reg'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['qtd_reg']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna impresso
     *
     * @return string
     */
    public function getImpresso($instance=false){
        if ($instance && !is_object($this->_data['impresso'])){
            $this->setImpresso('',array('required'=>false));
        }
        return $this->_data['impresso'];
    }
    /**
     * Seta o valor da coluna impresso
     *
     * @param string $value
     * @return Log_Model_Relatorio_Crud_Mapper
     */
    public function setImpresso($value,$options=array('required'=>true)){        
        $this->_data['impresso'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('strtoupper', )));
        if ($options['db'])
            $this->_data['impresso']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'impresso');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['impresso']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
}
?>