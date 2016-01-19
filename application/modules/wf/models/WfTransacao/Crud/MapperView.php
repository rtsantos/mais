<?php
    /**
    * Classe de visão da tabela wf_transacao
    */
    class Wf_Model_WfTransacao_Crud_MapperView extends Wf_Model_WfTransacao_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Wf_Model_WfFase_Mapper
         */
        protected $_wfFase;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Usuario_Mapper
         */
        protected $_usuario;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return '.Wf_Model_WfFase_Mapper.'
         */
        protected function _getWfFase(){
            if (!is_object($this->_wfFase)){
                $this->_wfFase = new Wf_Model_WfFase_Mapper();
            }
            return $this->_wfFase;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return '.Auth_Model_Usuario_Mapper.'
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
           $profile['order'] = array('id','id_wf_fase','valor_wf_fase','id_objeto','id_usuario_aloc','login_usuario_aloc','nome_usuario_aloc','dh_inc','observacao');
           $profile['width'] = array('id'=>120,'id_wf_fase'=>120,'valor_wf_fase'=>200,'id_objeto'=>150,'id_usuario_aloc'=>120,'login_usuario_aloc'=>200,'nome_usuario_aloc'=>200,'dh_inc'=>150,'observacao'=>200);
           $profile['align'] = array('id'=>'left','id_wf_fase'=>'left','valor_wf_fase'=>'left','id_objeto'=>'right','id_usuario_aloc'=>'left','login_usuario_aloc'=>'left','nome_usuario_aloc'=>'left','dh_inc'=>'center','observacao'=>'left');
           $profile['hidden'] = array('id','id_wf_fase','id_usuario_aloc');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Wf_Model_WfTransacao_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->addExpression('id', 'wf_transacao.id_wf_fase||\'-\'||wf_transacao.id_objeto', 'Wf_Model_WfTransacao_Mapper', ZendT_Lib::translate('wf_transacao.id'));
            $this->_columns->add('id_wf_fase', 'wf_transacao', 'id_wf_fase', $this->getModel()->getMapperName(), ZendT_Lib::translate('wf_transacao.id_wf_fase'));
            $this->_columns->add('valor_wf_fase', 'wf_fase', 'valor', $this->_getWfFase()->getModel()->getMapperName(), ZendT_Lib::translate('wf_transacao.id_wf_fase.wf_fase.valor'));
            $this->_columns->add('id_objeto', 'wf_transacao', 'id_objeto', $this->getModel()->getMapperName(), ZendT_Lib::translate('wf_transacao.id_objeto'));
            $this->_columns->add('id_usuario_aloc', 'wf_transacao', 'id_usuario_aloc', $this->getModel()->getMapperName(), ZendT_Lib::translate('wf_transacao.id_usuario_aloc'));
            $this->_columns->add('login_usuario_aloc', 'usuario_aloc', 'login', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('wf_transacao.id_usuario_aloc.usuario.login'));
            $this->_columns->add('nome_usuario_aloc', 'usuario_aloc', 'nome', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('wf_transacao.id_usuario_aloc.usuario.nome'));
            $this->_columns->add('dh_inc', 'wf_transacao', 'dh_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('wf_transacao.dh_inc'));
            $this->_columns->add('observacao', 'wf_transacao', 'observacao', $this->getModel()->getMapperName(), ZendT_Lib::translate('wf_transacao.observacao'));

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getWfFase()->getModel()->getTableName()." wf_fase ON ( wf_transacao.id_wf_fase = wf_fase.id ) 
                    JOIN ".$this->_getUsuario()->getModel()->getTableName()." usuario_aloc ON ( wf_transacao.id_usuario_aloc = usuario_aloc.id )  "; 
            return $sql;
        }
    }
?>