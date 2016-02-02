<?php

   /**
    * Classe de visão da tabela cv_pagto_pedido
    */
   class Vendas_DataView_Pagamento_MapperView extends Vendas_DataView_Pagamento_Crud_MapperView {

       protected function _loadColumns() {
           parent::_loadColumns();
           $this->_columns->add('qtd_parcela', 'parcela', 'qtd', $this->_getParcela()->getModel()->getMapperName(), ZendT_Lib::translate('Qtd. de Parcela'), null, '=');
           $this->_columns->add('dias_venc_parcela', 'parcela', 'dias_venc', $this->_getParcela()->getModel()->getMapperName(), ZendT_Lib::translate('Dias de Vencimento'), null, '=');
           $this->_columns->add('dt_emis_pedido', 'pedido', 'dt_emis', $this->_getPedido()->getModel()->getMapperName(), ZendT_Lib::translate('Data de Emissão do Pedido'), null, '=');
           $this->_columns->add('pago_forma_pagto', 'forma_pagto', 'pago', $this->_getFormaPagamento()->getModel()->getMapperName(), ZendT_Lib::translate('Pago'),null,'=');
       }

   }

?>