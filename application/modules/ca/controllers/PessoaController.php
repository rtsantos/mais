<?php
    class Ca_PessoaController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            $this->_startupAcl();
            $this->_serviceName = 'Ca_Service_Pessoa';            
            $this->_formName = 'Ca_Form_Pessoa_Edit';
            $this->_formSearchName = 'Ca_Form_Pessoa_Search';            
            $this->_mapper = new Ca_DataView_Pessoa_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'pessoa';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
