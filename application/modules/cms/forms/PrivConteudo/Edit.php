<?php
    class Cms_Form_PrivConteudo_Edit extends Cms_Form_PrivConteudo_Crud_Edit {
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            parent::loadElements($action);
        }
    }
?>