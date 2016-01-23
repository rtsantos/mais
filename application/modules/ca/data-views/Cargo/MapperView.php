<?php

   /**
    * Classe de visão da tabela ca_cargo
    */
   class Ca_DataView_Cargo_MapperView extends Ca_DataView_Cargo_Crud_MapperView {

       protected function _getWhere($postData) {
           $where = false;

           if (ZendT_Acl::getInstance()->restriction('restringe-empresa', 'auth')) {
               $where = new ZendT_Db_Where('AND');
               $where->addFilter('empresa.hierarquia', Auth_Session_User::getInstance()->getHierarquiaEmpresa(), '?%');
           }

           return $where;
       }

   }