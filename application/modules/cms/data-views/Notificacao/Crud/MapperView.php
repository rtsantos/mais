<?php
    /**
    * Classe de visão da tabela cms_notificacao
    */
    class Cms_DataView_Notificacao_Crud_MapperView extends Cms_Model_Notificacao_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Tools_Model_Maillist_Mapper
         */
        protected $_maillist;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Tools_Model_Maillist_Mapper
         */
        protected function _getMaillist(){
            if (!is_object($this->_maillist)){
                $this->_maillist = new Tools_Model_Maillist_Mapper();
            }
            return $this->_maillist;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_conteudo','id_usuario','id_maillist','mail_from_maillist');
           $profile['width'] = array('id'=>120,'id_conteudo'=>100,'id_usuario'=>100,'id_maillist'=>120,'mail_from_maillist'=>200);
           $profile['align'] = array('id'=>'left','id_conteudo'=>'left','id_usuario'=>'left','id_maillist'=>'left','mail_from_maillist'=>'left');
           $profile['hidden'] = array('id','id_maillist');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Cms_DataView_Notificacao_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->addExpression('id', 'cms_notificacao.id_conteudo||\'-\'||cms_notificacao.id_usuario', 'Cms_Model_Notificacao_Mapper', ZendT_Lib::translate('cms_notificacao.id'),null,'=');
            $this->_columns->add('id_conteudo', 'cms_notificacao', 'id_conteudo', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_notificacao.id_conteudo'),'String','%?%');
            $this->_columns->add('id_usuario', 'cms_notificacao', 'id_usuario', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_notificacao.id_usuario'),'String','%?%');
            $this->_columns->add('id_maillist', 'cms_notificacao', 'id_maillist', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_notificacao.id_maillist'), null, '=');
            $this->_columns->add('mail_from_maillist', 'maillist', 'mail_from', $this->_getMaillist()->getModel()->getMapperName(), ZendT_Lib::translate('cms_notificacao.id_maillist.maillist.mail_from'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    LEFT  JOIN ".$this->_getMaillist()->getModel()->getTableName()." maillist ON ( cms_notificacao.id_maillist = maillist.id )  "; 
            return $sql;
        }
    }
?>