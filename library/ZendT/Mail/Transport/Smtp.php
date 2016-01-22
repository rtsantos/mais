<?php

    class ZendT_Mail_Transport_Smtp {

        protected $_options = array();

        public function __construct($options) {
            $this->_options = $options;
        }

        public function send() {
            $config = ZendT_Application_Resource_Mail::$defaultOptions;
            $transport = new Zend_Mail_Transport_Smtp($config['host'], $config);

            $mail = new Zend_Mail();
            $mail->setBody($this->_options['body']);

            foreach ($this->_options['from'] as $email) {
                $mail->setFrom($email);
            }

            foreach ($this->_options['to'] as $email) {
                $mail->addTo($email);
            }

            $mail->setSubject($this->_options['subject']);

            $mail->send($transport);
        }

    }
    