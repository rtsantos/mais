<?php
    class ZendT_Exception extends Zend_Exception {
        protected $_notification = 'Error';
        protected $_show = 1;
        /**
         *
         * @param string $msg
         * @param int $code
         * @param Exception $previous 
         */
        public function __construct($msg = '', $code = 0, Exception $previous = null) {
            if (is_array($msg)){
                $code = $msg['type'];
                $msg = $msg['message'];
            }
            parent::__construct($msg, $code, $previous);
        }

        /**
         * Diz qual será o tipo de notificação da mensagem
         * 
         * @return string
         */
        public function getNotification() {
            return $this->_notification;
        }

        /**
         * Diz se a mensagem deve ser mostrada ou não
         * 
         * @return int
         */
        public function getShow() {
            return $this->_show;
        }

    }
?>