<?php

   class Layout_User {

       /**
        *
        * @var array
        */
       private $_data;

       /**
        * 
        * @param array $data
        */
       public function __construct($data) {
           $this->_data = $data;
       }

       /**
        * 
        * @return int
        */
       public function getId() {
           if (!$this->_data['id']) {
               $this->_data['id'] = 29568;
           }
           return $this->_data['id'];
       }

       /**
        * 
        * @return string
        */
       public function getLogin() {
           if (!$this->_data['login']) {
               $this->_data['login'] = 'GUEST';
           }
           return $this->_data['login'];
       }

       /**
        * 
        * @return string
        */
       public function getName() {
           if (!$this->_data['name']) {
               $this->_data['name'] = 'CONVIDADO';
           }
           return $this->_data['name'];
       }

       /**
        * 
        * @return string
        */
       public function getRole() {
           if (!$this->_data['role']) {
               $this->_data['role'] = 'DEFAULT';
           }
           return $this->_data['role'];
       }

       /**
        * 
        * @return boolean
        */
       public function authenticated() {
           if ($this->getLogin() == 'GUEST') {
               return false;
           } else {
               return true;
           }
       }

   }

?>
