<?php
    /**
    * Classe de visão da tabela cv_item_lanc
    */
    class Vendas_DataView_ItemLanc_Crud_MapperView extends Vendas_Model_ItemLanc_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_ItemPedido_Mapper
         */
        protected $_itemPedido;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Financeiro_Model_Lancamento_Mapper
         */
        protected $_lancamento;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_ItemPedido_Mapper
         */
        protected function _getItemPedido(){
            if (!is_object($this->_itemPedido)){
                $this->_itemPedido = new Vendas_Model_ItemPedido_Mapper();
            }
            return $this->_itemPedido;
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
           $profile['order'] = array('id','id_item_pedido','calculo_item_pedido','id_lancamento','tipo_lancamento');
           $profile['width'] = array('id'=>100,'id_item_pedido'=>120,'calculo_item_pedido'=>200,'id_lancamento'=>120,'tipo_lancamento'=>200);
           $profile['align'] = array('id'=>'left','id_item_pedido'=>'left','calculo_item_pedido'=>'left','id_lancamento'=>'left','tipo_lancamento'=>'left');
           $profile['hidden'] = array('id_item_pedido','id_lancamento');
           $profile['remove'] = array();
           $profile['listOptions'] = array('tipo_lancamento'=>$this->_getLancamento()->getModel()->getListOptions('tipo'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Vendas_DataView_ItemLanc_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'cv_item_lanc', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_lanc.id'),'String','%?%');
            $this->_columns->add('id_item_pedido', 'cv_item_lanc', 'id_item_pedido', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_lanc.id_item_pedido'), null, '=');
            $this->_columns->add('calculo_item_pedido', 'item_pedido', 'calculo', $this->_getItemPedido()->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_lanc.id_item_pedido.cv_item_pedido.calculo'),null,'?%');
            $this->_columns->add('id_lancamento', 'cv_item_lanc', 'id_lancamento', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_lanc.id_lancamento'), null, '=');
            $this->_columns->add('tipo_lancamento', 'lancamento', 'tipo', $this->_getLancamento()->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_lanc.id_lancamento.fc_lancamento.tipo'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getItemPedido()->getModel()->getTableName()." item_pedido ON ( cv_item_lanc.id_item_pedido = item_pedido.id ) 
                    JOIN ".$this->_getLancamento()->getModel()->getTableName()." lancamento ON ( cv_item_lanc.id_lancamento = lancamento.id )  "; 
            return $sql;
        }
    }
?>