<?php
    class Wf_WfTransacaoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Wf_Service_WfTransacao';            
            $this->_formName = 'Wf_Form_WfTransacao_Edit';
            $this->_formSearchName = 'Wf_Form_WfTransacao_Search';            
            $this->_mapper = new Wf_Model_WfTransacao_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'wftransacao';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
        
        public function gridAction() {
            $this->configGrid();
            $this->getGrid()->getObjToolbar()->removeButton('add');
            $this->getGrid()->getObjToolbar()->removeButton('edit');
            $this->getGrid()->getObjToolbar()->removeButton('del');
            $this->getGrid()->getObjToolbar()->removeButton('xls');
            $this->getGrid()->getObjToolbar()->removeButton('pdf');
            $this->getColumns();
            $this->view->grid = $this->getGrid()->render();
        }
    }
?>
