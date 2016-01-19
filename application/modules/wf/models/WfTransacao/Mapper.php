<?php
/**
 * Classe de mapeamento do registro da tabela wf_transacao
 */
class Wf_Model_WfTransacao_Mapper extends Wf_Model_WfTransacao_Crud_Mapper
{
    /**
     * Seta o valor da coluna observacao
     *
     * @param string $value
     * @return Wf_Model_WfTransacao_Crud_Mapper
     */
    public function setObservacao($value,$options=array('required'=>true)){
        
         $this->_data['observacao'] = new ZendT_Type_String($value);
         if ($options['db'])
            $this->_data['observacao']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 300, ) );
            $valueValid = $this->_data['observacao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }
}
?>