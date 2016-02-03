<?php

   /**
    * Classe de mapeamento do registro da tabela cv_item_pedido
    */
   class Vendas_Model_ItemPedido_Mapper extends Vendas_Model_ItemPedido_Crud_Mapper {

       public function _beforeSave() {
           if ($this->_action != 'delete') {
               if ($this->getIdUsuInc(true)->toPhp() == '') {
                   $this->setIdUsuInc(Auth_Session_User::getInstance()->getId());
               }

               $this->setIdUsuAlt(Auth_Session_User::getInstance()->getId());

               if ($this->getQtdItem(true)->toPhp() == '') {
                   $this->setQtdItem(1);
               }

               if ($this->getPerAcre(true)->toPhp() == '') {
                   $this->setPerAcre(0);
               }

               if ($this->getPerDesc(true)->toPhp() == '') {
                   $this->setPerDesc(0);
               }

               if ($this->getVlrItem(true)->toPhp() == '') {
                   $_pedido = new Vendas_DataView_Pedido_MapperView();
                   $_pedido->setId($this->getIdPedido())->retrieve();

                   $_produto = new Vendas_DataView_ProdutoContrato_MapperView();
                   $_produto->setIdClienteCon($_pedido->getIdClienteCon())
                         ->setId($this->getIdProduto());

                   $row = $_produto->retrieveRow($_where);
                   if (!$row) {
                       throw new ZendT_Exception_Alert(_i18n('Não foi possível determinar o valor do produto!'));
                   } else {
                       $this->setVlrItem($row['vlr_final']);
                   }
               }

               if ($this->getVlrFinal(true)->toPhp() == '') {
                   $vlrFinal = $this->getVlrItem()->toPhp() * $this->getQtdItem()->toPhp();
                   $vlrOrig = $vlrFinal;
                   if ($this->getPerAcre()->toPhp() > 0) {
                       $vlrAcre = ($vlrOrig * $this->getPerAcre()->toPhp()) / 100;
                       $vlrFinal+= $vlrAcre;
                   }
                   if ($this->getPerDesc()->toPhp() > 0) {
                       $vlrDesc = ($vlrOrig * $this->getPerDesc()->toPhp()) / 100;
                       $vlrFinal+= $vlrDesc;
                   }
                   $this->setVlrFinal($vlrFinal);
               }
           }
       }

   }

?>