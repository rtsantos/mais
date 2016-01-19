<?php

   /*
    * To change this license header, choose License Headers in Project Properties.
    * To change this template file, choose Tools | Templates
    * and open the template in the editor.
    */

   /**
    *
    * @author rsantos
    */
   class Ged_Service_FileSystem_Client {

       protected $_uri;

       public function __construct() {
           $result = include 'file-system-dirs.php';
           $this->_uri = $result['uri'];
           $this->_client = new Zend_Soap_Client($this->_uri);
       }

       /**
        * Escrita do arquivo
        * 
        * @param Ged_Service_FileSystem_ParamWrite $param parâmetros do arquivo
        * @return \ZendT_Service_Result
        */
       public function write($param) {
           $result = $this->write($param);

           return $result;
       }

   }
   