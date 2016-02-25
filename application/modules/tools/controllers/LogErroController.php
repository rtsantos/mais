<?php
    class Tools_LogErroController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();            
            $this->_formName = 'Tools_Form_LogErro_Edit';
            $this->_mapper = new Tools_DataView_LogErro_MapperView();
            $this->view->tabs = $this->_mapper->getTabs();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'logerro';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
