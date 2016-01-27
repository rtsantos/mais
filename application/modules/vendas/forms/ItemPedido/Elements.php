<?php

    /**
     * Classe de mapeamento dos pontos de entrada da tabela cv_item_pedido
     */
    class Vendas_Form_ItemPedido_Elements extends Vendas_Form_ItemPedido_Crud_Elements {

        public function getIdProduto() {
            $_element = parent::getIdProduto();
            $_element->addField('vlr_venda');
            $_element->getField('vlr_venda')->setAttrib('css-width', '105px');
            $_element->setSearchAttribs(array('css-width' => '105px'));
            return $_element;
        }

    }

?>