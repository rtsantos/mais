<?php
    /**
    * Classe de visão da tabela profile_job
    */
    class Profile_DataView_Job_Users extends Profile_Model_Job_Mapper implements ZendT_Db_View
    {
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_usuario','nome_usuario','email_usuario','uri','objeto');
           $profile['width'] = array('id'=>100,'id_usuario'=>120,'nome_usuario'=>200,'email_usuario'=>150);
           $profile['align'] = array('id'=>'left','id_usuario'=>'left','nome_usuario'=>'left','email_usuario'=>'center');
           $profile['hidden'] = array('id_usuario');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Profile_DataView_Job_Users',$this->_getSettingsDefault());
            
            $_view = new Profile_Model_ObjectView_Mapper();
            $_usuario = new Auth_Model_Usuario_Mapper();
            
            $this->_columns->addExpression( 'uri_token', "gettokenforurlportal(usuario.login)"
                                , new ZendT_Type_String(), ZendT_Lib::translate('Token URI'),'String','%?%');
            
            $this->_columns->add( 'id', 'profile_job', 'id'
                                , $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_job.id'),'String','%?%');
            
            $this->_columns->add( 'id_profile', 'profile_object_view', 'id'
                                , $_view->getId(true), ZendT_Lib::translate('Identificação da Visão'),'String','%?%');
            
            $this->_columns->add( 'observacao', 'profile_object_view', 'observacao'
                                , $_view->getObservacao(true), ZendT_Lib::translate('Observação da Visão'),'String','%?%');
            
            $this->_columns->add( 'uri', 'profile_object_view', 'uri'
                                , $_view->getUri(true), ZendT_Lib::translate('URI da Visão'),'String','%?%');
            
            $this->_columns->add( 'objeto', 'profile_object_view', 'objeto'
                                , $_view->getUri(true), ZendT_Lib::translate('Objeto da Visão'),'String','%?%');
            
            $this->_columns->add( 'nome', 'profile_object_view', 'nome'
                                , $_view->getNome(true), ZendT_Lib::translate('Nome da Visão'),'String','%?%');
            
            $this->_columns->add( 'id_usuario', 'usuario', 'id', $_usuario->getId(true)
                                , ZendT_Lib::translate('ID do Usuário'),'Number','=');
            
            $this->_columns->add( 'nome_usuario', 'usuario', 'nome', $_usuario->getNome(true)
                                , ZendT_Lib::translate('Nome do Usuário'),'String','?%');
            
            $this->_columns->add( 'email_usuario', 'usuario', 'email', $_usuario->getEmail(true)
                                , ZendT_Lib::translate('E-Mail do Usuário'),'String','?%');
            
            $this->_columns->add( 'id_papel', 'profile_job_dest', 'id_papel'
                                , $_view->getId(true), ZendT_Lib::translate('Identificação do Papel'),'String','%?%');
            
            $this->_columns->add( 'nome_papel', 'papel_usu', 'nome'
                                , $_view->getId(true), ZendT_Lib::translate('Nome do Papel'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = "profile_job
                    JOIN profile_object_view ON (profile_job.id_profile_object_view = profile_object_view.id)
                    JOIN profile_job_dest ON (profile_job_dest.id_profile_job = profile_job.id)
                    JOIN papel ON (profile_job_dest.id_papel = papel.id) 
                    JOIN papel papel_usu ON (papel_usu.nome LIKE papel.nome||'%')
                    JOIN usuario ON (usuario.id_papel = papel_usu.id AND usuario.status = 'A')";
            return $sql;
        }
    }
?>