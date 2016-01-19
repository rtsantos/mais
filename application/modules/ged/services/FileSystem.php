<?php

   class Ged_Service_FileSystem {

       /**
        *
        * @var Ged_Model_Arquivo_FileSystem
        */
       protected $_fileSystem;

       /**
        * Escrita do arquivo
        * 
        * @param string $token
        * @param Ged_Service_FileSystem_ParamWrite $param parâmetros do arquivo
        * @param string $encode
        * 
        * @return ZendT_Service_Result
        */
       public function write($token, $param, $encode='base64') {
           $_result = new ZendT_Service_Result();
           $_result->service = __METHOD__;

           $this->_fileSystem = new Ged_Model_Arquivo_FileSystem();

           try {
               $encode = $encode.'_decode';
               $param->fileContent = $encode($param->fileContent);
               $id = $this->_fileSystem->write($param);
               if ($id instanceof ZendT_Type){
                   $id = $id->get();
               }
               $_result->id = $id;
               $_result->success = 1;
           } catch (ZendT_Exception $ex) {
               $_result->success = 0;
               $_result->message->code = $ex->getCode();
               $_result->message->message = $ex->getMessage();
               $_result->message->notification = $ex->getNotification();
           }

           return $_result;
       }

       /**
        * Leitura do arquivo
        * 
        * @param string $token
        * @param int $id
        * @param string $encode
        * @return Ged_Service_FileSystem_ResultRead
        * @throws ZendT_Exception
        */
       public function read($token, $id, $encode='base64') {
           $_result = new ZendT_Service_Result();
           $_result->service = __METHOD__;

           $this->_fileSystem = new Ged_Model_Arquivo_FileSystem();

           try {
               $result = $this->_fileSystem->read($id);
               $_result->id = $result->fileId;
               $_result->fileName = $result->fileName;
               $encode = $encode . '_encode';
               $_result->fileContent = $encode($result->fileContent);
               $_result->fileType = $result->fileType;
               $_result->fileId = $result->fileId;

               $_result->success = 1;
           } catch (ZendT_Exception $ex) {
               $_result->success = 0;
               $_result->message->code = $ex->getCode();
               $_result->message->message = $ex->getMessage();
               $_result->message->notification = $ex->getNotification();
           }

           return $_result;
       }

       /**
        * Remove o arquivo
        * 
        * @param string $token
        * @param int $id
        * @param int $delete - deleta ou não o registro do banco
        * @return ZendT_Service_Result
        * @throws ZendT_Exception
        */
       public function remove($token, $id, $delete = 1) {
           $_result = new ZendT_Service_Result();
           $_result->service = __METHOD__;

           $this->_fileSystem = new Ged_Model_Arquivo_FileSystem();

           try {
               $this->_fileSystem->remove($id, $delete);
               $_result->id = 1;
               $_result->success = 1;
           } catch (ZendT_Exception $ex) {
               $_result->success = 0;
               $_result->message->code = $ex->getCode();
               $_result->message->message = $ex->getMessage();
               $_result->message->notification = $ex->getNotification();
           }

           return $_result;
       }

   }
   