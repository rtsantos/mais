<?php

    class Auth_Service_Ldap_ResultAuth extends ZendT_Service_Result {

        /**
         * @var string
         */
        public $name;

        /**
         * @var string
         */
        public $lastLogon;

        /**
         * @var string
         */
        public $userName;

        /**
         * Status do Usuário.
         * 
         * @var string
         */
        public $enable;

        /**
         * Data da Expiração da Senha.
         * 
         * @var string
         */
        public $accountExpires;

        /**
         * Quantidade de erros de autenticação.
         * 
         * @var string
         */
        public $badPwdCount;

    }
    