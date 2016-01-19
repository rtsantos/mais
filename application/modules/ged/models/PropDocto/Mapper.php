<?php

    /**
     * Classe de mapeamento do registro da tabela img_prop_docto
     */
    class Ged_Model_PropDocto_Mapper extends Ged_Model_PropDocto_Crud_Mapper {

        public function getConfig($instance = false, $unserialize = false) {
            $data = parent::getConfig($instance);
            if ($unserialize) {
                $data = unserialize(html_entity_decode($data));
            }
            return $data;
        }

    }

?>