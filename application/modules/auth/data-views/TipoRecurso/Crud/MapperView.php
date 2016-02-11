<?php
    /**
    * Classe de visão da tabela at_tipo_recurso
    */
    class Auth_DataView_TipoRecurso_Crud_MapperView extends Auth_Model_TipoRecurso_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','nome','descricao');
           $profile['width'] = array('id'=>15,'nome'=>200,'descricao'=>200);
           $profile['align'] = array('id'=>'left','nome'=>'left','descricao'=>'left');
           $profile['hidden'] = array();
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Auth_DataView_TipoRecurso_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'at_tipo_recurso', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_tipo_recurso.id'),'String','%?%');
            $this->_columns->add('nome', 'at_tipo_recurso', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_tipo_recurso.nome'),'String','%?%');
            $this->_columns->add('descricao', 'at_tipo_recurso', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_tipo_recurso.descricao'),'String','%?%');

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