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

        public function formAction() {
            $idPedido = $this->getRequest()->getParam('id_pedido');
            $vlrTotal = $this->_mapper->getSaldoPagar($idPedido);
            $this->_mapper->setVlrTotal($vlrTotal);
            $vlrTotal = $this->_mapper->getVlrTotal()->get();
            
            $perDesc = 0;
            $this->_mapper->setPerDesc($perDesc);
            $perDesc = $this->_mapper->getPerDesc()->get();
            
            $this->getRequest()->setParam('vlr_total', $vlrTotal);
            $this->getRequest()->setParam('vlr_a_pagar', $vlrTotal);
            $this->getRequest()->setParam('per_desc', $perDesc);
            $this->getRequest()->setParam('per_acre', $perDesc);
            
            parent::formAction();
        }

    }

?>
