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

       public function getHierarquiaEmpresa() {
           return $_SESSION['logon']['empresa']['hierarquia'];
       }
       
       public function getIdEmpresa() {
           return $_SESSION['logon']['empresa']['id'];
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
               $_SESSION["logon"]["usuario"]['id'] = $rowSession->getId();
               $_SESSION["logon"]["usuario"]['login'] = $rowSession->getLogin();
               $_SESSION["logon"]["usuario"]['nome'] = $rowSession->getName();
               $_SESSION["logon"]['papel'] = $rowSession->getRole();
               $_SESSION["logon"]["avatar"] = $rowSession->getAvatar();
               $_SESSION["logon"]["empresa"] = $rowSession->getEmpresa();
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
           //$data['empresa'] = $this->getEmpresa();
           //$data['apps'] = $this->getApps();
           return $data;
       }

   }
   