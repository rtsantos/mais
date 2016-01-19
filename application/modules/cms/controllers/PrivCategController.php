<?php

    class Cms_PrivCategController extends ZendT_Controller_ActionCrud {

        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Cms_Service_PrivCateg';
            $this->_formName = 'Cms_Form_PrivCateg_Edit';
            $this->_formSearchName = 'Cms_Form_PrivCateg_Search';
            $this->_mapper = new Cms_DataView_PrivCateg_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'privcateg';
            $this->setGrid(new ZendT_Grid('grid_' . $name));
        }

        public function configGrid() {
            parent::configGrid();

            $idCategoria = $this->getRequest()->getParam('id_categoria');
            if ($idCategoria) {
                $add = $this->getGrid()->getToolbarButton('add');
                $add->setUrl($add->getUrl() . '&id_categoria=' . $idCategoria);
                $this->getGrid()->setPostData(array('cms_priv_categ-id_categoria' => $idCategoria));
            }
        }

    }

?>
