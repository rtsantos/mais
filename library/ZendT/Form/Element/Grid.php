<?php

    class ZendT_Form_Element_Grid extends ZendT_Form_Element {

        /**
         * Default form view helper to use for rendering
         * @var string
         */
        public $helper = 'grid';
        
        /**
         *
         * @param type $spec
         * @param type $options 
         */
        public function __construct($spec, $options = null) {
            parent::__construct($spec, $options);
            $decorators = array();
            $decorators[] = new ZendT_Form_Decorator_Button();
            $this->setDecorators($decorators);
        }
        /**
         * 
         * @param type $value
         * @return \ZendT_Form_Element_Grid
         */
        public function setUrl($value){
            $this->setAttrib('url', $value);
            return $this;
        }
        /**
         * 
         * @param type $value
         * @return \ZendT_Form_Element_Grid
         */
        public function setWidth($value){
            $this->setAttrib('width', $value);
            return $this;
        }
        /**
         * 
         * @param type $columns
         * @return \ZendT_Form_Element_Grid
         */
        public function setColumns($columns){
            $this->setAttrib('columns', $columns);
            return $this;
        }
        /**
         * 
         * @param string $label
         * @return \ZendT_Form_Element_Grid
         */
        public function setLabel($label){
            parent::setLabel($label);
            $this->setAttrib('label', $label);
            return $this;
        }
        
        public function setPostData($data){
            $this->setAttrib('postData', $data);
            return $this;
        }
        
        public function addPostData($name, $value){
            
        }
        
        /**
         *
         * @param string $name
         * @param ZendT_Grid_Button $button
         * @return \ZendT_Form_Element_Grid 
         */
        public function addToolbarButton($name, $button) {
            if ($button instanceof ZendT_Grid_Button) {
                $buttons = $this->getAttrib('buttons');
                $buttons[] = array(
                    $name => $button
                );
                $this->setAttrib('buttons', $buttons);
            }
            return $this;
        }
    }

?>
