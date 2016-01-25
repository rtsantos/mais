<?php
/**
 * Classe de mapeamento do registro da tabela ca_numeracao
 */
class Ca_Model_Numeracao_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','nome','numero','tamanho','id_empresa');
    protected $_model = 'Ca_Model_Numeracao_Table';
    public static $table = 'mais.ca_numeracao';
    /**
     *
     * @var Ca_Model_Numeracao_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Ca_Model_Numeracao_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Ca_Model_Numeracao_Mapper){
            $this->_dataOld = new Ca_Model_Numeracao_Mapper();
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
                'id_empresa' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
                    'column' => 'id'
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
     * @return Ca_Model_Numeracao_Crud_Mapper
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
     * Retorna os dados da coluna nome
     *
     * @return string
     */
    public function getNome($instance=false){
        if ($instance && !is_object($this->_data['nome'])){
            $this->setNome('',array('required'=>false));
        }
        return $this->_data['nome'];
    }
    /**
     * Seta o valor da coluna nome
     *
     * @param string $value
     * @return Ca_Model_Numeracao_Crud_Mapper
     */
    public function setNome($value,$options=array('required'=>true)){        
        $this->_data['nome'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['nome']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'nome');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 100, ) );
            $valueValid = $this->_data['nome']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna numero
     *
     * @return string
     */
    public function getNumero($instance=false){
        if ($instance && !is_object($this->_data['numero'])){
            $this->setNumero('',array('required'=>false));
        }
        return $this->_data['numero'];
    }
    /**
     * Seta o valor da coluna numero
     *
     * @param string $value
     * @return Ca_Model_Numeracao_Crud_Mapper
     */
    public function setNumero($value,$options=array('required'=>true)){        
        $this->_data['numero'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['numero']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'numero');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna tamanho
     *
     * @return string
     */
    public function getTamanho($instance=false){
        if ($instance && !is_object($this->_data['tamanho'])){
            $this->setTamanho('',array('required'=>false));
        }
        return $this->_data['tamanho'];
    }
    /**
     * Seta o valor da coluna tamanho
     *
     * @param string $value
     * @return Ca_Model_Numeracao_Crud_Mapper
     */
    public function setTamanho($value,$options=array('required'=>true)){        
        $this->_data['tamanho'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['tamanho']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'tamanho');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_empresa
     *
     * @return string
     */
    public function getIdEmpresa($instance=false){
        if ($instance && !is_object($this->_data['id_empresa'])){
            $this->setIdEmpresa('',array('required'=>false));
        }
        return $this->_data['id_empresa'];
    }
    /**
     * Seta o valor da coluna id_empresa
     *
     * @param string $value
     * @return Ca_Model_Numeracao_Crud_Mapper
     */
    public function setIdEmpresa($value,$options=array('required'=>true)){        
        $this->_data['id_empresa'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_empresa']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_empresa');
                    
        }
        return $this;
    }

            
}
?>