<?php

   class Tools_Interface_Job {

       public static function prepareParams($params) {
           $result = array();
           $parts = explode('&', $params);
           if (count($parts) > 0) {
               foreach ($parts as $part) {
                   list($name, $value) = explode('=', $part);
                   if ($name) {
                       $result[$name] = $value;
                   }
               }
           }
           return $result;
       }

       public function run() {
           $_job = new Tools_DataView_Job_MapperView();
           $_where = new ZendT_Db_Where();
           $_where->addFilter('job.dh_pro_exec', ZendT_Type_Date::nowDateTime(), '<=');
           $_where->addFilter('job.dh_fim_exec', ZendT_Type_Date::nowDateTime(), '>=');
           $_job->findAll($_where, '*');
           while ($_job->fetch()) {
               if ($_job->getTpFrequencia()->toPhp() == 'H') {
                   $_job->getDhProExec()->addHour($_job->getNumFrequencia()->toPhp());
               } else if ($_job->getTpFrequencia()->toPhp() == 'D') {
                   $_job->getDhProExec()->addDay($_job->getNumFrequencia()->toPhp());
               } else if ($_job->getTpFrequencia()->toPhp() == 'M') {
                   $_job->getDhProExec()->addMonth($_job->getNumFrequencia()->toPhp());
               }
               $_job->update();

               try {
                   if ($_job->getFormaExec()->toPhp() == 'C') {
                       $_adapter = new Tools_Interface_Job_Php();
                   } else {
                       $_adapter = new Tools_Interface_Job_Http();
                   }

                   $_adapter->jobId = $_job->getId()->toPhp();

                   $_th = new ZendT_Thread();
                   $_th->start($_adapter, 'run');
               } catch (Exception $ex) {
                   $message = 'Mensagem: ' . $ex->getMessage() . "\n";
                   $message.= 'Erro: ' . $ex->getTraceAsString() . "\n";
                   Tools_Model_LogErro_Mapper::log($_job->getProcedimento()->toPhp(), $message);
               }
           }
       }

   }
   