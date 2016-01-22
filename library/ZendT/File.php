<?php

   /*
    * Essa classe tem como finalidade tratar os eventos de
    * manipulação de arquivos em um diretório temporário
    * 
    * @packge ZendT
    * @author rsantos
    */

   class ZendT_File {

       /**
        * Tempo de vida dos arquivos em horas
        * 
        * @var int
        */
       protected $_lifeTime = 1;

       /**
        *
        * @var string 
        */
       protected $_folder;

       /**
        *
        * @var string 
        */
       protected $_name;

       /**
        *
        * @var string
        */
       protected $_type;

       /**
        *
        * @var string
        */
       protected $_key = 'f1l3c5i7et1';

       /**
        *
        * @var type 
        */
       protected $_algorithm = MCRYPT_CRYPT;

       const ZENDT_FILE_PREFIX_FILENAME = 'filenameCrypt';

       protected $_id = null;

       /**
        * 
        * @param string $name
        * @param string $content 
        */
       public function __construct($name = '', $content = '', $type = 'application/txt', $id = '') {
           //if ($content) {
               $this->create($name, $content, $type, $id);
           //}
           //$this->_clearFiles();
       }

       /**
        * Busca o diretório base para jogar os
        * arquivos temporários
        *
        * @return string
        * @throws ZendT_Exception_Error 
        */
       public function getPathBase() {
           return ZendT_Lib::getTmpDir() . '/files';
       }

       /**
        * Limpa os lixos 
        */
       public function clearFiles($folder='') {
	       if (!$folder){
               $folder = $this->getPathBase() . '/';
		   }
           $dh = opendir($folder);
           while ($handle = readdir($dh)) {
               echo $folder . $handle . '<br />';
               if (is_dir($folder . $handle) && $handle != '.' && $handle != '..') {
                   $files = glob($folder . $handle . "/*.*");
                   if (count($files) == 0) {
                       $path = $folder . $handle;
					   $this->clearFiles($path.'/');
                       @rmdir($path);
                   } else {
                       foreach ($files as $file) {
                           $lastAccess = filemtime($file);
                           // 30 minutos
                           if ((time() - $lastAccess) > 30 * 60 * 1) {
                               @unlink($file);
                           }
                       }
                   }
               }
           }
           closedir($dh);
       }

       /**
        * Busca a pasta base para jogar os 
        * arquivos temporários
        *
        * @return string
        * @throws ZendT_Exception_Error 
        */
       public function getFolderBase() {

           $path = $this->getPathBase();
           if (!is_dir($path)) {
               @$result = mkdir($path);
               if (!$result) {
                   throw new ZendT_Exception_Error('Não foi possível criar o diretório temporário. Path: ' . $path . '!');
               }
           }

           try {
               #Zend_Session::start();
               #$folderBase = Zend_Session::getId();
               $folderBase = session_id();
               if (!$folderBase) {
                   throw new Exception('Sessão inexistente!');
               }
           } catch (Exception $Ex) {
               $folderBase = date('dmyhis') . rand(1000, 99999999);
           }

           if ($folderBase && !is_dir($path . '/' . $folderBase)) {
               @$result = mkdir($path . '/' . $folderBase);
               if (!$result) {
                   throw new ZendT_Exception_Error('Não foi possível criar o diretório temporário. Path: ' . $path . '!');
               }
           }
           $this->_folder = $folderBase;
           return $folderBase;
       }

       /**
        * Cria o arquivo no servidor e retorna o caminho completo do mesmo
        *
        * @param string $name
        * @param string $content
        * @return \ZendT_File
        * @throws ZendT_Exception_Error 
        */
       public function create($name = '', $content = '', $type = '', $id = '') {
           $this->_name = str_replace(':', '', $name);
           if ($this->_name == '') {
               $this->_name = md5(date('dmyhis') . rand(200000, 9999999999)) . '.tmp';
           }
           $this->_type = $type;
           $this->setId($id);
           //  $filename = $this->getPathBase() . '/' . $this->getFolderBase() . '/' . $this->_name;
           $this->getFolderBase();
           $filename = ZendT_Lib::getTmpDir() . '/files' . '/' . $this->getFolderBase() . '/' . $this->_name;
           if (file_exists($filename)) {
               @unlink($filename);
           }
           @$result = fopen($filename, 'a+');
           if (!$result) {
               $error = error_get_last();
               throw new ZendT_Exception_Error('Erro ao criar o arquivo.' . substr($error['message'], 0, 1000));
           }
           if ($content) {
               @$write = fwrite($result, $content);
               if (!$write) {
                   $error = error_get_last();
                   throw new ZendT_Exception_Error('Erro ao escrever no arquivo.' . substr($error['message'], 0, 1000));
               }
           }
           return $this;
       }

       /**
        * Retorna o nome do arquivo Gerado
        *
        * @return string
        * @throws ZendT_Exception 
        */
       public function getFilename() {
           if ($this->_folder == '') {
               throw new ZendT_Exception('Favor usar o método create ou setFilenameCrypt, para configuar a pasta de arnazenamento!');
           }
           if ($this->_name == '') {
               throw new ZendT_Exception('Favor usar o método create ou setFilenameCrypt, para configuar o nome do arquivo!');
           }
           $filename = $this->getPathBase() . '/' . $this->_folder . '/' . $this->_name;
           return $filename;
       }

       /**
        *
        * @return string
        * @throws ZendT_Exception 
        */
       public function getPath() {
           if ($this->_folder == '') {
               throw new ZendT_Exception('Favor usar o método create ou setFilenameCrypt, para configuar a pasta de arnazenamento!');
           }
           $filename = $this->getPathBase() . '/' . $this->_folder;
           return $filename;
       }

       /**
        * Retorna o nome do arquivo criptografado
        *
        * @param bool $urlEncode
        * @return string 
        */
       public function toFilenameCrypt($urlEncode = false) {
           $filename = $this->_folder . '/' . $this->_name;
           #$filename = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $filename); // Remove non-printable chars
           //$crypt = mcrypt_encrypt($this->getAlgorithm(),$this->getKey(),$filename);
           $crypt = base64_encode(utf8_encode($filename));
           $crypt = ZendT_File::ZENDT_FILE_PREFIX_FILENAME . '-' . $crypt;
           if ($urlEncode)
               $crypt = urlencode($crypt);
           return $crypt;
       }

       /**
        * 
        * @return string
        */
       public function toUrlDownload($encode = true) {
           $filename = $this->toFilenameCrypt(true);
           $uri = ZendT_Url::getHostName() .
                 ZendT_Url::getBaseUrl() .
                 '/file/download?filename=' . $filename .
                 '&type=' . $this->getType() .
                 '&delete=1';
           if ($encode) {
               $uri = base64_encode($uri);
           }
           return $uri;
       }

       /**
        * Retorna um array com o resultado que será 
        * renderizado pelo json
        *
        * @return array 
        */
       public function toArrayJson() {
           $jsonResult = array();
           $jsonResult['name'] = $this->getName();
           $jsonResult['type'] = $this->getType();
           $jsonResult['filename'] = $this->toFilenameCrypt(true);
           return $jsonResult;
       }

       /**
        * Configura o nome do arquivo criptografado
        * 
        * @param type $filename
        * @return \ZendT_File 
        */
       public static function fromFilenameCrypt($crypt) {
           $crypt = urldecode($crypt);
           $file = new ZendT_File();
           $crypt = str_replace(ZendT_File::ZENDT_FILE_PREFIX_FILENAME . '-', '', $crypt);
           //$deCrypt = mcrypt_decrypt($file->getAlgorithm(),$file->getKey(),$crypt);
           $deCrypt = utf8_decode(base64_decode($crypt));
           $pos = strrpos($deCrypt, '/');
           $name = substr($deCrypt, $pos + 1);
           $folder = substr($deCrypt, 0, $pos);
           return $file->setName($name)->setFolder($folder);
       }

       /**
        * Apaga o arquivo do servidor
        * 
        * @return \ZendT_File
        * @throws ZendT_Exception 
        */
       public function delete() {
           if ($this->_folder == '') {
               throw new ZendT_Exception('Favor usar o método create ou setFilenameCrypt, para configuar a pasta de arnazenamento!');
           }
           if ($this->_name == '') {
               throw new ZendT_Exception('Favor usar o método create ou setFilenameCrypt, para configuar o nome do arquivo!');
           }
           $filename = $this->getPathBase() . '/' . $this->_folder . '/' . $this->_name;
           if (file_exists($filename) && !@unlink($filename)) {
               throw new ZendT_Exception(error_get_last());
           }
           return $this;
       }

       /**
        * Adiciona um conteudo ao arquivo
        *
        * @param string $content
        * @return \ZendT_File
        * @throws ZendT_Exception 
        */
       public function setContent($content) {
           if ($this->_folder == '') {
               throw new ZendT_Exception('Favor usar o método create ou setFilenameCrypt, para configuar a pasta de arnazenamento!');
           }
           if ($this->_name == '') {
               throw new ZendT_Exception('Favor usar o método create ou setFilenameCrypt, para configuar o nome do arquivo!');
           }
           $filename = $this->getPathBase() . '/' . $this->_folder . '/' . $this->_name;
           if (!file_put_contents($filename, $content)) {
               throw new ZendT_Exception(error_get_last());
           }
           return $this;
       }

       /**
        * Retorna o conteudo ao arquivo
        *
        * $return string
        * @throws ZendT_Exception 
        */
       public function getContent() {
           if ($this->_folder == '') {
               throw new ZendT_Exception('Favor usar o método create ou setFilenameCrypt, para configuar a pasta de arnazenamento!');
           }
           if ($this->_name == '') {
               throw new ZendT_Exception('Favor usar o método create ou setFilenameCrypt, para configuar o nome do arquivo!');
           }
           $filename = $this->getPathBase() . '/' . $this->_folder . '/' . $this->_name;
           @$content = file_get_contents($filename);
           if ($content === false) {
               throw new ZendT_Exception(error_get_last());
           }
           return $content;
       }

       /**
        * Configura o nome do arquivo
        * 
        * @param string $value
        * @return \ZendT_File 
        */
       public function setName($value) {
           $name = explode("\r", $value);
           $this->_name = $name[0];
           return $this;
       }

       /**
        * Retorna o nome do arquivo
        *
        * @return string
        */
       public function getName() {
           return $this->_name;
       }

       /**
        * Configura o tipo do arquivo
        * 
        * @param string $value
        * @return \ZendT_File 
        */
       public function setType($value) {
           $this->_type = $value;
           return $this;
       }

       /**
        * Retorna o tipo do arquivo
        *
        * @return string
        */
       public function getType() {
           return $this->_type;
       }

       /**
        * Configura o nome da pasta base
        * 
        * @param string $value
        * @return \ZendT_File 
        */
       public function setFolder($value) {
           $this->_folder = $value;
           return $this;
       }

       /**
        * Retorna o nome da pasta base
        *
        * @return string
        */
       public function getFolder() {
           return $this->_folder;
       }

       /**
        * Retorna a chave de criptografia
        * @return string
        */
       public function getKey() {
           return $this->_key;
       }

       /**
        * Retorna o algorítmo de criptografia
        *
        * @return string
        */
       public function getAlgorithm() {
           return $this->_algorithm;
       }

       /**
        * Retorna o tamanho do arquivo
        * @return string
        */
       public function getSize($unit = 'b', $round = false) {
           @$size = filesize($this->getFilename());
           if ($size === false) {
               throw new ZendT_Exception(error_get_last());
           }
           $size = $this->_convertFileSize($size, $unit, $round);
           return $size;
       }

       /**
        * Converte o tamanho do arquivo de bites para a unidade especificada
        * 
        * @param Float $size
        * @param String $unit
        * @param Integer $round
        * @return Float
        */
       protected function _convertFileSize($size, $unit = 'b', $round = false) {
           $units = array('B', 'Kb', 'KB', 'Mb', 'MB', 'Gb', 'GB');
           if (in_array($unit, $units)) {
               $size *= 0.125;
               $count = array_search($unit, $units);
               for ($i = 1; $i <= $count; $i ++) {
                   if ($i % 2 == 0) {
                       $size /= 8;
                   } else {
                       $size /= 128;
                   }
               }
           }
           if ($round !== false) {
               $size = round($size, $round, PHP_ROUND_HALF_UP);
           }
           return $size;
       }

       /**
        * Configura o tempo de vida do arquivo
        * 
        * @param string $value
        * @return \ZendT_File 
        */
       public function setLifeTime($lifeTime) {
           $this->_lifeTime = $lifeTime;
           return $this;
       }

       public function getContentType() {
           return finfo_file(finfo_open(FILEINFO_MIME_TYPE), $this->getFilename());
       }

       public function getFileExtension() {
           return end(explode(".", $this->getFilename()));
       }

       public function setId($value) {
           $this->_id = $value;
           return $this;
       }

       public function getId() {
           return $this->_id;
       }

   }

?>