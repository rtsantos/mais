<?php
    /**
    * Classe de visão da tabela recurso
    */
    class Auth_DataView_Recurso_Crud_MapperView extends Auth_Model_Recurso_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_TipoRecurso_Mapper
         */
        protected $_tipoRecurso;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Aplicacao_Mapper
         */
        protected $_aplicacao;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Recurso_Mapper
         */
        protected $_recurso;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_TipoRecurso_Mapper
         */
        protected function _getTipoRecurso(){
            if (!is_object($this->_tipoRecurso)){
                $this->_tipoRecurso = new Auth_Model_TipoRecurso_Mapper();
            }
            return $this->_tipoRecurso;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Aplicacao_Mapper
         */
        protected function _getAplicacao(){
            if (!is_object($this->_aplicacao)){
                $this->_aplicacao = new Auth_Model_Aplicacao_Mapper();
            }
            return $this->_aplicacao;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Recurso_Mapper
         */
        protected function _getRecurso(){
            if (!is_object($this->_recurso)){
                $this->_recurso = new Auth_Model_Recurso_Mapper();
            }
            return $this->_recurso;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_tipo_recurso','nome_tipo_recurso','id_aplicacao','sigla_aplicacao','nome_aplicacao','id_recurso_pai','hierarquia_recurso_pai','nome','hierarquia','descricao','status','icone','observacao','ordem','nivel');
           $profile['width'] = array('id'=>100,'id_tipo_recurso'=>120,'nome_tipo_recurso'=>200,'id_aplicacao'=>120,'sigla_aplicacao'=>200,'nome_aplicacao'=>200,'id_recurso_pai'=>120,'hierarquia_recurso_pai'=>200,'nome'=>200,'hierarquia'=>200,'descricao'=>200,'status'=>150,'icone'=>200,'observacao'=>200,'ordem'=>200,'nivel'=>200);
           $profile['align'] = array('id'=>'left','id_tipo_recurso'=>'left','nome_tipo_recurso'=>'left','id_aplicacao'=>'left','sigla_aplicacao'=>'left','nome_aplicacao'=>'left','id_recurso_pai'=>'left','hierarquia_recurso_pai'=>'left','nome'=>'left','hierarquia'=>'left','descricao'=>'left','status'=>'center','icone'=>'left','observacao'=>'left','ordem'=>'left','nivel'=>'left');
           $profile['hidden'] = array('id_tipo_recurso','id_aplicacao','id_recurso_pai');
           $profile['remove'] = array();
           $profile['listOptions'] = array('status'=>$this->getModel()->getListOptions('status'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Auth_DataView_Recurso_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'recurso', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('recurso.id'),'String','%?%');
            $this->_columns->add('id_tipo_recurso', 'recurso', 'id_tipo_recurso', $this->getModel()->getMapperName(), ZendT_Lib::translate('recurso.id_tipo_recurso'), null, '=');
            $this->_columns->add('nome_tipo_recurso', 'tipo_recurso', 'nome', $this->_getTipoRecurso()->getModel()->getMapperName(), ZendT_Lib::translate('recurso.id_tipo_recurso.tipo_recurso.nome'),null,'?%');
            $this->_columns->add('id_aplicacao', 'recurso', 'id_aplicacao', $this->getModel()->getMapperName(), ZendT_Lib::translate('recurso.id_aplicacao'), null, '=');
            $this->_columns->add('sigla_aplicacao', 'aplicacao', 'sigla', $this->_getAplicacao()->getModel()->getMapperName(), ZendT_Lib::translate('recurso.id_aplicacao.aplicacao.sigla'),null,'?%');
            $this->_columns->add('nome_aplicacao', 'aplicacao', 'nome', $this->_getAplicacao()->getModel()->getMapperName(), ZendT_Lib::translate('recurso.id_aplicacao.aplicacao.nome'),null,'?%');
            $this->_columns->add('id_recurso_pai', 'recurso', 'id_recurso_pai', $this->getModel()->getMapperName(), ZendT_Lib::translate('recurso.id_recurso_pai'), null, '=');
            $this->_columns->add('hierarquia_recurso_pai', 'recurso_pai', 'hierarquia', $this->_getRecurso()->getModel()->getMapperName(), ZendT_Lib::translate('recurso.id_recurso_pai.recurso.hierarquia'),null,'?%');
            $this->_columns->add('nome', 'recurso', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('recurso.nome'),'String','%?%');
            $this->_columns->add('hierarquia', 'recurso', 'hierarquia', $this->getModel()->getMapperName(), ZendT_Lib::translate('recurso.hierarquia'),'String','%?%');
            $this->_columns->add('descricao', 'recurso', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('recurso.descricao'),'String','%?%');
            $this->_columns->add('status', 'recurso', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('recurso.status'),'String','=');
            $this->_columns->add('icone', 'recurso', 'icone', $this->getModel()->getMapperName(), ZendT_Lib::translate('recurso.icone'),'String','%?%');
            $this->_columns->add('observacao', 'recurso', 'observacao', $this->getModel()->getMapperName(), ZendT_Lib::translate('recurso.observacao'),'String','%?%');
            $this->_columns->add('ordem', 'recurso', 'ordem', $this->getModel()->getMapperName(), ZendT_Lib::translate('recurso.ordem'),'String','%?%');
            $this->_columns->add('nivel', 'recurso', 'nivel', $this->getModel()->getMapperName(), ZendT_Lib::translate('recurso.nivel'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getTipoRecurso()->getModel()->getTableName()." tipo_recurso ON ( recurso.id_tipo_recurso = tipo_recurso.id ) 
                    JOIN ".$this->_getAplicacao()->getModel()->getTableName()." aplicacao ON ( recurso.id_aplicacao = aplicacao.id ) 
                    LEFT  JOIN ".$this->_getRecurso()->getModel()->getTableName()." recurso_pai ON ( recurso.id_recurso_pai = recurso_pai.id )  "; 
            return $sql;
        }
    }
?>