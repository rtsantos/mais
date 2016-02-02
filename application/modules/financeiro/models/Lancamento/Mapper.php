<?php

   /**
    * Classe de mapeamento do registro da tabela fc_lancamento
    */
   class Financeiro_Model_Lancamento_Mapper extends Financeiro_Model_Lancamento_Crud_Mapper {

       protected function _beforeSave() {
           parent::_beforeSave();

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

           if ($this->getVlrLanc()->toPhp() <= ZendT_Type_Date::nowDate()->toPhp()) {
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
                     ->setUltimo('S');
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

   }

?>