<?php
    class Profile_JobDestController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Profile_Service_JobDest';            
            $this->_formName = 'Profile_Form_JobDest_Edit';
            $this->_formSearchName = 'Profile_Form_JobDest_Search';            
            $this->_mapper = new Profile_DataView_JobDest_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'jobdest';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
