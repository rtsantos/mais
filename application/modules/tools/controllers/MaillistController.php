<?php
    class Tools_MaillistController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Tools_Service_Maillist';            
            $this->_formName = 'Tools_Form_Maillist_Edit';
            $this->_formSearchName = 'Tools_Form_Maillist_Search';            
            $this->_mapper = new Tools_Model_Maillist_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'maillist';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
        
        public function emailAction(){
            $params = $this->getRequest()->getParams();
            if ($params['typeModal'] == 'AJAX') {
                Zend_Layout::getMvcInstance()->setLayout('ajaxModal');
            } else if ($params['typeModal'] == 'IFRAME') {
                Zend_Layout::getMvcInstance()->setLayout('iframeModal');
            } else if ($params['typeModal'] == 'WINDOW') {
                Zend_Layout::getMvcInstance()->setLayout('window');
            }
            $id = $this->getRequest()->getParam('id');
            if($id){
                $this->_mapper->setId($id)
                            ->retrive(null);
                $this->view->body = $this->_mapper->getMailBody();
                $this->view->id = $id;
            }
        }
    }
?>
