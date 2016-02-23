<?php
    /**
    * Classe de visão da tabela cv_pagto_pedido
    */
    class Vendas_DataView_Pagamento_Crud_MapperView extends Vendas_Model_Pagamento_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_Pedido_Mapper
         */
        protected $_pedido;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_FormaPagamento_Mapper
         */
        protected $_formaPagamento;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_Parcela_Mapper
         */
        protected $_parcela;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_Pedido_Mapper
         */
        protected function _getPedido(){
            if (!is_object($this->_pedido)){
                $this->_pedido = new Vendas_Model_Pedido_Mapper();
            }
            return $this->_pedido;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_FormaPagamento_Mapper
         */
        protected function _getFormaPagamento(){
            if (!is_object($this->_formaPagamento)){
                $this->_formaPagamento = new Vendas_Model_FormaPagamento_Mapper();
            }
            return $this->_formaPagamento;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_Parcela_Mapper
         */
        protected function _getParcela(){
            if (!is_object($this->_parcela)){
                $this->_parcela = new Vendas_Model_Parcela_Mapper();
            }
            return $this->_parcela;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_pedido','numero_pedido','vlr_total','vlr_pago','per_acre','vlr_parc','vlr_a_pagar','per_desc','nro_comprov','id_forma_pagto','descricao_forma_pagto','id_parcela','descricao_parcela','dt_venc_parc');
           $profile['width'] = array('id'=>100,'id_pedido'=>120,'numero_pedido'=>200,'vlr_total'=>150,'vlr_pago'=>150,'per_acre'=>150,'vlr_parc'=>150,'vlr_a_pagar'=>150,'per_desc'=>150,'nro_comprov'=>175,'id_forma_pagto'=>120,'descricao_forma_pagto'=>200,'id_parcela'=>120,'descricao_parcela'=>200,'dt_venc_parc'=>100);
           $profile['align'] = array('id'=>'left','id_pedido'=>'left','numero_pedido'=>'left','vlr_total'=>'right','vlr_pago'=>'right','per_acre'=>'right','vlr_parc'=>'right','vlr_a_pagar'=>'right','per_desc'=>'right','nro_comprov'=>'left','id_forma_pagto'=>'left','descricao_forma_pagto'=>'left','id_parcela'=>'left','descricao_parcela'=>'left','dt_venc_parc'=>'center');
           $profile['hidden'] = array('id_pedido','id_forma_pagto','id_parcela');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Vendas_DataView_Pagamento_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'cv_pagto_pedido', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.id'),'String','%?%');
            $this->_columns->add('id_pedido', 'cv_pagto_pedido', 'id_pedido', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.id_pedido'), null, '=');
            $this->_columns->add('numero_pedido', 'pedido', 'numero', $this->_getPedido()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.id_pedido.cv_pedido.numero'),null,'?%');
            $this->_columns->add('vlr_total', 'cv_pagto_pedido', 'vlr_total', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.vlr_total'),'Numeric','=');
            $this->_columns->add('vlr_pago', 'cv_pagto_pedido', 'vlr_pago', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.vlr_pago'),'Numeric','=');
            $this->_columns->add('per_acre', 'cv_pagto_pedido', 'per_acre', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.per_acre'),'Numeric','=');
            $this->_columns->add('vlr_parc', 'cv_pagto_pedido', 'vlr_parc', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.vlr_parc'),'Numeric','=');
            $this->_columns->add('vlr_a_pagar', 'cv_pagto_pedido', 'vlr_a_pagar', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.vlr_a_pagar'),'Numeric','=');
            $this->_columns->add('per_desc', 'cv_pagto_pedido', 'per_desc', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.per_desc'),'Numeric','=');
            $this->_columns->add('nro_comprov', 'cv_pagto_pedido', 'nro_comprov', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.nro_comprov'),'String','%?%');
            $this->_columns->add('id_forma_pagto', 'cv_pagto_pedido', 'id_forma_pagto', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.id_forma_pagto'), null, '=');
            $this->_columns->add('descricao_forma_pagto', 'forma_pagto', 'descricao', $this->_getFormaPagamento()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.id_forma_pagto.cv_forma_pagto.descricao'),null,'?%');
            $this->_columns->add('id_parcela', 'cv_pagto_pedido', 'id_parcela', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.id_parcela'), null, '=');
            $this->_columns->add('descricao_parcela', 'parcela', 'descricao', $this->_getParcela()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.id_parcela.cv_parcela.descricao'),null,'?%');
            $this->_columns->add('dt_venc_parc', 'cv_pagto_pedido', 'dt_venc_parc', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.dt_venc_parc'),'Date','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getAlias() ." 
                    JOIN ".$this->_getPedido()->getModel()->getTableName()." pedido ON ( cv_pagto_pedido.id_pedido = pedido.id ) 
                    LEFT  JOIN ".$this->_getFormaPagamento()->getModel()->getTableName()." forma_pagto ON ( cv_pagto_pedido.id_forma_pagto = forma_pagto.id ) 
                    LEFT  JOIN ".$this->_getParcela()->getModel()->getTableName()." parcela ON ( cv_pagto_pedido.id_parcela = parcela.id )  "; 
            return $sql;
        }
    }
?>