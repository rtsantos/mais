<?php

    class Log_LogEventoController extends ZendT_Controller_ActionCrud {

        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Log_Service_LogEvento';
            $this->_formName = 'Log_Form_LogEvento_Edit';
            $this->_formSearchName = 'Log_Form_LogEvento_Search';
            $this->_mapper = new Log_DataView_LogEvento_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'logevento';
            $this->setGrid(new ZendT_Grid('grid_' . $name));
        }

        public function gridAction() {           
            parent::gridAction();

            $this->getColumns();
            $this->getGrid()->getObjToolbar()->removeButton('add');
            $this->getGrid()->getObjToolbar()->removeButton('edit');
            $this->getGrid()->getObjToolbar()->removeButton('del');
            $this->getGrid()->getObjToolbar()->removeButton('xls');
        }
        
        public function configGrid() {
            parent::configGrid();
            
            $isSearch = $this->getRequest()->getParam('isSearch');
            $id_objeto = $this->getRequest()->getParam('id_objeto');
            $log_objeto_nome = $this->getRequest()->getParam('log_objeto_nome');
            
            if ($isSearch) {
                $postData = array('log_evento-id_objeto' => $id_objeto,
                                  'log_objeto-nome' => $log_objeto_nome);
                $this->getGrid()->setPostData($postData);
            }
        }

        public function logAction() {
            $id = $this->getRequest()->getParam('id');
            $table = $this->getRequest()->getParam('table');
            $url = '/log/log-evento/grid?isSearch=true&typeModal=WINDOW&log_objeto_nome=' . $table . '&id_objeto=' . $id;
            $this->_redirect($url);
        }

    }

?>
