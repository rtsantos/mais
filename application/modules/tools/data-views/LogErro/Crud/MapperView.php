<?php
    /**
    * Classe de visão da tabela tl_log_erro
    */
    class Tools_DataView_LogErro_Crud_MapperView extends Tools_Model_LogErro_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','procedimento','dh_log','mensagem');
           $profile['width'] = array('id'=>100,'procedimento'=>200,'dh_log'=>150,'mensagem'=>200);
           $profile['align'] = array('id'=>'left','procedimento'=>'left','dh_log'=>'center','mensagem'=>'left');
           $profile['hidden'] = array();
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Tools_DataView_LogErro_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'log_erro', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_erro.id'),'String','%?%');
            $this->_columns->add('procedimento', 'log_erro', 'procedimento', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_erro.procedimento'),'String','%?%');
            $this->_columns->add('dh_log', 'log_erro', 'dh_log', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_erro.dh_log'),'DateTime','=');
            $this->_columns->add('mensagem', 'log_erro', 'mensagem', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_erro.mensagem'),'String','%?%');

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