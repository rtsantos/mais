<?php
    /**
    * Classe de visão da tabela log_server
    */
    class Monitor_DataView_LogServer_Crud_MapperView extends Monitor_Model_LogServer_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','dh_log','total_accesses','total_traffic','cpu_usage','cpu_load','total_requests','mem_total','mem_used','mem_cached','swap_total','swap_used');
           $profile['width'] = array('id'=>100,'dh_log'=>150,'total_accesses'=>150,'total_traffic'=>150,'cpu_usage'=>100,'cpu_load'=>150,'total_requests'=>150,'mem_total'=>150,'mem_used'=>150,'mem_cached'=>150,'swap_total'=>150,'swap_used'=>150);
           $profile['align'] = array('id'=>'left','dh_log'=>'center','total_accesses'=>'right','total_traffic'=>'right','cpu_usage'=>'left','cpu_load'=>'right','total_requests'=>'right','mem_total'=>'right','mem_used'=>'right','mem_cached'=>'right','swap_total'=>'right','swap_used'=>'right');
           $profile['hidden'] = array();
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Monitor_DataView_LogServer_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'log_server', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server.id'),'String','%?%');
            $this->_columns->add('dh_log', 'log_server', 'dh_log', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server.dh_log'),'DateTime','=');
            $this->_columns->add('total_accesses', 'log_server', 'total_accesses', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server.total_accesses'),'Numeric','=');
            $this->_columns->add('total_traffic', 'log_server', 'total_traffic', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server.total_traffic'),'Numeric','=');
            $this->_columns->add('cpu_usage', 'log_server', 'cpu_usage', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server.cpu_usage'),'String','%?%');
            $this->_columns->add('cpu_load', 'log_server', 'cpu_load', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server.cpu_load'),'Numeric','=');
            $this->_columns->add('total_requests', 'log_server', 'total_requests', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server.total_requests'),'Numeric','=');
            $this->_columns->add('mem_total', 'log_server', 'mem_total', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server.mem_total'),'Numeric','=');
            $this->_columns->add('mem_used', 'log_server', 'mem_used', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server.mem_used'),'Numeric','=');
            $this->_columns->add('mem_cached', 'log_server', 'mem_cached', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server.mem_cached'),'Numeric','=');
            $this->_columns->add('swap_total', 'log_server', 'swap_total', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server.swap_total'),'Numeric','=');
            $this->_columns->add('swap_used', 'log_server', 'swap_used', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server.swap_used'),'Numeric','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = parent::_getSqlBase();
            return $sql;
        }
    }
?>