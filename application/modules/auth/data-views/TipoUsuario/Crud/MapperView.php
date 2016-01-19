<?php
    /**
    * Classe de visão da tabela tipo_usuario
    */
    class Auth_DataView_TipoUsuario_Crud_MapperView extends Auth_Model_TipoUsuario_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','codigo','descricao');
           $profile['width'] = array('id'=>192.5,'codigo'=>13,'descricao'=>200);
           $profile['align'] = array('id'=>'left','codigo'=>'left','descricao'=>'left');
           $profile['hidden'] = array();
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Auth_DataView_TipoUsuario_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'tipo_usuario', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('tipo_usuario.id'),'String','%?%');
            $this->_columns->add('codigo', 'tipo_usuario', 'codigo', $this->getModel()->getMapperName(), ZendT_Lib::translate('tipo_usuario.codigo'),'String','%?%');
            $this->_columns->add('descricao', 'tipo_usuario', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('tipo_usuario.descricao'),'String','%?%');

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