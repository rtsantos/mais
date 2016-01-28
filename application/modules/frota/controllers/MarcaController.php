<?php
    class Frota_MarcaController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();            
            $this->_formName = 'Frota_Form_Marca_Edit';
            $this->_mapper = new Frota_DataView_Marca_MapperView();
            $this->view->tabs = $this->_mapper->getTabs();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'marca';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
