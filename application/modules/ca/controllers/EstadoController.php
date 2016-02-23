<?php
    class Ca_EstadoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();            
            $this->_formName = 'Ca_Form_Estado_Edit';
            $this->_mapper = new Ca_DataView_Estado_MapperView();
            $this->view->tabs = $this->_mapper->getTabs();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'estado';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
