<?php

   set_time_limit(0);
   #$argv[1] = 38c7f9b68c8df740bba1cc9f87ff788f 
   #$argv[2] = C:/AppWeb/htdocs
   #$argv[3] = APPLICATION_ENV
   if (!isset($argv[2])) {
       $documentRoot = realpath('.');
   } else {
       $documentRoot = $argv[2];
   }
   /**
    * Define o PATH da Aplicação
    */
   define('APPLICATION_PATH', $documentRoot . '/application');
   /**
    * Define o ambiente
    */
   define('APPLICATION_ENV', $argv[3]);
   /**
    * Atribui os paths
    */
   set_include_path(PATH_SEPARATOR . $documentRoot .
                    PATH_SEPARATOR . $documentRoot . '/library' .
                    PATH_SEPARATOR . $documentRoot . '/application' .
                    PATH_SEPARATOR . $documentRoot . '/application/modules');
   /**
    * Include de bibliotecas
    */
   require 'core.php';
   require 'ZendT/Thread/Bootstrap.php';

   $options = array();
   $options['documentRoot'] = $documentRoot;
   $options['processId'] = $argv[1];
   if (isset($argv[4])) {
       $options['dirTmp'] = $argv[4];
   }
   
   $_bootstrap = new ZendT_Thread_Bootstrap($options);
   $_bootstrap->run();
?>