<?php

   /**
    * Classe de mapeamento do registro da tabela cv_parcela
    */
   class Vendas_Model_Parcela_Mapper extends Vendas_Model_Parcela_Crud_Mapper {

       public function _beforeSave() {
           parent::_beforeSave();

           if ($this->getIdEmpresa(true)->toPhp() == '') {
               $this->setIdEmpresa(Auth_Session_User::getInstance()->getIdEmpresa());
           }
       }

   }

?>