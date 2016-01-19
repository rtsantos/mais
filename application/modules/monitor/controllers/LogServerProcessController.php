<?php
    class Monitor_LogServerProcessController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Monitor_Service_LogServerProcess';            
            $this->_formName = 'Monitor_Form_LogServerProcess_Edit';
            $this->_formSearchName = 'Monitor_Form_LogServerProcess_Search';            
            $this->_mapper = new Monitor_DataView_LogServerProcess_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'logserverprocess';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
