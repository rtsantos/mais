<?php

    /**
     * Classe de mapeamento dos pontos de entrada da tabela cms_priv_categ
     */
    class Cms_Form_PrivCateg_Elements extends Cms_Form_PrivCateg_Crud_Elements {

        public function getIdCategoria() {
            $element = parent::getIdCategoria();
            $element->enableAutoComplete();
            return $element;
        }

        public function getIdPapel() {
            $element = parent::getIdPapel();
            $element->enableAutoComplete();
            return $element;
        }

    }

?>