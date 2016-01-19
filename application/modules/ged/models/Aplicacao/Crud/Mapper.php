<?php
/**
 * Classe de mapeamento do registro da tabela img_aplicacao
 */
class Ged_Model_Aplicacao_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_aplic_prouser');
    protected $_model = 'Ged_Model_Aplicacao_Table';
    /**
     *
     * @var Ged_Model_Aplicacao_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Ged_Model_Aplicacao_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Ged_Model_Aplicacao_Mapper){
            $this->_dataOld = new Ged_Model_Aplicacao_Mapper();
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
     * @return Ged_Model_Aplicacao_Crud_Mapper
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
     * Retorna os dados da coluna id_aplic_prouser
     *
     * @return string
     */
    public function getIdAplicProuser($instance=false){
        if ($instance && !is_object($this->_data['id_aplic_prouser'])){
            $this->setIdAplicProuser('',array('required'=>false));
        }
        return $this->_data['id_aplic_prouser'];
    }
    /**
     * Seta o valor da coluna id_aplic_prouser
     *
     * @param string $value
     * @return Ged_Model_Aplicacao_Crud_Mapper
     */
    public function setIdAplicProuser($value,$options=array('required'=>true)){        
        $this->_data['id_aplic_prouser'] = new ZendT_Type_Number($value,array('numDecimal'=>NULL));
         if ($options['db'])
            $this->_data['id_aplic_prouser']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_aplic_prouser');
                    
        }
        return $this;
    }
            
}
?>