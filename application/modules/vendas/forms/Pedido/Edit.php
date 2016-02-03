<?php

   class Vendas_Form_Pedido_Edit extends Vendas_Form_Pedido_Crud_Edit {

       /**
        * Carrega os elementos no formulário para serem renderizado
        * @return void
        */
       public function loadElements($action = 'insert') {
           parent::loadElements($action);

           $_itens = new Vendas_Form_ItemPedido_Elements();
           $_pagto = new Vendas_Form_Pagamento_Elements();


           $prefix = 'item_pedido';
           $_produto = $_itens->getIdProduto();
           $_produto->setBelongsTo($prefix);
           $this->addElement($_produto, $prefix . '_' . $_produto->getName());
           
           
           $prefix = 'pagamento';
           $_formPagto = $_pagto->getIdFormaPagto();
           $_formPagto->setBelongsTo($prefix);
           $this->addElement($_formPagto, $prefix . '_' . $_formPagto->getName());

           /*
             foreach($_elements as $_element){
             $name = $_element->getName();
             $_element->setBelongsTo('telefone');
             $_element->setRequired(false);
             $this->addElement($_element,'telefone_' . $name);
             }
             $_element = new ZendT_Form_Element_Hidden("mapper");
             $_element->setValue("Gpar_DataView_Telefone_MapperView");
             $_element->setBelongsTo('telefone');
             $this->addElement($_element,'telefone_mapper');

             $_element = new ZendT_Form_Element_Hidden("controller");
             $_element->setValue("/AppTA/index.php/gpar/telefone/retrieve");
             $_element->setBelongsTo('telefone');
             $this->addElement($_element,'telefone_controller');

             $_element = new ZendT_Form_Element_Hidden("column");
             $_element->setValue("id_parceiro");
             $_element->setBelongsTo('telefone');
             $this->addElement($_element,'telefone_column');
            */
       }

   }

?>