<?php

    class ZendT_Form_Element_Hidden extends ZendT_Form_Element {

        public $helper = 'formHidden';

        public function __construct($spec, $options = null) {
            parent::__construct($spec, $options);
            $decorators = array(new ZendT_Form_Decorator_Hidden());
            $this->setDecorators($decorators);
        }

    }

?>
