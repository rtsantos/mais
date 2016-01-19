<?php
    class Log_RelatorioController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            $this->_startupAcl();
            $this->_serviceName = 'Log_Service_Relatorio';            
            $this->_formName = 'Log_Form_Relatorio_Edit';
            $this->_formSearchName = 'Log_Form_Relatorio_Search';            
            $this->_mapper = new Log_DataView_Relatorio_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'relatorio';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
