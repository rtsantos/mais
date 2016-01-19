<?php
    /**
    * Classe de visão da tabela maillisthist
    */
    class Tools_Model_Maillisthist_Crud_MapperView extends Tools_Model_Maillisthist_Mapper implements ZendT_Db_View
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
           $profile['order'] = array('id_maillist','mail_from_maillist','action','dh_action','err_msg');
           $profile['width'] = array('id_maillist'=>150,'mail_from_maillist'=>200,'action'=>110,'dh_action'=>135,'err_msg'=>310);
           $profile['align'] = array('id_maillist'=>'left','mail_from_maillist'=>'left','action'=>'center','dh_action'=>'center','err_msg'=>'left');
           $profile['hidden'] = array('id_maillist');
           $profile['remove'] = array();
           $profile['listOptions'] = array('action'=>$this->getModel()->getListOptions('action'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Tools_Model_Maillisthist_MapperView',$this->_getSettingsDefault());
            $this->_columns->add('id_maillist', 'maillisthist', 'id_maillist', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillisthist.id_maillist'), null, '?%');
            $this->_columns->add('mail_from_maillist', 'maillist', 'mail_from', $this->_getMaillist()->getModel()->getMapperName(), ZendT_Lib::translate('maillist.mail_from'),null,'?%');
            $this->_columns->add('action', 'maillisthist', 'action', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillisthist.action'),'String','=');
            $this->_columns->add('dh_action', 'maillisthist', 'dh_action', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillisthist.dh_action'),'DateTime','=');
            $this->_columns->add('err_msg', 'maillisthist', 'err_msg', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillisthist.err_msg'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getMaillist()->getModel()->getTableName()." maillist ON ( maillisthist.id_maillist = maillist.id )  "; 
            return $sql;
        }
    }
?>