<?php

   /**
    * Classe de visão da tabela cv_forma_pagto
    */
   class Vendas_DataView_FormaPagamento_MapperView extends Vendas_DataView_FormaPagamento_Crud_MapperView {

       protected function _getWhere($postData) {
           $where = false;

           if (ZendT_Acl::getInstance()->restriction('restringe-empresa', 'auth')) {
               $where = new ZendT_Db_Where('AND');
               $where->addFilter('empresa.hierarquia', Auth_Session_User::getInstance()->getHierarquiaEmpresa(), '?%');
           }

           return $where;
       }

   }

?>