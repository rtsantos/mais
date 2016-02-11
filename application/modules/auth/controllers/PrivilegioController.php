<?php
    class Auth_PrivilegioController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();            
            $this->_formName = 'Auth_Form_Privilegio_Edit';
            $this->_mapper = new Auth_DataView_Privilegio_MapperView();
            $this->view->tabs = $this->_mapper->getTabs();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'privilegio';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
