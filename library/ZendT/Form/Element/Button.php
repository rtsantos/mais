<?php

    /**
     * 
     */
    class ZendT_Form_Element_Button extends ZendT_Form_Element {

        /**
         * Default form view helper to use for rendering
         * @var string
         */
        public $helper = 'button';

        /**
         *
         * @param type $spec
         * @param type $options 
         */
        public function __construct($spec, $options = null) {
            parent::__construct($spec, $options);
            $decorators = array();
            $decorators[] = new ZendT_Form_Decorator();
            $this->setDecorators($decorators);
        }

        /**
         *
         * @param type $name
         * @return \ZendT_Form_Element_Button 
         */
        public function setIcon($name) {
            $this->setAttrib('icon', $name);
            return $this;
        }

        /**
         * Configura o Label do Botão
         *
         * @param string $label
         * @return \ZendT_Form_Element_Button 
         */
        public function setLabel($label) {
            parent::setLabel($label);
            $this->setAttrib('caption', $label);
            return $this;
        }

    }

    