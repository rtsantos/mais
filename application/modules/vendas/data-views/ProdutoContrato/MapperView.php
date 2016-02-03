<?php

   /**
    * Classe de visão da tabela cv_produto
    */
   class Vendas_DataView_ProdutoContrato_MapperView extends Vendas_DataView_Produto_Crud_MapperView {
       protected $_idClienteCon;
       
       public function setIdClienteCon($value){
           $this->_idClienteCon = $value;
           return $this;
       }


       protected function _loadColumns($param) {
           $_number4 = new ZendT_Type_Number(null, array('numDecimal' => 4));
           parent::_loadColumns();

           /**
             'PA' => 'Acréscimo de Preço',
             'PD' => 'Desconto de Preço',
             'CD' => 'Custeio de Débito',
            */
           $expression = "(CASE";
           $expression.= " WHEN regra_contrato.tipo = 'PA' AND regra_contrato.vlr_fixo > 0 THEN ";
           $expression.= "      cv_produto.vlr_venda + regra_contrato.vlr_fixo ";
           $expression.= " WHEN regra_contrato.tipo = 'PA' AND regra_contrato.vlr_perc > 0 THEN ";
           $expression.= "      ((cv_produto.vlr_venda * regra_contrato.vlr_fixo) / 100) + cv_produto.vlr_venda ";
           $expression.= " WHEN regra_contrato.tipo = 'PD' AND regra_contrato.vlr_fixo > 0 THEN ";
           $expression.= "      cv_produto.vlr_venda - regra_contrato.vlr_fixo ";
           $expression.= " WHEN regra_contrato.tipo = 'PD' AND regra_contrato.vlr_perc > 0 THEN ";
           $expression.= "      ((cv_produto.vlr_venda * regra_contrato.vlr_fixo) / 100) - cv_produto.vlr_venda ";
           $expression.= " ELSE ";
           $expression.= "      cv_produto.vlr_venda ";
           $expression.= "END)";
           $this->_columns->addExpression('vlr_final', $expression, $_number4, ZendT_Lib::translate('Valor Final'));
       }

       protected function _getSqlBase() {
           $idPedido = Zend_Controller_Front::getInstance()->getRequest()->getParam('id_pedido');
           $idCliente = Zend_Controller_Front::getInstance()->getRequest()->getParam('id_cliente');
           
           if ($this->_idClienteCon){
               $idCliente = $this->_idClienteCon;
           }

           if (!$idCliente) {

               if ($idPedido) {
                   $_pedido = new Vendas_DataView_Pedido_MapperView();
                   $_pedido->setId($idPedido)->retrieve();

                   $idCliente = $_pedido->getIdClienteCon(true)->toPhp();
                   if ($idCliente) {
                       $idCliente = $_pedido->getIdCliente(true)->toPhp();
                   }
               }

               if (!$idCliente) {
                   $idCliente = 0;
               }
           }

           $hoje = ZendT_Type_Date::nowDate()->getValueToDb();
           $sql = parent::_getSqlBase();
           $sql.= " LEFT JOIN " . Ca_DataView_Contrato_MapperView::$table . " contrato ON ('" . $hoje . "' BETWEEN contrato.dt_vig_ini AND contrato.dt_vig_fim AND contrato.status = 'A' AND contrato.id_cliente = " . $idCliente . ") ";
           $sql.= " LEFT JOIN " . Ca_DataView_RegraContrato_MapperView::$table . " regra_contrato ON (regra_contrato.id_produto = cv_produto.id AND regra_contrato.status = 'A' AND regra_contrato.tipo IN ('PA','PD') ) ";

           return $sql;
       }

       /* protected function _prepareSql(&$sql, &$binds, $type) {                      
         echo $sql . "\n";
         } */
   }
   