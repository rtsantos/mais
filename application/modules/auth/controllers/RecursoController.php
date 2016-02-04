<?php
    class Auth_RecursoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            #$this->_startupAcl();
            $this->_serviceName = 'Auth_Service_Recurso';            
            $this->_formName = 'Auth_Form_Recurso_Edit';
            $this->_formSearchName = 'Auth_Form_Recurso_Search';            
            $this->_mapper = new Auth_DataView_Recurso_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'recurso';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
