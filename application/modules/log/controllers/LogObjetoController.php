<?php
    class Log_LogObjetoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Log_Service_LogObjeto';            
            $this->_formName = 'Log_Form_LogObjeto_Edit';
            $this->_formSearchName = 'Log_Form_LogObjeto_Search';            
            $this->_mapper = new Log_DataView_LogObjeto_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'logobjeto';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
