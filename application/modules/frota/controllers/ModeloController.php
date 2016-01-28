<?php
    class Frota_ModeloController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();            
            $this->_formName = 'Frota_Form_Modelo_Edit';
            $this->_mapper = new Frota_DataView_Modelo_MapperView();
            $this->view->tabs = $this->_mapper->getTabs();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'modelo';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
