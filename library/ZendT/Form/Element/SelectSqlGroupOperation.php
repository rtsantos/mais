<?php

    class ZendT_Form_Element_SelectSqlGroupOperation extends ZendT_Form_Element_Select {

        public function __construct($spec = 'filter_groupop', $options = null) {
            parent::__construct($spec, $options);
            $this->addMultiOption('AND', 'E');
            $this->addMultiOption('OR', 'Ou');

            $decoratorSelect = new ZendT_Form_Decorator_Select();
            $this->addDecorator($decoratorSelect);
        }

    }