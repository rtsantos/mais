<?php

    class Vendas_VspController extends Zend_Controller_Action {

        public function indexAction() {
            $_ice = new Vendas_Context_Vsp_Ice();
            $_ice->run();
            exit;
        }

        public function iceAction() {
            $_interface = new Vendas_Interface_Vsp_Ice();
            $where['placa'] = 'EKR4006';
            $_interface->run($where);
            exit;
        }

        public function tokioAction() {
            $_interface = new Vendas_Interface_Vsp_Tokio();
            $where['placa'] = 'EKR4006';
            $_interface->run($where);
            exit;
        }

    }
    