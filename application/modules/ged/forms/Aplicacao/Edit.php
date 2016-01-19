<?php
    class Ged_Form_Aplicacao_Edit extends Ged_Form_Aplicacao_Crud_Edit {
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            parent::loadElements($action);
        }
    }
?>