<?php

   class ZendT_Thread {

       /**
        *
        * @var string
        */
       private $_processId = null;

       /**
        *
        * @var string
        */
       private $_documentRoot = '';

       /**
        *
        * @var array
        */
       private $_path = '';

       /**
        *
        * @var array
        */
       private $_config = array();

       /**
        *
        * @var stdClass
        */
       private $_object = null;

       /**
        * 
        */
       public function __construct($object = null) {
           $this->_object = $object;
           $this->_documentRoot = str_replace("\\", "/", realpath('.'));
           /**
            * Busca as configurações do ambiente PHP
            */
           $filenameConfig = $this->_documentRoot . "/job/Config.xml";
           if (file_exists($filenameConfig)) {
               $xml = file_get_contents($filenameConfig);
               $config = new Zend_Config_Xml($xml);
               $this->_config = $config->toArray();
           }

           if (!isset($this->_config['Config']['Path'])) {
               $this->_config['Config']['Path'] = $this->_documentRoot . '/job/data';
           }

           if (!isset($this->_config['Config']['OperationSystem'])) {
               $this->_config['Config']['OperationSystem'] = 'Linux';
           }

           if (!isset($this->_config['Config']['PathPhpExe'])) {
               $this->_config['Config']['PathPhpExe'] = 'php';
           }
           
           if (!isset($this->_config['Config']['PathPhpExe'])) {
               $this->_config['Config']['PathPhpIni'] = '/etc/php.ini';
           }

           $this->_path = $this->_config['Config']['Path'];
           $this->_path = str_replace('\\', '/', $this->_path) . '/';
           //$this->_clearFiles();
       }

       /**
        * Enter description here...
        *
        * @param stdClass $object
        * @param string $methodName
        */
       public function start($object, $methodName, $params = array()) {
           $data = array();
           $data['object']['name'] = get_class($object);
           $data['object']['attr'] = array();
           foreach ($object as $key => $value) {
               $data['object']['attr'][$key] = $value;
           }
           $data['object']['method'] = $methodName;
           $data['object']['params'] = $params;
           $data = serialize($data);
           /**
            * Busca um nome aleatório para gerar o arquivo dat
            */
           $this->_processId = md5(date('dmyhis') . rand(1, 9999999999999));
           while (file_exists($this->_path . $this->_processId . ".in")) {
               $this->_processId = md5(date('dmyhis') . rand(1, 9999999999999));
           }
           file_put_contents($this->_path . $this->_processId . '.in', $data);
           /**
            * Prepa as informações para a execução do scriptname
            */
           $scriptname = $this->_config['Config']['PathPhpExe'] . ' -c ' . $this->_config['Config']['PathPhpIni'];
           /**
            * Prepa os dados de parâmetros
            */
           $params = $this->_documentRoot . '/job.php ';
           $params.= $this->_processId . ' ' . $this->_documentRoot . ' ' . APPLICATION_ENV . ' ' . $this->_config['Config']['Path'];
           /**
            * Caso não seja windows será executado uma 
            * linha de comando do sistema operacional para 
            * rodar em processo batch
            */
           if ($this->_config['Config']["OperationSystem"] == 'WINDOWS') {
               $this->_runWindows($scriptname, $params);
           } else {
               $this->_runLinux($scriptname, $params);
           }

           return $this->_processId;
       }

       /**
        * 
        * @param string $name
        * @param array $arguments
        */
       public function __call($name, $arguments) {
           $this->start($this->_object, $name, $arguments);
       }

       /**
        * 
        * @param string $scriptname
        * @param string $params
        */
       private function _runWindows($scriptname, $params) {
           $cmd = $scriptname . ' ' . $params;
           
           $xml = '<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?>
           <DocumentElement>
               <ParameterForExecute>
                   <Scriptname>' . $scriptname . '</Scriptname>
                   <Params>' . $params . '</Params>
               </ParameterForExecute>
           </DocumentElement>';
           //echo $scriptname . ' ' . $params;
           file_put_contents($this->_path . $this->_processId . '.xml', $xml);
       }

       /**
        * 
        * @param string $scriptname
        * @param string $params
        */
       private function _runLinux($scriptname, $params) {
           shell_exec($scriptname . " " . $params . " >/dev/null &");
       }

       /**
        * 
        */
       private function _clearFiles() {
           #$lifeTimeSeconds = 30*60; // 30 minutos 
           $lifeTimeSeconds = 1 * 24 * 60 * 60; // 1 dia
           $time = time();
           $files = glob($this->_path . "*.*");
           if (count($files) > 0) {
               foreach ($files as $file) {
                   $atime = @fileatime($file);
                   $lastAcess = (($time - $atime) / 60);
                   if ($lastAcess > $lifeTimeSeconds) {
                       @unlink($file);
                   }
               }
           }
       }

   }

?>