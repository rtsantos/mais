<?php
    class Auth_ContaRelController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            #$this->_startupAcl();
            $this->_serviceName = 'Auth_Service_ContaRel';            
            $this->_formName = 'Auth_Form_ContaRel_Edit';
            $this->_formSearchName = 'Auth_Form_ContaRel_Search';            
            $this->_mapper = new Auth_DataView_ContaRel_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'contarel';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
