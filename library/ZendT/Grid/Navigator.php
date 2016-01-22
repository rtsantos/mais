<?php
    /*
    * @category    ZendT
    * @author      rsantos
    * 
    */
    class ZendT_Grid_Navigator implements ZendT_JS_Interface {
        /**
        *
        * @var type integer
        */
        private $_idGrid;
        /**
        *
        * @var type string
        */
        private $_html;
        /**
        * Irá receber o js para renderização desta instância
        * que servirá para implementação no grid
        * 
        * @var type string
        */
        private $_js;
        /**
        *
        * @var array
        */
        private $_command;
        /**
         *
         * @param string $idGrid 
         */
        public function __construct( $idGrid ){
            $this->setIdGrid($idGrid);
            $this->setHtml('<div id="pager-' . $this->getIdGrid() . '"></div>');
        }
        /**
        *
        * @return type 
        */
        public function getIdGrid() {
            return $this->_idGrid;
        }
        /**
        *
        * @param type $idGrid
        * @return \ZendT_Grid_Navigator 
        */
        public function setIdGrid($idGrid) {
            $this->_idGrid = $idGrid;
            return $this;
        }
        /**
        *
        * @return type 
        */
        public function getHtml() {
            return $this->_html;
        }
        /**
        *
        * @param type $html
        * @return \ZendT_Grid_Navigator 
        */
        public function setHtml($html) {
            $this->_html = $html;
            return $this;
        }
        /**
        *
        * @return type 
        */
        public function getJs() {
            return $this->_js;
        }
        /**
        *
        * @param type $js
        * @return \ZendT_Grid_Navigator 
        */
        public function setJs($js) {
            $this->_js = $js;
            return $this;
        }    
        /**
        * Adiciona um comando HTML a ser renderizado
        * 
        * @param string $id
        * @param string $cmdHtml 
        * @return \ZendT_Grid_Navigator 
        */
        public function addCommand($id,$cmdHtml){
            $this->_command[$id] = $cmdHtml;
            return $this;
        }
        /**
        *
        * @return string 
        */
        public function createJS(){
            $cmdHtml = '';        
            $js = '';
            if (count($this->_command) > 0){
                foreach($this->_command as $cmdHtml){
                    if (is_object($cmdHtml)){
                        $cmdHtml = $cmdHtml->render();
                    }
                    $cmdHtml = str_replace(array(chr(10),chr(13),"'"),array('','',"\'"),$cmdHtml);
                }
                $js = '.jqGrid("appendNavigatorHtml","#pager-' . $this->getIdGrid() . '",\''.$cmdHtml.'\')';
            }
            return $js;
        }
        /**
         *
         * @return string 
         */
        public function render(){
            $this->setJs($this->createJS());
            return $this->getJs();
        }
    }
?>