<?php

    class ZendT_Mail {

        /**
         *
         * @var array 
         */
        private $_to = false;

        /**
         *
         * @var type 
         */
        private $_from;

        /**
         *
         * @var type 
         */
        private $_cc;

        /**
         *
         * @var type 
         */
        private $_bcc;

        /**
         *
         * @var type 
         */
        private $_alert;

        /**
         *
         * @var type 
         */
        private $_lifeTime;

        /**
         *
         * @var type 
         */
        private $_dhSend;

        /**
         * 
         * @var ZendT_Mail_Body
         */
        private $_body;

        /**
         *
         * @var type 
         */
        private $_subject;

        /**
         *
         * @var type 
         */
        private $_messageErro;

        /**
         * 
         * @var ZendT_Mail_Db_Recipient
         */
        private $_recipient;

        /**
         * 
         * @var ZendT_Mail_Db_Sender
         */
        private $_sender;

        /**
         *
         * @var type 
         */
        private $_cityLocal;

        /**
         *
         * @var type 
         */
        private $_typeLayout;

        /**
         *
         * @var type 
         */
        private $_title;

        /**
         *
         * @var type 
         */
        private $_comment;

        /**
         *
         * @var type 
         */
        private $_id;

        /**
         *
         * @var ZendT_Mail_Attachment[] 
         */
        private $_attachment;

        /**
         * 
         * @var Zend_Mail_Transport_Smtp
         */
        #private $_transportMail;
        /**
         * 
         */
        public function __construct($options = array()) {
            $this->_lifeTime = 3;
            $this->_alert = 'rafael.santos@tanet.com.br';
            $this->_cityLocal = 'Americana';
            $this->_typeLayout = 'TA';
            $this->_dhSend = time();

            $this->_to = array();
            $this->_from = array();
            $this->_cc = array();
            $this->_bcc = array();
            $this->_attachment = array();

            $this->_recipient = new ZendT_Mail_Recipient();
            $this->_sender = new ZendT_Mail_Sender();
        }

        /**
         * Adiciona a conta do Destinatário do E-mail
         *
         * @param string $mail
         * @param string $name 
         * @return \ZendT_Mail 
         */
        public function addTo($mail, $name = "") {
            if ($name) {
                $this->_recipient->name = $name;
            }
            $this->_to[] = $mail;
            return $this;
        }

        /**
         * Adiciona a conta do Remetente do E-mail
         * 
         * @param string $mail
         * @param string $name 
         * @return \ZendT_Mail 
         */
        public function addFrom($mail, $name = "") {
            if ($name) {
                $this->_sender->name = $name;
                $this->_sender->mail = $mail;
            }
            $this->_from[] = $mail;
            return $this;
        }

        /**
         * Adiciona uma conta de cópia ao E-mail
         * 
         * @param string $mail
         * @param string $name 
         * @return \ZendT_Mail 
         */
        public function addCc($mail, $name = "") {
            $this->_cc[] = $mail;
            return $this;
        }

        /**
         * Adiciona uma conta de cópia oculta ao E-mail
         * 
         * @param string $mail
         * @param string $name 
         * @return \ZendT_Mail 
         */
        public function addBcc($mail, $name = "") {
            $this->_bcc[] = $mail;
            return $this;
        }

        /**
         * Adiciona um arquivo que será anexado ao e-mail
         * 
         * @param string $content
         * @param string $name
         * @param string $type 
         * @return \ZendT_Mail 
         */
        public function addAttachment($content, $name, $type = 'Clob', $path = '/oradb/oraftp/pub/temp') {
            $this->_attachment[] = new ZendT_Mail_Attachment($content, $name, $type, $path);
            return $this;
        }

        /**
         * Salva o e-mail para ser enviado
         *
         * @param bool $sendNow
         * @return int
         * @throws Zend_Exception 
         */
        public function send($sendNow = false) {
            $options = array();
            $options['subject'] = $this->_subject;
            $options['from'] = $this->_from;

            if (!$this->_to) {
                $this->_to[] = ZendT_Application_Resource_Mail::$defaultOptions['to'];
            }

            $options['to'] = $this->_to;
            $options['cc'] = $this->_cc;
            $options['cc'] = $this->_cc;
            $options['bcc'] = $this->_bcc;
            $options['bcc'] = $this->_bcc;
            $options['body'] = $this->_body->getHtml();

            $_transport = new ZendT_Application_Resource_Mail::$defaultOptions['adapter']($options);
            if ($_transport->send()) {
                
            } else {
                
            }

            return true;
        }

        /**
         *
         * @return string 
         */
        public function getAlert() {
            return $this->_alert;
        }

        /**
         *
         * @param string $value
         * @return \ZendT_Mail 
         */
        public function setAlert($value) {
            $this->_alert = $value;
            return $this;
        }

        /**
         * 
         * @return int 
         */
        public function getLifeTime() {
            return $this->_lifeTime;
        }

        /**
         *
         * 
         * @param int $value
         * @return \ZendT_Mail 
         */
        public function setLifeTime($value) {
            $this->_lifeTime = $value;
            return $this;
        }

        /**
         *
         * 
         * @return timestamp 
         */
        public function getDhSend() {
            return $this->_dhSend;
        }

        /**
         *
         * 
         * @param timestamp $value
         * @return \ZendT_Mail 
         */
        public function setDhSend($value) {
            $this->_dhSend = $value;
            return $this;
        }

        /**
         *
         * @return  
         */
        public function getBody() {
            return $this->_body;
        }

        /**
         *
         * 
         * @param $value
         * @return \ZendT_Mail 
         */
        public function setBody($value) {
            $this->_body = $value;
            return $this;
        }

        /**
         *
         * 
         * @return string 
         */
        public function getSubject() {
            return $this->_subject;
        }

        /**
         *
         * 
         * @param string $value
         * @return \ZendT_Mail 
         */
        public function setSubject($value) {
            $this->_subject = $value;
            return $this;
        }

        /**
         *
         * 
         * @return string
         */
        public function getMessageErro() {
            return $this->_messageErro;
        }

        /**
         *
         * 
         * @param string $value
         * @return \ZendT_Mail 
         */
        public function setMessageErro($value) {
            $this->_messageErro = $value;
            return $this;
        }

        /**
         *
         * 
         * @return string 
         */
        public function getCityLocal() {
            return $this->_cityLocal;
        }

        /**
         *
         * @param string $value
         * @return \ZendT_Mail 
         */
        public function setCityLocal($value) {
            $this->_cityLocal = $value;
            return $this;
        }

        /**
         *
         * 
         * @return string 
         */
        public function getTypeLayout() {
            return $this->_typeLayout;
        }

        /**
         *
         * 
         * @param string $value
         * @return \ZendT_Mail 
         */
        public function setTypeLayout($value) {
            $this->_typeLayout = $value;
            return $this;
        }

        /**
         *
         * @return string 
         */
        public function getTitle() {
            return $this->_title;
        }

        /**
         *
         * @param string $value
         * @return \ZendT_Mail 
         */
        public function setTitle($value) {
            $this->_title = $value;
            return $this;
        }

        /**
         *
         * 
         * @return string
         */
        public function getComment() {
            return $this->_comment;
        }

        /**
         *
         * @param string $value
         * @return \ZendT_Mail 
         */
        public function setComment($value) {
            $this->_comment = $value;
            return $this;
        }

        /**
         *
         * @return int 
         */
        public function getId() {
            return $this->_id;
        }

        /**
         *
         * @param int $value
         * @return \ZendT_Mail 
         */
        public function setId($value) {
            $this->_id = $value;
            return $this;
        }

    }
    