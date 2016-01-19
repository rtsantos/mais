<?php
    class Auth_PapelController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            $this->_startupAcl();
            $this->_serviceName = 'Auth_Service_Papel';            
            $this->_formName = 'Auth_Form_Papel_Edit';
            $this->_formSearchName = 'Auth_Form_Papel_Search';            
            $this->_mapper = new Auth_DataView_Papel_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'papel';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
