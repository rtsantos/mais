<?php
    class ZendT_Cache{
        /**
         *
         * @var Zend_Cache 
         */
        private $_cache;
        /**
         *
         * @var string 
         */
        private $_id;
        
        public function __construct($id='',$lifetime='') {
            if (!$lifetime){
                $lifetime = 60 * 60 * 24 * 7; // 7 dias
            }
            $frontendOptions = array(
                'lifetime' => $lifetime,
                'automatic_serialization' => true
            );

            $backendOptions = array();
            $this->_cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
            $this->_id = $id;
        }
        /**
         *
         * @param string $id
         * @return boolean|array
         */
        public function get($id=''){
            if ($id == ''){
                $id = $this->_id;
            }
            if ($id == ''){
                throw new ZendT_Exception('Favor informar o id do cache!');
            }
            $data = $this->_cache->load($id);
            if (!$data){
                return false;
            }
            return unserialize($data);
        }
        /**
         *
         * @param string|array $data
         * @param string $id
         * @return \ZendT_Cache 
         */
        public function set($data,$id=''){
            if ($id == ''){
                $id = $this->_id;
            }
            if ($id == ''){
                throw new ZendT_Exception('Favor informar o id do cache!');
            }
            $data = serialize($data);
            $this->_cache->save($data, $id);
            return $this;
        }
    }
?>
