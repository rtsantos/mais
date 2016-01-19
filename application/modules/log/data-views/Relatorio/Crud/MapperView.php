<?php
    /**
    * Classe de visão da tabela log_web_relat
    */
    class Log_DataView_Relatorio_Crud_MapperView extends Log_Model_Relatorio_Mapper implements ZendT_Db_View
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
           $profile['order'] = array('id','id_usuario','login_usuario','nome_usuario','sessao','arquivo','titulo','dh_ini_exec','dh_fim_exec','dh_fim_relat','qtd_reg','impresso');
           $profile['width'] = array('id'=>100,'id_usuario'=>120,'login_usuario'=>200,'nome_usuario'=>200,'sessao'=>200,'arquivo'=>200,'titulo'=>200,'dh_ini_exec'=>150,'dh_fim_exec'=>150,'dh_fim_relat'=>150,'qtd_reg'=>150,'impresso'=>100);
           $profile['align'] = array('id'=>'left','id_usuario'=>'left','login_usuario'=>'left','nome_usuario'=>'left','sessao'=>'left','arquivo'=>'left','titulo'=>'left','dh_ini_exec'=>'center','dh_fim_exec'=>'center','dh_fim_relat'=>'center','qtd_reg'=>'right','impresso'=>'left');
           $profile['hidden'] = array('id_usuario');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Log_Model_Relatorio_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'log_web_relat', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_web_relat.id'),'String','%?%');
            $this->_columns->add('id_usuario', 'log_web_relat', 'id_usuario', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_web_relat.id_usuario'), null, '?%');
            $this->_columns->add('login_usuario', 'usuario', 'login', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('log_web_relat.id_usuario.usuario.login'),null,'?%');
            $this->_columns->add('nome_usuario', 'usuario', 'nome', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('log_web_relat.id_usuario.usuario.nome'),null,'?%');
            $this->_columns->add('sessao', 'log_web_relat', 'sessao', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_web_relat.sessao'),'String','%?%');
            $this->_columns->add('arquivo', 'log_web_relat', 'arquivo', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_web_relat.arquivo'),'String','%?%');
            $this->_columns->add('titulo', 'log_web_relat', 'titulo', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_web_relat.titulo'),'String','%?%');
            $this->_columns->add('dh_ini_exec', 'log_web_relat', 'dh_ini_exec', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_web_relat.dh_ini_exec'),'DateTime','=');
            $this->_columns->add('dh_fim_exec', 'log_web_relat', 'dh_fim_exec', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_web_relat.dh_fim_exec'),'DateTime','=');
            $this->_columns->add('dh_fim_relat', 'log_web_relat', 'dh_fim_relat', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_web_relat.dh_fim_relat'),'DateTime','=');
            $this->_columns->add('qtd_reg', 'log_web_relat', 'qtd_reg', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_web_relat.qtd_reg'),'Numeric','=');
            $this->_columns->add('impresso', 'log_web_relat', 'impresso', $this->getModel()->getMapperName(), ZendT_Lib::translate('log_web_relat.impresso'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    LEFT  JOIN ".$this->_getUsuario()->getModel()->getTableName()." usuario ON ( log_web_relat.id_usuario = usuario.id )  "; 
            return $sql;
        }
    }
?>