<?php
    /**
     * 
     */
    class ZendT_Json_Client extends Zend_Http_Client{
        /**
         * Requisita uma ação do serviço via json
         *
         * @param string $name
         * @param array $arguments
         * @return array|string 
         */
        public function __call($name, $arguments){
            $paramRequest = array (
                'jsonrpc' => '2.0',
                'method' => $name,
                'params' => $arguments,
                'id' => $name
            );
            $this->setRawData(json_encode($paramRequest));
            $return = $this->request()->getBody();
            $result = json_decode($return);
            return $result;
        }
    }
?>
