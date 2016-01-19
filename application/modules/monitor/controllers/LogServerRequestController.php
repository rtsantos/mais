<?php
    class Monitor_LogServerRequestController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Monitor_Service_LogServerRequest';            
            $this->_formName = 'Monitor_Form_LogServerRequest_Edit';
            $this->_formSearchName = 'Monitor_Form_LogServerRequest_Search';            
            $this->_mapper = new Monitor_DataView_LogServerRequest_MapperView();
            /**
             * ConfiguraÃ§Ã£o do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'logserverrequest';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
        
        /**
         * 
         */
        public function logAction() {            
            $postData = Zend_Controller_Front::getInstance()->getRequest()->getParams();
            
            $url = $postData['url'];
            
            if ($url == '') {
                $url = 'http://intranet.tanet.com.br/server-status';
            }
            
            $serverStatus = new Monitor_Model_LogServerRequest_Mapper();
            $this->view->result = $serverStatus->log($url);
        }
    }
?>
