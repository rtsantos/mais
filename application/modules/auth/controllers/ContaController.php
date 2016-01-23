<?php
    class Auth_ContaController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            $this->_startupAcl();
            $this->_serviceName = 'Auth_Service_Conta';            
            $this->_formName = 'Auth_Form_Conta_Edit';
            $this->_formSearchName = 'Auth_Form_Conta_Search';            
            $this->_mapper = new Auth_DataView_Conta_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'conta';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
