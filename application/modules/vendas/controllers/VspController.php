<?php
    class Vendas_VspController extends Zend_Controller_Action{
        
        public function indexAction(){
            $_interface = new Vendas_Context_Vsp_Tokio();
            $_interface->login();
            exit;
        }
    }