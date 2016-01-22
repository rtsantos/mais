<?php

    class ZendT_View_Helper_Hotkeys_Container {

        /**
         *
         * @var ZendT_View_Helper_Hotkeys_Container 
         */
        public static $_instance;
        private $_hotkeys;

        /**
         * 
         * @return ZendT_View_Helper_Hotkeys_Container
         */
        public static function getInstance() {
            if (!(self::$_instance instanceof ZendT_View_Helper_Hotkeys_Container)) {
                self::$_instance = new ZendT_View_Helper_Hotkeys_Container();
            }
            return self::$_instance;
        }

        public function __construct() {
            $this->_hotkeys = new ZendT_View_Hotkeys();
        }

        public function add($name, $keys, $action) {
            $this->_hotkeys->addHotkey($name, $keys, $action);
        }

        public function render() {
            return $this->_hotkeys->render();
        }

        public function __toString() {
            return $this->render();
        }

    }

?>