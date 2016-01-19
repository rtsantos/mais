<?php

    /**
     * Classe de mapeamento do registro da tabela recurso
     */
    class Auth_Model_Recurso_Mapper extends Auth_Model_Recurso_Crud_Mapper {
        /*
          protected function _beforeSave() {
          parent::_beforeSave();
          $hierarquia = '';
          $idRecursoPai = $this->getIdRecursoPai(true)->toPhp();
          if ($idRecursoPai) {
          $_recurso = new Auth_Model_Recurso_Mapper();
          $_recurso->setId($idRecursoPai)->retrieve();
          $hierarquia = $_recurso->getHierarquia();
          }
          if ($hierarquia) {
          $hierarquia.= '.';
          }
          $hierarquia.= $this->getNome()->get();
          $this->setHierarquia($hierarquia);
          } */

        private $_oldHierarquia = '';

        protected function _beforeSave() {
            parent::_beforeSave();

            $this->_oldHierarquia = $this->getHierarquia();

            $hirarquia = $this->getNome()->toPhp();
            $idPai = $this->getIdRecursoPai()->toPhp();
            if ($idPai) {
                $_mapper = new Auth_Model_Recurso_Mapper();
                $_mapper->setId($idPai)->retrieve();

                $hirarquia = $_mapper->getHierarquia()->toPhp() . '.' . $hirarquia;
            }
            $this->setHierarquia($hirarquia);
        }

        protected function _afterSave() {
            parent::_afterSave();
            if ($this->_action == 'update') {
                $_where = new ZendT_Db_Where();
                $_where->add('recurso.hierarquia', $this->_oldHierarquia, '?%');

                $_mapper = new Auth_Model_Recurso_Mapper();
                $_mapper->findAll($_where);
                while ($_mapper->fetch()) {
                    $_mapper->update();
                }
            }
        }

    }

?>