<?php
    class Cms_Form_Categoria_Edit extends Cms_Form_Categoria_Crud_Edit {
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            parent::loadElements($action);
        }
    }
?>