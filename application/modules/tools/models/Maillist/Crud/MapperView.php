<?php
    /**
    * Classe de visão da tabela maillist
    */
    class Tools_Model_Maillist_Crud_MapperView extends Tools_Model_Maillist_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','mail_from','mail_to','mail_subject','mail_cc','mail_bcc','mail_alert','send_alert','status','html','ntry','life_time','dh_send','dh_request','discard_attachment','attachment','mail_body');
           $profile['width'] = array('id'=>200,'mail_from'=>200,'mail_to'=>200,'mail_subject'=>200,'mail_cc'=>200,'mail_bcc'=>200,'mail_alert'=>200,'send_alert'=>200,'status'=>200,'html'=>200,'ntry'=>200,'life_time'=>200,'dh_send'=>200,'dh_request'=>200,'discard_attachment'=>200,'attachment'=>200,'mail_body'=>200);
           $profile['align'] = array('id'=>'left','mail_from'=>'left','mail_to'=>'left','mail_subject'=>'left','mail_cc'=>'left','mail_bcc'=>'left','mail_alert'=>'left','send_alert'=>'left','status'=>'left','html'=>'left','ntry'=>'left','life_time'=>'left','dh_send'=>'left','dh_request'=>'left','discard_attachment'=>'left','attachment'=>'left','mail_body'=>'left');
           $profile['hidden'] = array();
           $profile['remove'] = array('mail_body');
           $profile['listOptions'] = array('send_alert'=>$this->getModel()->getListOptions('send_alert'),'status'=>$this->getModel()->getListOptions('status'),'html'=>$this->getModel()->getListOptions('html'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Tools_Model_Maillist_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'maillist', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.id'));
            $this->_columns->add('mail_from', 'maillist', 'mail_from', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.mail_from'));
            $this->_columns->add('mail_to', 'maillist', 'mail_to', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.mail_to'));
            $this->_columns->add('mail_subject', 'maillist', 'mail_subject', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.mail_subject'));
            $this->_columns->add('mail_cc', 'maillist', 'mail_cc', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.mail_cc'));
            $this->_columns->add('mail_bcc', 'maillist', 'mail_bcc', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.mail_bcc'));
            $this->_columns->add('mail_alert', 'maillist', 'mail_alert', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.mail_alert'));
            $this->_columns->add('send_alert', 'maillist', 'send_alert', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.send_alert'));
            $this->_columns->add('status', 'maillist', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.status'));
            $this->_columns->add('html', 'maillist', 'html', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.html'));
            $this->_columns->add('ntry', 'maillist', 'ntry', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.ntry'));
            $this->_columns->add('life_time', 'maillist', 'life_time', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.life_time'));
            $this->_columns->add('dh_send', 'maillist', 'dh_send', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.dh_send'));
            $this->_columns->add('dh_request', 'maillist', 'dh_request', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.dh_request'));
            $this->_columns->add('discard_attachment', 'maillist', 'discard_attachment', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.discard_attachment'));
            $this->_columns->add('attachment', 'maillist', 'attachment', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.attachment'));
            $this->_columns->add('mail_body', 'maillist', 'mail_body', $this->getModel()->getMapperName(), ZendT_Lib::translate('maillist.mail_body'));

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = parent::_getSqlBase();
            return $sql;
        }
    }
?>