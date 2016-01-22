<?php
    /**
     * Procedimento criado para montar o corpo de um e-mail em HTML
     * 
     * @package ZendT
     * @subpackage Mail
     * @author rsantos
     */
    class ZendT_Mail_Body {
        /**
         *
         * @var string
         */
        private $_scriptName;
        /**
         *
         * @var string
         */
        private $_html;
        /**
         * Procedimento criado para montar o corpo de um e-mail em HTML
         * 
         * @param string $scriptName Nome do script que contém o HTML do e-mail
         * @param string $html string com os comandos html
         */
        public function __construct($scriptName = null, $html = null) {
            $this->_scriptName = $scriptName;
            $this->_html = $html;
        }
        /**
         *
         * @return string
         */
        public function getHtml() {
            if ($this->_html) {
                return $this->_html;
            } else {
                ob_start();
                $moduleName = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
                $controllerName = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
                require('application/modules/' . strtolower($moduleName) . '/views/scripts/' . strtolower($controllerName) . "/" . $this->_scriptName . ".phtml");
                $html = ob_get_contents();
                ob_clean();
                ob_end_flush();
                return $html;
            }
        }
        /**
         *
         * @return string 
         */
        public function __toString() {
            return $this->getHtml();
        }
    }