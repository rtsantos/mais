<?php
    class Wf_Form_WfTransacao_Edit extends Wf_Form_WfTransacao_Crud_Edit {
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            parent::loadElements($action);
        }
    }
?>