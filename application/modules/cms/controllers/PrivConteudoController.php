<?php

    class Cms_PrivConteudoController extends ZendT_Controller_ActionCrud {

        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Cms_Service_PrivConteudo';
            $this->_formName = 'Cms_Form_PrivConteudo_Edit';
            $this->_formSearchName = 'Cms_Form_PrivConteudo_Search';
            $this->_mapper = new Cms_DataView_PrivConteudo_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'privconteudo';
            $this->setGrid(new ZendT_Grid('grid_' . $name));
        }

        public function configGrid() {
            parent::configGrid();

            $idConteudo = $this->getRequest()->getParam('id_conteudo');
            if ($idConteudo) {
                $add = $this->getGrid()->getToolbarButton('add');
                $add->setUrl($add->getUrl() . '&id_conteudo=' . $idConteudo);
                $this->getGrid()->setPostData(array('cms_priv_conteudo-id_conteudo' => $idConteudo));
            }
        }

    }

?>
