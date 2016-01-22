<?php

    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */

    class ZendT_Form_Element_Query extends ZendT_Form_Element {

        public $helper = "Query";

        /**
         * 
         * @param string|ZendT_Db_Mapper $value
         * @return \ZendT_Form_Element_Query
         */
        public function setMapperView($value) {
            $this->setAttrib('mapperView', $value);
            return $this;
        }

    }

?>
