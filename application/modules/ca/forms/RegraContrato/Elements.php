<?php

    /**
     * Classe de mapeamento dos pontos de entrada da tabela ca_regra_contrato
     */
    class Ca_Form_RegraContrato_Elements extends Ca_Form_RegraContrato_Crud_Elements {
        public function getIdProduto() {
            $_element = parent::getIdProduto();
            $_element->addField('vlr_venda');
            $_element->getField('vlr_venda')->setAttrib('css-width', '105px');
            $_element->setSearchAttribs(array('css-width'=>'105px'));
            return $_element;
        }
    }

?>