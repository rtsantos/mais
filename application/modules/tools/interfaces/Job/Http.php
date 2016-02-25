<?php

   class Tools_Interface_Job_Http {

       /**
        *
        * @var int
        */
       public $jobId = 0;

       /**
        * 
        */
       public function run() {
           $_job = new Tools_DataView_Job_MapperView();
           $_job->setId($this->jobId)->retrieve();
           try {
               $start = ZendT_Type_Date::nowDateTime();

               $config = array('useragent' => 'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/44.0',
                  'encodecookies' => false,
                  'timeout' => (60 * 60));

               $params = Tools_Interface_Job::prepareParams($_job->getParametro()->toPhp());

               $_client = new Zend_Http_Client($_job->getProcedimento()->toPhp(), $config);

               if (count($params) > 0) {
                   foreach ($params as $name => $value) {
                       $_client->setParameterGet($name, $value);
                   }
               }

               $response = $_client->request();
               $message = $response->getBody();
               if ($message == '' || $message == 'OK') {
                   
               } else {
                   Tools_Model_LogErro_Mapper::log($_job->getProcedimento()->toPhp(), $message);
               }

               $finish = ZendT_Type_Date::nowDateTime();
               $diff = $start->diff($finish);

               $_job->setTempoUlExec($diff->i);
           } catch (Exception $ex) {
               $message = 'Mensagem: ' . $ex->getMessage() . "\n";
               $message.= 'Erro: ' . $ex->getTraceAsString() . "\n";
               Tools_Model_LogErro_Mapper::log($_job->getProcedimento()->toPhp(), $message);
               $_job->setTempoUlExec(0);
           }
           $_job->setDhUltExec(ZendT_Type_Date::nowDateTime());
           $_job->update();

           return true;
       }

   }
   