<?php

   /**
    * Classe de mapeamento do registro da tabela papel
    */
   class Auth_Model_Conta_Mapper extends Auth_Model_Conta_Crud_Mapper {

       private $_oldHierarquia = '';
       private $_idPaiOld = '';

       protected function _beforeSave() {
           parent::_beforeSave();

           $this->_oldHierarquia = $this->getHierarquia();

           $hirarquia = $this->getNome(true)->toPhp();
           $idPai = $this->getIdPapelPai(true)->toPhp();
           if ($idPai) {
               $_mapper = new Auth_Model_Conta_Mapper();
               $_mapper->setId($idPai)->retrieve();

               $hirarquia = $_mapper->getHierarquia(true)->toPhp() . '.' . $hirarquia;
           }
           $this->setHierarquia($hirarquia);

           if ($this->_action == 'update') {
               $this->_idPaiOld = $this->getValueOld()->getIdPapelPai(true)->toPhp();
           }
       }

       protected function _afterSave() {
           parent::_afterSave();

           if ($this->_action == 'update') {
               $_where = new ZendT_Db_Where();
               $_where->addFilter($this->getModel()->getName() . '.hierarquia', $this->_oldHierarquia, '?%');
               $_where->addFilter($this->getModel()->getName() . '.id', $this->getId(), '!=');

               $_mapper = new Auth_DataView_Conta_MapperView();
               $_mapper->findAll($_where, '*');
               while ($_mapper->fetch()) {
                   $_mapper->update();
               }

               $idPai = $this->getIdPapelPai(true)->toPhp();
               if ($this->_idPaiOld && $this->_idPaiOld != $idPai) {
                   $_relation = new Auth_Model_ContaRel_Mapper();
                   $_relation->setIdPapel($this->getId())
                             ->setIdPapelRel($this->_idPaiOld)
                             ->retrieve();

                   if ($idPai) {
                       $_relation->setIdPapelRel($idPai)->update();
                   } else {
                       $_relation->delete();
                   }
               }
           } elseif ($this->_action == 'insert') {
               $_relation = new Auth_Model_ContaRel_Mapper();
               $_relation->setIdPapel($this->getId())
                     ->setIdPapelRel($this->getId())
                     ->setStatus('A')
                     ->insert();

               if ($this->getIdPapelPai(true)->toPhp()) {
                   $_relation->newRow()
                         ->setIdPapel($this->getId())
                         ->setIdPapelRel($this->getIdPapelPai())
                         ->setStatus('A')
                         ->insert();
               }
           }
       }

   }

?>