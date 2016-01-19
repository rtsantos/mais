<?php
    class Log_LogTabelaController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Log_Service_LogTabela';            
            $this->_formName = 'Log_Form_LogTabela_Edit';
            $this->_formSearchName = 'Log_Form_LogTabela_Search';            
            $this->_mapper = new Log_DataView_LogTabela_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'logtabela';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
