<?php

    class Vendas_PagamentoController extends ZendT_Controller_ActionCrud {

        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Vendas_Service_Pagamento';
            $this->_formName = 'Vendas_Form_Pagamento_Edit';
            $this->_formSearchName = 'Vendas_Form_Pagamento_Search';
            $this->_mapper = new Vendas_DataView_Pagamento_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'pagamento';
            $this->setGrid(new ZendT_Grid('grid_' . $name));
        }

    }

?>
