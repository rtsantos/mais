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

        public function efetivar($idPedido = false) {
            if (!$idPedido) {
                $idPedido = $this->getIdPedido();
            }

            $_pedido = new Vendas_DataView_Pedido_MapperView();
            $_pedido->setId($idPedido)->retrieve();

            $_pagtoLanc = new Vendas_DataView_PagtoLanc_MapperView();
            $_pagamento = new Vendas_DataView_Pagamento_MapperView();
            $_lancamento = new Financeiro_DataView_Lancamento_MapperView();

            $_where = new ZendT_Db_Where();
            $_where->addFilter('cv_pagto_pedido.id_pedido', $idPedido);

            $rows = $_pagamento->recordset($_where);
            $pago = false;
            
            $vlrTotal = 0;
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
                    
                    $vlrParc = $row['vlr_parc'];
                    if ($vlrParc->toPhp() == ''){
                        $vlrParc = $row['vlr_a_pagar'];
                    }
                    if ($vlrParc->toPhp() == ''){
                        $vlrParc = $row['vlr_pago'];
                    }

                    $_lancamento->newRow()
                            ->setTipo('C')
                            ->setIdEmpresa($_pedido->getIdEmpresa())
                            ->setIdFavorecido($_pedido->getIdEmpresa())
                            ->setDescricao('PEDIDO DE VENDA: ' . $row['numero_pedido'])
                            ->setObservacao('PAGAMENTO ' . ($index + 1) . " de " . $qtd)
                            ->setIdFormaPagto($row['id_forma_pago'])
                            ->setPago($row['pago_forma_pagto'])
                            ->setDtLanc($dtVenc)
                            ->setVlrLanc($vlrParc)
                            ->insert();

                    $_pagtoLanc->newRow()
                            ->setIdPagtoPedido($row['id'])
                            ->setIdLancamento($_lancamento->getId())
                            ->insert();
                    
                    $vlrTotal = $vlrTotal + $vlrParc->toPhp();
                }
            }
            /**
             * Avalia se é preciso gerar débitos para o pedido
             * custos com imposto ou comissões
             */
            $dtPedido = $_pedido->getDtEmis();
            if ($dtPedido->toPhp() == '') {
                $dtPedido = ZendT_Type_Date::nowDate();
            }

            $dtVenc = $dtPedido;

            $_regra = new Ca_DataView_RegraContrato_MapperView();

            $_itens = new Vendas_DataView_ItemPedido_MapperView();
            $_itens->setIdPedido($idPedido);
            $_itens->findAll(null,'*');
            while ($_itens->fetch()) {
                $_where = new ZendT_Db_Where();
                $_where->addFilter('ca_regra_contrato.id_produto', $_itens->getIdProduto());
                $_where->addFilter('ca_regra_contrato.status', 'A');
                $_where->addFilter('ca_regra_contrato.tipo', 'CD');
                $_where->addFilter('ca_regra_contrato.favorecido', 'ca_pedido.', '?%');
                $_where->addFilter('contrato.dt_vig_ini', $dtPedido, '<=');
                $_where->addFilter('contrato.dt_vig_fim', $dtPedido, '>=');
                $_where->addFilter('contrato.id_cliente', $_pedido->getIdClienteCon());
                $_where->addFilter('contrato.status', 'A');

                $_regra->findAll($_where,'*');
                while ($_regra->fetch()) {
                    $favorecido = $_regra->getFavorecido()->toPhp();
                    $favorecido = str_replace('ca_pedido.', '', $favorecido);
                    if ($favorecido == 'especifico') {
                        $idFavorecido = $_regra->getIdFavorecido();
                    } else {
                        $idFavorecido = $_pedido->getData($favorecido);
                    }


                    $desc = $_regra->getDescLanc()->toPhp();
                    if (!$desc) {
                        $desc = 'PEDIDO DE VENDA: ' . $_pedido->getNumero()->get();
                    }

                    if (!$idFavorecido) {
                        $idFavorecido = $_regra->getIdFavorecido();
                    }
                    
                    //$vlrTotal
                    if ($_regra->getVlrFixo()->toPhp() > 0){
                        $vlrLanc = $_regra->getVlrFixo();
                    }else if ($_regra->getVlrPerc()->toPhp() > 0){
                        $vlrLanc = ($vlrTotal * $_regra->getVlrPerc()->toPhp()) / 100;
                    }else{
                        $vlrLanc = 0;
                    }

                    if ($idFavorecido) {
                        $_lancamento->newRow()
                                ->setTipo('D')
                                ->setIdContrato($_regra->getIdContrato())
                                ->setIdFavorecido($idFavorecido)
                                ->setDescricao($desc)
                                ->setObservacao('PEDIDO DE VENDA: ' . $_pedido->getNumero()->get())
                                ->setPago('N')
                                ->setDtLanc($dtVenc)
                                ->setVlrLanc($vlrLanc)
                                ->insert();

                        if (!$pago) {
                            $_lancamento->newRow()
                                    ->setTipo('C')
                                    ->setIdContrato($_regra->getIdContrato())
                                    ->setIdFavorecido($idFavorecido)
                                    ->setDescricao($desc)
                                    ->setObservacao('CUSTEADO PELO CLIENTE')
                                    ->setPago('S')
                                    ->setDtLanc($dtVenc)
                                    ->setVlrLanc($vlrLanc)
                                    ->insert();
                        }
                    }
                }
            }
        }

    }

?>