<?php
    class Profile_ObjectViewPrivController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Profile_Service_ObjectViewPriv';            
            $this->_formName = 'Profile_Form_ObjectViewPriv_Edit';
            $this->_formSearchName = 'Profile_Form_ObjectViewPriv_Search';            
            $this->_mapper = new Profile_DataView_ObjectViewPriv_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'objectviewpriv';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
