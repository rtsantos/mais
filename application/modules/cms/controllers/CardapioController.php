<?php

    class Cms_CardapioController extends ZendT_Controller_ActionCrud {

        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Cms_Service_Cardapio';
            $this->_formName = 'Cms_Form_Cardapio_Edit';
            $this->_formSearchName = 'Cms_Form_Cardapio_Search';
            $this->_mapper = new Cms_DataView_Cardapio_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'cardapio';
            $this->setGrid(new ZendT_Grid('grid_' . $name));
        }

        public function diaAction() {

            $this->_disableRender(true,false);            
            
            $_mapper = $this->getMapper();
            $_mapper->setDtExibe(ZendT_Type_Date::nowDate());

            $recordset = $_mapper->recordset($_mapper->getWhere(), false, false, 'sigla_filial');

            $data = array();
            while ($row = $recordset->getRow()) {
                $data[] = $row;
            }
            
            $this->view->data = $data;
        }

    }

?>
