<?php
    /**
    * Classe de visão da tabela cv_log_pedido
    */
    class Vendas_DataView_LogPedido_Crud_MapperView extends Vendas_Model_LogPedido_Mapper implements ZendT_Db_View
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
         * @return Vendas_Model_Pedido_Mapper
         */
        protected function _getPedido(){
            if (!is_object($this->_pedido)){
                $this->_pedido = new Vendas_Model_Pedido_Mapper();
            }
            return $this->_pedido;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_pedido','numero_pedido','dh_log','mensagem');
           $profile['width'] = array('id'=>100,'id_pedido'=>120,'numero_pedido'=>200,'dh_log'=>150,'mensagem'=>200);
           $profile['align'] = array('id'=>'left','id_pedido'=>'left','numero_pedido'=>'left','dh_log'=>'center','mensagem'=>'left');
           $profile['hidden'] = array('id_pedido');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Vendas_DataView_LogPedido_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'log_pedido', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_pedido.id'),'String','%?%');
            $this->_columns->add('id_pedido', 'log_pedido', 'id_pedido', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_pedido.id_pedido'), null, '=');
            $this->_columns->add('numero_pedido', 'pedido', 'numero', $this->_getPedido()->getModel()->getMapperName(), ZendT_Lib::translate('cv_log_pedido.id_pedido.cv_pedido.numero'),null,'?%');
            $this->_columns->add('dh_log', 'log_pedido', 'dh_log', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_pedido.dh_log'),'DateTime','=');
            $this->_columns->add('mensagem', 'log_pedido', 'mensagem', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_pedido.mensagem'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getAlias() ." 
                    JOIN ".$this->_getPedido()->getModel()->getTableName()." pedido ON ( log_pedido.id_pedido = pedido.id )  "; 
            return $sql;
        }
    }
?>