<?php

    class Tools_Interface_Job {

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

                $procedimento = explode("::", $_job->getProcedimento()->toPhp());

                try {
                    $_obj = new $procedimento[0]();
                    $_obj->{$procedimento[1]}();

                    $_job->getDhUltExec(ZendT_Type_Date::nowDateTime());
                } catch (Exception $ex) {
                    $message = 'Mensagem: ' . $ex->getMessage() . "\n";
                    $message.= 'Erro: ' . $ex->getTraceAsString() . "\n";
                    Tools_Model_LogErro_Mapper::log($procedimento[0], $message);
                }

                $_job->update();
            }
        }

    }
    