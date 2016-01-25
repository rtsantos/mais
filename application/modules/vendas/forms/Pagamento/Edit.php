<?php
    class Vendas_Form_Pagamento_Edit extends Vendas_Form_Pagamento_Crud_Edit {
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            parent::loadElements($action);
        }
    }
?>