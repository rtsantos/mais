<?php
    class Ca_ContratoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            $this->_startupAcl();
            $this->_formName = 'Ca_Form_Contrato_Edit';
            $this->_mapper = new Ca_DataView_Contrato_MapperView();
            $this->view->tabs = $this->_mapper->getTabs();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'contrato';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
