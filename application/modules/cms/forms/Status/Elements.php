<?php

    /**
     * Classe de mapeamento dos pontos de entrada da tabela cms_status
     */
    class Cms_Form_Status_Elements extends Cms_Form_Status_Crud_Elements {

        public function getIdCategoria() {
            $element = parent::getIdCategoria();
            $element->enableAutoComplete();
            return $element;
        }

    }

?>