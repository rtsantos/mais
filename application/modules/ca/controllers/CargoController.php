<?php
    class Ca_CargoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Ca_Service_Cargo';            
            $this->_formName = 'Ca_Form_Cargo_Edit';
            $this->_formSearchName = 'Ca_Form_Cargo_Search';            
            $this->_mapper = new Ca_DataView_Cargo_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'cargo';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
