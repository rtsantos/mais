<?php

    class Tools_Interface_Job_Php {

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

                $params = Tools_Interface_Job::prepareParams($_job->getParametro()->toPhp());

                $procedimento = explode("::", $_job->getProcedimento()->toPhp());
                $_obj = new $procedimento[0]();
                $_obj->{$procedimento[1]}($params);

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
            $_job->setStatus('A');
            $_job->update();

            return true;
        }

    }
    