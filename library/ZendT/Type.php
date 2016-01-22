<?php

    /**
     * Essa classe tem como finalidade tratar os tipos de objeto
     * particular
     *
     * @package ZendT
     * @subpackage Type
     * @author rsantos
     */
    interface ZendT_Type {

        /**
         * Construtor da classe
         * 
         * @param string|int $value
         * @param array|string $options
         * @param string|Zend_Locale $locale 
         */
        public function __construct($value = null, $options = null, $locale = null);

        /**
         * Retorna o valor no formato do usuário
         *
         * @param string $options
         * @param type $locale 
         */
        public function get($options = null, $locale = null);

        /**
         * Preenche o valor vindo do usuário
         */
        public function set($value, $options = null, $locale = null);

        /**
         * Retorna o valor no formato que o banco de dados aceita
         */
        public function getValueToDb();

        /**
         * Configura o valor vindo do banco de dados
         */
        public function setValueFromDb($value);

        /**
         * Configura o valor vindo do banco de dados
         */
        public function isNull();

        /**
         * Método default para retornar o valor em string
         */
        public function __toString();

        public function toPhp();
    }

?>
