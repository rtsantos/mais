<?php

   /**
    * Classe de mapeamento do registro da tabela cv_pedido
    */
   class Vendas_Model_Pedido_Mapper extends Vendas_Model_Pedido_Crud_Mapper {

       private $_pagamento = false;
       private $_others = array();

       /**
        * 
        * @param array $value
        * @return \Vendas_Model_Pedido_Mapper
        */
       public function setPagamento($value) {
           $this->_others['pagamento'] = $value;
           return $this;
       }

       /**
        * 
        * @param array $value
        * @return \Vendas_Model_Pedido_Mapper
        */
       public function setItemPedido($value) {
           $this->_others['item_pedido'] = $value;
           return $this;
       }

       /**
        * 
        * @return array
        */
       public function getPagamento() {
           return $this->_others['pagamento'];
       }

       /**
        * 
        * @return array
        */
       public function getItemPedido() {
           return $this->_others['item_pedido'];
       }

       public function _beforeSave() {
           parent::_beforeSave();

           if ($this->_action == 'insert' && !$this->getNumero(true)->toPhp()) {
               $_numeracao = new Ca_Model_Numeracao_Mapper();
               $numero = $_numeracao->proximo(self::$table . '.numero'
                     , $this->getIdEmpresa()->toPhp());
               $this->setNumero($numero);
           }

           if ($this->_action != 'delete') {

               if ($this->getIdEmpresa(true)->toPhp() == '') {
                   $this->setIdEmpresa(Auth_Session_User::getInstance()->getIdEmpresa());
               }

               if ($this->getIdCliente(true)->toPhp() == '') {
                   $_pessoa = new Ca_DataView_Pessoa_MapperView();
                   $_pessoa->setNome(_i18n('CONSUMIDOR'));
                   $_pessoa->retrieve();
                   $this->setIdCliente($_pessoa->getId());
               }

               if ($this->getIdClienteCon(true)->toPhp() == '') {
                   $this->setIdClienteCon($this->getIdCliente());
               }

               if ($this->getIdUsuInc(true)->toPhp() == '') {
                   $this->setIdUsuInc(Auth_Session_User::getInstance()->getId());
               }

               if ($this->getDtEmis(true)->toPhp() == '') {
                   $this->setDtEmis(ZendT_Type_Date::nowDate());
               }

               if ($this->getDhInc(true)->toPhp() == '') {
                   $this->setDhInc(ZendT_Type_Date::nowDateTime());
               }

               $this->setIdUsuAlt(Auth_Session_User::getInstance()->getId());

               if ($this->getIdFuncionario(true)->toPhp() == '') {
                   $_pessoa = new Ca_DataView_Pessoa_MapperView();
                   $_pessoa->setEmail(Auth_Session_User::getInstance()->getLogin());
                   $_pessoa->retrieve();
                   $this->setIdFuncionario($_pessoa->getId());
               }

               if ($this->_action == 'update') {
                   $this->_pagamento = new Vendas_DataView_Pagamento_MapperView();
                   $this->_saldoPagto = $this->_pagamento->getSaldoPagar($this->getId());
                   if ($this->_saldoPagto > 0) {
                       if ($this->getStatus(true)->toPhp() == 'E') {
                           throw new ZendT_Exception_Alert(_i18n('Pedido ainda está pendente de Pagamento!'));
                       }
                   } else {
                       if ($this->getStatus()->toPhp() == 'A') {
                           $this->setStatus('P'); // pago
                       }
                   }
               }
           }
       }

       public function _afterSave() {
           parent::_afterSave();

           if (count($this->_others['item_pedido']) > 0 && $this->_others['item_pedido']['id_produto']) {
               $_itemPedido = new Vendas_DataView_ItemPedido_MapperView();
               $_itemPedido->setIdPedido($this->getId())
                     ->setIdProduto($this->_others['item_pedido']['id_produto'])
                     ->setQtdItem($this->_others['item_pedido']['qtd_item'])
                     ->insert();
           }

           if (count($this->_others['pagamento']) > 0 && $this->_others['pagamento']['id_forma_pagto']) {
               $_pagamento = new Vendas_DataView_Pagamento_MapperView();
               $_pagamento->setIdPedido($this->getId())
                     ->setIdFormaPagto($this->_others['pagamento']['id_forma_pagto'])
                     ->insert();
           }

           if ($this->getStatus(true)->toPhp() == 'E') {
               $_pagtoLanc = new Vendas_DataView_PagtoLanc_MapperView();

               $_where = new ZendT_Db_Where();
               $_where->addFilter('pagto_pedido.id_pedido', $this->getId());
               $_pagtoLanc->findAll($_where);

               if (!$_pagtoLanc->fetch()) {
                   $this->_pagamento->efetivar($this->getId());
               }
           }
           
           if ($this->getStatus(true)->toPhp() == 'C') {
               $_pagtoLanc = new Vendas_DataView_PagtoLanc_MapperView();

               $_where = new ZendT_Db_Where();
               $_where->addFilter('pagto_pedido.id_pedido', $this->getId());
               $_pagtoLanc->findAll($_where);

               if ($_pagtoLanc->fetch()) {
                   $this->_pagamento->cancelar($this->getId());
               }
           }
       }

       public function efetivar() {
           if ($this->getId()->toPhp() == '') {
               throw new ZendT_Exception_Alert(_i18n('Necessário informar um Pedido!'));
           } else {
               if ($this->getStatus()->toPhp() == '') {
                   $this->retrieve();
               }
           }
           $this->setStatus('E')->update();
           return true;
       }
       
       public function cancelar(){
           if ($this->getId()->toPhp() == '') {
               throw new ZendT_Exception_Alert(_i18n('Necessário informar um Pedido!'));
           } else {
               if ($this->getStatus()->toPhp() == '') {
                   $this->retrieve();
               }
           }
           $this->setStatus('C')->update();
           return true;
       }

   }

?>