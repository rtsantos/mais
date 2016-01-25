<?php
    class Ca_ClienteContratoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Ca_Service_ClienteContrato';            
            $this->_formName = 'Ca_Form_ClienteContrato_Edit';
            $this->_formSearchName = 'Ca_Form_ClienteContrato_Search';            
            $this->_mapper = new Ca_DataView_ClienteContrato_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'clientecontrato';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
