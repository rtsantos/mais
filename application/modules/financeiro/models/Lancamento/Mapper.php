<?php

   /**
    * Classe de mapeamento do registro da tabela fc_lancamento
    */
   class Financeiro_Model_Lancamento_Mapper extends Financeiro_Model_Lancamento_Crud_Mapper {

       protected function _beforeSave() {
           parent::_beforeSave();

           if ($this->_action != 'delete') {

               if ($this->getStatus(true)->toPhp() == '') {
                   $this->setStatus('A');
               }

               if ($this->getDhInc(true)->toPhp() == '') {
                   $this->setDhInc(ZendT_Type_Date::nowDate());
               }

               if ($this->getDtLanc(true)->toPhp() == '') {
                   $this->setDtLanc(ZendT_Type_Date::nowDate());
               }

               if ($this->getIdUsuInc(true)->toPhp() == '') {
                   $this->setIdUsuInc(Auth_Session_User::getInstance()->getId());
               }

               if ($this->getIdEmpresa(true)->toPhp() == '') {
                   $this->setIdEmpresa(Auth_Session_User::getInstance()->getIdEmpresa());
               }

               if ($this->getDtLanc()->toPhp() <= ZendT_Type_Date::nowDate()->toPhp() && $this->getUltimo(true)->toPhp() != 'N') {
                   $vlrSaldo = 0;
                   $_lancamento = new Financeiro_Model_Lancamento_Mapper();
                   $_lancamento->newRow()
                         ->setUltimo('S')
                         ->setIdEmpresa($this->getIdEmpresa())
                         ->retrieve();
                   if ($_lancamento->getId(true)->toPhp()) {
                       $vlrSaldo = $_lancamento->getVlrSaldo()->toPhp();
                       $_lancamento->setUltimo('N')
                             ->update();
                   }

                   if ($this->getTipo()->toPhp() == 'D') {
                       $vlrSaldo-= $this->getVlrLanc(true)->toPhp();
                   } else {
                       $vlrSaldo+= $this->getVlrLanc(true)->toPhp();
                   }

                   $this->setVlrSaldo($vlrSaldo)
                        ->setStatus('E')
                        ->setUltimo('S');
               }
           }
       }

       public function processLanc() {
           $_lancamentos = new Financeiro_DataView_Lancamento_MapperView();

           $_where = new ZendT_Db_Where();
           $_where->addFilter('fc_lancamento.dt_lanc', ZendT_Type_Date::nowDate(), '<=');
           if (Auth_Session_User::getInstance()->getIdEmpresa()) {
               $_where->addFilter('fc_lancamento.id_empresa', Auth_Session_User::getInstance()->getIdEmpresa());
           }
           $_where->addFilter('fc_lancamento.vlr_saldo', '', '=', '', true);
           $_lancamentos->findAll($_where);

           while ($_lancamentos->fetch()) {
               $_lancamentos->update();
           }
       }
       
       public function cancelar(){
           if ($this->getStatus()->toPhp() == 'E'){
               $data = $this->getData();
               unset($data['vlr_saldo']);
               unset($data['ultimo']);
               unset($data['id']);
               unset($data['dh_inc']);
               $_lanc = new Financeiro_Model_Lancamento_Mapper();
               $_lanc->populate($data);
               if ($this->getTipo()->toPhp() == 'D'){
                   $_lanc->setTipo('C');
               }else{
                   $_lanc->setTipo('D');
               }
               $_lanc->setDescricao('ESTORNO POR CANCELAMENTO')
                     ->setObservacao('LANCAMENTO: ' . $this->getId())
                     ->setIdLancamentoOrig($this->getId())
                     ->insert();
           }else if ($this->getStatus()->toPhp() == 'A'){
               $this->setStatus('C')->update();
           }
           return true;
       }

   }

?>