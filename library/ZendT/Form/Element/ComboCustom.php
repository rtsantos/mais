<?php

    /**
     * 
     *
     * @category    ZendT
     * @author      ksantoja
     */

    /**
     * Form Element para ComboCuston do ZendT
     *
     * 
     */
    class ZendT_Form_Element_ComboCustom extends ZendT_Form_Element {

        public $helper = "comboCustom";

        public function __construct($spec, $options = null) {
            parent::__construct($spec, $options);
            $decoratorDefault = new ZendT_Form_Decorator_Default();
            $this->addDecorator($decoratorDefault);
        }

        /**
         * Define um URL para o botão Add
         * 
         * @param string $url
         * @return \ZendT_Form_Element_ComboCustom 
         */
        public function setNavAdd($url) {
            if ($url) {
                $this->_setGridParams('navAdd', $url);
                $this->_setNavButtons('add', 'true');
            }
            return $this;
        }

        /**
         * Define um URL para o botão Edit
         * 
         * @param string $url
         * @return \ZendT_Form_Element_ComboCustom 
         */
        public function setNavEdit($url) {
            if ($url) {
                $this->_setGridParams('navEdit', $url);
                $this->_setNavButtons('edit', 'true');
            }
            return $this;
        }

        /**
         * Define um URL para o botão Del
         * 
         * @param string $url
         * @return \ZendT_Form_Element_ComboCustom 
         */
        public function setNavDel($url) {
            if ($url) {
                $this->_setGridParams('navDel', $url);
                $this->_setNavButtons('del', 'true');
            }
            return $this;
        }

        /**
         * Define uma URL para o grid
         * 
         * @param string $url
         * @return \ZendT_Form_Element_ComboCustom 
         */
        public function setUrl($url) {
            if ($url) {
                $this->_setGridParams('url', $url);
            }
            return $this;
        }

        /**
         * Adiciona um novo parametro ao Grid do ComboCustom
         * 
         * @param string $key
         * @param string $value 
         */
        private function _setGridParams($key, $value) {
            $grid = $this->getJQueryParam('grid');
            if (is_array($grid)) {
                $this->setJQueryParams(array('grid' => array_merge($grid, array($key => $value))));
            } else {
                $this->setJQueryParams(array('grid' => array($key => $value)));
            }
        }

        /**
         * Retorna um parametro do Grid
         * 
         * @param string $key
         * @return string|array 
         */
        private function _getGridParam($key) {
            $grid = $this->getJQueryParam('grid');
            return $grid[$key];
        }

        /**
         * Adiciona um parametro novo ao navButtons do Grid
         * 
         * @param string $key
         * @param string $value 
         */
        private function _setNavButtons($key, $value) {
            $grid = $this->_getGridParam('navButtons');
            if (is_array($grid)) {
                $this->_setGridParams('navButtons', array_merge($grid, array($key => $value)));
            } else {
                $this->_setGridParams('navButtons', array($key => $value));
            }
        }

        /**
         * Retorna o valor do parametro navAdd do Grid
         * 
         * @return string
         */
        public function getNavAdd() {
            return $this->_getGridParam('navAdd');
        }

        /**
         * Retorna o valor do parametro navEdit do Grid
         * 
         * @return string
         */
        public function getNavEdt() {
            return $this->_getGridParam('navEdit');
        }

        /**
         * Retorna o valor do parametro navDel do Grid
         * 
         * @return string
         */
        public function getNavDel() {
            return $this->_getGridParam('navDel');
        }

        /**
         * Define um id para o grid do ComboCustom
         * 
         * @param string $value
         * @return \ZendT_Form_Element_ComboCustom 
         */
        public function setIdGrid($value) {
            $this->_setGridParams('id', $value);
            return $this;
        }

        /**
         * Retorna o id da grid do ComboCustom
         * 
         * @return string
         */
        public function getIdGrid() {
            return $this->_getGridParam('id');
        }

        /**
         * Define um Height para o grid do ComboCustom
         * 
         * @param int|string $value
         * @return \ZendT_Form_Element_ComboCustom 
         */
        public function setHeight($value) {
            $this->_setGridParams('height', $value);
            return $this;
        }

        /**
         * Retorna o Height da grid do combocustom
         * 
         * @return int|string
         */
        public function getHeight() {
            return $this->_getGridParam('height');
        }

        /**
         * Define o numero maximo de linhas do grid
         * 
         * @param int $value
         * @return \ZendT_Form_Element_ComboCustom 
         */
        public function setMaxRows($value) {
            if (is_numeric($value)) {
                $this->_setGridParams('rowNum', $value);
            } else {
                require_once "ZendX/JQuery/Exception.php";
                throw new ZendX_JQuery_Exception(
                        'setMaxRow deve conter um valor numerico'
                );
            }
            return $this;
        }

        /**
         * Retorna o numero maximo de linhs do Grid
         * 
         * @return int
         */
        public function getMaxRows() {
            return $this->_getGridParam('rowNum');
        }

    }