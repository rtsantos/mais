<?php
    /**
    * Classe de visão da tabela profile_object_view_priv
    */
    class Profile_DataView_ObjectViewPriv_Crud_MapperView extends Profile_Model_ObjectViewPriv_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Profile_Model_ObjectView_Mapper
         */
        protected $_objectView;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Papel_Mapper
         */
        protected $_papel;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Profile_Model_ObjectView_Mapper
         */
        protected function _getObjectView(){
            if (!is_object($this->_objectView)){
                $this->_objectView = new Profile_Model_ObjectView_Mapper();
            }
            return $this->_objectView;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Papel_Mapper
         */
        protected function _getPapel(){
            if (!is_object($this->_papel)){
                $this->_papel = new Auth_Model_Papel_Mapper();
            }
            return $this->_papel;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_profile_object_view','nome_profile_object_view','id_papel','nome_papel','tipo');
           $profile['width'] = array('id'=>100,'id_profile_object_view'=>120,'nome_profile_object_view'=>200,'id_papel'=>120,'nome_papel'=>200,'tipo'=>150);
           $profile['align'] = array('id'=>'left','id_profile_object_view'=>'left','nome_profile_object_view'=>'left','id_papel'=>'left','nome_papel'=>'left','tipo'=>'center');
           $profile['hidden'] = array('id_profile_object_view','id_papel');
           $profile['remove'] = array();
           $profile['listOptions'] = array('tipo'=>$this->getModel()->getListOptions('tipo'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Profile_DataView_ObjectViewPriv_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'profile_object_view_priv', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view_priv.id'),'String','%?%');
            $this->_columns->add('id_profile_object_view', 'profile_object_view_priv', 'id_profile_object_view', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view_priv.id_profile_object_view'), null, '=');
            $this->_columns->add('nome_profile_object_view', 'profile_object_view', 'nome', $this->_getObjectView()->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view_priv.id_profile_object_view.profile_object_view.nome'),null,'?%');
            $this->_columns->add('id_papel', 'profile_object_view_priv', 'id_papel', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view_priv.id_papel'), null, '=');
            $this->_columns->add('nome_papel', 'papel', 'nome', $this->_getPapel()->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view_priv.id_papel.papel.nome'),null,'?%');
            $this->_columns->add('tipo', 'profile_object_view_priv', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view_priv.tipo'),'String','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getObjectView()->getModel()->getTableName()." profile_object_view ON ( profile_object_view_priv.id_profile_object_view = profile_object_view.id ) 
                    JOIN ".$this->_getPapel()->getModel()->getTableName()." papel ON ( profile_object_view_priv.id_papel = papel.id )  "; 
            return $sql;
        }
    }
?>