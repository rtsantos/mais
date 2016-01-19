<?php
    /**
    * Classe de visão da tabela aplicacao
    */
    class Auth_DataView_Aplicacao_Crud_MapperView extends Auth_Model_Aplicacao_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','sigla','nome','status','observacao','icone','url','dh_inc');
           $profile['width'] = array('id'=>100,'sigla'=>175,'nome'=>200,'status'=>150,'observacao'=>200,'icone'=>200,'url'=>200,'dh_inc'=>150);
           $profile['align'] = array('id'=>'left','sigla'=>'left','nome'=>'left','status'=>'center','observacao'=>'left','icone'=>'left','url'=>'left','dh_inc'=>'center');
           $profile['hidden'] = array();
           $profile['remove'] = array();
           $profile['listOptions'] = array('status'=>$this->getModel()->getListOptions('status'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Auth_DataView_Aplicacao_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'aplicacao', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('aplicacao.id'),'String','%?%');
            $this->_columns->add('sigla', 'aplicacao', 'sigla', $this->getModel()->getMapperName(), ZendT_Lib::translate('aplicacao.sigla'),'String','%?%');
            $this->_columns->add('nome', 'aplicacao', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('aplicacao.nome'),'String','%?%');
            $this->_columns->add('status', 'aplicacao', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('aplicacao.status'),'String','=');
            $this->_columns->add('observacao', 'aplicacao', 'observacao', $this->getModel()->getMapperName(), ZendT_Lib::translate('aplicacao.observacao'),'String','%?%');
            $this->_columns->add('icone', 'aplicacao', 'icone', $this->getModel()->getMapperName(), ZendT_Lib::translate('aplicacao.icone'),'String','%?%');
            $this->_columns->add('url', 'aplicacao', 'url', $this->getModel()->getMapperName(), ZendT_Lib::translate('aplicacao.url'),'String','%?%');
            $this->_columns->add('dh_inc', 'aplicacao', 'dh_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('aplicacao.dh_inc'),'DateTime','=');

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