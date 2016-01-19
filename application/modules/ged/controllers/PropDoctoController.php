<?php

    class Ged_PropDoctoController extends ZendT_Controller_ActionCrud {

        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Ged_Service_PropDocto';
            $this->_formName = 'Ged_Form_PropDocto_Edit';
            $this->_formSearchName = 'Ged_Form_PropDocto_Search';
            $this->_mapper = new Ged_DataView_PropDocto_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'propdocto';
            $this->setGrid(new ZendT_Grid('grid_' . $name));
        }

        public function insertAction() {
            if ($this->_setConfig()) {
                parent::insertAction();
            }
        }

        public function updateAction() {
            if ($this->_setConfig()) {
                parent::updateAction();
            }
        }

        private function _setConfig(&$data = '') {
            $this->_disableRender();
            $json = new ZendT_Json_Result();
            try {
                $configKey = Ged_Form_PropDocto_FormConfig::$configKey;
                if (!$data) {
                    $param = $this->getRequest()->getParams();
                    if ($param[$configKey]['horizontal'] && !$param[$configKey]['vertical'] || !$param[$configKey]['horizontal'] && $param[$configKey]['vertical']) {
                        throw new ZendT_Exception("Ao preencher o campo horizontal, é necessário preencher também o campo vertical, e vice-versa!");
                    }
                    if ($param[$configKey]['height'] && !$param[$configKey]['width']) {
                        throw new ZendT_Exception("Ao preencher o campo altura, é necessário preencher também o campo largura!");
                    }
                    if (!$param[$configKey]['maxSize']) {
                        $param[$configKey]['maxSizeUnit'] = '';
                    }
                    $this->getMapper()->setConfig(serialize($param[$configKey]));
                    $this->getRequest()->setParam($configKey, null);
                    unset($_POST[$configKey]);
                } else if ($data[$configKey]) {
                    $keys = unserialize(html_entity_decode($data[$configKey]));
                    foreach ($keys as $key => $val) {
                        $data[$configKey . "-" . $key] = $val;
                    }
                    unset($data[$configKey]);
                }
                return true;
            } catch (Exception $Ex) {
                $json->setException($Ex);
            }
            echo $json->render();
        }

        public function retrieveAction() {
            //parent::retrieveAction();
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);
            $json = new ZendT_Json_Result();
            try {
                $row = $this->_retrieve();
                $this->_setConfig($row);
                if (!$row) {
                    $row = array('found' => false);
                }
                $json->setResult($row);
            } catch (Exception $Ex) {
                $json->setException($Ex);
            }
            echo $json->render();
        }

    }

?>
