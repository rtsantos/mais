<?php

   /**
    * Dependências
    */
   require 'Extra/Zip/ziplib.php';
   /**
    * 
    */
   class ZendT_Zip {

       /**
        *
        * @var ziplib
        */
       protected $_zip;

       /**
        *
        * @var string
        */
       private $_fileName;

       /**
        * 
        * @param string $fileName
        * @return \ZendT_Zip
        */
       public function open($fileName) {
           $this->_fileName = $fileName;
           $this->_zip = new ziplib();
           return $this;
       }

       /**
        * 
        * @param string $filename
        * @param string $name
        * @return \ZendT_Zip
        */
       public function addFile($filename, $name = null) {
           if (is_file($filename)) {
               $content = file_get_contents($filename);
               
               $posName = strrpos(str_replace('\\', '/', $filename), '/');
               if ($posName !== false){
                   $posName++;
               }else{
                   $posName = 0;
               }
               $name = substr($filename, $posName);
           } else {
               $content = $filename;
               if ($name == '') {
                   throw new Exception('ZendT_Zip :: Favor informar o nome do arquivo a ser zipado!',9001);
               }
           }
           $this->_zip->addFile($content, $name);
           return $this;
       }

       /**
        * 
        * @return \ZendT_Zip
        * @throws ZendT_Exception
        */
       public function close() {
           $this->_zip->output($this->_fileName);
           if (!file_exists($this->_fileName)) {
               throw new Exception('ZendT_Zip :: Nao foi possivel gerar o arquivo Zip!',9000);
           }
           return $this;
       }

   }

?>