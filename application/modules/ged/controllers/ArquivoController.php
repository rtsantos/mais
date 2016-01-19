<?php

    class Ged_ArquivoController extends ZendT_Controller_ActionCrud {

        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Ged_Service_Arquivo';
            $this->_formName = 'Ged_Form_Arquivo_Edit';
            $this->_formSearchName = 'Ged_Form_Arquivo_Search';
            $this->_mapper = new Ged_DataView_Arquivo_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'arquivo';
            $this->setGrid(new ZendT_Grid('grid_' . $name));
        }

        public function showAction() {
            #echo "";die;
            $id = $this->getRequest()->getParam('id');
            $this->getMapper()->setId($id)->retrieve();
            $_fileSystem = new Ged_Service_FileSystem();
            #echo $_fileSystem->getFileName($id);die;
            header('Content-Type: ' . $this->getMapper()->getConteudoType());
            echo file_get_contents($_fileSystem->getFileName($id));
            die;
            /* $_fileSystem = new ZendT_Type_FileSystem();
              $_file = $_fileSystem->setValueFromDb($id)->get();
              header('Content-Type: ' . $_file->getContentType());
              echo $_file->getContent();
              die; */
        }

    }

?>
