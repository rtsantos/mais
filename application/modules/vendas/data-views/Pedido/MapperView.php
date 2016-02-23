<?php

   /**
    * Classe de visão da tabela cv_pedido
    */
   class Vendas_DataView_Pedido_MapperView extends Vendas_DataView_Pedido_Crud_MapperView {

       protected function _getWhere($postData) {
           $where = false;

           if (ZendT_Acl::getInstance()->restriction('restringe-empresa', 'auth')) {
               $where = new ZendT_Db_Where('AND');
               $where->addFilter('empresa.hierarquia', Auth_Session_User::getInstance()->getHierarquiaEmpresa(), '?%');
           }

           return $where;
       }

       /*protected function _prepareSql(&$sql, &$binds, $type) {
           parent::_prepareSql($sql, $binds, $type);
           
           echo '<pre>';
           print_r($sql);
           echo '<hr />';
           print_r($binds);
           echo '</pre>';
       }*/

   }

?>