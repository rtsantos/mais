<?php
    class Vendas_ParcelaController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            $this->_startupAcl();            
            $this->_formName = 'Vendas_Form_Parcela_Edit';
            $this->_mapper = new Vendas_DataView_Parcela_MapperView();
            $this->view->tabs = $this->_mapper->getTabs();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'parcela';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
