<?php

    //require_once('Extra/HtmlPurifier/HTMLPurifier.auto.php');

    /**
     * Essa classe tem como finalidade trabalhar com campos de texto
     * grande. No oracle existe um tratamento especial para trabalhar
     * com esse tipo de dado
     * 
     * Também tem como finalidade filtrar os dados para chegar no
     * banco de dados com segurança.
     *
     * @package ZendT
     * @subpackage Clob
     * @author ksantoja
     */
    class ZendT_Type_Clob implements ZendT_Type {

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
         * Recebe uma instancia da HtmlPurifier
         * 
         * @var Html Purifier
         */
        protected $_htmlPurifier;

        /**
         * Filtra comandos html e javascript
         */
        const FILTER_FULL = 'filter-html-js';

        /**
         * Filtra apenas comandos javascript
         */
        const FILTER_JS = 'filter-js';

        /**
         * Filtra apenas comandos html
         */
        const FILTER_HTML = 'filter-html';

        /**
         *
         * @param string $value
         * @param array $options
         * @param Zend_Locale $locale 
         */
        public function __construct($value = null, $options = array('noFilter' => true), $locale = null) {
            $this->_value = $value;
            $this->_options = $options;
        }

        /**
         * Retorna o conteúdo filtrado para o banco de dados
         * 
         * @return string
         */
        public function getValueToDb() {
            /**
             * @todo trabalhar $this->_options nesse ponto 
             */
            $value = $this->_value;
            if (!$this->_options['noFilter']) {
                $value = stripslashes($this->_value);
            }
            $func = ZendT_Config::$type . '_decode';
            $value = $func($value);
            return $value;
        }

        /**
         * Retorna o conteúdo no formato do banco de dados
         * 
         * @param string $value
         * @return \ZendT_Type_Clob
         */
        public function setValueFromDb($value) {
            $func = ZendT_Config::$type . '_encode';
            $this->_value = $func($value);
            return $this;
        }

        /**
         * Configura o valor de LOB vindo do usuário
         * 
         * @param string $value
         * @param array $options
         * @param string|Zend_Locale $locale 
         * @return \ZendT_Type_Clob
         */
        public function set($value, $options = null, $locale = null) {
            $this->_value = $value;
            return $this;
        }

        /**
         * Retorna o valor do CLOB, no formato do usuário
         * @param array $options
         * @param string|Zend_Locale $locale 
         * @return string
         */
        public function get($options = null, $locale = null) {
            return $this->_value;
        }

        /**
         * Retorna o valor do CLOB, no formato do usuário
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
            return $this->getValueToDb();
        }

        /**
         * Retorna que o objeto tem conteúdo do tipo String
         */
        public function getType() {
            return 'String';
        }

    }

?>