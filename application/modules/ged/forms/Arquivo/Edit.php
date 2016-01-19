<?php
    class Ged_Form_Arquivo_Edit extends Ged_Form_Arquivo_Crud_Edit {
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            parent::loadElements($action);
            
            $this->removeElement('dh_inc');
            $this->removeElement('hashcode');
        }
    }
?>