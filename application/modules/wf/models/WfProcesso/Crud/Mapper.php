<?php
/**
 * Classe de mapeamento do registro da tabela wf_processo
 */
class Wf_Model_WfProcesso_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id');
    protected $_model = 'Wf_Model_WfProcesso_Table';

    
    /**
     * Retorna os dados da coluna id
     *
     * @return string
     */
    public function getId(){
        return $this->_data['id'];
    }
    /**
     * Seta o valor da coluna id
     *
     * @param string $value
     * @return Wf_Model_WfProcesso_Crud_Mapper
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
     * Retorna os dados da coluna descricao
     *
     * @return string
     */
    public function getDescricao(){
        return $this->_data['descricao'];
    }
    /**
     * Seta o valor da coluna descricao
     *
     * @param string $value
     * @return Wf_Model_WfProcesso_Crud_Mapper
     */
    public function setDescricao($value,$options=array('required'=>true)){        
        $this->_data['descricao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filter'=>array()));
        if ($options['db'])
            $this->_data['descricao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['descricao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
            
    /**
     * Retorna os dados da coluna id_aplicacao
     *
     * @return string
     */
    public function getIdAplicacao(){
        return $this->_data['id_aplicacao'];
    }
    /**
     * Seta o valor da coluna id_aplicacao
     *
     * @param string $value
     * @return Wf_Model_WfProcesso_Crud_Mapper
     */
    public function setIdAplicacao($value,$options=array('required'=>true)){        
        $this->_data['id_aplicacao'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
        if ($options['db'])
            $this->_data['id_aplicacao']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }
            
}
?>