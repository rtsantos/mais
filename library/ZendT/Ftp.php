<?php

   class ZendT_Ftp {

       /**
        *
        * @var resource
        */
       protected $_idFtp;

       /**
        *
        * @var bool
        */
       protected $_isConnected;

       /**
        * 
        * @param string $host
        * @param string $user
        * @param string $pass
        * @param string $port
        * @param boolean $passive
        * @param boolean $ssl
        * @return boolean
        * @throws Exception
        */
       public function connect($host, $user, $pass, $port=21, $passive = true, $ssl = false) {
           $this->host = $host;
           $this->user = $user;
           $this->pass = $pass;
           $this->port = $port;
           $this->_idFtp = null;
           $this->passive = $passive;
           $this->ssl = $ssl;

           if ($this->ssl) {
               $this->_idFtp = @ftp_ssl_connect($this->host, $this->port);
           } else {
               $this->_idFtp = @ftp_connect($this->host, $this->port);
           }
           if (!$this->_idFtp) {
               throw new Exception('Nao foi possivel conectar ao servidor "' . $this->host . '" sobre a porta "' . $this->port . '".', -32001);
           }

           $result = @ftp_login($this->_idFtp, $this->user, $this->pass);
           if (!$result) {
               throw new Exception('Usuario ou senha invalido!', -32010);
           }

           if (!@ftp_pasv($this->_idFtp, $this->passive)) {
               throw new Exception('Nao foi possivel alterar o modo "passive mode"!', -32002);
           }
           $this->_isConnected = true;
           return true;
       }
       /**
        * Cria um arquivo no servidor de forma temporária
        * 
        * @param string $content
        * @return string
        */
       private function _createFilenameTmp($content) {
           $_file = new ZendT_File('', $content);
           return $_file->getFilename();
       }

       /**
        * Verifica se está conectado
        * @return bool
        */
       public function isConnected() {
           return $this->_isConnected;
       }

       /**
        * 
        * @param string $fileNameLocal
        * @param string $fileNameRemote
        * @return boolean
        * @throws Exception
        */
       public function put($fileNameLocal, $fileNameRemote) {
           if (!is_file($fileNameLocal)){
               $fileNameLocal = $this->_createFilenameTmp($fileNameLocal);
           }
           $result = @ftp_put($this->_idFtp, $fileNameRemote, $fileNameLocal, FTP_BINARY);
           if (!$result) {
               throw new Exception('Nao foi possivel disponibilizar o arquivo "' . $fileNameLocal . '" no servidor "' . $fileNameRemote . '".', -32003);
           }
           return true;
       }

       /**
        * 
        * @param string $fileNameLocal
        * @param string $fileNameRemote
        * @return boolean
        * @throws Exception
        */
       public function get($fileNameLocal, $fileNameRemote) {
           $result = @ftp_get($this->_idFtp, $fileNameLocal, $fileNameRemote, FTP_BINARY);
           if (!$result) {
               throw new Exception('Nao foi possivel buscar o arquivo "' . $fileNameRemote . '".', -32004);
           }
           return true;
       }

       /**
        * 
        * @param string $fileNameRemote
        * @return boolean
        * @throws Exception
        */
       public function delete($fileNameRemote) {
           $result = @ftp_delete($this->_idFtp, $fileNameRemote);
           if (!$result) {
               throw new Exception('Nao foi possivel apagar o arquivo "' . $fileNameRemote . '".', -32005);
           }
           return true;
       }

       /**
        * 
        * @param string $fileNameRemote
        * @param string $fileNameRemoteNew
        * @return boolean
        * @throws Exception
        */
       public function rename($fileNameRemote, $fileNameRemoteNew) {
           $result = @ftp_rename($this->_idFtp, $fileNameRemote, $fileNameRemoteNew);
           if (!$result) {
               throw new Exception('Nao foi possivel renomear o arquivo "' . $fileNameRemote . '".', -32006);
           }
           return true;
       }

       /**
        * 
        * @param string $folderName
        * @return string
        * @throws Exception
        */
       public function pwd($folderName) {
           $result = @ftp_pwd($this->_idFtp);
           if (!$result) {
               throw new Exception('Nao foi possivel mostrar o path.', -32007);
           }
           return $result;
       }

       /**
        * 
        * @param string $folderName
        * @return boolean
        * @throws Exception
        */
       public function changeDir($folderName) {
           $result = @ftp_chdir($this->_idFtp, $folderName);
           if (!$result) {
               throw new Exception('Nao foi possivel mudar para diretorio "' . $folderName . '" verifique se a pasta existe.', -32008);
           }
           return true;
       }

       /**
        * 
        * @param string $filter
        * @param string $folderName
        * @return array
        */
       public function listDir($filter = null, $folderName = null) {
           if ($folderName != null) {
               $this->changeDir($folderName);
           }

           $structure = array();
           $rawfiles = @ftp_rawlist($this->_idFtp, $filter);
           //file_put_contents('x.txt', $rawfiles);
           $structure = array();
           if ($rawfiles) {
               if (count($rawfiles) > 0) {
                   foreach ($rawfiles as $rawfile) {
                       if (!empty($rawfile)) {
                           $info = preg_split("/[\s]+/", $rawfile, 9);
                           if (count($info) == 4) {
                               $date = explode('-', $info[0]);
                               $time = explode(':', $info[1]);
                               if (substr($time[1], 2, 2) == 'PM') {
                                   $time[0]+= 12;
                               }
                               $time[1] = substr($time[1], 0, 2);
                               $date = strtotime($date[2] . '-' . $date[1] . '-' . $date[0] . ' ' . $time[0] . ':' . $time[1]);

                               $structure[] = array(
                                  'name' => $info[3],
                                  'dir' => (($info[2] == '<DIR>') ? 1 : 0),
                                  'size' => ((is_numeric($info[2])) ? $info[2] : null),
                                  'chmod' => null,
                                  'date' => date('Y-m-d\TH:i:s', $date),
                                  'raw' => $info
                               );
                           } else if (count($info) == 8) {
                               $structure[] = array(
                                  'name' => $info[7],
                                  'dir' => (($info[1]{0} == 'd') ? 1 : 0),
                                  'size' => $info[3],
                                  'chmod' => $info[0],
                                  'date' => date('Y-m-d\TH:i:s', strtotime($info[5] . ' ' . $info[4] . ' ' . $info[6])),
                                  'raw' => $info
                               );
                           } else {
                               $structure[] = array(
                                  'name' => $info[8],
                                  'dir' => (($info[0]{0} == 'd') ? 1 : 0),
                                  'size' => $info[4],
                                  'chmod' => $info[0],
                                  'date' => date('Y-m-d\TH:i:s', strtotime($info[6] . ' ' . $info[5] . ' ' . $info[7])),
                                  'raw' => $info
                               );
                           }
                       }
                   }
               }
           }
           return $structure;
       }

       /**
        * 
        * @param string $folderName
        * @return boolean
        * @throws Exception
        */
       public function deleteDir($folderName) {
           $result = @ftp_rmdir($this->_idFtp, $folderName);
           if (!$result) {
               throw new Exception('Nao foi possivel apagar para diretorio "' . $folderName . '" verifique se a pasta existe.', -32009);
           }
           return true;
       }

       public function disconnect() {
           @ftp_quit($this->_idFtp);
       }

       public function __destruct() {
           @$this->disconnect();
       }

   }
   