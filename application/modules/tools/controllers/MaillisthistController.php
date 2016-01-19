<?php
    class Tools_MaillisthistController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Tools_Service_Maillisthist';            
            $this->_formName = 'Tools_Form_Maillisthist_Edit';
            $this->_formSearchName = 'Tools_Form_Maillisthist_Search';            
            $this->_mapper = new Tools_Model_Maillisthist_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'maillisthist';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
        
        public function gridAction() {
            $this->configGrid();
            $this->getGrid()->getObjToolbar()->removeButton('add');
            $this->getGrid()->getObjToolbar()->removeButton('edit');
            $this->getGrid()->getObjToolbar()->removeButton('del');
            $this->getGrid()->getObjToolbar()->removeButton('xls');
            $this->getGrid()->getObjToolbar()->removeButton('pdf');
            $this->getColumns();
            $this->view->grid = $this->getGrid()->render();
        }
    }
?>
