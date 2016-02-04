<?php
    /**
     * Description of Row
     *
     * @author rsantos
     */
    class ZendT_Acl_Resource_RowMenu {
        /**
         * Url do menu
         * 
         * @var string
         */
        private $_url;

        /**
         * Descrição do menu
         * 
         * @var string
         */
        private $_description;
        
        /**
         * ìcone do menu
         * 
         * @var string
         */
        private $_parent;
        /**
         *
         * @var bool
         */
        private $_group;
        
        /**
         *
         * @return string
         */
        public function getParent() {
            return $this->_parent;
        }

        /**
         *
         * @param string $parent
         * @return \ZendT_Acl_Resource_RowMenu 
         */
        public function setParent($parent) {
            $this->_parent = $parent;
            return $this;
        }
        
        /**
         *
         * @return string
         */
        public function getUrl() {
            return $this->_url;
        }

        /**
         *
         * @param string $url
         * @return \ZendT_Acl_Resource_RowMenu 
         */
        public function setUrl($url) {
            $this->_url = $url;
            return $this;
        }

        /**
         *
         * @return string
         */
        public function getDescription() {
            return $this->_description;
        }

        /**
         *
         * @param string $description
         * @return \ZendT_Acl_Resource_RowMenu 
         */
        public function setDescription($description) {
            $this->_description = $description;
            return $this;
        }
        /**
         * 
         * @return bool
         */
        public function getGroup(){
            return $this->_group;
        }
        /**
         * 
         * @param bool $value
         * @return \ZendT_Acl_Resource_RowMenu
         */
        public function setGroup($value){
            $this->_group = $value;
            return $this;
        }
        /**
         * Retorna um array com os dados
         * @return type 
         */
        public function toArray(){
            $row['url'] = $this->_url;
            $row['desc'] = $this->_description;
            $row['group'] = $this->_group;
            return $row;
        }
    }
?>
