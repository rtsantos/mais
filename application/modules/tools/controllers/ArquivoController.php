<?php
    class Tools_ArquivoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Tools_Service_Arquivo';            
            $this->_formName = 'Tools_Form_Arquivo_Edit';
            $this->_formSearchName = 'Tools_Form_Arquivo_Search';            
            $this->_mapper = new Tools_Model_Arquivo_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'arquivo';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
