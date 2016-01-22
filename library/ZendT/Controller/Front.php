<?php
    class ZendT_Controller_Front {
        /**
        * Singleton instance
        *
        * Marked only as protected to allow extension of the class. To extend,
        * simply override {@link getInstance()}.
        *
        * @var ZendT_Controller_Front
        */
        protected static $_instance = null;
        /**
         *
         * @var string 
         */
        protected $_baseUrl;
        /**
         *
         * @var string
         */
        protected $_layoutDirectory;
        /**
         *
         * @var string
         */
        protected $_moduleDirectory;
        /**
         *
         * @var string
         */
        protected $_controllerDirectory;
        /**
         * @var type 
         */
        protected $_moduleNameDefault = 'default';
        /**
         *
         * @var type 
         */
        protected $_controllerNameDefault = 'index';
        /**
         *
         * @var type 
         */
        protected $_actionNameDefault = 'index';
        /**
         *
         * @var array
         */
        protected $_headers;
        /**
         *
         * @var Zend_Controller_Request_Http 
         */
        protected $_request;
        /**
         *
         * @var Zend_Controller_Response_Http 
         */
        protected $_response;
        /**
         * Busca o nome do módulo
         */
        protected function _getModuleDefault(){
            return 'Default';
        }
        /**
         * Busca o nome do módulo
         */
        protected function _getControllerDefault(){
            return 'Index';
        }
        /**
         * Busca o nome do módulo
         */
        protected function _getActionDefault(){
            return 'index';
        }
        /**
         *
         * @return string
         */
        public function getBaseUrl(){
            return $this->_baseUrl;
        }
        /**
         * Providencia o roteamento
         *
         * @throws ZendT_Exception 
         */
        public function dispatch(){
            try{
                /**
                * Detecta os parâmetros de url rewrite 
                */
                $pathInfo = $this->getRequest()->getPathInfo();
                $_paramRewrite = explode('/',$pathInfo);
                
                $uriModule = $_paramRewrite[1];
                $uriController = $_paramRewrite[2];
                $uriAction = $_paramRewrite[3];
                unset($_paramRewrite[0]);
                unset($_paramRewrite[1]);
                unset($_paramRewrite[2]);
                unset($_paramRewrite[3]);
                

                $module = ZendT_Lib::formatNameObject($uriModule);
                $controller = ZendT_Lib::formatNameObject($uriController);
                $action = ZendT_Lib::formatNameObject($uriAction,true);

                if (!is_dir($this->_moduleDirectory.'/'.$module)){
                    $module = ucfirst($this->_moduleNameDefault);
                    $uriModule = $this->_moduleNameDefault;
                }

                if (!file_exists($this->_moduleDirectory.'/'.$module.'/Controller/'.$controller.'.php')){
                    $controller = ucfirst($this->_controllerNameDefault);
                    $uriController = $this->_controllerNameDefault;
                }
                $className = $module.'_Controller_'.$controller;
                
                $options = array();
                $options['module'] = $uriModule;
                $options['controller'] = $uriController;
                $options['action'] = $uriAction;
                $options['moduleDirectory'] = $this->_moduleDirectory;
                $options['layoutDirectory'] = $this->_layoutDirectory;
                
                $_controller = new $className($this->getRequest(),$this->getResponse(),$options);
                $action.= 'Action';
                if (!method_exists($_controller, $action)){
                    $action = $this->_actionNameDefault.'Action';
                    if (!method_exists($_controller, $action.'Action')){
                        throw new ZendT_Exception('Action invalid!');
                    }else{
                        $uriAction = $this->_actionNameDefault;
                    }
                }

                $this->getRequest()->setParam('module', $uriModule);
                $this->getRequest()->setParam('controller', $uriController);
                $this->getRequest()->setParam('action', $uriAction);                
                
                $_controller->_init();
                $result = call_user_method($action, $_controller);
                
                if (is_array($result)){
                    foreach($result as $key=>$value){
                        $_controller->view->{$key} = $value;
                    }
                }
                
                $this->getResponse()->setBody($_controller->view->render());
                foreach($this->_headers as $name=>$value){
                    $this->getResponse()->setHeader($name, $value);
                }
                
                echo $this->getResponse()->sendResponse();
            }catch(Exception $ex){
                echo $ex->getMessage();
            }
        }        
        /**
         *
         * @param array $options 
         */
        public function setOptions($options){
            if (count($options) > 0){
                foreach($options as $key=>$value){
                    $prop = '_'.$key;
                    $this->{$prop} = $value;
                }
            }       
        }
        /**
         *
         * @return Zend_Controller_Request_Http 
         */
        public function getRequest(){
            if (!$this->_request instanceof Zend_Controller_Request_Http){
                $this->_request = new Zend_Controller_Request_Http();
            }
            return $this->_request;
        }        
        /**
         * 
         * @return \Zend_Controller_Response_Http
         */
        public function getResponse(){
            if (!$this->_response instanceof Zend_Controller_Response_Http){
                $this->_response = new Zend_Controller_Response_Http();
            }
            return $this->_response;
        }
        /**
         * Singleton instance
         *
         * @return ZendT_Controller_Front
         */
        public static function getInstance(){
            if (null === self::$_instance) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }
    }
?>