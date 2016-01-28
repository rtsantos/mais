<?php
    class Frota_VeiculoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();            
            $this->_formName = 'Frota_Form_Veiculo_Edit';
            $this->_mapper = new Frota_DataView_Veiculo_MapperView();
            $this->view->tabs = $this->_mapper->getTabs();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'veiculo';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
