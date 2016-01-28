<?php
    class Frota_Form_Veiculo_Edit extends Frota_Form_Veiculo_Crud_Edit {
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            parent::loadElements($action);
        }
    }
?>