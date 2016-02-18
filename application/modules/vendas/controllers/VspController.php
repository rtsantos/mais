<?php
    class Vendas_VspController extends Zend_Controller_Action{
        
        public function indexAction(){
            $_ice = new Vendas_Context_Vsp_Ice();
            $_ice->run();
            
            
            /*$_interface = new Vendas_Context_Vsp_Tokio();
            //$_interface->test();
            $_interface->importXls();*/
            exit;
        }
    }