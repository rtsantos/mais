<?php

    /**
     * Description of Number
     *
     * @author rsantos
     */
    class ZendT_Type_Number implements ZendT_Type {

        /**
         * Valor
         * 
         * @var float
         */
        protected $_value;

        /**
         * Local para tratar conversão do valor
         * @var Zend_Locale
         */
        protected $_locale;

        /**
         *
         * @var array
         */
        protected $_part;

        /**
         *
         * @param float $value
         * @param Zend_Locale $locale 
         */
        public function __construct($value = null, $options = array('numDecimal' => 2), $locale = null) {
            $this->_value = $value;
            $this->_locale = $locale;
            $this->_part = $options;
        }

        /**
         * Configura a formatação padrão
         * 
         * @param type $value 
         * @return \ZendT_Type_Number
         */
        public function setFormats($value) {
            $this->_part = $value;
            return $this;
        }

        /**
         * Retorna a formatação padrão
         */
        public function getFormat() {
            return $this->_part;
        }

        /**
         * 
         * @param string $value
         * @return \ZendT_Type_Number
         */
        public function setMask($value = '?') {
            $this->_part['mask'] = $value;
            return $this;
        }

        /**
         * 
         * @return string
         */
        public function getMask() {
            return $this->_part['mask'];
        }

        /**
         * Retorna o conteúdo no formato ISO
         */
        public function getValueToDb() {
            $value = $this->_value;
            if ($value instanceof ZendT_Type) {
                $value = $value->getValueToDb();
            }
            if ($value != null) {
                if ($value instanceof ZendT_Type_Number) {
                    $value = $value->get();
                }
                if (is_string($value)) {
                    if ($this->_value instanceof ZendT_Type) {
                        $this->_value = $this->_value->get();
                    }
                    if (strpos($value, ',') !== false && strpos($value, '.') !== false) {
                        $value = str_replace('.', '', $value);
                        $value = str_replace(',', '.', $value);
                        $value*=1;
                    } elseif (strpos($this->_value, '.') !== false) {
                        $value = str_replace('.', '', $value);
                        $value*=1;
                    } elseif (strpos($this->_value, ',') !== false) {
                        $value = str_replace(',', '.', $value);
                        $value*=1;
                    }
                }

                if (isset($this->_part['numDecimal']) && $this->_part['numDecimal']) {
                    $this->_part['numDecimal'] = $this->_part['numDecimal'] * 1;
                    $value = round($value, $this->_part['numDecimal']);
                }
            }
            if (!$value && $value !== '0' && $this->_part['numDecimal'] === null) {
                $value = null;
            }
            return $value;
        }

        /**
         * Faz atribuição do valor em formato ISO
         * @example 1000.55
         *
         * @param float $value 
         * @return \ZendT_Type_Number
         */
        public function setValueFromDb($value) {
            if ($value == '') {
                $this->_value = '';
            } else {
                @$this->_value = number_format($value, $this->_part['numDecimal'], ',', '.');
            }
            return $this;
        }

        /**
         * Retona o conteúdo no formato locale
         * @param int $numDecimal 
         */
        public function get($options = null, $locale = null) {
            $value = $this->getValueToDb();
            if (!$value && $this->_part['numDecimal'] !== null) {
                $value = 0;
            }
            if (isset($options['numDecimal']) && $options['numDecimal'] >= 0) {
                @$_value = number_format($value, $options['numDecimal'], ',', '.');
            } else if ($this->_part['numDecimal'] !== null) {
                @$_value = number_format($value, $this->_part['numDecimal'], ',', '.');
            } else {
                $_value = $value;
            }

            if ($this->_part['mask']) {
                $_value = str_replace('?', $_value, $this->_part['mask']);
            }
            return $_value;
        }

        /**
         * Preenche o valor vindo do usuário
         */
        public function set($value, $options = null, $locale = null) {
            $this->_value = $value;
            return $this;
        }

        /**
         * Retona o conteúdo no formato locale
         */
        public function __toString() {
            $result = $this->get();
            return $result . '';
            /* if (is_numeric($result)) {
              return $result.'';
              } else {
              return '';
              } */
        }

        /**
         * Retorna se o objeto está com valor nulo
         * 
         * @return bool
         */
        public function isNull() {
            return $this->_value == '';
        }

        /**
         * Retorna o valor no formato php para calculo
         *
         * @return string 
         */
        public function toPhp() {
            return $this->getValueToDb();
        }

        /**
         * Retorna o tipo do Objeto, sendo Numeric ou Integer
         * 
         * @return string 
         */
        public function getType() {
            if (isset($this->_part['numDecimal'])) {
                if ($this->_part['numDecimal'] == 0) {
                    return 'Integer';
                } else {
                    return 'Numeric';
                }
            } else {
                return 'Numeric';
            }
        }

        /**
         *
         * @return array 
         */
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
         *
         * @param ZendT_Type $value
         * @param type $func 
         */
        public function setTotalCalc($row, $prop) {
            if (!isset($this->_total['calctotal'])) {
                $this->_total['calctotal'] = $prop;
            }
            foreach ($prop['columns'] as $columnName) {
                if ($row[$columnName] instanceof ZendT_Type) {
                    $this->_total['values'][$columnName]+= $row[$columnName]->toPhp();
                } else {
                    $this->_total['values'][$columnName]+= $row[$columnName];
                }
            }
        }

        /**
         * @return \ZendT_Type_Number
         */
        public function getTotal($adapter = null) {
            if (isset($this->_total['calctotal'])) {
                $expression = $this->_total['calctotal']['expression'];
                foreach ($this->_total['calctotal']['columns'] as $nameExp => $columnName) {
                    $expression = str_replace($nameExp, $this->_total['values'][$columnName], $expression);
                }
                $sql = "SELECT " . $expression . " as total FROM dual ";
                $this->_total['value'] = $adapter->fetchOne($sql);
                $value = $this->sum();
                return $value;
            } else if ($this->_total['func']) {
                $value = $this->{$this->_total['func']}();
                return $value;
            } else {
                return false;
            }
        }

        /**
         *
         * @param type $value
         * @return \ZendT_Type_Number 
         */
        public function sum() {
            $type = clone $this;
            $type->setValueFromDb($this->_total['value']);
            return $type;
        }

        /**
         *
         * @param type $value
         * @return \ZendT_Type_Number 
         */
        public function count() {
            $type = clone $this;
            $type->setValueFromDb($this->_total['count']);
            return $type;
        }

        /**
         *
         * @param type $value
         * @return \ZendT_Type_Number 
         */
        public function avg() {
            $type = clone $this;
            $type->setValueFromDb($this->_total['value'] / $this->_total['count']);
            return $type;
        }

    }

?>
