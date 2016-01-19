<?php
    /**
    * Classe de visão da tabela profile_object_view
    */
    class Profile_DataView_ObjectView_Crud_MapperView extends Profile_Model_ObjectView_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Conta_Mapper
         */
        protected $_conta;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Conta_Mapper
         */
        protected function _getConta(){
            if (!is_object($this->_conta)){
                $this->_conta = new Auth_Model_Conta_Mapper();
            }
            return $this->_conta;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','tipo','padrao','nome','objeto','observacao','config','id_usuario','nome_usuario','uri','chave');
           $profile['width'] = array('id'=>100,'tipo'=>150,'padrao'=>150,'nome'=>200,'objeto'=>200,'observacao'=>200,'config'=>200,'id_usuario'=>120,'nome_usuario'=>200,'uri'=>200,'chave'=>200);
           $profile['align'] = array('id'=>'left','tipo'=>'center','padrao'=>'center','nome'=>'left','objeto'=>'left','observacao'=>'left','config'=>'left','id_usuario'=>'left','nome_usuario'=>'left','uri'=>'left','chave'=>'left');
           $profile['hidden'] = array('id_usuario');
           $profile['remove'] = array();
           $profile['listOptions'] = array('tipo'=>$this->getModel()->getListOptions('tipo'),'padrao'=>$this->getModel()->getListOptions('padrao'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Profile_DataView_ObjectView_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'profile_object_view', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view.id'),'String','%?%');
            $this->_columns->add('tipo', 'profile_object_view', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view.tipo'),'String','=');
            $this->_columns->add('padrao', 'profile_object_view', 'padrao', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view.padrao'),'String','=');
            $this->_columns->add('nome', 'profile_object_view', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view.nome'),'String','%?%');
            $this->_columns->add('objeto', 'profile_object_view', 'objeto', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view.objeto'),'String','%?%');
            $this->_columns->add('observacao', 'profile_object_view', 'observacao', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view.observacao'),'String','%?%');
            $this->_columns->add('config', 'profile_object_view', 'config', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view.config'),'String','%?%');
            $this->_columns->add('id_usuario', 'profile_object_view', 'id_usuario', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view.id_usuario'), null, '=');
            $this->_columns->add('nome_usuario', 'usuario', 'nome', $this->_getConta()->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view.id_usuario.papel.nome'),null,'?%');
            $this->_columns->add('uri', 'profile_object_view', 'uri', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view.uri'),'String','%?%');
            $this->_columns->add('chave', 'profile_object_view', 'chave', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_object_view.chave'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getConta()->getModel()->getTableName()." usuario ON ( profile_object_view.id_usuario = usuario.id )  "; 
            return $sql;
        }
    }
?>