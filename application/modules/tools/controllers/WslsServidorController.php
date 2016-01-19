<?php
    class Tools_WslsServidorController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Tools_Service_WslsServidor';            
            $this->_formName = 'Tools_Form_WslsServidor_Edit';
            $this->_formSearchName = 'Tools_Form_WslsServidor_Search';            
            $this->_mapper = new Tools_Model_WslsServidor_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'wslsservidor';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
