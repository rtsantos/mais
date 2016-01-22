<?php

    /**
     * Classe com constantes de configuração, usado pela aplicação
     * 
     * 
     * @author rsantos
     * @package ZendT
     * @subpackage ZendT_Config
     * @version 1.0 
     */
    class ZendT_Config {

        /**
         * Usado no objeto ZendT_Type
         * Essa configuração é atribuída conforme charset do banco de dados
         * Ao efetuar qualquer comando no no bando de dados essa configuração é 
         * alterada para fazer as conversões na tipagem.
         * 
         * @var string
         */
        public static $type = 'utf8';

    }
    