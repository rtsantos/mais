<?php
    /**
     *
     * @author lmarquesini
     */
    class ZendT_Acl_Ldap_Row {
        
        /**
         * @var string
         */
        private $_login;
        
        /**
         * @var string
         */
        private $_nome;
        
        /**
         * @var string
         */
        private $_email;
        
        /**
         * @var array
         */
        private $_groups;
        
        
        public function setLogin($login) {
            $this->_login = $login;
        }
        
        public function getLogin() {
            return $this->_login;
        }
        
        public function setNome($nome) {
            $this->_nome = $nome;
        }
        
        public function getNome() {
            return $this->_nome;
        }
        
        public function setEmail($email) {
            $this->_email = $email;
        }
        
        public function getEmail() {
            return $this->_email;
        }
        
        public function addGroup($group) {
            $this->_groups[] = $group;
        }
        
        public function listGroups() {
            return $this->_groups;
        }
        
    }