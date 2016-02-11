<?php
    class Auth_Form_Privilegio_Edit extends Auth_Form_Privilegio_Crud_Edit {
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            parent::loadElements($action);
        }
    }
?>