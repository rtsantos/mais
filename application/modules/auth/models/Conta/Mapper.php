<?php

    /**
     * Classe de mapeamento do registro da tabela papel
     */
    class Auth_Model_Conta_Mapper extends Auth_Model_Conta_Crud_Mapper {

        private $_oldHierarquia = '';

        protected function _beforeSave() {
            parent::_beforeSave();

            $this->_oldHierarquia = $this->getHierarquia();

            $hirarquia = $this->getNome()->toPhp();
            $idPai = $this->getIdPapelPai()->toPhp();
            if ($idPai) {
                $_mapper = new Auth_Model_Conta_Mapper();
                $_mapper->setId($idPai)->retrieve();

                $hirarquia = $_mapper->getHierarquia()->toPhp() . '.' . $hirarquia;
            }
            $this->setHierarquia($hirarquia);
        }

        protected function _afterSave() {
            parent::_afterSave();
            if ($this->_action == 'update') {
                $_where = new ZendT_Db_Where();
                $_where->addFilter($this->getModel()->getName() . '.hierarquia', $this->_oldHierarquia, '?%');

                $_mapper = new Auth_Model_Conta_Mapper();
                $_mapper->findAll($_where);
                while ($_mapper->fetch()) {
                    $_mapper->update();
                }
            }
        }

    }

?>