<?php

    /**
     * 
     */
    class ZendT_Form_Element_Text extends ZendT_Form_Element {

        /**
         * Default form view helper to use for rendering
         * @var string
         */
        public $helper = 'text';

        /**
         *
         * @param string|array $value
         * @return \ZendT_Form_Element_Text 
         */
        public function setMask($value) {
            $this->setJQueryParam('mask', $value);
            if (is_array($value)) {
                $maxlength = -1;
                $masks = $value;
                foreach ($masks as $value) {
                    if (strlen($value) > $maxlength) {
                        $maxlength = strlen($value);
                    }
                }
            } else {
                $maxlength = strlen($value);
            }
            $this->setAttrib('maxlength', $maxlength);
            return $this;
        }
        
        /**
         *
         * @param string $value
         * @return \ZendT_Form_Element_Text 
         */
        public function setCharMask($value) {
            $this->setJQueryParam('charMask', $value);
            return $this;
        }

    }

    