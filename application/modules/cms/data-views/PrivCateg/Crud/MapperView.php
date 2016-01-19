<?php
    /**
    * Classe de visão da tabela cms_priv_categ
    */
    class Cms_DataView_PrivCateg_Crud_MapperView extends Cms_Model_PrivCateg_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Cms_Model_Categoria_Mapper
         */
        protected $_categoria;
                
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
        protected $_usuario;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Cms_Model_Categoria_Mapper
         */
        protected function _getCategoria(){
            if (!is_object($this->_categoria)){
                $this->_categoria = new Cms_Model_Categoria_Mapper();
            }
            return $this->_categoria;
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
           $profile['order'] = array('id','id_categoria','descricao_categoria','id_papel','nome_papel','tipo','env_email','id_usuario','login_usuario','nome_usuario');
           $profile['width'] = array('id'=>100,'id_categoria'=>120,'descricao_categoria'=>200,'id_papel'=>120,'nome_papel'=>200,'tipo'=>150,'env_email'=>150,'id_usuario'=>120,'login_usuario'=>200,'nome_usuario'=>200);
           $profile['align'] = array('id'=>'left','id_categoria'=>'left','descricao_categoria'=>'left','id_papel'=>'left','nome_papel'=>'left','tipo'=>'center','env_email'=>'center','id_usuario'=>'left','login_usuario'=>'left','nome_usuario'=>'left');
           $profile['hidden'] = array('id_categoria','id_papel','id_usuario');
           $profile['remove'] = array();
           $profile['listOptions'] = array('tipo'=>$this->getModel()->getListOptions('tipo'),'env_email'=>$this->getModel()->getListOptions('env_email'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Cms_DataView_PrivCateg_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'cms_priv_categ', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_categ.id'),'String','%?%');
            $this->_columns->add('id_categoria', 'cms_priv_categ', 'id_categoria', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_categ.id_categoria'), null, '=');
            $this->_columns->add('descricao_categoria', 'categoria', 'descricao', $this->_getCategoria()->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_categ.id_categoria.cms_categoria.descricao'),null,'?%');
            $this->_columns->add('id_papel', 'cms_priv_categ', 'id_papel', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_categ.id_papel'), null, '=');
            $this->_columns->add('nome_papel', 'papel', 'nome', $this->_getPapel()->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_categ.id_papel.papel.nome'),null,'?%');
            $this->_columns->add('tipo', 'cms_priv_categ', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_categ.tipo'),'String','=');
            $this->_columns->add('env_email', 'cms_priv_categ', 'env_email', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_categ.env_email'),'String','=');
            $this->_columns->add('id_usuario', 'cms_priv_categ', 'id_usuario', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_categ.id_usuario'), null, '=');
            $this->_columns->add('login_usuario', 'usuario', 'login', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_categ.id_usuario.usuario.login'),null,'?%');
            $this->_columns->add('nome_usuario', 'usuario', 'nome', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('cms_priv_categ.id_usuario.usuario.nome'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getCategoria()->getModel()->getTableName()." categoria ON ( cms_priv_categ.id_categoria = categoria.id ) 
                    LEFT  JOIN ".$this->_getPapel()->getModel()->getTableName()." papel ON ( cms_priv_categ.id_papel = papel.id ) 
                    LEFT  JOIN ".$this->_getUsuario()->getModel()->getTableName()." usuario ON ( cms_priv_categ.id_usuario = usuario.id )  "; 
            return $sql;
        }
    }
?>