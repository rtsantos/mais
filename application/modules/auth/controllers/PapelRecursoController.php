<?php
    class Auth_PapelRecursoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            #$this->_startupAcl();
            $this->_serviceName = 'Auth_Service_PapelRecurso';            
            $this->_formName = 'Auth_Form_PapelRecurso_Edit';
            $this->_formSearchName = 'Auth_Form_PapelRecurso_Search';            
            $this->_mapper = new Auth_DataView_PapelRecurso_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'papelrecurso';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
