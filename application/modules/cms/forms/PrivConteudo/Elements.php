<?php

    /**
     * Classe de mapeamento dos pontos de entrada da tabela cms_priv_conteudo
     */
    class Cms_Form_PrivConteudo_Elements extends Cms_Form_PrivConteudo_Crud_Elements {

        public function getIdConteudo() {
            $element = parent::getIdConteudo();
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