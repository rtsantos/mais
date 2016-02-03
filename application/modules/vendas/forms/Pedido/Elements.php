<?php

   /**
    * Classe de mapeamento dos pontos de entrada da tabela cv_pedido
    */
   class Vendas_Form_Pedido_Elements extends Vendas_Form_Pedido_Crud_Elements {

       public function getIdCliente() {
           $where = new ZendT_Db_Where();
           $where->addFilter('ca_pessoa.papel_cliente', 1);

           $_element = parent::getIdCliente();
           $_element->setWhere($where);
           return $_element;
       }

       public function getIdContCliResp() {
           $cmdOnFilter = "function(){
                var objWhere = new TWhere('AND');
                
                var idCliente = $('#frm_cv_pedido #id_cliente');                
                if (idCliente.val() == ''){
                    jQuery.DialogT.alert('".  _i18n('Necessário informar o Cliente!') . "');
                    return false;
                }

                filter = {
                    field: 'ca_pessoa.id_pessoa_resp',
                    value: idCliente.val(),
                    operation: '='
                };
                objWhere.addFilter(filter);

                filter = {
                    field: 'ca_pessoa.papel_contato',
                    value: 1,
                    operation: '='
                };
                objWhere.addFilter(filter);
                
                filter = {
                    field: 'cargo.sigla',
                    value: 'GER',
                    operation: '='
                };
                objWhere.addFilter(filter);

                return objWhere.toJson();
           }";
           
           $_element = parent::getIdContCliResp();
           $_element->setOnFilter($cmdOnFilter);
           return $_element;
       }
       
       public function getIdContCliVend() {
           $cmdOnFilter = "function(){
                var objWhere = new TWhere('AND');
                
                var idCliente = $('#frm_cv_pedido #id_cliente');                
                if (idCliente.val() == ''){
                    jQuery.DialogT.alert('".  _i18n('Necessário informar o Cliente!') . "');
                    return false;
                }

                filter = {
                    field: 'ca_pessoa.id_pessoa_resp',
                    value: idCliente.val(),
                    operation: '='
                };
                objWhere.addFilter(filter);

                filter = {
                    field: 'ca_pessoa.papel_contato',
                    value: 1,
                    operation: '='
                };
                objWhere.addFilter(filter);
                
                filter = {
                    field: 'cargo.sigla',
                    value: 'VEND',
                    operation: '='
                };
                objWhere.addFilter(filter);

                return objWhere.toJson();
           }";
           
           $_element = parent::getIdContCliVend();
           $_element->setOnFilter($cmdOnFilter);
           return $_element;
       }

   }
?>