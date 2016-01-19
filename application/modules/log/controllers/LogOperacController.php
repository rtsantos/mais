<?php
    class Log_LogOperacController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Log_Service_LogOperac';            
            $this->_formName = 'Log_Form_LogOperac_Edit';
            $this->_formSearchName = 'Log_Form_LogOperac_Search';            
            $this->_mapper = new Log_DataView_LogOperac_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'logoperac';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
