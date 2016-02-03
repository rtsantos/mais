<?php

   class Vendas_Form_Pagamento_Edit extends Vendas_Form_Pagamento_Crud_Edit {

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElements($action = 'insert') {
           parent::loadElements($action);

           $idPedido = Zend_Controller_Front::getInstance()->getRequest()->getParam('id_pedido');
           if ($idPedido) {
               $_mapper = new Vendas_DataView_Pagamento_MapperView();
               
               $vlrTotal = $_mapper->getSaldoPagar($idPedido);
               $_mapper->setVlrTotal($vlrTotal);
               $vlrTotal = $_mapper->getVlrTotal()->get();

               $perDesc = 0;
               $_mapper->setPerDesc($perDesc);
               $perDesc = $_mapper->getPerDesc()->get();

               $this->getElement('vlr_total')->setValue($vlrTotal);
               $this->getElement('vlr_a_pagar')->setValue($vlrTotal);
               $this->getElement('per_desc')->setValue($perDesc);
               $this->getElement('per_acre')->setValue($perDesc);
           }
       }

   }

?>