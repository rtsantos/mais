<?php
    /**
     * Cria botão para disparar um Window
     * 
     * @author rsantos
     * @package ZendT
     * @subpackage Grid
     * @category Button 
     */
    class ZendT_View_Button_Download extends ZendT_View_Button {
        /**
         *
         * @var string
         */
        private $_url;
        /**
         *
         * @var string
         */
        private $_param = '';
        /**
         *
         * @param string $id
         * @param string $caption
         * @param string $url 
         */
        public function __construct($id, $caption, $url) {
            $this->setUrl($url);
            $this->setId($id);
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
         * @return \ZendT_Grid_Button_Download 
         */
        public function setUrl($url){
            $this->_url = $url;
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
        * @return \ZendT_Grid_Button_Download 
        */
        public function setParam($param) {
            $this->_param = $param;
            return $this;
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
                    if($(\'iframe[name="downloadFile"]\').attr(\'name\') == undefined){
                        $(\'html\').append(\'<iframe name="downloadFile"></iframe>\');
                    }
                    $(\'iframe[name="downloadFile"]\')                    
                    .attr(\'src\',\''.$this->getUrl().'?'.$this->getParam().'\');
                }
            ';
            $this->addHeadScript($this->getId(), $clickFunction);
            return $clickFunction;
        }
    }
?>
