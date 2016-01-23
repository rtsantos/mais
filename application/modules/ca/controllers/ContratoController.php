<?php
    class Ca_ContratoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Ca_Service_Contrato';            
            $this->_formName = 'Ca_Form_Contrato_Edit';
            $this->_formSearchName = 'Ca_Form_Contrato_Search';            
            $this->_mapper = new Ca_DataView_Contrato_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'contrato';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
