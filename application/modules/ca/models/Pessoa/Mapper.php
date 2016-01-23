<?php

   /**
    * Classe de mapeamento do registro da tabela ca_pessoa
    */
   class Ca_Model_Pessoa_Mapper extends Ca_Model_Pessoa_Crud_Mapper {

       protected function _afterSave() {
           parent::_afterSave();

           $oldHierarquia = $this->getHierarquia(true)->toPhp();

           $idResp = $this->getIdPessoaResp(true)->toPhp();
           if ($idResp) {
               $_mapper = new Ca_Model_Pessoa_Mapper();
               $_mapper->setId($idResp)->retrieve();

               $hirarquia = $_mapper->getHierarquia(true)->toPhp() . '.' . $this->getId()->toPhp();
           } else {
               $hirarquia = $this->getId()->toPhp();
           }

           $hierarquiaComp = substr($hirarquia, 0, strlen($oldHierarquia));
           if ($hierarquiaComp && $oldHierarquia == $hierarquiaComp && $hierarquiaComp != $this->getId()->toPhp()) {
               //throw new ZendT_Exception_Alert(_i18n('Não é possível associar a empresa responvável para este registro, devido a infringir a hierarquia!'));
           }

           if ($oldHierarquia != $hirarquia) {
               $data = array();
               $data['hierarquia'] = $hirarquia;
               $this->getModel()->getAdapter()->update($this->getModel()->getName(), $data, 'id = ' . $this->getId()->toPhp());
           }
           $this->setHierarquia($hirarquia);

           if ($this->_action == 'update' && $oldHierarquia && $oldHierarquia != $hirarquia) {
               $_where = new ZendT_Db_Where();
               $_where->addFilter($this->getModel()->getName() . '.hierarquia', $oldHierarquia, '?%');
               $_where->addFilter($this->getModel()->getName() . '.id', $this->getId(), '!=');

               $_mapper = new Ca_DataView_Pessoa_MapperView();
               $_mapper->findAll($_where, '*');
               while ($_mapper->fetch()) {
                   $_mapper->update();
               }
           }
       }

   }

?>