<?php

   /**
    * Classe de mapeamento do registro da tabela cv_item_pedido
    */
   class Vendas_Model_ItemPedido_Mapper extends Vendas_Model_ItemPedido_Crud_Mapper {

       public function _beforeSave() {
           if ($this->getIdUsuInc(true)->toPhp() == '') {
               $this->setIdUsuInc(Auth_Session_User::getInstance()->getId());
           }

           $this->setIdUsuAlt(Auth_Session_User::getInstance()->getId());
       }

   }
?>