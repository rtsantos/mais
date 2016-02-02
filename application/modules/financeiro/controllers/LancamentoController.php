<?php
    class Financeiro_LancamentoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();            
            $this->_formName = 'Financeiro_Form_Lancamento_Edit';
            $this->_mapper = new Financeiro_DataView_Lancamento_MapperView();
            $this->view->tabs = $this->_mapper->getTabs();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'lancamento';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
