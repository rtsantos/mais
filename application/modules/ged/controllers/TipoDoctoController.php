<?php
    class Ged_TipoDoctoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Ged_Service_TipoDocto';            
            $this->_formName = 'Ged_Form_TipoDocto_Edit';
            $this->_formSearchName = 'Ged_Form_TipoDocto_Search';            
            $this->_mapper = new Ged_DataView_TipoDocto_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'tipodocto';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
