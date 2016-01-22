<?php

    /**
     * Description of NumberTime
     *
     * @author tesilva
     */
    class ZendT_Type_NumberTime implements ZendT_Type {

        protected $_value;
        protected $_locale;
        protected $_part;

        /**
         *
         * @param float $value
         * @param Zend_Locale $locale 
         */
        public function __construct($value = null, $options = array('format' => '[hh]:mi:ss'), $locale = null) {
            $this->_value = $value;
            $this->_locale = $locale;
            $this->_part = $options;
        }

        /**
         * Retona o conteúdo no formato locale
         * @param string $format
         */
        public function get($options = null, $locale = null) {
            $db = Zend_Registry::get('db.projta');
            $value = $this->_value;
            $format = $this->_part['format'];

            if ($value != null && $this->_part) {
                $sql = "SELECT date_diff_pkg.to_char(round({$value},10), '{$format}') format FROM dual";
                @$value = trim($db->fetchOne($sql));
                if ($value == '::') {
                    $value = '';
                }
            }
            return $value;
        }

        public function getExcel() {
            $db = Zend_Registry::get('db.projta');
            $value = $this->_value;
            if ($value != null) {
                $sql = "SELECT date_diff_pkg.to_char(round({$value},10), 'excel') format FROM dual";
                @$value = trim($db->fetchOne($sql));
                if ($value == '::') {
                    $value = '1899-12-31T00:00:00.000';
                }
            } else {
                $value = '1899-12-31T00:00:00.000';
            }
            return $value;
        }

        public function set($value, $options = null, $locale = null) {
            $this->_value = $value;
            return $this;
        }

        public function getValueToDb() {
            $value = $this->_value;
            return $value;
        }

        public function setValueFromDb($value) {
            @$this->_value = $value;
            return $this;
        }

        public function isNull() {
            return $this->_value == '';
        }

        public function __toString() {
            return $this->get();
        }

        public function toPhp() {
            return $this->getValueToDb();
        }

        public function getType() {
            return 'NumberTime';
        }

        public function getOptions() {
            return $this->_part;
        }

        /**
         *
         * @param ZendT_Type $value
         * @param type $func 
         */
        public function setTotal($value, $func = 'sum') {
            if ($value instanceof ZendT_Type) {
                $this->_total['value']+=$value->toPhp();
            } else {
                $this->_total['value']+=$value;
            }
            $this->_total['count'] ++;
            $this->_total['func'] = $func;
        }

        /**
         * @return \ZendT_Type_NumberTime
         */
        public function getTotal() {
            if ($this->_total['func']) {
                $value = $this->{$this->_total['func']}();
                return $value;
            } else {
                return false;
            }
        }

        /**
         *
         * @param type $value
         * @return \ZendT_Type_NumberTime 
         */
        public function sum() {
            $type = clone $this;
            $type->setValueFromDb($this->_total['value']);
            return $type;
        }

        /**
         *
         * @param type $value
         * @return \ZendT_Type_NumberTime 
         */
        public function count() {
            $type = clone $this;
            $type->setValueFromDb($this->_total['count']);
            return $type;
        }

        /**
         *
         * @param type $value
         * @return \ZendT_Type_NumberTime 
         */
        public function avg() {
            $type = clone $this;
            $type->setValueFromDb($this->_total['value'] / $this->_total['count']);
            return $type;
        }

    }

?>
