<?php

    require_once('Layout/Menu.php');
    require_once('Layout/Content.php');
    //require_once('Layout/MenuTopApplication.php');
    //require_once('Layout/MenuTopUser.php');

    /**
     * Classe criada para renderizar os layouts das aplicações TA
     */
    class Layout {

        /**
         *
         * @var bool 
         */
        private $_rendered;

        /**
         *
         * @var string 
         */
        private $_layout;

        /**
         *
         * @var array
         */
        private $_param;

        /**
         *
         * @param string $layout 
         */
        public function __construct($layout = 'default', $obStart = true, $filters = array()) {
            $this->_layout = $layout;
            $this->_filters = $filters;
            $this->_rendered = false;
            $this->_content = new Layout_Content();
            $this->getContent()->setDisplayTopMenu(true);
            if ($layout == 'default') {
                $this->getContent()->setMenuTopApplication(Layout_MenuTopApplication::render());
                $this->getContent()->setMenuTopUser(Layout_MenuTopUser::render());
            }
            if ($obStart)
                ob_start();
        }

        /**
         *
         * @param stdClass $content 
         */
        private function _intranet() {
            $this->_rendered = true;
            require_once('Templates/intranet.phtml');
        }

        /**
         *
         * @param stdClass $content 
         */
        private function _default() {
            $this->_rendered = true;
            require_once('Templates/default.phtml');
        }

        /**
         *
         * @param stdClass $content 
         */
        private function _window() {
            $this->_rendered = true;
            require_once('Templates/window.phtml');
        }

        /**
         *
         * @param stdClass $content 
         */
        private function _ajax() {
            $this->_rendered = true;
            require_once('Templates/ajax.phtml');
        }

        /**
         *
         * @param stdClass $content 
         */
        private function _iframe() {
            $this->_rendered = true;
            require_once('Templates/iframe.phtml');
        }

        /**
         *
         * @param stdClass $content 
         */
        private function _atividade() {
            $this->_rendered = true;
            require_once('Templates/atividade.phtml');
        }

        /**
         *
         * @param stdClass $content 
         */
        private function _print() {
            $this->_rendered = true;
            require_once('Templates/print.phtml');
        }

        /**
         *
         * @param stdClass $content 
         */
        private function _json() {
            $this->_rendered = true;
            require_once('Templates/json.phtml');
        }

        /**
         *
         * @param stdClass $content 
         */
        public function render($body = '') {
            if ($body) {
                $this->getContent()->setBody($body);
            } else {
                $this->getContent()->setBody(ob_get_contents());
                ob_clean();
            }
            $layout = '_' . $this->_layout;
            $this->{$layout}();
        }

        /**
         * 
         * @param string $name
         * @param string $value
         * @return \Layout
         */
        public function addParam($name, $value) {
            $this->_param[$name] = $value;
            return $this;
        }

        /**
         * 
         * @param string $name
         * @return string
         */
        public function getParam($name) {
            return $this->_param[$name];
        }

        /**
         * Verifica se o layout foi renderizado
         * 
         * @return bool
         */
        public function isRendered() {
            return $this->_rendered;
        }

        /**
         *
         * @return Layout_Content 
         */
        public function getContent() {
            return $this->_content;
        }

        public function setMenu($value) {
            $this->_menu = $value;
            return $this;
        }

        public function getMenu() {
            return $this->_menu;
        }

        public function getApps($all = false) {
            $result = array();
            if ($_SESSION['logon']['usuario'] != 'GUEST') {
                if (!$all) {
                    $result = $_SESSION['logon']['topApplication'];
                } else {
                    $result = $_SESSION['logon']['allApplication'];
                }

                if (count($this->_filters) > 0) {
                    if (count($result)) {
                        foreach ($result as $app => &$values) {
                            foreach ($this->_filters as $filter) {
                                $values['descricao'] = $filter($values['descricao']);
                            }
                        }
                    }
                }
                /* foreach ($result as $app => &$values) {
                  $string = new ZendT_Type_String($values['descricao']);
                  $values['descricao'] = $string->get();
                  } */
            }
            return $result;
        }

        public function getNotificacoes() {
            return Cms_Model_Notificacao_Mapper::get();
        }

    }

?>