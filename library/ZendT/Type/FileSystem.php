<?php

   /**
    * Tipo criado com o intuito de substituir o armazenamento do arquivo na base de dados
    * facilitando o armazenamento de URL's dos Arquivos
    */
   class ZendT_Type_FileSystem implements ZendT_Type {

       protected $_value;
       protected $_options;
       protected $_locale;
       protected $_valueDb;

       /**
        *
        * @var Zend_Soap_Client
        */
       protected $_client;

       /**
        * 
        * @param ZendT_File $value
        * @param type $options
        * @param type $locale
        */
       public function __construct($value = null, $options = null, $locale = null) {
           $this->set($value, $options);
           $this->_locale = $locale;
           $this->_options = $options;



           //$wsdl = APPLICATION_PATH . '/modules/ged/services/FileSystem/wsdl/FileSystem_v1_0.wsdl';
           //$this->_client = new Zend_Soap_Client($wsdl);


           $this->_client = new Ged_Service_FileSystem();
       }

       /**
        * Retorna o arquivo
        * 
        * @return string|ZendT_File
        * @throws ZendT_Exception
        */
       public function getFile() {

           $result = '';
           if ($this->_valueDb) {
               $id = $this->_valueDb;
               if ($id instanceof ZendT_Type) {
                   $id = $this->_valueDb->toPhp();
               }
               $_result = $this->_client->read('0ac618c3e7d9012b', $this->_valueDb, 'base64');
               if ($_result->success == 1) {
                   if ($_result->fileId) {
                       $this->_value = new ZendT_File($_result->fileName
                             , base64_decode($_result->fileContent)
                             , $_result->fileType
                             , $_result->fileId);
                       $result = $this->_value;
                   } else {
                       $this->_value = '';
                   }
               } else {
                   throw new ZendT_Exception($_result->message->message, $_result->message->code);
               }
           }

           return $result;
       }

       /**
        * 
        * @param type $options
        * @param type $locale
        */
       public function get($options = null, $locale = null) {
           if ($this->_value) {
               return $this->_value;
           } else {
               return $this->_valueDb;
           }
       }

       /**
        * 
        * @param type $value
        * @param type $options
        * @param type $locale
        */
       public function set($value, $options = null, $locale = null) {
           if ($value && is_numeric($value)) {
               $this->_valueDb = $value;
           } else if ($value instanceof ZendT_File) {
               $this->_value = $value;
           } else if ($value !== null && $value) {
               $file = ZendT_File::fromFilenameCrypt($value);
               $this->_value = $file;
           }
           if (!is_array($this->_options)) {
               $this->_options = array();
           }
           if (!is_array($options)) {
               $options = array();
           }
           $this->_options = array_merge($this->_options, $options);
           $this->_locale = $locale;
           return $this;
       }

       public function isNull() {
           return $this->_value == '';
       }

       public function getValueToDb() {
           //$_server = new Ged_Service_FileSystem();
           $param = new Ged_Service_FileSystem_ParamWrite();
           if ($this->_value instanceof ZendT_File) {
               $param->fileName = $this->_value->getName();
               $param->fileContent = base64_encode($this->_value->getContent());
               $param->fileId = $this->_options['id'];
               $param->userId = $this->_options['user_id'];
               $param->parentId = $this->_options['parent_id'];
               $param->typeId = $this->_options['type_id'];
               $param->desc = $this->_options['desc'];
               $param->propName = $this->_options['prop_docto_name'];
               $param->userInc = Zend_Auth::getInstance()->getStorage()->read()->getId();
               $_result = $this->_client->write('0ac618c3e7d9012b', $param, 'base64');

               if ($_result->success == 0) {
                   throw new ZendT_Exception($_result->message->message, $_result->message->code);
               }

               return $_result->id;
           } else if ($this->_valueDb) {
               return $this->_valueDb;
           } else {
               if ($this->_options['id']) {
                   $_result = $this->_client->remove('0ac618c3e7d9012b', $this->_options['id'], 1);
                   if ($_result->success == 0) {
                       throw new ZendT_Exception($_result->message->message, $_result->message->code);
                   }
               }
               return null;
           }
       }

       /**
        * 
        * @param type $value
        */
       public function setValueFromDb($value) {
           if ($value !== null && $value) {
               $this->_valueDb = $value;
           } else {
               $this->_valueDb = '';
           }
           $this->_value = $this->get();
           return $this;
       }

       public function toPhp() {
           return $this->_valueDb;
       }

       public function __toString() {
           return $this->_value;
       }

       public function getType() {
           return 'Integer';
       }

   }
   