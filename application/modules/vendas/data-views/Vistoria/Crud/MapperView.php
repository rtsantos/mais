<?php
    /**
    * Classe de visão da tabela cv_vistoria
    */
    class Vendas_DataView_Vistoria_Crud_MapperView extends Vendas_Model_Vistoria_Mapper implements ZendT_Db_View
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
         * @return Frota_Model_Veiculo_Mapper
         */
        protected $_veiculo;
                
        
                
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
         * @return Frota_Model_Veiculo_Mapper
         */
        protected function _getVeiculo(){
            if (!is_object($this->_veiculo)){
                $this->_veiculo = new Frota_Model_Veiculo_Mapper();
            }
            return $this->_veiculo;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_pedido','numero_pedido','id_veiculo','placa_veiculo','sinistro','numero','status','observacao','dt_emis','local','laudo');
           $profile['width'] = array('id'=>100,'id_pedido'=>120,'numero_pedido'=>200,'id_veiculo'=>120,'placa_veiculo'=>200,'sinistro'=>200,'numero'=>200,'status'=>200,'observacao'=>200,'dt_emis'=>100,'local'=>200,'laudo'=>150);
           $profile['align'] = array('id'=>'left','id_pedido'=>'left','numero_pedido'=>'left','id_veiculo'=>'left','placa_veiculo'=>'left','sinistro'=>'left','numero'=>'left','status'=>'left','observacao'=>'left','dt_emis'=>'center','local'=>'left','laudo'=>'right');
           $profile['hidden'] = array('id_pedido','id_veiculo');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Vendas_DataView_Vistoria_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'vistoria', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('vistoria.id'),'String','%?%');
            $this->_columns->add('id_pedido', 'vistoria', 'id_pedido', $this->getModel()->getMapperName(), ZendT_Lib::translate('vistoria.id_pedido'), null, '=');
            $this->_columns->add('numero_pedido', 'pedido', 'numero', $this->_getPedido()->getModel()->getMapperName(), ZendT_Lib::translate('cv_vistoria.id_pedido.cv_pedido.numero'),null,'?%');
            $this->_columns->add('id_veiculo', 'vistoria', 'id_veiculo', $this->getModel()->getMapperName(), ZendT_Lib::translate('vistoria.id_veiculo'), null, '=');
            $this->_columns->add('placa_veiculo', 'veiculo', 'placa', $this->_getVeiculo()->getModel()->getMapperName(), ZendT_Lib::translate('cv_vistoria.id_veiculo.fr_veiculo.placa'),null,'?%');
            $this->_columns->add('sinistro', 'vistoria', 'sinistro', $this->getModel()->getMapperName(), ZendT_Lib::translate('vistoria.sinistro'),'String','%?%');
            $this->_columns->add('numero', 'vistoria', 'numero', $this->getModel()->getMapperName(), ZendT_Lib::translate('vistoria.numero'),'String','%?%');
            $this->_columns->add('status', 'vistoria', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('vistoria.status'),'String','%?%');
            $this->_columns->add('observacao', 'vistoria', 'observacao', $this->getModel()->getMapperName(), ZendT_Lib::translate('vistoria.observacao'),'String','%?%');
            $this->_columns->add('dt_emis', 'vistoria', 'dt_emis', $this->getModel()->getMapperName(), ZendT_Lib::translate('vistoria.dt_emis'),'Date','=');
            $this->_columns->add('local', 'vistoria', 'local', $this->getModel()->getMapperName(), ZendT_Lib::translate('vistoria.local'),'String','%?%');
            $this->_columns->add('laudo', 'vistoria', 'laudo', $this->getModel()->getMapperName(), ZendT_Lib::translate('vistoria.laudo'),'Numeric','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getAlias() ." 
                    JOIN ".$this->_getPedido()->getModel()->getTableName()." pedido ON ( vistoria.id_pedido = pedido.id ) 
                    JOIN ".$this->_getVeiculo()->getModel()->getTableName()." veiculo ON ( vistoria.id_veiculo = veiculo.id )  "; 
            return $sql;
        }
    }
?>