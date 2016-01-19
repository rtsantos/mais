<?php
    /**
    * Classe de visão da tabela log_server_process
    */
    class Monitor_DataView_LogServerProcess_Crud_MapperView extends Monitor_Model_LogServerProcess_Mapper implements ZendT_Db_View
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
           $profile['order'] = array('id','id_log_server','dh_log_log_server','cpu_load_log_server','pid','cpu','mem','men_vsz','men_rss','time_min','program');
           $profile['width'] = array('id'=>100,'id_log_server'=>120,'dh_log_log_server'=>200,'cpu_load_log_server'=>200,'pid'=>150,'cpu'=>150,'mem'=>150,'men_vsz'=>150,'men_rss'=>150,'time_min'=>150,'program'=>200);
           $profile['align'] = array('id'=>'left','id_log_server'=>'left','dh_log_log_server'=>'left','cpu_load_log_server'=>'left','pid'=>'right','cpu'=>'right','mem'=>'right','men_vsz'=>'right','men_rss'=>'right','time_min'=>'right','program'=>'left');
           $profile['hidden'] = array('id_log_server');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Monitor_DataView_LogServerProcess_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'log_server_process', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_process.id'),'String','%?%');
            $this->_columns->add('id_log_server', 'log_server_process', 'id_log_server', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_process.id_log_server'), null, '=');
            $this->_columns->add('dh_log_log_server', 'log_server', 'dh_log', $this->_getLogServer()->getModel()->getMapperName(), ZendT_Lib::translate('log_server_process.id_log_server.log_server.dh_log'),null,'?%');
            $this->_columns->add('cpu_load_log_server', 'log_server', 'cpu_load', $this->_getLogServer()->getModel()->getMapperName(), ZendT_Lib::translate('log_server_process.id_log_server.log_server.cpu_load'),null,'?%');
            $this->_columns->add('pid', 'log_server_process', 'pid', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_process.pid'),'Numeric','=');
            $this->_columns->add('cpu', 'log_server_process', 'cpu', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_process.cpu'),'Numeric','=');
            $this->_columns->add('mem', 'log_server_process', 'mem', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_process.mem'),'Numeric','=');
            $this->_columns->add('men_vsz', 'log_server_process', 'men_vsz', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_process.men_vsz'),'Numeric','=');
            $this->_columns->add('men_rss', 'log_server_process', 'men_rss', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_process.men_rss'),'Numeric','=');
            $this->_columns->add('time_min', 'log_server_process', 'time_min', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_process.time_min'),'Numeric','=');
            $this->_columns->add('program', 'log_server_process', 'program', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_server_process.program'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getLogServer()->getModel()->getTableName()." log_server ON ( log_server_process.id_log_server = log_server.id )  "; 
            return $sql;
        }
    }
?>