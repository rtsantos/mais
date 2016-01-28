<?php

   /**
    * Classe de mapeamento do registro da tabela fr_marca
    */
   class Frota_Model_Marca_Mapper extends Frota_Model_Marca_Crud_Mapper {

       public function _beforeSave() {
           parent::_beforeSave();


           if ($this->getIdEmpresa(true)->toPhp() == '') {
               $this->setIdEmpresa(Auth_Session_User::getInstance()->getIdEmpresa());
           }
       }

   }

?>