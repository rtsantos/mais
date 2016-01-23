<?php

    /**
     * Description of Row
     *
     * @author rsantos
     */
    class ZendT_Acl_User_Row {

        /**
         * @var int
         */
        private $_id;

        /**
         * @var string
         */
        private $_login;

        /**
         * @var string
         */
        private $_name;

        /**
         *
         * @var string
         */
        private $_role;

        /**
         *
         * @var array
         */
        private $_roles;

        /**
         * 
         * @var string
         */
        private $_email;

        /**
         *
         * @var string 
         */
        private $_chapa;

        /**
         *
         * @var array
         */
        private $_apps;

        /**
         *
         * @var string
         */
        private $_avatar;
        /**
         *
         * @var array
         */
        private $_empresa;

        /**
         *
         * @return type 
         */
        public function getId() {
            return $this->_id;
        }

        /**
         *
         * @param type $id
         * @return \ZendT_Acl_User_Row 
         */
        public function setId($id) {
            $this->_id = $id;
            return $this;
        }

        /**
         *
         * @return type 
         */
        public function getLogin() {
            return $this->_login;
        }

        /**
         *
         * @param type $login
         * @return \ZendT_Acl_User_Row 
         */
        public function setLogin($login) {
            $this->_login = $login;
            return $this;
        }

        /**
         *
         * @return type 
         */
        public function getName() {
            return $this->_name;
        }

        /**
         *
         * @param type $name
         * @return \ZendT_Acl_User_Row 
         */
        public function setName($name) {
            $this->_name = $name;
            return $this;
        }

        /**
         *
         * @return type 
         */
        public function getRole() {
            return $this->_role;
        }

        /**
         *
         * @return type 
         */
        public function getRoles() {
            return $this->_roles;
        }

        /**
         *
         * @param type $role
         * @return \ZendT_Acl_User_Row 
         */
        public function setRole($role) {
            $this->_role = $role;
            return $this;
        }

        /**
         *
         * @param type $roles
         * @return \ZendT_Acl_User_Row 
         */
        public function setRoles($roles) {
            $this->_roles = $roles;
            return $this;
        }

        /**
         *
         * @return type 
         */
        public function getEmail() {
            return $this->_email;
        }

        /**
         *
         * @param type $email
         * @return \ZendT_Acl_User_Row 
         */
        public function setEmail($email) {
            $this->_email = $email;
            return $this;
        }

        /**
         *
         * @return string 
         */
        public function getChapa() {
            return $this->_chapa;
        }

        /**
         * 
         * @param string $chapa
         * @return \ZendT_Acl_User_Row 
         */
        public function setChapa($chapa) {
            $this->_chapa = $chapa;
            return $this;
        }

        /**
         * Retorna o token do usuário
         * 
         * @return string
         */
        public function toToken() {
            $token = base64_encode(serialize($this));
            return $token;
        }

        /**
         * 
         * @param string $value
         * @return \ZendT_Acl_User_Row
         */
        public function setAvatar($value) {
            $this->_avatar = $value;
            return $this;
        }

        /**
         * 
         * @return string
         */
        public function getAvatar() {
            return $this->_avatar;
        }

        /**
         * 
         * @return array
         */
        public function getApps() {
            return $this->_apps;
        }

        /**
         * 
         * @param array $value
         * @return \ZendT_Acl_User_Row
         */
        public function setApps($value) {
            $this->_apps = $value;
            return $this;
        }
        
        /**
         * 
         * @return array
         */
        public function getEmpresa() {
            return $this->_empresa;
        }

        /**
         * 
         * @param array $value
         * @return \ZendT_Acl_User_Row
         */
        public function setEmpresa($value) {
            $this->_empresa = $value;
            return $this;
        }

        /**
         * Carrega os dados do usuário com base no token
         * 
         * @param string $token 
         * @return \ZendT_Acl_User_Row
         */
        public function fromToken($token) {
            $_token = unserialize(base64_decode($token));
            $this->setId($_token->getId());
            $this->setLogin($_token->getLogin());
            $this->setEmail($_token->getEmail());
            $this->setName($_token->getName());
            $this->setChapa($_token->getChapa());
            $this->setRole($_token->getRole());
            $this->setRoles($_token->getRoles());
            $this->setApps($_token->getApps());

            return $this;
        }

    }

?>
