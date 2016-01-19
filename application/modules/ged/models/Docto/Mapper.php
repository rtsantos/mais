<?php

    /**
     * Classe de mapeamento do registro da tabela img_docto
     */
    class Ged_Model_Docto_Mapper extends Ged_Model_Docto_Crud_Mapper {

        /**
         * 
         * @return ZendT_Type_Number
         */
        public function save() {
            if ($this->getId(true)->toPhp()) {
                $where = new ZendT_Db_Where();
                $where->addFilter('image.img_docto.id', str_replace('.', '', $this->getId()->toPhp()));
                $this->update($where);
            } else {
                $this->insert();
            }

            return $this->getId();
        }

    }

?>