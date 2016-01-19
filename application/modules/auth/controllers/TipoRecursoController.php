<?php
    class Auth_TipoRecursoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            $this->_serviceName = 'Auth_Service_TipoRecurso';            
            $this->_formName = 'Auth_Form_TipoRecurso_Edit';
            $this->_formSearchName = 'Auth_Form_TipoRecurso_Search';            
            $this->_mapper = new Auth_DataView_TipoRecurso_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'tiporecurso';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
                
        }
    }
?>
