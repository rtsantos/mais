<?php
    class Cms_Form_Notificacao_Edit extends Cms_Form_Notificacao_Crud_Edit {
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            parent::loadElements($action);
        }
    }
?>