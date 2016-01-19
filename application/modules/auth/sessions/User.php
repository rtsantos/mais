<?php

    class Auth_Session_User {

        /**
         *
         * @var Auth_Session_User 
         */
        protected static $_instance = null;

        /**
         * 
         * @return Auth_Session_User
         */
        public static function getInstance() {
            if (null === self::$_instance) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        public function __construct() {
            $userRow = Zend_Auth::getInstance()->getStorage()->read();
            if (!$userRow || !$userRow->getId()) {
                self::refresh('GUEST');
            }
        }

        public function getApps() {
            return Zend_Auth::getInstance()->getStorage()->read()->getApps();
        }

        public function getId() {
            return Zend_Auth::getInstance()->getStorage()->read()->getId();
        }

        public function getLogin() {
            return Zend_Auth::getInstance()->getStorage()->read()->getLogin();
        }

        public function getName() {
            return Zend_Auth::getInstance()->getStorage()->read()->getName();
        }

        public function getRole() {
            return Zend_Auth::getInstance()->getStorage()->read()->getRole();
        }

        public function getNameFormat($empresa = true, $filial = true, $primeiroUltimo = false) {
            $_usuario = new Auth_Model_Usuario_Mapper();
            return $_usuario->setId($this->getId())->retrieve()->getNomeFormatado($empresa, $filial, $primeiroUltimo);
        }

        public function getAvatar() {
            return Zend_Auth::getInstance()->getStorage()->read()->getAvatar();
        }

        public static function refresh($login = '') {
            if ($login == 'GUEST') {
                $_SESSION["logon"]["avatar_generic"] = true;
            } else {
                $_SESSION["logon"]["avatar_generic"] = false;
            }
            $_usuario = new Auth_Model_Conta_Mapper();
            $_usuario->setNome($login)->retrieve();

            $rowSession = $_usuario->getModel()->getRowSession($_usuario->getId());

            /**
             * Verifico se existe id do usuário na sessão
             * se não escreva nela os dados do usuário 
             */
            if ($rowSession->getId() != '') {
                $storage = Zend_Auth::getInstance()->getStorage();
                $storage->write($rowSession);
                Zend_Auth::getInstance()->setStorage($storage);
                /**
                 * Usado para sistema legado
                 */
                $_SESSION["logon"]["active"] = 1;
                $_SESSION["logon"]["id_usuario"] = $rowSession->getId();
                $_SESSION["logon"]["usuario"] = $rowSession->getLogin();
                $_SESSION["logon"]["nome"] = $rowSession->getName();
                $_SESSION["logon"]["papel"] = $rowSession->getRole();
                $_SESSION["logon"]["avatar"] = $rowSession->getAvatar();
            } else {
                throw Exception('Não existe o usuário "GUEST"(Convidado) no sistema!');
            }
        }

        public function authenticated() {
            if (Zend_Auth::getInstance()->getStorage()->read()->getLogin() == 'GUEST') {
                return false;
            } else {
                return true;
            }
        }

        public function getRowSession() {
            return Zend_Auth::getInstance()->getStorage()->read();
        }

        /**
         * 
         * @return array
         */
        public function toArray() {
            $data = array();
            $data['id'] = $this->getId();
            $data['name'] = $this->getName();
            $data['role'] = $this->getRole();
            $data['login'] = $this->getLogin();
            return $data;
        }

    }
    