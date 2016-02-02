<?php

   /**
    * Classe de mapeamento do registro da tabela cv_pedido
    */
   class Vendas_Model_Pedido_Mapper extends Vendas_Model_Pedido_Crud_Mapper {
       private $_idLastPagto = false;
       private $_pagamento = false;

       public function _beforeSave() {
           parent::_beforeSave();

           if ($this->_action == 'insert' && !$this->getNumero(true)->toPhp()) {
               $_numeracao = new Ca_Model_Numeracao_Mapper();
               $numero = $_numeracao->proximo(self::$table . '.numero'
                     , $this->getIdEmpresa()->toPhp());
               $this->setNumero($numero);
           }

           if ($this->getIdEmpresa(true)->toPhp() == '') {
               $this->setIdEmpresa(Auth_Session_User::getInstance()->getIdEmpresa());
           }

           if ($this->getIdCliente(true)->toPhp() == '') {
               $_pessoa = new Ca_DataView_Pessoa_MapperView();
               $_pessoa->setNome(_i18n('CONSUMIDOR'));
               $_pessoa->retrieve();
               $this->setIdCliente($_pessoa->getId());
           }

           if ($this->getIdUsuInc(true)->toPhp() == '') {
               $this->setIdUsuInc(Auth_Session_User::getInstance()->getId());
           }
           
           if ($this->getDtEmis(true)->toPhp() == '') {
               $this->getDtEmis(ZendT_Type_Date::nowDate());
           }
           
           if ($this->getDhInc(true)->toPhp() == '') {
               $this->getDhInc(ZendT_Type_Date::nowDateTime());
           }

           $this->setIdUsuAlt(Auth_Session_User::getInstance()->getId());

           if ($this->getIdFuncionario(true)->toPhp() == '') {
               $_pessoa = new Ca_DataView_Pessoa_MapperView();
               $_pessoa->setEmail(Auth_Session_User::getInstance()->getLogin());
               $_pessoa->retrieve();
               $this->setIdFuncionario($_pessoa->getId());
           }
           
           if ($this->_action == 'update'){
               $this->_pagamento = new Vendas_DataView_Pagamento_MapperView();
               $this->_idLastPagto = $this->_pagamento->lastIdPagamento($this->getId());
               $this->_saldoPagto = $this->_pagamento->getSaldoPagar($this->getId());
               if ($this->_saldoPagto === 0){
                   $this->setStatus('P'); // pago
               } else {
                   if ($this->getStatus(true)->toPhp() == 'E'){
                       throw new ZendT_Exception_Alert(_i18n('Pedido ainda está pendente de Pagamento!'));
                   }
               }
           }
       }
       
       public function _afterSave() {
           parent::_afterSave();
           
           if ($this->getStatus(true)->toPhp() == 'E'){
               $_pagtoLanc = new Vendas_DataView_PagtoLanc_MapperView();
               
               $_lancamento = new Financeiro_DataView_Lancamento_MapperView();
               
               $_where = new ZendT_Db_Where();
               $_where->addFilter('pagto_pedido.id_pedido', $this->getId());               
               $_pagtoLanc->findAll($_where);
                     
               if (!$_pagtoLanc->fetch()){
                   $_pagtoLanc->efetiva($this->getId());
               }
           }
       }

   }

?>