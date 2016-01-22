<?php
    /**
     * Cria botão para disparar um Window
     * 
     * @author rsantos
     * @package ZendT
     * @subpackage Grid
     * @category Button 
     */
    class ZendT_View_Button_Window extends ZendT_View_Button {
        /**
         *
         * @var string
         */
        private $_url;
        /**
         * Tipo de Requisição
         * 
         * @var string
         */
        private $_method;
        /**
         *
         * @var string
         */
        private $_param = '';
        /**
         *
         * @var string
         */
        private $_type;
        /**
         *
         * @var int
         */
        private $_windowHeight;
        /**
         *
         * @var int
         */
        private $_windowWidth;
        /**
         *
         * @var boolean
         */
        private $_fullScreen;
        /**
         *
         * @param string $id
         * @param string $caption
         * @param string $url 
         */
        public function __construct($id, $caption, $url) {
            $this->setUrl($url);
            $this->setId($id);
            $this->setMethod('GET');
            $this->setType('WINDOW');
            $this->setWindowHeight(450);
            $this->setWindowWidth(750);
            parent::__construct($id, $caption, $this->_getFunctionName().'()');
        }
        /**
         *
         * @param string $value
         * @return \ZendT_View_Button_Window 
         */
        public function setId($value) {
            $this->setAttr('id', $value);
            $this->setOnClick($this->_getFunctionName().'()');        
            return $this;
        }    
        /**
         * Retorna a URL de Requisição
         * 
         * @return string
         */
        public function getUrl() {
            return $this->_url;
        }
        /**
         * Configura uma URL de requisição Window
         * 
         * @param string $url
         * @return \ZendT_Grid_Button_Window 
         */
        public function setUrl($url){
            $this->_url = $url;
            return $this;
        }
        /**
        * Retorna o tipo de requisição Window POST ou GET
        * @return string
        */
        public function getMethod() {
            return $this->_method;
        }
        /**
        * Configura o tipo de requisiçao Window POST ou GET
        * @param method $method
        * @return \ZendT_Grid_Button_Window 
        */
        public function setMethod($method) {
            $this->_method = $method;
            return $this;
        }
        /**
        * Retorna os parâmetros da requisição Window
        * 
        * @return string
        */
        public function getParam() {
            return $this->_param;
        }
        /**
        * Configura os parâmetros de uma requisição Window
        * 
        * @param string $param
        * @return \ZendT_Grid_Button_Window 
        */
        public function setParam($param) {
            $this->_param = $param;
            return $this;
        }
        /**
         * Retorna a Largura da Janela
         * 
         * @return int
         */
        public function getWindowWidth(){
            return $this->_windowWidth;
        }
        /**
         * Configura a Largura da Janela
         * 
         * @param int $value
         * @return \ZendT_View_Button_Window
         */
        public function setWindowWidth($value){
            $this->_windowWidth = $value;
            return $this;
        }
        /**
         * Retorna a Altura da Janela
         * 
         * @return int
         */
        public function getWindowHeight(){
            return $this->_windowHeight;
        }
        /**
         * Configura a Altura da Janela
         * 
         * @param int $value
         * @return \ZendT_View_Button_Window
         */
        public function setWindowHeight($value){
            $this->_windowHeight = $value;
            return $this;
        }
        /**
         * Retorna o tipo de janela
         * 
         * @return string
         */
        public function getType(){
            return $this->_type;
        }
        /**
         * Configura o tipo de janela
         * 
         * @param string $value
         * @return \ZendT_View_Button_Window
         */
        public function setType($value){
            $this->_type = $value;
            return $this;
        }
        /**
         * Configura janela full screen
         * 
         * @param boolean $value
         * @return \ZendT_View_Button_Window
         */
        public function setFullScreen($value){
            $this->_fullScreen = $value;
            return $this;
        }
        /**
         * Retorna se a janela é full screen
         * 
         * @return boolean
         */
        public function getFullScreen(){
            return $this->_fullScreen;
        }
        /**
         *
         * @return type 
         */
        protected function _getFunctionName(){
            return 'onClickButton_'.str_replace('-','_',$this->getId());
        }
        /**
        * Cria o comando JavaScript
        * @return method 
        */
        public function createJS(){
            $this->addHeadScriptFile(ZendT_Url::getBaseDiretoryPublic().'/scripts/jquery/plugin/ButtonWindowT.js');            
            $clickFunction = parent::createJS().'
                function '.$this->_getFunctionName().'(){
                    jQuery.ButtonWindowT({
                        url: "' . $this->getUrl() . '",
                        method: "' . $this->getMethod() . '",
                        param: "' . $this->getParam() . '",
                        windowHeight: ' . $this->getWindowHeight() . ',
                        windowWidth: ' . $this->getWindowWidth() . ',
                        type: "' . $this->getType() . '",
                        fullscreen: "' . $this->getFullScreen() . '"
                    });
                }
            ';
            $this->addHeadScript($this->getId(), $clickFunction);
            return $clickFunction;
        }
    }
?>
