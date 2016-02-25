<?php

    class Tools_JobController extends ZendT_Controller_ActionCrud {

        public function init() {
            $this->_init();
            //$this->_startupAcl();            
            $this->_formName = 'Tools_Form_Job_Edit';
            $this->_mapper = new Tools_DataView_Job_MapperView();
            $this->view->tabs = $this->_mapper->getTabs();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'job';
            $this->setGrid(new ZendT_Grid('grid_' . $name));
        }

        public function testAction() {
            $_interface = new Tools_Interface_Job();
            $_interface->run();
            exit;
        }

    }

?>
