<?php
    class Vendas_FormaPagamentoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();            
            $this->_formName = 'Vendas_Form_FormaPagamento_Edit';
            $this->_mapper = new Vendas_DataView_FormaPagamento_MapperView();
            $this->view->tabs = $this->_mapper->getTabs();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'formapagamento';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
