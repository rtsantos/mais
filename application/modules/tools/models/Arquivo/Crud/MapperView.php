<?php
    /**
    * Classe de visão da tabela arquivo
    */
    class Tools_Model_Arquivo_Crud_MapperView extends Tools_Model_Arquivo_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','tipo','tempo_vida','dh_inc','hashcode','nome','arq_clob','chave_acesso','arq_blob');
           $profile['width'] = array('id'=>200,'tipo'=>200,'tempo_vida'=>200,'dh_inc'=>200,'hashcode'=>200,'nome'=>200,'arq_clob'=>200,'chave_acesso'=>200,'arq_blob'=>200);
           $profile['align'] = array('id'=>'left','tipo'=>'left','tempo_vida'=>'left','dh_inc'=>'left','hashcode'=>'left','nome'=>'left','arq_clob'=>'left','chave_acesso'=>'left','arq_blob'=>'left');
           $profile['hidden'] = array();
           $profile['remove'] = array('arq_clob','arq_blob');
           $profile['listOptions'] = array('tipo'=>$this->getModel()->getListOptions('tipo'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Tools_Model_Arquivo_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'arquivo', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.id'));
            $this->_columns->add('tipo', 'arquivo', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.tipo'));
            $this->_columns->add('tempo_vida', 'arquivo', 'tempo_vida', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.tempo_vida'));
            $this->_columns->add('dh_inc', 'arquivo', 'dh_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.dh_inc'));
            $this->_columns->add('hashcode', 'arquivo', 'hashcode', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.hashcode'));
            $this->_columns->add('nome', 'arquivo', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.nome'));
            $this->_columns->add('arq_clob', 'arquivo', 'arq_clob', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.arq_clob'));
            $this->_columns->add('chave_acesso', 'arquivo', 'chave_acesso', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.chave_acesso'));
            $this->_columns->add('arq_blob', 'arquivo', 'arq_blob', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.arq_blob'));

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