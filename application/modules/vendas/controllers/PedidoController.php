<?php

    class Vendas_PedidoController extends ZendT_Controller_ActionCrud {

        public function init() {
            $this->_init();
            //$this->_startupAcl();            
            $this->_formName = 'Vendas_Form_Pedido_Edit';
            $this->_mapper = new Vendas_DataView_Pedido_MapperView();
            $this->view->tabs = $this->_mapper->getTabs();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'pedido';
            $this->setGrid(new ZendT_Grid('grid_' . $name));
        }

        public function gridAction() {
            parent::gridAction();

            if ($this instanceof ZendT_Controller_ActionCrud && ZendT_Acl::getInstance()->isAllowed('efetivar', $this->_resourceBase)) {
                $btnId = 'btn_efetivar_' . $this->getGrid()->getID();
                $_efetivar = new ZendT_Grid_Button_Ajax($idbt);
                $_efetivar->setIdGrid($this->getGrid()->getID())
                        ->setButtonIcon('ui-icon-check')
                        ->setUrl(ZendT_Url::getUri(true) . '/efetivar')
                        ->setTitle('Efetivar');
                $this->view->hotkeys()->add('btn_efetivar', 'ctrl+t', '$("#' . $btnId . '").click();');
                $this->getGrid()->addToolbarButton('btn_efetivar', $_efetivar, 'btn_efetiva');
            }
        }

        public function efetivarAction() {
            $this->_disableRender(true, true);
            $idPedido = $this->getRequest()->getParam('id');

            $_json = new ZendT_Json_Result();
            $this->getModel()->getAdapter()->beginTransaction();
            try {
                if (!$idPedido){
                    throw new ZendT_Exception_Alert(_i18n('Necessário informar um pedido'));
                }
                $this->getMapper()->setId($idPedido)->retrieve()->efetivar();
                $this->getModel()->getAdapter()->commit();
                $_json->setResult(array('ok' => 1));                
            } catch (Exception $ex) {
                $_json->setException($ex);
                $this->getModel()->getAdapter()->rollBack();
            }
            
            echo $_json->render();
        }

    }

?>
