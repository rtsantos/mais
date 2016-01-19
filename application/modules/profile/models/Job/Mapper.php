<?php
    /**
     * Classe de mapeamento do registro da tabela profile_job
     */
    class Profile_Model_Job_Mapper extends Profile_Model_Job_Crud_Mapper
    {
        protected function _afterSave() {
            parent::_afterSave();
            if ($this->_action != 'delete'){
                $client = new Zend_Http_Client("http://impressao02.tanet.com.br/job/create.php");
                $client->setParameterGet("id", $this->getId()->get());
                $client->setParameterGet("descricao", $this->getDescricao()->get());
                $client->setParameterGet("frequencia", $this->getFrequencia()->toPhp());
                $client->setParameterGet("dh_ini_exec", $this->getDhIniExec()->get());
                $client->setParameterGet("dh_fim_exec", $this->getDtFimExec()->get());
                $client->setParameterGet("tipo", $this->getTipo()->toPhp());
                $response = $client->request();
            }
        }
        
        protected function _beforeSave() {
            parent::_beforeSave();
            if ($this->_action == 'delete'){
                $client = new Zend_Http_Client("http://impressao02.tanet.com.br/job/delete.php");
                $client->setParameterGet("id", $this->getId()->get());
                $response = $client->request();
                echo $this->getId()->get();
            }
        }
        
    }
?>