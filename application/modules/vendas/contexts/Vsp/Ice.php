<?php

    class Vendas_Context_Vsp_Ice {

        /**
         *
         * @var Zend_Http_Client
         */
        protected $_client = null;

        /**
         * 
         */
        public function __construct() {
            $this->_client = new Zend_Http_Client();
        }

        /**
         * 
         */
        protected function _request($url, $params, $method = Zend_Http_Client::GET) {
            $this->_client->setUri($url)
                    ->resetParameters();

            if (count($params['header'])) {
                foreach ($params['header'] as $name => $value) {
                    $this->_client->setHeaders($name, $value);
                }
            }

            if (count($params['post'])) {
                foreach ($params['post'] as $name => $value) {
                    $this->_client->setParameterPost($name, $value);
                }
            }

            if (count($params['get'])) {
                foreach ($params['get'] as $name => $value) {
                    $this->_client->setParameterGet($name, $value);
                }
            }
            
            if (count($params['json'])) {
                //$this->_client->setHeaders('Content-type','application/json');
                $rawJson = json_encode($params['json']);
                //$this->_client->setRawData($rawJson);
                $this->_client->setRawData($rawJson, 'application/json');
            }
            
            $response = $this->_client->request($method);
            
            echo $response->getBody();
            $result = $response->getBody();
            return $result;
        }

        protected function _doLogin() {
            $params = array();
            $params['json']['login'] = 'ecv.spvistoria';
            $params['json']['senha'] = 'dlkdl109d';
            
            #$params['json']['login'] = 'felipe.marchette';
            #$params['json']['senha'] = 'mrkt1202';
            
            #$params['json']['login'] = 'ecv.comunication';
            #$params['json']['senha'] = 'a1a1a1';
            
            
            $result = $this->_request('https://servicos.vistoriasp.com.br/ECVCommunicationService/api/usuario/login', $params, Zend_Http_Client::POST);
        }

        public function run() {
            $this->_doLogin();
        }

    }
    