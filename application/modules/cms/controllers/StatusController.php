<?php
    class Cms_StatusController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Cms_Service_Status';            
            $this->_formName = 'Cms_Form_Status_Edit';
            $this->_formSearchName = 'Cms_Form_Status_Search';            
            $this->_mapper = new Cms_DataView_Status_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'status';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
            
            $this->setLayout(ZendT_Controller_Action::LAYOUT_INTRANET);
        }
    }
?>
