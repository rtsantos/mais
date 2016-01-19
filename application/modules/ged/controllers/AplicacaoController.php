<?php
    class Ged_AplicacaoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Ged_Service_Aplicacao';            
            $this->_formName = 'Ged_Form_Aplicacao_Edit';
            $this->_formSearchName = 'Ged_Form_Aplicacao_Search';            
            $this->_mapper = new Ged_DataView_Aplicacao_MapperView();
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
