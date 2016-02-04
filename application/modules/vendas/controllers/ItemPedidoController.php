<?php
    class Vendas_ItemPedidoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_init();
            $this->_startupAcl();
            $this->_serviceName = 'Vendas_Service_ItemPedido';            
            $this->_formName = 'Vendas_Form_ItemPedido_Edit';
            $this->_formSearchName = 'Vendas_Form_ItemPedido_Search';            
            $this->_mapper = new Vendas_DataView_ItemPedido_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'itempedido';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
