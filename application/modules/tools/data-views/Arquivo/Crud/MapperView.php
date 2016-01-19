<?php
    /**
    * Classe de visão da tabela arquivo
    */
    class Tools_DataView_Arquivo_Crud_MapperView extends Tools_Model_Arquivo_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','tipo','tempo_vida','dh_inc','hashcode','nome','arq_clob','chave_acesso','arq_blob');
           $profile['width'] = array('id'=>100,'tipo'=>150,'tempo_vida'=>150,'dh_inc'=>150,'hashcode'=>37,'nome'=>200,'arq_clob'=>200,'chave_acesso'=>200,'arq_blob'=>200);
           $profile['align'] = array('id'=>'left','tipo'=>'right','tempo_vida'=>'right','dh_inc'=>'center','hashcode'=>'left','nome'=>'left','arq_clob'=>'left','chave_acesso'=>'left','arq_blob'=>'left');
           $profile['hidden'] = array();
           $profile['remove'] = array('arq_clob','arq_blob');
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Tools_DataView_Arquivo_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'arquivo', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.id'),'String','%?%');
            $this->_columns->add('tipo', 'arquivo', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.tipo'),'Numeric','=');
            $this->_columns->add('tempo_vida', 'arquivo', 'tempo_vida', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.tempo_vida'),'Numeric','=');
            $this->_columns->add('dh_inc', 'arquivo', 'dh_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.dh_inc'),'DateTime','=');
            $this->_columns->add('hashcode', 'arquivo', 'hashcode', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.hashcode'),'String','%?%');
            $this->_columns->add('nome', 'arquivo', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.nome'),'String','%?%');
            $this->_columns->add('arq_clob', 'arquivo', 'arq_clob', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.arq_clob'),'String','%?%');
            $this->_columns->add('chave_acesso', 'arquivo', 'chave_acesso', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.chave_acesso'),'String','%?%');
            $this->_columns->add('arq_blob', 'arquivo', 'arq_blob', $this->getModel()->getMapperName(), ZendT_Lib::translate('arquivo.arq_blob'),'String','%?%');

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