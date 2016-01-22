<?php

    /**
     * Essa classe tem como finalidade trabalhar com data
     * Basicamente foi especializado a parte de entrada de 
     * formatação e tratamento de entrada e saída dos dados
     * do banco de dados ao usuário
     * 
     * Outra finalidade é tratar o dado efetuando calculos de 
     * manipulação da mesma
     *
     * @author rsantos
     */
    class ZendT_Type_Date implements ZendT_Type {

        /**
         * Para indicar que a data pode ser nula
         * 
         * @var bool
         */
        protected $_isNull;

        /**
         *
         * @var string
         */
        protected $_partT;

        /**
         *
         * @var array|Zend_Locale
         */
        protected $_localeT;

        /**
         *
         * @var string Date, DateTime, Time
         */
        protected $_type;

        /**
         *
         * @var int
         */
        protected $_value;

        /**
         * Construtor da classe ZendT_Type_Date
         * 
         * @param string|int $value
         * @param string $options
         * @param string|Zend_Locale $locale 
         */
        public function __construct($value = null, $options = null, $locale = null) {
            $value = str_replace('_', ' ', $value);
            if ($options == 'Date') {
                $options = 'd/m/Y';
                $this->_type = 'Date';
            } else if ($options == 'Time') {
                $options = 'H:i';
                $this->_type = 'Time';
            } else {
                $options = 'd/m/Y H:i';
                $this->_type = 'DateTime';
            }

            if ($value == 'SYSDATE') {
                $value = date($options);
            }

            if (in_array(substr($value, 4, 1), array('-', '/'))) {
                $this->setIso($value);
            } else {
                $this->set($value, $options, $locale);
            }
            $this->_partT = $options;
            $this->_localeT = $locale;
        }

        public function diff($dateCompare) {
            $diff = $this->toPhp() - $dateCompare->toPhp();

            $diff_seconds = $diff;
            $diff_weeks = floor($diff_seconds / 604800);
            $diff_seconds -= $diff_weeks * 604800;
            $diff_days = floor($diff_seconds / 86400);
            $diff_seconds -= $diff_days * 86400;
            $diff_hours = floor($diff_seconds / 3600);
            $diff_seconds -= $diff_hours * 3600;
            $diff_minutes = floor($diff_seconds / 60);
            $diff_seconds -= $diff_minutes * 60;
            $result = array(
                'w' => $diff_weeks,
                'd' => $diff_days,
                'h' => $diff_hours,
                'i' => $diff_minutes,
                's' => $diff_seconds
            );
            /* $result = array(
              'h' => floor(($diff) / 3600),
              'i' => floor(($diff) / 60),
              's' => ($diff),
              'd' => floor(($diff) / 86400),
              'm' => floor(($diff) / 2628000),
              'y' => floor(($diff) / 31536000)
              ); */
            return (object) $result;
        }

        /**
         * Configura um valor vindo do usuário
         *
         * @param string $value
         * @param array $options
         * @param array $locale 
         */
        public function set($value, $options = null, $locale = 'pt_BR') {
            $value = str_replace('_', ' ', $value);
            /**
             * @todo usar o locale para acertar formatação
             */
            if (strlen($value) >= 4) {
                $day = substr($value, 0, 2) * 1;
                if (!$day)
                    $day = 0;
                $month = substr($value, 3, 2) * 1;
                if (!$month)
                    $month = 0;
                $year = substr($value, 6, 4) * 1;
                if (!$year)
                    $year = 0;
                $hour = substr($value, 11, 2) * 1;
                if (!$hour)
                    $hour = 0;
                $minute = substr($value, 14, 2) * 1;
                if (!$minute)
                    $minute = 0;
                @$value = mktime($hour, $minute, 0, $month, $day, $year);
                if ($value == false) {
                    throw new ZendT_Exception_Error("Valor informado para data não está válido! Value: " . $value);
                }
                $this->_isNull = false;
            } else {
                $this->_setDataNull();
            }
            $this->_value = $value;
        }

        /**
         * Define que a data pode ser nula
         * 
         * @return \ZendT_Type_Date 
         */
        private function _setDataNull() {
            $this->_isNull = true;
            return $this;
        }

        /**
         * Retorna o valor do objeto formatado
         *
         * @param string $options
         * @param type $locale 
         */
        public function get($options = null, $locale = null) {
            if ($this->_isNull && !$this->_value) {
                return '';
            } else {
                if ($options == null) {
                    $options = $this->_partT;
                }

                if (strpos('%', $options) === false) {
                    $options = str_replace(array('d', 'm', 'Y', 'y', 'H', 'i'), array('%d', '%m', '%Y', '%y', '%H', '%M'), $options);
                }

                if ($locale == null)
                    $locale = $this->_localeT;
                setlocale(LC_TIME, $locale);
                @$value = strftime($options, $this->_value);
                if ($value) {
                    return $value;
                } else {
                    return '';
                }
            }
        }

        /**
         * Configura uma data para calculo no formato iso
         */
        public function setValueFromDb($value) {
            if ($this->_partT == 'H:i' && strlen($value) == 4) {
                $value = '1900-01-01 ' . ZendT_Format::string($value, '@@:@@');
            }
            if ($value && $value != null) {
                $this->setIso($value);
            } else if ($value == '' || $value === null) {
                $this->_isNull = true;
                $this->_value = '';
            }
        }

        /**
         * Configura uma nova data no formato ISO
         * 
         * @param string $value
         * @return \ZendT_Type_Date 
         */
        public function setIso($value) {
            if (strlen($value) >= 4) {
                $year = substr($value, 0, 4) * 1;
                $month = substr($value, 5, 2) * 1;
                $day = substr($value, 8, 2) * 1;
                $hour = substr($value, 11, 2) * 1;
                $minute = substr($value, 14, 2) * 1;

                $this->_value = mktime($hour, $minute, 0, $month, $day, $year);
                $this->_isNull = false;
            } else {
                $this->_isNull = true;
                $this->_value = '';
            }
            return $this;
        }

        /**
         * Retorna a data em formato ISO
         *
         * @return string 
         */
        public function getW3C() {
            if ($this->_isNull) {
                return '';
            } else {
                if ($this->_partT == 'd/m/Y') {
                    return date('Y-m-d', $this->_value);
                } else {
                    return date('Y-m-d H:i', $this->_value);
                }
            }
        }

        /**
         * Retorna a data em formato ISO
         *
         * @return string 
         */
        public function getIso() {
            return $this->getW3C();
        }

        /**
         * Retorna o conteúdo no formato ISO
         * 
         * @return string 
         */
        public function getValueToDb() {
            return $this->getIso();
        }

        /**
         * Retona o conteúdo no formato do usuário(localidade)
         * 
         * @return string 
         */
        public function __toString() {
            return $this->get();
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
            return $this->_value;
        }

        /**
         * Transforma o data para o último dia do mês
         *
         * @return \ZendT_Type_Date 
         */
        public function lastDayMonth() {
            if ($this->_value) {
                $_value = mktime(date('H', $this->_value) * 1, date('i', $this->_value) * 1, date('s', $this->_value) * 1, (date('m', $this->_value) * 1) + 1, 0, # @todo testar essa chamada
                        date('Y', $this->_value) * 1);
                $this->_value = $_value;
            }
            return $this;
        }

        public function firstHour() {
            if ($this->_value) {
                $_value = mktime(0, 0, 0, date('m', $this->_value) * 1, date('d', $this->_value) * 1, date('Y', $this->_value) * 1);
                $this->_value = $_value;
            }
            return $this;
        }

        /**
         * Configura um horário para a data
         * 
         * @return \ZendT_Type_Date 
         */
        public function setHour($value) {
            $value = str_replace(':', '', $value);
            if (strlen($value) == 1) {
                $value = '0' . $value . '00';
            } else {
                $value = str_pad($value, 4, '0');
            }
            $hour = substr($value, 0, 2) * 1;
            $minutes = substr($value, 2, 2) * 1;

            if ($this->_value) {
                $_value = mktime($hour, $minutes, date('s', $this->_value) * 1, date('m', $this->_value) * 1, date('d', $this->_value) * 1, date('Y', $this->_value) * 1);
                $this->_value = $_value;
            }
            return $this;
        }

        /**
         * Transforma o data para o primeiro dia do mês
         * 
         * @return \ZendT_Type_Date 
         */
        public function firstDayMonth() {
            if ($this->_value) {
                $_value = mktime(date('H', $this->_value) * 1, date('i', $this->_value) * 1, date('s', $this->_value) * 1, date('m', $this->_value) * 1, 1, date('Y', $this->_value) * 1);
                $this->_value = $_value;
            }
            return $this;
        }

        /**
         * Transforma o data para o primeiro mês do ano
         * 
         * @return \ZendT_Type_Date 
         */
        public function firstMonth() {
            if ($this->_value) {
                $_value = mktime(date('H', $this->_value) * 1, date('i', $this->_value) * 1, date('s', $this->_value) * 1, 1, date('d', $this->_value) * 1, date('Y', $this->_value) * 1);
                $this->_value = $_value;
            }
            return $this;
        }

        /**
         * Transforma o data para o primeiro mês do ano
         * 
         * @return \ZendT_Type_Date 
         */
        public function lastMonth() {
            if ($this->_value) {
                $_value = mktime(date('H', $this->_value) * 1, date('i', $this->_value) * 1, date('s', $this->_value) * 1, 12, date('d', $this->_value) * 1, date('Y', $this->_value) * 1);
                $this->_value = $_value;
            }
            return $this;
        }

        /**
         * Adiciona um número de anos sobre a data corrente
         * 
         * @param int $numDay
         * @return \ZendT_Type_Date 
         */
        public function addYear($numYear) {
            if ($this->_value) {
                $_value = mktime(date('H', $this->_value) * 1, date('i', $this->_value) * 1, date('s', $this->_value) * 1, date('m', $this->_value) * 1, date('d', $this->_value) * 1, (date('Y', $this->_value) * 1) + $numYear);
                $this->_value = $_value;
            }
            return $this;
        }

        /**
         * Adiciona um número de meses sobre a data corrente
         * 
         * @param int $numDay
         * @return \ZendT_Type_Date 
         */
        public function addMonth($numMonth) {
            if ($this->_value) {
                $_value = mktime(date('H', $this->_value) * 1, date('i', $this->_value) * 1, date('s', $this->_value) * 1, (date('m', $this->_value) * 1) + $numMonth, date('d', $this->_value) * 1, date('Y', $this->_value) * 1);
                $this->_value = $_value;
            }
            return $this;
        }

        /**
         * Adiciona um número de dias sobre a data corrente
         * 
         * @param int $numDay
         * @param bool $util
         * @return \ZendT_Type_Date 
         */
        public function addDay($numDay, $util = false) {
            if (!$this->_value) {
                return $this;
            }

            if ($util) {
                if ($numDay > 0) {
                    $_value = $this->_value;
                    for ($i = 1; $i <= $numDay; $i++) {
                        do {
                            $_value = mktime(date('H', $_value) * 1, date('i', $_value) * 1, date('s', $_value) * 1, date('m', $_value) * 1, (date('d', $_value) * 1) + 1, # soma
                                    date('Y', $_value) * 1);
                        } while (in_array(date('N', $_value), array('6', '7'))); # sabado e domingo
                    }
                } else {
                    $_value = $this->_value;
                    for ($i = 1; $i <= abs($numDay); $i++) {
                        do {
                            $_value = mktime(date('H', $_value) * 1, date('i', $_value) * 1, date('s', $_value) * 1, date('m', $_value) * 1, (date('d', $_value) * 1) - 1, # subtraí
                                    date('Y', $_value) * 1);
                        } while (in_array(date('N', $_value), array('6', '7'))); # sabado e domingo
                    }
                }
            } else {
                $_value = mktime(date('H', $this->_value) * 1, date('i', $this->_value) * 1, date('s', $this->_value) * 1, date('m', $this->_value) * 1, (date('d', $this->_value) * 1) + $numDay, date('Y', $this->_value) * 1);
            }
            $this->_value = $_value;
            return $this;
        }

        /**
         * Adiciona o número de horas sobre a data corrente.
         * 
         * @param int $numHours         
         * @return \ZendT_Type_Date 
         */
        public function addHour($numHours) {

            if ($numHours > 0) {
                $_value = mktime((date('H', $this->_value) * 1) + $numHours, date('i', $this->_value) * 1, date('s', $this->_value) * 1, date('m', $this->_value) * 1, date('d', $this->_value) * 1, date('Y', $this->_value) * 1);
                $this->_value = $_value;
            }

            return $this->_value;
        }

        /**
         * Retorna um objeto com a data e hora corrente
         * 
         * @return \ZendT_Type_Date 
         */
        public static function nowDateTime() {
            $date = new ZendT_Type_Date('SYSDATE', 'DateTime');
            return $date;
        }

        /**
         * Retorna um objeto com a data corrente
         * 
         * @return \ZendT_Type_Date 
         */
        public static function nowDate() {
            $date = new ZendT_Type_Date('SYSDATE', 'Date');
            return $date;
        }

        /**
         * Retorna um objeto com a hora corrente
         * 
         * @return \ZendT_Type_Date 
         */
        public static function nowTime() {
            $date = new ZendT_Type_Date('SYSDATE', 'Time');
            return $date;
        }

        /**
         * Retorna o tipo do Objeto, sendo Numeric ou Integer
         * 
         * @return string Date, DateTime, Time
         */
        public function getType() {
            return $this->_type;
        }

        /**
         * Faz o pase de uma data passando 
         * @param type $value
         * @param type $type
         * @return \ZendT_Type_Date
         * @throws ZendT_Exception 
         */
        public static function parse($value, $type) {
            $funcParse = array();
            /**
             * pt-br 
             */
            $funcParse['hora'] = 'setHour';
            $funcParse['primeirahora'] = 'firstHour';
            $funcParse['primeirodia'] = 'firstDayMonth';
            $funcParse['ultimodia'] = 'lastDayMonth';
            $funcParse['primeiromes'] = 'firstMonth';
            $funcParse['ultimomes'] = 'lastMonth';
            $funcParse['adicionadia'] = 'addDay';
            $funcParse['adicionames'] = 'addMonth';
            $funcParse['adicionaano'] = 'addYear';
            $funcParse['adicionasemana'] = 'addWeek';
            $funcParse['primeirasemana'] = 'firstDayWeek';
            $funcParse['ultimasemana'] = 'lastDayWeek';
            $funcParse['adicionahora'] = 'addHour';
            /**
             * us
             */
            $funcParse['firstdaymonth'] = 'firstDayMonth';
            $funcParse['lastdaymonth'] = 'lastDayMonth';
            $funcParse['firstmonth'] = 'firstMonth';
            $funcParse['lastmonth'] = 'lastMonth';
            $funcParse['addday'] = 'addDay';
            $funcParse['addmonth'] = 'addMonth';
            $funcParse['addyear'] = 'addYear';
            $funcParse['addweek'] = 'addWeek';
            $funcParse['firstweek'] = 'firstDayWeek';
            $funcParse['lastweek'] = 'lastDayWeek';

            $pos = strpos($value, '.');
            if (!$pos) {
                $pos = strlen($value);
            }
            $dateString = substr($value, 0, $pos);
            if (strtolower($dateString) == 'hoje') {
                $dateString = 'SYSDATE';
            }
            $date = new ZendT_Type_Date($dateString, $type);
            $funcs = explode('.', $value);

            unset($funcs[0]);
            if (count($funcs) > 0) {
                foreach ($funcs as $func) {
                    $aux = explode('(', str_replace(')', '', $func));
                    $name = $aux[0];
#if (strpos($dateString, $name))
                    $params = explode(',', $aux[1]);

                    $nameParse = $funcParse[strtolower($name)];
                    @$result = call_user_func_array(array($date, $nameParse), $params);
                    if (!$result) {
                        throw new ZendT_Exception('Macro inválida. Não encontrado a função "' . $name . '"!');
                    }
                }
            }

            return $date;
        }

        /**
         * Transforma a data para o primeiro dia da semana
         * 
         * @return \ZendT_Type_Date 
         */
        public function firstDayWeek() {
            if ($this->_value) {
                $_value = mktime(0, 0, 0, date('n', $this->_value), date('j', $this->_value), date('Y', $this->_value)) - ((date('N', $this->_value)) * 3600 * 24);
                $this->_value = $_value;
            }
            return $this;
        }

        /**
         * Transforma a data para o último dia da semana
         *
         * @return \ZendT_Type_Date 
         */
        public function lastDayWeek() {
            if ($this->_value) {
                $_value = mktime(23, 59, 59, date('n', $this->_value), date('j', $this->_value) + 6, date('Y', $this->_value)) - ((date('N', $this->_value)) * 3600 * 24);
                $this->_value = $_value;
            }
            return $this;
        }

        /**
         * Adiciona um número de semanas sobre a data corrente
         * 
         * @param int $numDay
         * @return \ZendT_Type_Date 
         */
        public function addWeek($numWeek = 0) {
            if ($this->_value) {
                $numWeek = $numWeek * -1;
                $_value = mktime(date('H', $this->_value) * 1, date('i', $this->_value) * 1, date('s', $this->_value) * 1, (date('n', $this->_value) * 1), date('j', $this->_value) * 1 - ($numWeek * 7), date('Y', $this->_value) * 1);
                $this->_value = $_value;
            }
            return $this;
        }

    }

?>
