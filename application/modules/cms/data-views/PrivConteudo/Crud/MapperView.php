<?php
    /**
    * Classe de visão da tabela cms_priv_conteudo
    */
    class Cms_DataView_PrivConteudo_Crud_MapperView extends Cms_Model_PrivConteudo_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Cms_Model_Conteudo_Mapper
         */
        protected $_conteudo;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Conta_Mapper
         */
        protected $_papel;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Usuario_Mapper
         */
        protected $_usuario;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Cms_Model_Conteudo_Mapper
         */
        protected function _getConteudo(){
            if (!is_object($this->_conteudo)){
                $this->_conteudo = new Cms_Model_Conteudo_Mapper();
            }
            return $this->_conteudo;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Conta_Mapper
         */
        protected function _getPapel(){
            if (!is_object($this->_papel)){
                $this->_papel = new Auth_Model_Conta_Mapper();
            }
            return $this->_papel;
        }
                
                
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
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id_conteudo','titulo_conteudo','id_papel','nome_papel','id','tipo','env_email','id_usuario','login_usuario','nome_usuario');
           $profile['width'] = array('id_conteudo'=>120,'titulo_conteudo'=>200,'id_papel'=>120,'nome_papel'=>200,'id'=>100,'tipo'=>150,'env_email'=>150,'id_usuario'=>120,'login_usuario'=>200,'nome_usuario'=>200);
           $profile['align'] = array('id_conteudo'=>'left','titulo_conteudo'=>'left','id_papel'=>'left','nome_papel'=>'left','id'=>'left','tipo'=>'center','env_email'=>'center','id_usuario'=>'left','login_usuario'=>'left','nome_usuario'=>'left');
           $profile['hidden'] = array('id_conteudo','id_papel','id_usuario');
           $profile['remove'] = array();
           $profile['listOptions'] = array('tipo'=>$this->getModel()->getListOptions('tipo'),'env_email'=>$this->getModel()->getListOptions('env_email'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Cms_DataView_PrivConteudo_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id_conteudo', 'cms_priv_conteudo', 'id_conteudo', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_conteudo.id_conteudo'), null, '=');
            $this->_columns->add('titulo_conteudo', 'conteudo', 'titulo', $this->_getConteudo()->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_conteudo.id_conteudo.cms_conteudo.titulo'),null,'?%');
            $this->_columns->add('id_papel', 'cms_priv_conteudo', 'id_papel', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_conteudo.id_papel'), null, '=');
            $this->_columns->add('nome_papel', 'papel', 'nome', $this->_getPapel()->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_conteudo.id_papel.papel.nome'),null,'?%');
            $this->_columns->add('id', 'cms_priv_conteudo', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_conteudo.id'),'String','%?%');
            $this->_columns->add('tipo', 'cms_priv_conteudo', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_conteudo.tipo'),'String','=');
            $this->_columns->add('env_email', 'cms_priv_conteudo', 'env_email', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_conteudo.env_email'),'String','=');
            $this->_columns->add('id_usuario', 'cms_priv_conteudo', 'id_usuario', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_conteudo.id_usuario'), null, '=');
            $this->_columns->add('login_usuario', 'usuario', 'login', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_conteudo.id_usuario.usuario.login'),null,'?%');
            $this->_columns->add('nome_usuario', 'usuario', 'nome', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_conteudo.id_usuario.usuario.nome'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getConteudo()->getModel()->getTableName()." conteudo ON ( cms_priv_conteudo.id_conteudo = conteudo.id ) 
                    LEFT  JOIN ".$this->_getPapel()->getModel()->getTableName()." papel ON ( cms_priv_conteudo.id_papel = papel.id ) 
                    LEFT  JOIN ".$this->_getUsuario()->getModel()->getTableName()." usuario ON ( cms_priv_conteudo.id_usuario = usuario.id )  "; 
            return $sql;
        }
    }
?>