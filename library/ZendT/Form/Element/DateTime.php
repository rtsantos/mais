<?php

    /**
     * 
     *
     * @category    ZendT
     * @author      ksantoja
     */

    /**
     * Form Element para Numeric do ZendT
     *
     * 
     */
    class ZendT_Form_Element_DateTime extends ZendT_Form_Element {

        public $helper = "dateTime";

        public function __construct($spec, $options = null) {
            $date = new ZendT_Form_Element_Text($spec . '_date');
            $decorators = array(new ZendT_Form_Decorator());
            $date->setDecorators($decorators);

            $time = new ZendT_Form_Element_Text($spec . '_time');
            $decorators = array(new ZendT_Form_Decorator());
            $time->setDecorators($decorators);

            $this->setAttrib('propDate', $date);
            $this->setAttrib('propTime', $time);

            parent::__construct($spec, $options);
        }

        /**
         * Configura um novo nome para o objeto
         * 
         * @param string $name
         * @return \ZendT_Form_Element_DateTime
         */
        public function setName($name) {
            parent::setName($name);
            $this->getAttrib('propDate')->setName($name . '_date');
            $this->getAttrib('propTime')->setName($name . '_time');
            return $this;
        }

        /**
         *
         * @param type $value
         * @return \ZendT_Form_Element_DateTime 
         */
        public function setRequired($value = true) {
            $this->getAttrib('propDate')->setRequired($value);
            $this->getAttrib('propTime')->setRequired($value);
            return parent::setRequired($value);
        }

        /**
         *
         * @param array $attribs
         * @return \ZendT_Form_Element_DateTime 
         */
        public function setDateAttribs(array $attribs) {
            $this->getAttrib('propDate')->setAttribs($attribs);
            return $this;
        }

        /**
         *
         * @param array $attribs
         * @return \ZendT_Form_Element_DateTime 
         */
        public function setTimeAttribs(array $attribs) {
            $this->getAttrib('propTime')->setAttribs($attribs);
            return $this;
        }

        /**
         *
         * @param type $key
         * @param type $value
         * @return \ZendT_Form_Element_DateTime 
         */
        public function setDateAttrib($key, $value) {
            $this->getAttrib('propDate')->setAttrib($key, $value);
            return $this;
        }

        /**
         *
         * @param type $key
         * @param type $value
         * @return \ZendT_Form_Element_DateTime 
         */
        public function setTimeAttrib($key, $value) {
            $this->getAttrib('propTime')->setAttrib($key, $value);
            return $this;
        }

        /**
         *
         * @param array $params
         * @return \ZendT_Form_Element_DateTime 
         */
        public function setDateParams(array $params) {
            $this->setDateAttrib('jQueryParams', $params);
            return $this;
        }

        /**
         *
         * @param array $params
         * @return \ZendT_Form_Element_DateTime 
         */
        public function setTimeParams(array $params) {
            $this->setTimeAttrib('jQueryParams', $params);
            return $this;
        }

        public function render() {
            $params = array();
            $params['paramDate'] = $this->getAttrib('propDate')->getAttrib('jQueryParams');
            $params['paramTime'] = $this->getAttrib('propTime')->getAttrib('jQueryParams');
            $this->setJQueryParams($params);
            return parent::render();
        }

        public function renderDateTime() {
            /* $decoratorDateTime = new ZendT_Form_Decorator_DateTime();
              $attribs = array();
              $params = array();
              if (is_array($this->_time)) {
              if (is_array($this->_time['attribs'])) {
              $attribs = array_merge($attribs,$this->_time['attribs']);
              }
              if(is_array($this->_time['params'])){
              $params['paramTime'] = $this->_time['params'];
              }
              }
              if (is_array($this->_date)){
              if (is_array($this->_date['attribs'])) {
              $attribs = array_merge($attribs,$this->_date['attribs']);
              }
              if(is_array($this->_date['params'])){
              $params['paramDate'] = $this->_date['params'];
              }
              }
              $this->setAttribs($attribs);
              $this->setJQueryParams($params);
              $this->addDecorator($decoratorDateTime);
              parent::renderDateTime(); */
        }

    }