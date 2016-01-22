<?php

    /**
     * Essa classe tem como finalidade trabalhar com de texto
     * formatados. 
     * 
     * Também tem como finalidade filtrar os dados para chegar no
     * banco de dados da forma correta.
     *
     * @package ZendT
     * @subpackage String
     * @author ksantoja
     */
    class ZendT_Type_String implements ZendT_Type {

        /**
         * valor do texto grande
         * 
         * @var float
         */
        protected $_value;

        /**
         *
         * @var array
         */
        protected $_options;

        /**
         *
         * @param string $value
         * @param array $options
         * @param Zend_Locale $locale 
         */
        public function __construct($value = null, $options = array('charMask' => array('@', '9')), $locale = null) {
            if ($value instanceof ZendT_Type) {
                $value = $value->getValueToDb();
            }
            $this->set($value);
            #$this->_value = $value;
            if (!$options['charMask']) {
                $options['charMask'] = array('@', '9');
            }
            if (!is_array($options['charMask'])) {
                $options['charMask'] = array($options['charMask']);
            }
            $this->_options = $options;
        }

        /**
         * Retorna o conteúdo filtrado para o banco de dados
         * 
         * @return string
         */
        public function getValueToDb() {
            $string = '';
            if (is_array($this->_options['mask']) && $this->_options['charMask']) {
                $numCharValue = strlen($this->_value);
                foreach ($this->_options['mask'] as $mask) {
                    $numCharMask = strlen($mask);
                    //$nummask2 = strlen(str_replace($this->_options['charMask'],'',$mask));                    
                    if ($numCharMask == $numCharValue) {
                        if (isset($mask)) {
                            $string = $this->_clearString($this->_value, $mask, $this->_options['charMask']);
                            break;
                        } else {
                            throw new ZendT_Exception('Para uma mascará multipla é preciso informar o parâmentro $options[\'mask\'][$i][\'mask\'] ');
                        }
                    }
                }
                if (!$string)
                    $string = $this->_value;
            }else {
                if ($this->_options['mask'] && $this->_options['charMask']) {
                    $string = $this->_clearString($this->_value, $this->_options['mask'], $this->_options['charMask']);
                } else {
                    $string = $this->_value;
                }
            }
            if (isset($this->_options['filter'])) {
                foreach ($this->_options['filter'] as $funcName => $filter) {
                    if (is_array($filter)) {
                        $param = array();
                        $param[] = $string;
                        foreach ($filter as $value) {
                            $param[] = $value;
                        }
                        $string = call_user_func_array($funcName, $param);
                    } else {
                        $string = $filter($string);
                    }
                }
            }
            /**
             * Caso esteja vindo o descritivo da lista de opção, deve-se trocar pela chave,
             * pois é ela quem está armazenada no banco de dados.
             */
            if (is_array($this->_options['listOptions'])) {
                foreach ($this->_options['listOptions'] as $key => $value) {
                    if ($string == $value) {
                        $string = $key;
                        break;
                    }
                }
            }

            if (ZendT_Config::$type == 'utf8' && mb_detect_encoding($string, 'UTF-8', true) == 'UTF-8') {
                return utf8_decode($string);
            }
            return $string;
        }

        /**
         * Retorna os filtros do campo String
         * 
         * @return array
         */
        public function getFilters() {
            return $this->_options['filter'];
        }

        /**
         * Adiciona um novo filtro
         *
         * @param string|array $value
         * @return \ZendT_Type_String 
         */
        public function addFilter($value) {
            if (!isset($this->_options['filter'])) {
                $this->_options['filter'] = array();
            }
            if (is_array($value)) {
                $this->_options['filter']+=$value;
            } else {
                $this->_options['filter'][] = $value;
            }
            return $this;
        }

        /**
         * Retorna os filtros para o banco de dados
         * 
         * @return array
         */
        public function getFiltersDb() {
            return $this->_options['filterDb'];
        }

        /**
         * Define uma nova mascara para a String
         * 
         * @param string $mask
         * @param string $charMask
         * @return \ZendT_Type_String 
         */
        public function setMask($mask, $charMask = false) {
            $this->_options['mask'] = $mask;
            if ($charMask) {
                $this->_options['charMask'] = $charmask;
            }
            return $this;
        }

        /**
         * Retorna o conteúdo no formato do banco de dados
         * 
         * @param string $value
         * @return string
         */
        public function setValueFromDb($value) {
            $this->_value = $value;
            if (is_array($this->_options['mask'])) {
                $numCharValue = strlen($this->_value);
                foreach ($this->_options['mask'] as $mask) {
                    $numCharMask = strlen($mask) - strlen(str_replace($this->_options['charMask'], '', $mask));
                    if ($numCharMask == $numCharValue) {
                        $this->_value = $this->_formatString($value, $mask, $this->_options['charMask']);
                        break;
                    }
                }
            } else if ($this->_options['mask']) {
                $this->_value = $this->_formatString($value, $this->_options['mask'], $this->_options['charMask']);
            }
            $this->set($this->_value);
            return $this;
        }

        /**
         * Configura o valor de String vindo do usuário
         * 
         * @param string $value
         * @param array $options
         * @param string|Zend_Locale $locale 
         * @return \ZendT_Type_Clob
         */
        public function set($value, $options = null, $locale = null) {
            if (ZendT_Config::$type == 'utf8' && mb_detect_encoding($value, 'UTF-8', true) != 'UTF-8') {
                $value = utf8_encode($value);
            }
            $this->_value = $value;
            return $this;
        }

        /**
         * Retorna o valor do String, no formato do usuário
         * @param array $options
         * @param string|Zend_Locale $locale 
         * @return string
         */
        public function get($options = null, $locale = null) {
            $value = $this->_value;
            if (isset($this->_options['listOptions'])) {
                $value = $this->_options['listOptions'][$value];
            }
            if (isset($this->_options['format'])) {
                foreach ($this->_options['format'] as $funcName => $filter) {
                    if (is_array($filter)) {
                        $param = array();
                        $param[] = $value;
                        foreach ($filter as $funcFormat) {
                            $param[] = $funcFormat;
                        }
                        $value = call_user_func_array($funcName, $param);
                    } else {
                        $value = $filter($value);
                    }
                }
            }
            return $value;
        }

        /**
         * Retorna o valor do String, no formato do usuário
         * @return string
         */
        public function __toString() {
            $value = $this->get();
            if ($value === null) {
                $value = '';
            }
            return $value;
        }

        /**
         * Limpa a mascara de uma string
         * 
         * @param string $string
         * @param string $mask
         * @param string $charmask
         * @return string 
         */
        private function _clearString($string, $mask, $charmask = array('@', '9')) {
            $vCharFormat = str_replace($charmask, '', $mask);
            $vCharFormat = str_split($vCharFormat);
            return str_replace($vCharFormat, '', $string);
        }

        /**
         * Formata uma string conforme a mascara
         * 
         * @param string $string
         * @param string $mask
         * @param string $charmask
         * @return string 
         */
        private function _formatString($string, $mask, $charMask = array('@', '9')) {
            $vString = $string;
            $vCharFormat = str_replace($charMask, '', $mask);
            $string = $this->_clearString($string, $mask, $charmask);
            if (strlen($vString) == strlen($mask) - strlen($vCharFormat)) {
                for ($vIndex = 0; $vIndex < strlen($mask); $vIndex++) {
                    $Char = substr($mask, $vIndex, 1);
                    if (!in_array($Char, $charMask)) {
                        $ini = substr($vString, 0, $vIndex);
                        $fim = substr($vString, $vIndex);

                        $vString = $ini . $Char . $fim;
                    }
                }
                return $vString;
            } else {
                return $string;
            }
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

        public function getType() {
            return 'String';
        }

        public function getListOptions() {
            if (isset($this->_options['listOptions'])) {
                return $this->_options['listOptions'];
            } else {
                return false;
            }
        }

    }

?>