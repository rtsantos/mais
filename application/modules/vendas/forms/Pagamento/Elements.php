<?php

   /**
    * Classe de mapeamento dos pontos de entrada da tabela cv_pagto_pedido
    */
   class Vendas_Form_Pagamento_Elements extends Vendas_Form_Pagamento_Crud_Elements {

       public function getIdFormaPagto() {
           $_element = parent::getIdFormaPagto();
           $_element->enableAutoComplete();
           $_element->addField('parcela', 'parcela', 'hidden');
           $_element->setOnChange("function(data){ \$_pagamento.onFormaPagto(data); }");
           return $_element;
       }

       public function getIdParcela() {
           $_element = parent::getIdParcela();
           $_element->enableAutoComplete();
           $_element->addField('per_juro', 'per_juro', 'hidden');
           $_element->addField('qtd', 'qtd', 'hidden');
           $_element->setOnChange("function(data){ \$_pagamento.onParcela(data); }");
           return $_element;
       }

   }

?>