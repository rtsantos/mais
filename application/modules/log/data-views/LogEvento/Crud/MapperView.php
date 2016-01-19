<?php
    /**
    * Classe de visão da tabela log_evento
    */
    class Log_DataView_LogEvento_Crud_MapperView extends Log_Model_LogEvento_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Log_Model_LogObjeto_Mapper
         */
        protected $_logObjeto;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Log_Model_LogOperac_Mapper
         */
        protected $_logOperac;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Usuario_Mapper
         */
        protected $_usuario;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Log_Model_LogTabela_Mapper
         */
        protected $_logTabela;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Log_Model_LogObjeto_Mapper
         */
        protected function _getLogObjeto(){
            if (!is_object($this->_logObjeto)){
                $this->_logObjeto = new Log_Model_LogObjeto_Mapper();
            }
            return $this->_logObjeto;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Log_Model_LogOperac_Mapper
         */
        protected function _getLogOperac(){
            if (!is_object($this->_logOperac)){
                $this->_logOperac = new Log_Model_LogOperac_Mapper();
            }
            return $this->_logOperac;
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
         * @return Log_Model_LogTabela_Mapper
         */
        protected function _getLogTabela(){
            if (!is_object($this->_logTabela)){
                $this->_logTabela = new Log_Model_LogTabela_Mapper();
            }
            return $this->_logTabela;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_log_objeto','nome_log_objeto','id_log_operac','acao_log_operac','id_objeto','id_usuario','login_usuario','nome_usuario','dh_evento','chave','observacao','id_log_tabela','nome_log_tabela');
           $profile['width'] = array('id'=>120,'id_log_objeto'=>120,'nome_log_objeto'=>200,'id_log_operac'=>120,'acao_log_operac'=>200,'id_objeto'=>150,'id_usuario'=>120,'login_usuario'=>200,'nome_usuario'=>200,'dh_evento'=>150,'chave'=>100,'observacao'=>200,'id_log_tabela'=>120,'nome_log_tabela'=>200);
           $profile['align'] = array('id'=>'left','id_log_objeto'=>'left','nome_log_objeto'=>'left','id_log_operac'=>'left','acao_log_operac'=>'left','id_objeto'=>'right','id_usuario'=>'left','login_usuario'=>'left','nome_usuario'=>'left','dh_evento'=>'center','chave'=>'left','observacao'=>'left','id_log_tabela'=>'left','nome_log_tabela'=>'left');
           $profile['hidden'] = array('id','id_log_objeto','id_log_operac','id_usuario','id_log_tabela');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Log_DataView_LogEvento_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->addExpression('id', 'log_evento.id_objeto||\'-\'||log_evento.id_log_tabela', 'Log_Model_LogEvento_Mapper', ZendT_Lib::translate('log_evento.id'),null,'=');
            $this->_columns->add('id_log_objeto', 'log_evento', 'id_log_objeto', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_evento.id_log_objeto'), null, '=');
            $this->_columns->add('nome_log_objeto', 'log_objeto', 'nome', $this->_getLogObjeto()->getModel()->getMapperName(), ZendT_Lib::translate('log_evento.id_log_objeto.log_objeto.nome'),null,'?%');
            $this->_columns->add('id_log_operac', 'log_evento', 'id_log_operac', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_evento.id_log_operac'), null, '=');
            $this->_columns->add('acao_log_operac', 'log_operac', 'acao', $this->_getLogOperac()->getModel()->getMapperName(), ZendT_Lib::translate('log_evento.id_log_operac.log_operac.acao'),null,'?%');
            $this->_columns->add('id_objeto', 'log_evento', 'id_objeto', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_evento.id_objeto'),'Numeric','=');
            $this->_columns->add('id_usuario', 'log_evento', 'id_usuario', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_evento.id_usuario'), null, '=');
            $this->_columns->add('login_usuario', 'usuario', 'login', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('log_evento.id_usuario.usuario.login'),null,'?%');
            $this->_columns->add('nome_usuario', 'usuario', 'nome', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('log_evento.id_usuario.usuario.nome'),null,'?%');
            $this->_columns->add('dh_evento', 'log_evento', 'dh_evento', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_evento.dh_evento'),'DateTime','=');
            $this->_columns->add('chave', 'log_evento', 'chave', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_evento.chave'),'String','%?%');
            $this->_columns->add('observacao', 'log_evento', 'observacao', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_evento.observacao'),'String','%?%');
            $this->_columns->add('id_log_tabela', 'log_evento', 'id_log_tabela', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_evento.id_log_tabela'), null, '=');
            $this->_columns->add('nome_log_tabela', 'log_tabela', 'nome', $this->_getLogTabela()->getModel()->getMapperName(), ZendT_Lib::translate('log_evento.id_log_tabela.log_tabela.nome'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getLogObjeto()->getModel()->getTableName()." log_objeto ON ( log_evento.id_log_objeto = log_objeto.id ) 
                    JOIN ".$this->_getLogOperac()->getModel()->getTableName()." log_operac ON ( log_evento.id_log_operac = log_operac.id ) 
                    LEFT  JOIN ".$this->_getUsuario()->getModel()->getTableName()." usuario ON ( log_evento.id_usuario = usuario.id ) 
                    LEFT  JOIN ".$this->_getLogTabela()->getModel()->getTableName()." log_tabela ON ( log_evento.id_log_tabela = log_tabela.id )  "; 
            return $sql;
        }
    }
?>