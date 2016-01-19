<?php
    /**
    * Classe de visão da tabela cms_conteudo
    */
    class Cms_DataView_Conteudo_Crud_MapperView extends Cms_Model_Conteudo_Mapper implements ZendT_Db_View
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
         * @return Cms_Model_Conteudo_Mapper
         */
        protected $_conteudo;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Usuario_Mapper
         */
        protected $_usuario;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Cms_Model_Status_Mapper
         */
        protected $_status;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Filial_Mapper
         */
        protected $_filial;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Cidade_Mapper
         */
        protected $_cidade;
                
        
                
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
         * @return Cms_Model_Status_Mapper
         */
        protected function _getStatus(){
            if (!is_object($this->_status)){
                $this->_status = new Cms_Model_Status_Mapper();
            }
            return $this->_status;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Filial_Mapper
         */
        protected function _getFilial(){
            if (!is_object($this->_filial)){
                $this->_filial = new Ca_Model_Filial_Mapper();
            }
            return $this->_filial;
        }
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Cidade_Mapper
         */
        protected function _getCidade(){
            if (!is_object($this->_cidade)){
                $this->_cidade = new Ca_Model_Cidade_Mapper();
            }
            return $this->_cidade;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_categoria','descricao_categoria','id_conteudo_pai','titulo_conteudo_pai','titulo','sub_titulo','dh_ini_pub','dh_fim_pub','corpo','arquivo','thumbnail','id_usuario_inc','login_usuario_inc','nome_usuario_inc','id_status','descricao_status','publico','banner','corpo_url','chave','chave_macro','id_usuario_aprov','login_usuario_aprov','nome_usuario_aprov','id_filial','sigla_filial','nome_cidade');
           $profile['width'] = array('id'=>100,'id_categoria'=>120,'descricao_categoria'=>200,'id_conteudo_pai'=>120,'titulo_conteudo_pai'=>200,'titulo'=>200,'sub_titulo'=>200,'dh_ini_pub'=>150,'dh_fim_pub'=>150,'corpo'=>200,'arquivo'=>150,'thumbnail'=>150,'id_usuario_inc'=>120,'login_usuario_inc'=>200,'nome_usuario_inc'=>200,'id_status'=>120,'descricao_status'=>200,'publico'=>150,'banner'=>150,'corpo_url'=>200,'chave'=>200,'chave_macro'=>200,'id_usuario_aprov'=>120,'login_usuario_aprov'=>200,'nome_usuario_aprov'=>200,'id_filial'=>120,'sigla_filial'=>200,'nome_cidade'=>200);
           $profile['align'] = array('id'=>'left','id_categoria'=>'left','descricao_categoria'=>'left','id_conteudo_pai'=>'left','titulo_conteudo_pai'=>'left','titulo'=>'left','sub_titulo'=>'left','dh_ini_pub'=>'center','dh_fim_pub'=>'center','corpo'=>'left','arquivo'=>'right','thumbnail'=>'right','id_usuario_inc'=>'left','login_usuario_inc'=>'left','nome_usuario_inc'=>'left','id_status'=>'left','descricao_status'=>'left','publico'=>'center','banner'=>'right','corpo_url'=>'left','chave'=>'left','chave_macro'=>'left','id_usuario_aprov'=>'left','login_usuario_aprov'=>'left','nome_usuario_aprov'=>'left','id_filial'=>'left','sigla_filial'=>'left','nome_cidade'=>'left');
           $profile['hidden'] = array('id_categoria','id_conteudo_pai','id_usuario_inc','id_status','id_usuario_aprov','id_filial');
           $profile['remove'] = array('corpo');
           $profile['listOptions'] = array('publico'=>$this->getModel()->getListOptions('publico'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Cms_DataView_Conteudo_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'cms_conteudo', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id'),'String','%?%');
            $this->_columns->add('id_categoria', 'cms_conteudo', 'id_categoria', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_categoria'), null, '=');
            $this->_columns->add('descricao_categoria', 'categoria', 'descricao', $this->_getCategoria()->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_categoria.cms_categoria.descricao'),null,'?%');
            $this->_columns->add('id_conteudo_pai', 'cms_conteudo', 'id_conteudo_pai', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_conteudo_pai'), null, '=');
            $this->_columns->add('titulo_conteudo_pai', 'conteudo_pai', 'titulo', $this->_getConteudo()->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_conteudo_pai.cms_conteudo.titulo'),null,'?%');
            $this->_columns->add('titulo', 'cms_conteudo', 'titulo', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.titulo'),'String','%?%');
            $this->_columns->add('sub_titulo', 'cms_conteudo', 'sub_titulo', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.sub_titulo'),'String','%?%');
            $this->_columns->add('dh_ini_pub', 'cms_conteudo', 'dh_ini_pub', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.dh_ini_pub'),'DateTime','=');
            $this->_columns->add('dh_fim_pub', 'cms_conteudo', 'dh_fim_pub', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.dh_fim_pub'),'DateTime','=');
            $this->_columns->add('corpo', 'cms_conteudo', 'corpo', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.corpo'),'String','%?%');
            $this->_columns->add('arquivo', 'cms_conteudo', 'arquivo', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.arquivo'),'Numeric','=');
            $this->_columns->add('thumbnail', 'cms_conteudo', 'thumbnail', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.thumbnail'),'Numeric','=');
            $this->_columns->add('id_usuario_inc', 'cms_conteudo', 'id_usuario_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_usuario_inc'), null, '=');
            $this->_columns->add('login_usuario_inc', 'usuario_inc', 'login', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_usuario_inc.usuario.login'),null,'?%');
            $this->_columns->add('nome_usuario_inc', 'usuario_inc', 'nome', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_usuario_inc.usuario.nome'),null,'?%');
            $this->_columns->add('id_status', 'cms_conteudo', 'id_status', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_status'), null, '=');
            $this->_columns->add('descricao_status', 'status', 'descricao', $this->_getStatus()->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_status.cms_status.descricao'),null,'?%');
            $this->_columns->add('publico', 'cms_conteudo', 'publico', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.publico'),'String','=');
            $this->_columns->add('banner', 'cms_conteudo', 'banner', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.banner'),'Numeric','=');
            $this->_columns->add('corpo_url', 'cms_conteudo', 'corpo_url', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.corpo_url'),'String','%?%');
            $this->_columns->add('chave', 'cms_conteudo', 'chave', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.chave'),'String','%?%');
            $this->_columns->add('chave_macro', 'cms_conteudo', 'chave_macro', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.chave_macro'),'String','%?%');
            $this->_columns->add('id_usuario_aprov', 'cms_conteudo', 'id_usuario_aprov', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_usuario_aprov'), null, '=');
            $this->_columns->add('login_usuario_aprov', 'usuario_aprov', 'login', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_usuario_aprov.usuario.login'),null,'?%');
            $this->_columns->add('nome_usuario_aprov', 'usuario_aprov', 'nome', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_usuario_aprov.usuario.nome'),null,'?%');
            $this->_columns->add('id_filial', 'cms_conteudo', 'id_filial', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_filial'), null, '=');
            $this->_columns->add('sigla_filial', 'filial', 'sigla', $this->_getFilial()->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_filial.filial.sigla'),null,'?%');
            $this->_columns->add('nome_cidade', 'cidade', 'nome', $this->_getCidade()->getModel()->getMapperName(), ZendT_Lib::translate('cms_conteudo.id_filial.filial.nome_cidade'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getCategoria()->getModel()->getTableName()." categoria ON ( cms_conteudo.id_categoria = categoria.id ) 
                    LEFT  JOIN ".$this->_getConteudo()->getModel()->getTableName()." conteudo_pai ON ( cms_conteudo.id_conteudo_pai = conteudo_pai.id ) 
                    JOIN ".$this->_getUsuario()->getModel()->getTableName()." usuario_inc ON ( cms_conteudo.id_usuario_inc = usuario_inc.id ) 
                    JOIN ".$this->_getStatus()->getModel()->getTableName()." status ON ( cms_conteudo.id_status = status.id ) 
                    LEFT  JOIN ".$this->_getUsuario()->getModel()->getTableName()." usuario_aprov ON ( cms_conteudo.id_usuario_aprov = usuario_aprov.id ) 
                    LEFT  JOIN ".$this->_getFilial()->getModel()->getTableName()." filial ON ( cms_conteudo.id_filial = filial.id ) 
                    LEFT  JOIN ".$this->_getCidade()->getModel()->getTableName()." cidade ON ( filial.id_cidade = cidade.id )  "; 
            return $sql;
        }
    }
?>