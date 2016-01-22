<?php

    /**
     * 
     *
     * @category    ZendT
     * @author      tesilva
     */
    class ZendT_Form_Element_DateDynamic extends ZendT_Form_Element {

        public $helper = "dateDynamic";

        public function setMaxPeriodo($value){
            $this->setJQueryParam('max_periodo', $value);
            return $this;
        }
        
        public function getMaxPeriodo(){
            return $this->getJQueryParam('max_periodo');
        }
    }