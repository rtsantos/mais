<?php

   /**
    * Classe de mapeamento do registro da tabela cv_pagto_pedido
    */
   class Vendas_Model_Pagamento_Mapper extends Vendas_Model_Pagamento_Crud_Mapper {

       public function lastIdPagamento($idPedido) {
           $id = false;
           $_pagamento = new Vendas_DataView_Pagamento_MapperView();
           $_pagamento->setIdPedido($idPedido);
           $_pagamento->findAll(null, array('id'), array('id DESC'));
           while ($_pagamento->fetch()) {
               $id = $_pagamento->getId();
               break;
           }

           return $id;
       }

       public function getSaldoPagar($idPedido) {
           $vlrPagar = 0;
           $lastId = $this->lastIdPagamento($idPedido);
           if ($lastId) {
               $_pagamento = new Vendas_DataView_Pagamento_MapperView();
               $_pagamento->setId($lastId);
               $_pagamento->findAll(null, '*');
               while ($_pagamento->fetch()) {
                   $vlrPagar = $_pagamento->getVlrAPagar()->toPhp() - $_pagamento->getVlrPago()->toPhp();
               }
           } else {
               $_item = new Vendas_DataView_ItemPedido_MapperView();
               $_item->setIdPedido($idPedido);
               $_item->findAll(null, '*');
               while ($_item->fetch()) {
                   $vlrPagar+= $_item->getVlrFinal()->toPhp();
               }
           }

           return $vlrPagar;
       }

       public function efetiva($idPedido = false) {
           if (!$idPedido) {
               $idPedido = $this->getIdPedido();
           }

           $_pedido = new Vendas_DataView_Pedido_MapperView();
           $_pedido->setId($idPedido)->retrieve();

           $_pagtoLanc = new Vendas_DataView_PagtoLanc_MapperView();
           $_pagamento = new Vendas_DataView_Pagamento_MapperView();

           $_where = new ZendT_Db_Where();
           $_where->addFilter('pagto_pedido.id_pedido', $idPedido);

           $rows = $_pagamento->recordset($_where);
           $pago = false;
           while ($row = $rows->getRow()) {

               if ($row['pago_forma_pagto']->toPhp() == 'S') {
                   $pago = true;
               }

               $qtd = $row['qtd_parcela']->toPhp();
               if (!$qtd)
                   $qtd = 1;

               for ($index = 0; $index < $qtd; $index++) {
                   $dtVenc = $row['dt_venc_parc'];
                   if ($dtVenc->toPhp() == '') {
                       $dtVenc = $row['dt_emis_pedido'];
                   }
                   if ($dtVenc->toPhp() == '') {
                       $dtVenc = ZendT_Type_Date::nowDate();
                   }
                   if ($index) {
                       $dtVenc->addMonths($index);
                   }

                   $_lancamento->newRow()
                         ->setTipo('C')
                         ->setIdEmpresa($_pedido->getIdEmpresa())
                         ->setIdFavorecido($_pedido->getIdEmpresa())
                         ->setDescricao('PEDIDO: ' . $row['numero_pedido'])
                         ->setDtLanc($dtVenc)
                         ->insert();

                   $_pagtoLanc->newRow()
                         ->setIdPagtoPedido($row['id'])
                         ->setIdLancamento($_lancamento->getId())
                         ->insert();
               }
           }
           /**
            * Avalia se é preciso gerar débitos para o pedido
            * custos com imposto ou comissões
            */
           if ($pago) {
               $dtPedido = $_pedido->getDtEmis();
               if ($dtPedido->toPhp() == '') {
                   $dtPedido = ZendT_Type_Date::nowDate();
               }

               $dtVenc = $dtPedido;

               $_regra = new Ca_DataView_RegraContrato_MapperView();

               $_itens = new Vendas_DataView_ItemPedido_MapperView();
               $_itens->setIdPedido($idPedido);
               while ($_itens->fetch()) {
                   $_where = new ZendT_Db_Where();
                   $_where->addFilter('ca_regra_contrato.id_produto', $_itens->getIdProduto());
                   $_where->addFilter('ca_regra_contrato.status', 'A');
                   $_where->addFilter('ca_regra_contrato.tipo', 'CD');
                   $_where->addFilter('ca_regra_contrato.favorecido', 'ca_pedido.', '?%');
                   $_where->addFilter('contrato.dt_vig_ini', $dtPedido, '>=');
                   $_where->addFilter('contrato.dt_vig_fim', $dtPedido, '<=');
                   $_where->addFilter('contrato.id_cliente', $_pedido->getIdCliente());
                   $_where->addFilter('contrato.status', 'A');

                   $_regra->findAll($_where);
                   while ($_regra->fetch()) {
                       $favorecido = $_regra->getFavorecido()->toPhp();
                       $favorecido = str_replace('ca_pedido.', '', $favorecido);
                       $idFavorecido = $_pedido->getData($favorecido);

                       $_lancamento->newRow()
                             ->setTipo('D')
                             ->setDescricao('PEDIDO: ' . $_pedido->getNumero())
                             ->setIdFavorecido($idFavorecido)
                             ->setDtLanc($dtVenc)
                             ->insert();
                   }
               }
           }
       }

   }

?>