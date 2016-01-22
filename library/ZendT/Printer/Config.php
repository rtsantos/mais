<?php
    /*
    * To change this template, choose Tools | Templates
    * and open the template in the editor.
    */
    /**
    * Description of Config
    *
    * @author rsantos
    */
    class ZendT_Printer_Config {
        private $_name;
        private $_ip;
        private $_documentName;
        private $_numDocByPage;
        /**
        * 
        */
        public function __construct() {
            $this->_name = 'WSPS_ETIQUETA_INTERMEC_01';
            $this->_ip = '192.168.1.162';
            $this->_documentName = 'ZendT_Printer';
            $this->_numDocByPage = 1;
        }
        /**
        * Nome da impressora
        * 
        * @param string $value
        * @return \ZendT_Printer_Config 
        */
        public function setName($value){
            $this->_name = $value;
            return $this;
        }
        /**
        * IP do servidor
        * 
        * @param string $value
        * @return \ZendT_Printer_Config 
        */
        public function setIp($value){
            $this->_ip = $value;
            return $this;
        }
        /**
        * Nome do documento
        * 
        * @param string $value
        * @return \ZendT_Printer_Config 
        */
        public function setDocumentName($value){
            $this->_documentName = $value;
            return $this;
        }
        /**
        * Número de Documentos por Página
        * 
        * @param string $value
        * @return \ZendT_Printer_Config 
        */
        public function setNumDocByPage($value){
            $this->_numDocByPage = $value;
            return $this;
        }
        /**
        * Nome da impressora
        * 
        * @return string
        */
        public function getName(){
            return $this->_name;
        }
        /**
        * IP do Servidor
        * 
        * @return string
        */
        public function getIp(){
            return $this->_ip;
        }
        /**
        * Nome do documento
        * 
        * @return string
        */
        public function getDocumentName(){
            return $this->_documentName;
        }
        /**
        * Número de Documentos por Página
        * 
        * @return string
        */
        public function getNumDocByPage(){
            return $this->_numDocByPage;
        }
    }
?>
