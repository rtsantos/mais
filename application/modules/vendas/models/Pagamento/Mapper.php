<?php

    /**
     * Classe de mapeamento do registro da tabela cv_pagto_pedido
     */
    class Vendas_Model_Pagamento_Mapper extends Vendas_Model_Pagamento_Crud_Mapper {

        private function _lastIdPagamento($idPedido) {
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

        public function getVlrPagar($idPedido) {
            $vlrPagar = 0;
            $lastId = $this->_lastIdPagamento($idPedido);
            if ($lastId) {
                $_pagamento = new Vendas_DataView_Pagamento_MapperView();
                $_pagamento->setId($lastId);
                $_pagamento->findAll(null, '*');
                while ($_pagamento->fetch()) {
                    $vlrPagar = $this->getVlrAPagar()->toPhp() - $this->getVlrPago()->toPhp();
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

    }

?>