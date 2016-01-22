<?php

    /*
     * @category    ZendT
     * @author      jcarlos
     * 
     */

    class ZendT_Grid_Button_Delete extends ZendT_Grid_Button implements ZendT_JS_Interface {

        /**
         *
         * @var type string
         */
        private $_url;

        /**
         *
         * @var type numeric
         */
        private $_windowHeight = 520;

        /**
         *
         * @var type numeric
         */
        private $_windowWidth = 720;

        /**
         * 
         * @var type function
         */
        private $_onAfterLoad;

        /**
         *
         * @var type string
         */
        private $_modal = 'true';

        /**
         *
         * @var type string
         */
        private $_type = 'AJAX';

        public function __construct($id = null) {
            parent::__construct($id);
        }

        public function getUrl() {
            return $this->_url;
        }

        public function setUrl($url) {
            $this->_url = $url;
            return $this;
        }

        public function getWindowHeight() {
            return $this->_windowHeight;
        }

        public function setWindowHeight($windowHeight) {
            $this->_windowHeight = $windowHeight;
            return $this;
        }

        public function getWindowWidth() {
            return $this->_windowWidth;
        }

        public function setWindowWidth($windowWidth) {
            $this->_windowWidth = $windowWidth;
            return $this;
        }

        public function getOnAfterLoad() {
            return $this->_onAfterLoad;
        }

        public function setOnAfterLoad($onAfterLoad) {
            $this->_onAfterLoad = $onAfterLoad;
            return $this;
        }

        public function getModal() {
            return $this->_modal;
        }

        public function setModal($modal) {
            $this->_modal = $modal;
            return $this;
        }

        public function getType() {
            return $this->_type;
        }

        public function setType($type) {
            $this->_type = $type;
            return $this;
        }

        public function createJS() {
            $selector = "jQuery('#" . $this->getIdGrid() . "')";
            $clickFunction = "
                function(){
                 var idSel = " . $selector . ".jqGrid('getGridParam', 'selrow');
                  if(idSel != null){    
                    if (confirm('Deseja Remover o Registro selecionado?')){    
                        jQuery.AjaxT.json({
                           url: '" . $this->getUrl() . "',
                           data: 'id='+idSel,
                           success: function (result) {
                            " . $selector . ".trigger('reloadGrid');
                           }
                        })
                   }
                 } 
                }";

            return $clickFunction;
        }

        /**
         * Renderiza o botão
         * 
         * @return method 
         */
        public function render() {
            return parent::render();
        }

    }

?>
