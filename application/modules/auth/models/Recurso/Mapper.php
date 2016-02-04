<?php

   /**
    * Classe de mapeamento do registro da tabela recurso
    */
   class Auth_Model_Recurso_Mapper extends Auth_Model_Recurso_Crud_Mapper {

       private $_oldHierarquia = '';

       protected function _beforeSave() {
           parent::_beforeSave();

           $this->_oldHierarquia = $this->getHierarquia();

           $hirarquia = $this->getNome(true)->toPhp();
           $idPai = $this->getIdRecursoPai(true)->toPhp();
           if ($idPai) {
               $_mapper = new Auth_Model_Recurso_Mapper();
               $_mapper->setId($idPai)->retrieve();

               $hirarquia = $_mapper->getHierarquia(true)->toPhp() . '.' . $hirarquia;
           }
           $this->setHierarquia($hirarquia);
       }

       protected function _afterSave() {
           parent::_afterSave();
           if ($this->_action == 'update') {
               $_where = new ZendT_Db_Where();
               $_where->addFilter('recurso.hierarquia', $this->_oldHierarquia, '?%');
               $_where->addFilter('recurso.id', $this->getId(), '!=');

               $_mapper = new Auth_DataView_Recurso_MapperView();
               $_mapper->findAll($_where);
               while ($_mapper->fetch()) {
                   $_mapper->update();
               }
           }
       }

   }

?>