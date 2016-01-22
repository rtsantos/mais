<?php

    class ZendT_Form_Element_SelectSqlOperation extends ZendT_Form_Element_Select {

        public function __construct($spec, $options = null) {
            parent::__construct($spec, $options);

            $options = array('?%' => " começa com ",
                '!?%' => " não começa com ",
                '%?' => " termina com ",
                '!%?' => " não termina com ",
                '%?%' => " contém ",
                '!%?%' => " não contém ",
                '=' => " igual ",
                '<>' => " diferente ",
                '<' => " menor que ",
                '<=' => " menor igual a ",
                '>' => " maior que ",
                '>=' => " maior igual a ",
                'in' => " está contido em Ex:[1,2]",
                '!in' => " não está contido em",
                'between' => " está entre ",
                '!between' => " não está entre ");
            $this->addMultiOptions($options);

            $decoratorSelect = new ZendT_Form_Decorator_Select();
            $this->addDecorator($decoratorSelect);
        }

    }

    