<?php

    /**
     * Classe de visão da tabela ca_regra_contrato
     */
    class Ca_DataView_RegraContrato_MapperView extends Ca_DataView_RegraContrato_Crud_MapperView {

        protected function _loadColumns() {
            $_number4 = new ZendT_Type_Number(null,array('numDecimal'=>4));
            
            parent::_loadColumns();
            $this->_columns->add('vlr_venda_produto', 'produto', 'vlr_venda', $this->_getProduto()->getModel()->getMapperName(), ZendT_Lib::translate('Valor do Produto'), null, '=');
            
            /**
            'PA' => 'Acréscimo de Preço',
            'PD' => 'Desconto de Preço',
            'CD' => 'Custeio de Débito',
             */
            $expression = "(CASE";
            $expression.= " WHEN ca_regra_contrato.tipo = 'PA' AND ca_regra_contrato.vlr_fixo > 0 THEN ";
            $expression.= "      produto.vlr_venda + ca_regra_contrato.vlr_fixo ";
            $expression.= " WHEN ca_regra_contrato.tipo = 'PA' AND ca_regra_contrato.vlr_perc > 0 THEN ";
            $expression.= "      ((produto.vlr_venda * ca_regra_contrato.vlr_fixo) / 100) + produto.vlr_venda ";
            $expression.= " WHEN ca_regra_contrato.tipo = 'PD' AND ca_regra_contrato.vlr_fixo > 0 THEN ";
            $expression.= "      produto.vlr_venda - ca_regra_contrato.vlr_fixo ";
            $expression.= " WHEN ca_regra_contrato.tipo = 'PD' AND ca_regra_contrato.vlr_perc > 0 THEN ";
            $expression.= "      ((produto.vlr_venda * ca_regra_contrato.vlr_fixo) / 100) - produto.vlr_venda ";
            $expression.= " WHEN ca_regra_contrato.tipo = 'CD' AND ca_regra_contrato.vlr_fixo > 0 THEN ";
            $expression.= "      ca_regra_contrato.vlr_fixo ";
            $expression.= " WHEN ca_regra_contrato.tipo = 'CD' AND ca_regra_contrato.vlr_perc > 0 THEN ";
            $expression.= "      ((produto.vlr_venda * ca_regra_contrato.vlr_fixo) / 100) ";
            $expression.= "END)";
            $this->_columns->addExpression('vlr_final', $expression, $_number4, ZendT_Lib::translate('Valor Final'));
        }

    }

?>