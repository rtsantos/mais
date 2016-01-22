<?php

    /**
     * 
     */
    class ZendT_Form_Element_Button_SubmitGrid extends ZendT_Form_Element_Button {

        /**
         *
         * @param string $spec
         * @param string $idGrid
         * @param array $options 
         */
        public function __construct($spec, $idForm, $idGrid, $options = null) {
            parent::__construct($spec, $options);
            $this->setAttrib('onClick', "$.AjaxT.submitJqGrid({idForm: '" . $idForm . "', idGrid: '" . $idGrid . "'})");
        }

    }

?>
