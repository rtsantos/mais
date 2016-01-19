<?php
    class Application_Form_File extends ZendT_Form {
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements() {
            $element = new ZendT_Form_Element_Hidden('id');
            $this->addElement($element);
            
            $element = new ZendT_Form_Element_Hidden('options');
            $this->addElement($element);
            
            $element = new ZendT_Form_Element_File('file');
            $element->setLabel('Selecione o Arquivo:');            
            $this->addElement($element);
        }
    }
?>