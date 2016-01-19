<?php
    /**
    * Classe de visão da tabela log_server_request
    */
    class Monitor_DataView_LogServerRequest_Crud_MapperView extends Monitor_Model_LogServerRequest_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Monitor_Model_LogServer_Mapper
         */
        protected $_logServer;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Monitor_Model_LogServer_Mapper
         */
        protected function _getLogServer(){
            if (!is_object($this->_logServer)){
                $this->_logServer = new Monitor_Model_LogServer_Mapper();
            }
            return $this->_logServer;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_log_server','dh_log_log_server','cpu_load_log_server','srv','pid','acc','m','cpu','ss','req','conn','child','slot','client','vhost','request','perc_cpu','perc_mem','time','system');
           $profile['width'] = array('id'=>100,'id_log_server'=>120,'dh_log_log_server'=>200,'cpu_load_log_server'=>200,'srv'=>40,'pid'=>150,'acc'=>80,'m'=>20,'cpu'=>150,'ss'=>150,'req'=>150,'conn'=>150,'child'=>150,'slot'=>150,'client'=>90,'vhost'=>160,'request'=>280,'perc_cpu'=>150,'perc_mem'=>150,'time'=>150,'system'=>200);
           $profile['align'] = array('id'=>'left','id_log_server'=>'left','dh_log_log_server'=>'left','cpu_load_log_server'=>'left','srv'=>'left','pid'=>'right','acc'=>'left','m'=>'left','cpu'=>'right','ss'=>'right','req'=>'right','conn'=>'right','child'=>'right','slot'=>'right','client'=>'left','vhost'=>'left','request'=>'left','perc_cpu'=>'right','perc_mem'=>'right','time'=>'right','system'=>'left');
           $profile['hidden'] = array('id_log_server');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Monitor_DataView_LogServerRequest_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'log_server_request', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.id'),'String','%?%');
            $this->_columns->add('id_log_server', 'log_server_request', 'id_log_server', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.id_log_server'), null, '?%');
            $this->_columns->add('dh_log_log_server', 'log_server', 'dh_log', $this->_getLogServer()->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.id_log_server.log_server.dh_log'),null,'?%');
            $this->_columns->add('cpu_load_log_server', 'log_server', 'cpu_load', $this->_getLogServer()->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.id_log_server.log_server.cpu_load'),null,'?%');
            $this->_columns->add('srv', 'log_server_request', 'srv', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.srv'),'String','%?%');
            $this->_columns->add('pid', 'log_server_request', 'pid', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.pid'),'Numeric','=');
            $this->_columns->add('acc', 'log_server_request', 'acc', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.acc'),'String','%?%');
            $this->_columns->add('m', 'log_server_request', 'm', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.m'),'String','%?%');
            $this->_columns->add('cpu', 'log_server_request', 'cpu', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.cpu'),'Numeric','=');
            $this->_columns->add('ss', 'log_server_request', 'ss', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.ss'),'Numeric','=');
            $this->_columns->add('req', 'log_server_request', 'req', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.req'),'Numeric','=');
            $this->_columns->add('conn', 'log_server_request', 'conn', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.conn'),'Numeric','=');
            $this->_columns->add('child', 'log_server_request', 'child', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.child'),'Numeric','=');
            $this->_columns->add('slot', 'log_server_request', 'slot', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.slot'),'Numeric','=');
            $this->_columns->add('client', 'log_server_request', 'client', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.client'),'String','%?%');
            $this->_columns->add('vhost', 'log_server_request', 'vhost', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.vhost'),'String','%?%');
            $this->_columns->add('request', 'log_server_request', 'request', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.request'),'String','%?%');
            $this->_columns->add('perc_cpu', 'log_server_request', 'perc_cpu', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.perc_cpu'),'Numeric','=');
            $this->_columns->add('perc_mem', 'log_server_request', 'perc_mem', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.perc_mem'),'Numeric','=');
            $this->_columns->add('time', 'log_server_request', 'time', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.time'),'Numeric','=');
            $this->_columns->add('system', 'log_server_request', 'system', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_request.system'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getLogServer()->getModel()->getTableName()." log_server ON ( log_server_request.id_log_server = log_server.id )  "; 
            return $sql;
        }
    }
?>