<?php
    class Auth_ContaEmpresaController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();            
            $this->_formName = 'Auth_Form_ContaEmpresa_Edit';
            $this->_mapper = new Auth_DataView_ContaEmpresa_MapperView();
            $this->view->tabs = $this->_mapper->getTabs();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'contaempresa';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
