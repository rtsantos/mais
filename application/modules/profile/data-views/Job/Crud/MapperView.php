<?php
    /**
    * Classe de visão da tabela profile_job
    */
    class Profile_DataView_Job_Crud_MapperView extends Profile_Model_Job_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Profile_Model_ObjectView_Mapper
         */
        protected $_objectView;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Profile_Model_ObjectView_Mapper
         */
        protected function _getObjectView(){
            if (!is_object($this->_objectView)){
                $this->_objectView = new Profile_Model_ObjectView_Mapper();
            }
            return $this->_objectView;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_profile_object_view','nome_profile_object_view','descricao','dh_ini_exec','dh_ult_exec','tipo','frequencia','dt_fim_exec');
           $profile['width'] = array('id'=>100,'id_profile_object_view'=>120,'nome_profile_object_view'=>200,'descricao'=>524,'dh_ini_exec'=>150,'dh_ult_exec'=>150,'tipo'=>150,'frequencia'=>150,'dt_fim_exec'=>100);
           $profile['align'] = array('id'=>'left','id_profile_object_view'=>'left','nome_profile_object_view'=>'left','descricao'=>'left','dh_ini_exec'=>'center','dh_ult_exec'=>'center','tipo'=>'center','frequencia'=>'right','dt_fim_exec'=>'center');
           $profile['hidden'] = array('id_profile_object_view');
           $profile['remove'] = array();
           $profile['listOptions'] = array('tipo'=>$this->getModel()->getListOptions('tipo'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Profile_DataView_Job_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'profile_job', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_job.id'),'String','%?%');
            $this->_columns->add('id_profile_object_view', 'profile_job', 'id_profile_object_view', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_job.id_profile_object_view'), null, '=');
            $this->_columns->add('nome_profile_object_view', 'profile_object_view', 'nome', $this->_getObjectView()->getModel()->getMapperName(), ZendT_Lib::translate('profile_job.id_profile_object_view.profile_object_view.nome'),null,'?%');
            $this->_columns->add('descricao', 'profile_job', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_job.descricao'),'String','%?%');
            $this->_columns->add('dh_ini_exec', 'profile_job', 'dh_ini_exec', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_job.dh_ini_exec'),'DateTime','=');
            $this->_columns->add('dh_ult_exec', 'profile_job', 'dh_ult_exec', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_job.dh_ult_exec'),'DateTime','=');
            $this->_columns->add('tipo', 'profile_job', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_job.tipo'),'String','=');
            $this->_columns->add('frequencia', 'profile_job', 'frequencia', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_job.frequencia'),'Numeric','=');
            $this->_columns->add('dt_fim_exec', 'profile_job', 'dt_fim_exec', $this->getModel()->getMapperName(), ZendT_Lib::translate('profile_job.dt_fim_exec'),'Date','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getObjectView()->getModel()->getTableName()." profile_object_view ON ( profile_job.id_profile_object_view = profile_object_view.id )  "; 
            return $sql;
        }
    }
?>