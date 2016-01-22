<?php

    /**
     * 
     *
     * @category    ZendT
     * @author      ksantoja
     */

    /**
     * Form Element para Date do ZendT
     *
     * 
     */
    class ZendT_Form_Element_DateMonthYear extends ZendT_Form_Element {

        public $helper = "dateMonthYear";

        public function __construct($spec, $options = null) {
            parent::__construct($spec, $options);
            $this->addStyle('width', '100px');
        }

    }