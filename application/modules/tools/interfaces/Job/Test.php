<?php

   class Tools_Interface_Job_Test {

       /**
        *
        * @var int
        */
       public $input = array('ok' => true);

       /**
        * 
        */
       public function run($params = array()) {
           $message = var_export($params, true);
           Tools_Model_LogErro_Mapper::log('Tools_Interface_Job_Test', $message);
           return $params;
       }

   }
   