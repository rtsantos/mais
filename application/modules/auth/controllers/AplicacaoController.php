<?php
    class Auth_AplicacaoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            #$this->_startupAcl();
            $this->_serviceName = 'Auth_Service_Aplicacao';            
            $this->_formName = 'Auth_Form_Aplicacao_Edit';
            $this->_formSearchName = 'Auth_Form_Aplicacao_Search';            
            $this->_mapper = new Auth_DataView_Aplicacao_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'aplicacao';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
