<?php

   /**
    * Classe de mapeamento do registro da tabela ca_contrato
    */
   class Ca_Model_Contrato_Mapper extends Ca_Model_Contrato_Crud_Mapper {

       public function _beforeSave() {
           parent::_beforeSave();

           if ($this->_action == 'insert' && !$this->getNumero(true)->toPhp()) {
               $_numeracao = new Ca_Model_Numeracao_Mapper();
               $numero = $_numeracao->proximo(self::$table . '.numero'
                                             ,$this->getIdEmpresa(true)->toPhp());
               $this->setNumero($numero);
           }
       }

   }

?>