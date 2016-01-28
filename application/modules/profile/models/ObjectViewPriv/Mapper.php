<?php

   /**
    * Classe de mapeamento do registro da tabela profile_object_view_priv
    */
   class Profile_Model_ObjectViewPriv_Mapper extends Profile_Model_ObjectViewPriv_Crud_Mapper {

       public function getSqlPriv($user = false, $column = 'profile_object_view.id') {
           if ($user) {
               $idUsuario = $user['id'];
           } else {
               $idUsuario = Auth_Session_User::getInstance()->getId();
           }

           $sqlPriv = "(SELECT 1
                          FROM " . Profile_Model_ObjectViewPriv_Mapper::$table . " object_view_sec
                          JOIN " . Auth_Model_Conta_Mapper::$table . " conta_sec ON (object_view_sec.id_papel = conta_sec.id)
                          JOIN " . Auth_Model_ContaRel_Mapper::$table . " conta_rel_sec ON (conta_rel_sec.id_papel = " . $idUsuario . ")
                          JOIN " . Auth_Model_Conta_Mapper::$table . " conta_usu_sec ON (conta_rel_sec.id_papel_rel = conta_usu_sec.id)
                         WHERE object_view_sec.id_profile_object_view = " . $column . "
                           AND conta_usu_sec.hierarquia LIKE " . $this->getModel()->getAdapter()->concat(array("conta_sec.hierarquia", "'%'")) . ")";
           return $sqlPriv;
       }

   }

?>