<?php
    /**
    * Classe de visão da tabela img_docto
    */
    class Ged_DataView_Docto_Crud_MapperView extends Ged_Model_Docto_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ged_Model_TipoDocto_Mapper
         */
        protected $_tipoDocto;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Usuario_Mapper
         */
        protected $_usuario;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ged_Model_Arquivo_Mapper
         */
        protected $_arquivo;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ged_Model_TipoDocto_Mapper
         */
        protected function _getTipoDocto(){
            if (!is_object($this->_tipoDocto)){
                $this->_tipoDocto = new Ged_Model_TipoDocto_Mapper();
            }
            return $this->_tipoDocto;
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
         * @return Ged_Model_Arquivo_Mapper
         */
        protected function _getArquivo(){
            if (!is_object($this->_arquivo)){
                $this->_arquivo = new Ged_Model_Arquivo_Mapper();
            }
            return $this->_arquivo;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_tipo_docto','nome_tipo_docto','id_prop_relac','dh_inclusao','id_usu_incl','login_usu_incl','nome_usu_incl','descricao','id_arquivo','conteudo_name_arquivo');
           $profile['width'] = array('id'=>100,'id_tipo_docto'=>120,'nome_tipo_docto'=>200,'id_prop_relac'=>150,'dh_inclusao'=>150,'id_usu_incl'=>120,'login_usu_incl'=>200,'nome_usu_incl'=>200,'descricao'=>200,'id_arquivo'=>120,'conteudo_name_arquivo'=>200);
           $profile['align'] = array('id'=>'left','id_tipo_docto'=>'left','nome_tipo_docto'=>'left','id_prop_relac'=>'right','dh_inclusao'=>'center','id_usu_incl'=>'left','login_usu_incl'=>'left','nome_usu_incl'=>'left','descricao'=>'left','id_arquivo'=>'left','conteudo_name_arquivo'=>'left');
           $profile['hidden'] = array('id_tipo_docto','id_usu_incl','id_arquivo');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ged_DataView_Docto_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'img_docto', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_docto.id'),'String','%?%');
            $this->_columns->add('id_tipo_docto', 'img_docto', 'id_tipo_docto', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_docto.id_tipo_docto'), null, '=');
            $this->_columns->add('nome_tipo_docto', 'tipo_docto', 'nome', $this->_getTipoDocto()->getModel()->getMapperName(), ZendT_Lib::translate('img_docto.id_tipo_docto.img_tipo_docto.nome'),null,'?%');
            $this->_columns->add('id_prop_relac', 'img_docto', 'id_prop_relac', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_docto.id_prop_relac'),'Numeric','=');
            $this->_columns->add('dh_inclusao', 'img_docto', 'dh_inclusao', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_docto.dh_inclusao'),'DateTime','=');
            $this->_columns->add('id_usu_incl', 'img_docto', 'id_usu_incl', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_docto.id_usu_incl'), null, '=');
            $this->_columns->add('login_usu_incl', 'usu_incl', 'login', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('img_docto.id_usu_incl.usuario.login'),null,'?%');
            $this->_columns->add('nome_usu_incl', 'usu_incl', 'nome', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('img_docto.id_usu_incl.usuario.nome'),null,'?%');
            $this->_columns->add('descricao', 'img_docto', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_docto.descricao'),'String','%?%');
            $this->_columns->add('id_arquivo', 'img_docto', 'id_arquivo', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_docto.id_arquivo'), null, '=');
            $this->_columns->add('conteudo_name_arquivo', 'arquivo', 'conteudo_name', $this->_getArquivo()->getModel()->getMapperName(), ZendT_Lib::translate('img_docto.id_arquivo.img_arquivo.conteudo_name'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getTipoDocto()->getModel()->getTableName()." tipo_docto ON ( img_docto.id_tipo_docto = tipo_docto.id ) 
                    LEFT  JOIN ".$this->_getUsuario()->getModel()->getTableName()." usu_incl ON ( img_docto.id_usu_incl = usu_incl.id ) 
                    LEFT  JOIN ".$this->_getArquivo()->getModel()->getTableName()." arquivo ON ( img_docto.id_arquivo = arquivo.id )  "; 
            return $sql;
        }
    }
?>