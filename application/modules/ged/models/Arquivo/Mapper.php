<?php

    /**
     * Classe de mapeamento do registro da tabela img_arquivo
     */
    class Ged_Model_Arquivo_Mapper extends Ged_Model_Arquivo_Crud_Mapper {

        protected function _beforeSave() {
            if ($this->_action == 'insert') {
                $this->setDhInc('SYSDATE');
            }

            if ($this->getConteudo()) {
                $hashcode = md5($this->getConteudo()->toPhp());
                $this->setHashcode($hashcode);
            }
        }

        /**
         * 
         * @return int|ZendT_Type
         */
        public function save($updateIfExists = false) {
            $id = 0;

            $this->_beforeSave();

            $hashcode = $this->getHashcode();
            $where = new ZendT_Db_Where();
            $where->addFilter('img_arquivo.hashcode', $hashcode);
            if ($this->exists($where)) {
                if ($updateIfExists) {
                    $this->update();
                }
                $id = $this->getId();
            } else if ($this->getId(true)->toPhp()) {
                $id = $this->getId();
            } else {
                $this->insert();
                $id = $this->getId();
            }

            $this->_afterSave();
            return $id;
        }

    }

?>