<?php
    /**
    * Classe de visão da tabela cv_pagto_lanc
    */
    class Vendas_DataView_PagtoLanc_Crud_MapperView extends Vendas_Model_PagtoLanc_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_Pagamento_Mapper
         */
        protected $_pagamento;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Financeiro_Model_Lancamento_Mapper
         */
        protected $_lancamento;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_Pagamento_Mapper
         */
        protected function _getPagamento(){
            if (!is_object($this->_pagamento)){
                $this->_pagamento = new Vendas_Model_Pagamento_Mapper();
            }
            return $this->_pagamento;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Financeiro_Model_Lancamento_Mapper
         */
        protected function _getLancamento(){
            if (!is_object($this->_lancamento)){
                $this->_lancamento = new Financeiro_Model_Lancamento_Mapper();
            }
            return $this->_lancamento;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_pagto_pedido','id_lancamento','tipo_lancamento');
           $profile['width'] = array('id'=>100,'id_pagto_pedido'=>120,'id_lancamento'=>120,'tipo_lancamento'=>200);
           $profile['align'] = array('id'=>'left','id_pagto_pedido'=>'left','id_lancamento'=>'left','tipo_lancamento'=>'left');
           $profile['hidden'] = array('id_pagto_pedido','id_lancamento');
           $profile['remove'] = array();
           $profile['listOptions'] = array('tipo_lancamento'=>$this->_getLancamento()->getModel()->getListOptions('tipo'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Vendas_DataView_PagtoLanc_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'cv_pagto_lanc', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_lanc.id'),'String','%?%');
            $this->_columns->add('id_pagto_pedido', 'cv_pagto_lanc', 'id_pagto_pedido', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_lanc.id_pagto_pedido'), null, '=');
            $this->_columns->add('id_lancamento', 'cv_pagto_lanc', 'id_lancamento', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_lanc.id_lancamento'), null, '=');
            $this->_columns->add('tipo_lancamento', 'lancamento', 'tipo', $this->_getLancamento()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_lanc.id_lancamento.fc_lancamento.tipo'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getAlias() ." 
                    LEFT  JOIN ".$this->_getPagamento()->getModel()->getTableName()." pagto_pedido ON ( cv_pagto_lanc.id_pagto_pedido = pagto_pedido.id ) 
                    LEFT  JOIN ".$this->_getLancamento()->getModel()->getTableName()." lancamento ON ( cv_pagto_lanc.id_lancamento = lancamento.id )  "; 
            return $sql;
        }
    }
?>