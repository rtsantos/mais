<?php

    class ZendT_Form_Element_SubmitAjax extends ZendT_Form_Element {

        public $helper = 'submitAjax';

        public function __construct($spec, $options = null) {
            parent::__construct($spec, $options);
            $decoratorSubmitAjax = new ZendT_Form_Decorator_SubmitAjax();
            $this->addDecorator($decoratorSubmitAjax);
        }

    }