<?php

    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */

    class ZendT_Form_Element_File extends Zend_Form_Element_File {

        public function __construct($spec, $options = null) {
            parent::__construct($spec, $options);
            $decoratorFile = new ZendT_Form_Decorator_File();
            $this->addDecorator($decoratorFile);
        }

    }

?>
