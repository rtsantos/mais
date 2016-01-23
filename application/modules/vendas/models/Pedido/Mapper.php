<?php

   /**
    * Classe de mapeamento do registro da tabela cv_pedido
    */
   class Vendas_Model_Pedido_Mapper extends Vendas_Model_Pedido_Crud_Mapper {

       public function _beforeSave() {
           parent::_beforeSave();

           if ($this->_action == 'insert' && !$this->getNumero(true)->toPhp()) {
               $_numeracao = new Ca_Model_Numeracao_Mapper();
               $numero = $_numeracao->proximo(self::$table . '.numero');
               $this->setNumero($numero);
           }
       }

   }

?>