<?php

    class Ged_DoctoController extends ZendT_Controller_ActionCrud {

        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Ged_Service_Docto';
            $this->_formName = 'Ged_Form_Docto_Edit';
            $this->_formSearchName = 'Ged_Form_Docto_Search';
            $this->_mapper = new Ged_DataView_Docto_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'docto';
            $this->setGrid(new ZendT_Grid('grid_' . $name));
        }

        public function configGrid() {
            parent::configGrid();

            $idPropRelac = $this->getRequest()->getParam('id_prop_relac');

            if ($idPropRelac) {
                $this->getGrid()->setPostData(array('img_docto-id_prop_relac' => $idPropRelac));
            }
        }

    }

?>
