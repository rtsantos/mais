<?php

    class Vendas_VspController extends Zend_Controller_Action {

        public function indexAction() {
            $_ice = new Vendas_Context_Vsp_Ice();
            $_ice->run();
            exit;
        }

        public function iceAction() {
            $params = $this->getRequest()->getParams();
            $_interface = new Vendas_Interface_Vsp_Ice();
            $_interface->run($params);
            exit;
        }
        
        public function iceLaudosAction(){
            $params = $this->getRequest()->getParams();
            $_interface = new Vendas_Interface_Vsp_Ice();
            $_interface->runLaudos($params);
            exit;
        }

        public function tokioAction() {
            $params = $this->getRequest()->getParams();
            $_interface = new Vendas_Interface_Vsp_Tokio();
            $_interface->run($params);
            exit;
        }

    }
    