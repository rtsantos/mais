<?php
    class Ca_NumeracaoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            $this->_startupAcl();
            $this->_serviceName = 'Ca_Service_Numeracao';            
            $this->_formName = 'Ca_Form_Numeracao_Edit';
            $this->_formSearchName = 'Ca_Form_Numeracao_Search';            
            $this->_mapper = new Ca_DataView_Numeracao_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'numeracao';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
