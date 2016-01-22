<?php

    class ZendT_Form_Element_MultiCheckbox extends Zend_Form_Element_MultiCheckbox {

        public function __construct($spec, $options = null) {
            parent::__construct($spec, $options);
            $decoratorDefault = new ZendT_Form_Decorator_Select();
            $this->addDecorator($decoratorDefault);
        }

    }

    