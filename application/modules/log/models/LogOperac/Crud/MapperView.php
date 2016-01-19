<?php
    /**
    * Classe de visão da tabela log_operac
    */
    class Log_Model_LogOperac_Crud_MapperView extends Log_Model_LogOperac_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','codigo','operacao','status','acao');
           $profile['width'] = array('id'=>50,'codigo'=>50,'operacao'=>150,'status'=>150,'acao'=>150);
           $profile['align'] = array('id'=>'left','codigo'=>'left','operacao'=>'left','status'=>'left','acao'=>'left');
           $profile['hidden'] = array();
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Log_Model_LogOperac_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'log_operac', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_operac.id'));
            $this->_columns->add('codigo', 'log_operac', 'codigo', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_operac.codigo'));
            $this->_columns->add('operacao', 'log_operac', 'operacao', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_operac.operacao'));
            $this->_columns->add('status', 'log_operac', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_operac.status'));
            $this->_columns->add('acao', 'log_operac', 'acao', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_operac.acao'));

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