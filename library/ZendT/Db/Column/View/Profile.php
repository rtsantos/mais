<?php
    /**
     * 
     */
    class ZendT_Db_Column_View_Profile {
        /**
         *
         * @var array
         */
        protected $_order = array();
        /**
         *
         * @var array
         */
        protected $_remove = array();
        /**
         *
         * @var array
         */
        protected $_width = array();
        /**
         *
         * @var array
         */
        protected $_align = array();
        /**
         *
         * @var array
         */
        protected $_hidden = array();
        /**
         *
         * @var array
         */
        protected $_tree = array();
        /**
         *
         * @var array
         */
        protected $_listOptions = array();
        /**
         *
         * @var array
         */
        protected $_options = array();
        /**
         *
         * @var array
         */
        protected $_subtotal = array();
        /**
         * 
         * @var ZendT_Profile_ColumnsView 
         */
        protected $_modelView;
        /**
         *
         * @var array
         */
        protected $_required;
        /**
         *
         * @var array
         */
        protected $_autoComplete;
        /**
         *
         * @var array
         */
        protected $_autoCompleteFilter;
        /**
         *
         * @var array
         */
        protected $_seeker = array();
        /**
         *
         * @var array
         */
        protected $_groupHeaders;
        /**
         *
         * @var array
         */
        protected $_bind;
        /**
         *
         * @param string $viewName 
         */
        public function __construct($viewName,$profilesDefault){
            //$_profiles = $this->_modelView->getProfile($viewName);
            /*$_profile = new ZendT_Profile_ColumnsView();
            $config = $_profile->getProfile($viewName);
            if (count($config) > 0){
                $config['columns'] = ZendT_Sort::sortArray($config['column'], 'order');
                $_profiles['order'] = array();
                foreach($config['columns'] as $name=>$column){
                    $_profiles['order'] = $name;
                }
            }*/
            
            
            $_profiles = array();
            if (count($_profiles) == 0){
                $_profiles = $profilesDefault;
            }
            
            $this->setOrder($_profiles['order']);
            $this->setRemove($_profiles['remove']);
            $this->setWidth($_profiles['width']);
            $this->setAlign($_profiles['align']);
            $this->setHidden($_profiles['hidden']);
            $this->setTree($_profiles['tree']);
            $this->setListOptions($_profiles['listOptions']);
            $this->setSubtotal($_profiles['subtotal']);
            $this->setOptions($_profiles['options']);
            $this->setRequired($_profiles['required']);
            $this->setAutoComplete($_profiles['auto-complete']);
            $this->setSeeker($_profiles['seeker']);
            $this->setGroupHeaders($_profiles['groupHeaders']);
            $this->setBind($_profiles['bind']);
            $this->setAutocompleteFilter($_profiles['auto-complete-filter']);
        }
        /**
         *
         * @param string|array $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setRequired($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_required = $value;
            return $this;
        }
        /**
         *
         * @param string|array $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setSeeker($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_seeker = $value;
            return $this;
        }
        /**
         *
         * @param string|array $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setAutoComplete($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_autoComplete = $value;
            return $this;
        }
        
        /**
         *
         * @param string|array $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setAutocompleteFilter($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_autoCompleteFilter = $value;
            return $this;
        }
        /**
         *
         * @param string|array $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setOrder($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_order = $value;
            return $this;
        }
        /**
         *
         * @param string|array $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setRemove($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_remove = $value;
            return $this;
        }
        /**
         *
         * @param string|array $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setWidth($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_width = $value;
            return $this;
        }
        /**
         *
         * @param string|array $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setAlign($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_align = $value;
            return $this;
        }
        /**
         *
         * @param string|array $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setHidden($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_hidden = $value;
            return $this;
        }
        /**
         *
         * @param string $column 
         */
        public function addHidden($column){
            $this->_hidden[] = $column;
        }
        /**
         *
         * @param string|array $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setTree($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_tree = $value;
            return $this;
        }
        /**
         *
         * @param string|array $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setListOptions($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_listOptions = $value;
            return $this;
        }
        /**
         *
         * @param string|array $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setOptions($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_options = $value;
            return $this;
        }
        /**
         *
         * @param type $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setSubtotal($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_subtotal = $value;
            return $this;
        }
        /**
         *
         * @param string|array $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setGroupHeaders($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_groupHeaders = $value;
            return $this;
        }
        /**
         *
         * @param string|array $value
         * @return \ZendT_Db_Column_View_Profile 
         */
        public function setBind($value){
            if (is_string($value)){
                $value = explode(',', $value);
            }
            $this->_bind = $value;
            return $this;
        }
        /**
         *
         * @return array
         */
        public function getRequired($aliasColumn=''){
            if ($aliasColumn){
                return $this->_required[$aliasColumn];
            }
            return $this->_required;
        }
        /**
         *
         * @return array
         */
        public function getSeeker($aliasColumn=''){
            if ($aliasColumn){
                return $this->_seeker[$aliasColumn];
            }
            return $this->_seeker;
        }
        /**
         *
         * @return array
         */
        public function getAutoComplete($aliasColumn=''){
            if ($aliasColumn){
                return $this->_autoComplete[$aliasColumn];
            }
            return $this->_autoComplete;
        }
        /**
         *
         * @return array
         */
        public function getAutoCompleteFilter($aliasColumn=''){
            if ($aliasColumn){
                return $this->_autoCompleteFilter[$aliasColumn];
            }
            return $this->_autoCompleteFilter;
        }
        /**
         *
         * @return array
         */
        public function getOrder(){
            return $this->_order;
        }
        /**
         *
         * @return array
         */
        public function getRemove($aliasColumn){
            if ($aliasColumn){
                if (in_array($aliasColumn,$this->_remove)){
                    return true;
                }else{
                    return false;
                }
            }
            return $this->_remove;
        }
        /**
         *
         * @return array|int
         */
        public function getWidth($aliasColumn=''){
            if ($aliasColumn){
                if (isset($this->_width[$aliasColumn])){
                    return $this->_width[$aliasColumn];
                }else{
                    return 200;
                }
            }
            return $this->_width;
        }
        /**
         *
         * @return array|string
         */
        public function getAlign($aliasColumn=''){
            if ($aliasColumn){
                if (isset($this->_align[$aliasColumn])){
                    return $this->_align[$aliasColumn];
                }else{
                    return 'left';
                }
            }
            return $this->_align;
        }
        /**
         *
         * @return array
         */
        public function getHidden($aliasColumn=''){
            if ($aliasColumn){
                if (in_array($aliasColumn,$this->_hidden)){
                    return true;
                }else{
                    return false;
                }
            }
            return $this->_hidden;
        }
        /**
         *
         * @return array
         */
        public function getTree($aliasColumn=''){
            if ($aliasColumn && is_array($this->_tree)){
                if (in_array($aliasColumn,$this->_tree)){
                    return true;
                }else{
                    return false;
                }
            }
            return $this->_tree;
        }
        /**
         *
         * @return array
         */
        public function getListOptions($aliasColumn=''){
            if ($aliasColumn){
                if (isset($this->_listOptions[$aliasColumn])){
                    return $this->_listOptions[$aliasColumn];
                }else{
                    return array();
                }
            }
            return $this->_listOptions;
        }        
        /**
         * Retorna as opções particulares da coluna
         * 
         * @return array
         */
        public function getOptions($aliasColumn){
            if ($aliasColumn){
                if (isset($this->_options[$aliasColumn])){
                    return $this->_options[$aliasColumn];
                }else{
                    return array();
                }
            }
            return $this->_options;            
        }
        /**
         * Retorna as colunas que tem subtotal
         * 
         * @return array
         */
        public function getSubtotal($aliasColumn){
            if ($aliasColumn){
                if (isset($this->_subtotal[$aliasColumn])){
                    return $this->_subtotal[$aliasColumn];
                }else{
                    return false;
                }
            }
            return $this->_subtotal;            
        }
        /**
         *
         * @return array|int
         */
        public function getGroupHeaders(){
            return $this->_groupHeaders;
        }
        /**
         * Retorna as colunas que tem subtotal
         * 
         * @return array
         */
        public function getBind($aliasColumn){
            if ($aliasColumn){
                if (isset($this->_bind[$aliasColumn])){
                    return $this->_bind[$aliasColumn];
                }else{
                    return false;
                }
            }
            return $this->_bind;            
        }
    }
?>
