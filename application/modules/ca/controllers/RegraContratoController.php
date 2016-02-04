<?php
    class Ca_RegraContratoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            $this->_startupAcl();
            $this->_serviceName = 'Ca_Service_RegraContrato';            
            $this->_formName = 'Ca_Form_RegraContrato_Edit';
            $this->_formSearchName = 'Ca_Form_RegraContrato_Search';            
            $this->_mapper = new Ca_DataView_RegraContrato_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'regracontrato';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
