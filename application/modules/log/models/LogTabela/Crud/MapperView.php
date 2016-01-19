<?php
    /**
    * Classe de visão da tabela log_tabela
    */
    class Log_Model_LogTabela_Crud_MapperView extends Log_Model_LogTabela_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','nome','owner','table_name');
           $profile['width'] = array('id'=>87.5,'nome'=>150,'owner'=>100,'table_name'=>150);
           $profile['align'] = array('id'=>'left','nome'=>'left','owner'=>'left','table_name'=>'left');
           $profile['hidden'] = array();
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Log_Model_LogTabela_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'log_tabela', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_tabela.id'));
            $this->_columns->add('nome', 'log_tabela', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_tabela.nome'));
            $this->_columns->add('owner', 'log_tabela', 'owner', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_tabela.owner'));
            $this->_columns->add('table_name', 'log_tabela', 'table_name', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_tabela.table_name'));

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