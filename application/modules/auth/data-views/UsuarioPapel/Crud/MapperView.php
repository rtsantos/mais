<?php
    /**
    * Classe de visão da tabela usuario_papel
    */
    class Auth_DataView_UsuarioPapel_Crud_MapperView extends Auth_Model_UsuarioPapel_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Usuario_Mapper
         */
        protected $_usuario;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Papel_Mapper
         */
        protected $_papel;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Usuario_Mapper
         */
        protected function _getUsuario(){
            if (!is_object($this->_usuario)){
                $this->_usuario = new Auth_Model_Usuario_Mapper();
            }
            return $this->_usuario;
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
           $profile['order'] = array('id','id_usuario','login_usuario','nome_usuario','id_papel','nome_papel','prioridade');
           $profile['width'] = array('id'=>120,'id_usuario'=>120,'login_usuario'=>200,'nome_usuario'=>200,'id_papel'=>120,'nome_papel'=>200,'prioridade'=>150);
           $profile['align'] = array('id'=>'left','id_usuario'=>'left','login_usuario'=>'left','nome_usuario'=>'left','id_papel'=>'left','nome_papel'=>'left','prioridade'=>'right');
           $profile['hidden'] = array('id','id_usuario','id_papel');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Auth_DataView_UsuarioPapel_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->addExpression('id', 'usuario_papel.id_usuario||\'-\'||usuario_papel.id_papel', 'Auth_Model_UsuarioPapel_Mapper', ZendT_Lib::translate('usuario_papel.id'),null,'=');
            $this->_columns->add('id_usuario', 'usuario_papel', 'id_usuario', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario_papel.id_usuario'), null, '=');
            $this->_columns->add('login_usuario', 'usuario', 'login', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('usuario_papel.id_usuario.usuario.login'),null,'?%');
            $this->_columns->add('nome_usuario', 'usuario', 'nome', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('usuario_papel.id_usuario.usuario.nome'),null,'?%');
            $this->_columns->add('id_papel', 'usuario_papel', 'id_papel', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario_papel.id_papel'), null, '=');
            $this->_columns->add('nome_papel', 'papel', 'nome', $this->_getPapel()->getModel()->getMapperName(), ZendT_Lib::translate('usuario_papel.id_papel.papel.nome'),null,'?%');
            $this->_columns->add('prioridade', 'usuario_papel', 'prioridade', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario_papel.prioridade'),'Numeric','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getUsuario()->getModel()->getTableName()." usuario ON ( usuario_papel.id_usuario = usuario.id ) 
                    JOIN ".$this->_getPapel()->getModel()->getTableName()." papel ON ( usuario_papel.id_papel = papel.id )  "; 
            return $sql;
        }
    }
?>