<?php
    /**
    * Classe de visão da tabela log_objeto
    */
    class Log_Model_LogObjeto_Crud_MapperView extends Log_Model_LogObjeto_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Log_Model_LogTabela_Mapper
         */
        protected $_logTabela;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return '.Log_Model_LogTabela_Mapper.'
         */
        protected function _getLogTabela(){
            if (!is_object($this->_logTabela)){
                $this->_logTabela = new Log_Model_LogTabela_Mapper();
            }
            return $this->_logTabela;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','nome','descricao','status','id_log_tabela','nome_log_tabela','tempo_vida');
           $profile['width'] = array('id'=>35,'nome'=>35,'descricao'=>200,'status'=>150,'id_log_tabela'=>120,'nome_log_tabela'=>200,'tempo_vida'=>150);
           $profile['align'] = array('id'=>'left','nome'=>'left','descricao'=>'left','status'=>'center','id_log_tabela'=>'left','nome_log_tabela'=>'left','tempo_vida'=>'right');
           $profile['hidden'] = array('id_log_tabela');
           $profile['remove'] = array();
           $profile['listOptions'] = array('status'=>$this->getModel()->getListOptions('status'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Log_Model_LogObjeto_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'log_objeto', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_objeto.id'));
            $this->_columns->add('nome', 'log_objeto', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_objeto.nome'));
            $this->_columns->add('descricao', 'log_objeto', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_objeto.descricao'));
            $this->_columns->add('status', 'log_objeto', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_objeto.status'));
            $this->_columns->add('id_log_tabela', 'log_objeto', 'id_log_tabela', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_objeto.id_log_tabela'));
            $this->_columns->add('nome_log_tabela', 'log_tabela', 'nome', $this->_getLogTabela()->getModel()->getMapperName(), ZendT_Lib::translate('log_objeto.id_log_tabela.log_tabela.nome'));
            $this->_columns->add('tempo_vida', 'log_objeto', 'tempo_vida', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_objeto.tempo_vida'));

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    LEFT  JOIN ".$this->_getLogTabela()->getModel()->getTableName()." log_tabela ON ( log_objeto.id_log_tabela = log_tabela.id )  "; 
            return $sql;
        }
    }
?>