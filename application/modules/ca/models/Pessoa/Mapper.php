<?php

    /**
     * Classe de mapeamento do registro da tabela ca_pessoa
     */
    class Ca_Model_Pessoa_Mapper extends Ca_Model_Pessoa_Crud_Mapper {

        protected function _afterSave() {
            parent::_afterSave();

            $oldHierarquia = $this->getHierarquia();

            $idResp = $this->getIdPessoaResp(true)->toPhp();
            if ($idResp) {
                $_mapper = new Ca_Model_Pessoa_Mapper();
                $_mapper->setId($idResp)->retrieve();

                $hirarquia = $_mapper->getHierarquia()->toPhp() . '.' . $this->getId()->toPhp();

                $data = array();
                $data['hierarquia'] = $hirarquia;
                $where = array();
                $where['id'] = $this->getId()->toPhp();
                $this->getModel()->getAdapter()->update($this->getModel()->getTableName(), $data, $where);
                
                $this->setHierarquia($hirarquia);
            }

            if ($this->_action == 'update') {
                $_where = new ZendT_Db_Where();
                $_where->add($this->getModel()->getName() . '.hierarquia', $oldHierarquia, '?%');

                $_mapper = new Ca_Model_Pessoa_Mapper();
                $_mapper->findAll($_where);
                while ($_mapper->fetch()) {
                    $_mapper->update();
                }
            }
        }

    }

?>