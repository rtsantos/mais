<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    class ZendT_Grid_Grouping implements ZendT_JS_Interface {
        /**
         * Colunas que serão agrupadas
         * @var array
         */
        private $_groupField;
        /**
         * Sequencia das colunas para exibição valor em bool
         * 
         * @var array 
         */
        private $_groupColumnShow;
        /**
         * 
         * @var array
         */
        private $_groupText;
        /**
         *
         * @var bool
         */
        private $_groupCollapse;
        /**
         *
         * @var array
         */
        private $_groupOrder;
        /**
         *
         * @var array 
         */
        private $_groupSummary;
        /**
         *
         * @var bool 
         */
        private $_showSummaryOnHide;
        /**
         *
         * @var bool 
         */
        private $_groupDataSorted;
        /**
         * 
         */
        public function __construct() {
            $this->_groupField = array();
            $this->_groupColumnShow = array(true);
            $this->_groupText = array('<b>{0}</b>');
            $this->_groupCollapse = true;
            $this->_groupOrder = array('asc');
            $this->_groupSummary = array(true);
            $this->_showSummaryOnHide = true;
            $this->_groupDataSorted = true;
        }
        /**
         * Retorna as colunas agrupadas
         * 
         * @return array 
         */
        public function getGroupField(){
            return $this->_groupField;
        }
        /**
         * Configura as colunas a serem agrupadas
         * 
         * @param array $groupField
         * @return \ZendT_Grid_Grouping 
         */
        public function setGroupField($groupField){
            $this->_groupField = $groupField;
            return $this;
        }
        /**
         * Retorna as colunas agrupadas
         * 
         * @return array 
         */
        public function getGroupColumnShow(){
            return $this->_groupColumnShow;
        }
        /**
         * Configura as colunas a serem agrupadas
         * 
         * @param array $groupColumnShow
         * @return \ZendT_Grid_Grouping 
         */
        public function setGroupColumnShow($groupColumnShow){
            $this->_groupColumnShow = $groupColumnShow;
            return $this;
        }
        /**
         * Retorna as colunas agrupadas
         * 
         * @return array 
         */
        public function getGroupText(){
            return $this->_groupText;
        }
        /**
         * Configura as colunas a serem agrupadas
         * 
         * @param array $groupText
         * @return \ZendT_Grid_Grouping 
         */
        public function setGroupText($groupText){
            $this->_groupText = $groupText;
            return $this;
        }
        /**
         * Retorna as colunas agrupadas
         * 
         * @return bool 
         */
        public function getGroupCollapse(){
            return $this->_groupCollapse;
        }
        /**
         * Configura as colunas a serem agrupadas
         * 
         * @param bool $groupCollapse
         * @return \ZendT_Grid_Grouping 
         */
        public function setGroupCollapse($groupCollapse){
            $this->_groupCollapse = $groupCollapse;
            return $this;
        } 
        /**
         * Retorna as colunas agrupadas
         * 
         * @return array 
         */
        public function getGroupOrder(){
            return $this->_groupOrder;
        }
        /**
         * Configura as colunas a serem agrupadas
         * 
         * @param array $groupOrder
         * @return \ZendT_Grid_Grouping 
         */
        public function setGroupOrder($groupOrder){
            $this->_groupOrder = $groupOrder;
            return $this;
        }   
        /**
         * Retorna as colunas agrupadas
         * 
         * @return array 
         */
        public function getGroupSummary(){
            return $this->_groupSummary;
        }
        /**
         * Configura as colunas a serem agrupadas
         * 
         * @param array $groupSummary
         * @return \ZendT_Grid_Grouping 
         */
        public function setGroupSummary($groupSummary){
            $this->_groupSummary = $groupSummary;
            return $this;
        }
        /**
         * Retorna as colunas agrupadas
         * 
         * @return bool 
         */
        public function getshowSummaryOnHide(){
            return $this->_showSummaryOnHide;
        }
        /**
         * Configura as colunas a serem agrupadas
         * 
         * @param bool $showSummaryOnHide
         * @return \ZendT_Grid_Grouping 
         */
        public function setshowSummaryOnHide($showSummaryOnHide){
            $this->_showSummaryOnHide = $showSummaryOnHide;
            return $this;
        }
        /**
         * Retorna as colunas agrupadas
         * 
         * @return bool 
         */
        public function getGroupDataSorted(){
            return $this->_groupDataSorted;
        }
        /**
         * Configura as colunas a serem agrupadas
         * 
         * @param bool $groupDataSorted
         * @return \ZendT_Grid_Grouping 
         */
        public function setGroupDataSorted($groupDataSorted){
            $this->_groupDataSorted = $groupDataSorted;
            return $this;
        }
        /**
         *
         * @return type 
         */
        public function createJS(){
            $data = array();
            foreach ($this as $name=>$prop){
                $data[substr($name,1)] = $prop;
            }
            return Zend_Json::encode($data);
        }
        /**
         *
         * @return string 
         */
        public function render(){
            return $this->createJS();
        }
    }
?>
