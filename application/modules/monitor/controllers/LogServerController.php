<?php
    class Monitor_LogServerController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Monitor_Service_LogServer';            
            $this->_formName = 'Monitor_Form_LogServer_Edit';
            $this->_formSearchName = 'Monitor_Form_LogServer_Search';            
            $this->_mapper = new Monitor_DataView_LogServer_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'logserver';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
