<?php
    /**
    * Classe de visão da tabela tl_job
    */
    class Tools_DataView_Job_Crud_MapperView extends Tools_Model_Job_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','descricao','dh_inc','dh_ini_exec','dh_ult_exec','dh_fim_exec','tp_frequencia','num_frequencia','forma_exec','procedimento','parametro','tempo_ul_exec','dh_pro_exec','status');
           $profile['width'] = array('id'=>100,'descricao'=>200,'dh_inc'=>150,'dh_ini_exec'=>150,'dh_ult_exec'=>150,'dh_fim_exec'=>150,'tp_frequencia'=>150,'num_frequencia'=>150,'forma_exec'=>150,'procedimento'=>200,'parametro'=>200,'tempo_ul_exec'=>150,'dh_pro_exec'=>150,'status'=>150);
           $profile['align'] = array('id'=>'left','descricao'=>'left','dh_inc'=>'center','dh_ini_exec'=>'center','dh_ult_exec'=>'center','dh_fim_exec'=>'center','tp_frequencia'=>'center','num_frequencia'=>'right','forma_exec'=>'center','procedimento'=>'left','parametro'=>'left','tempo_ul_exec'=>'right','dh_pro_exec'=>'center','status'=>'center');
           $profile['hidden'] = array();
           $profile['remove'] = array();
           $profile['listOptions'] = array('tp_frequencia'=>$this->getModel()->getListOptions('tp_frequencia'),'forma_exec'=>$this->getModel()->getListOptions('forma_exec'),'status'=>$this->getModel()->getListOptions('status'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Tools_DataView_Job_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'job', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('job.id'),'String','%?%');
            $this->_columns->add('descricao', 'job', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('job.descricao'),'String','%?%');
            $this->_columns->add('dh_inc', 'job', 'dh_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('job.dh_inc'),'DateTime','=');
            $this->_columns->add('dh_ini_exec', 'job', 'dh_ini_exec', $this->getModel()->getMapperName(), ZendT_Lib::translate('job.dh_ini_exec'),'DateTime','=');
            $this->_columns->add('dh_ult_exec', 'job', 'dh_ult_exec', $this->getModel()->getMapperName(), ZendT_Lib::translate('job.dh_ult_exec'),'DateTime','=');
            $this->_columns->add('dh_fim_exec', 'job', 'dh_fim_exec', $this->getModel()->getMapperName(), ZendT_Lib::translate('job.dh_fim_exec'),'DateTime','=');
            $this->_columns->add('tp_frequencia', 'job', 'tp_frequencia', $this->getModel()->getMapperName(), ZendT_Lib::translate('job.tp_frequencia'),'String','=');
            $this->_columns->add('num_frequencia', 'job', 'num_frequencia', $this->getModel()->getMapperName(), ZendT_Lib::translate('job.num_frequencia'),'Numeric','=');
            $this->_columns->add('forma_exec', 'job', 'forma_exec', $this->getModel()->getMapperName(), ZendT_Lib::translate('job.forma_exec'),'String','=');
            $this->_columns->add('procedimento', 'job', 'procedimento', $this->getModel()->getMapperName(), ZendT_Lib::translate('job.procedimento'),'String','%?%');
            $this->_columns->add('parametro', 'job', 'parametro', $this->getModel()->getMapperName(), ZendT_Lib::translate('job.parametro'),'String','%?%');
            $this->_columns->add('tempo_ul_exec', 'job', 'tempo_ul_exec', $this->getModel()->getMapperName(), ZendT_Lib::translate('job.tempo_ul_exec'),'Numeric','=');
            $this->_columns->add('dh_pro_exec', 'job', 'dh_pro_exec', $this->getModel()->getMapperName(), ZendT_Lib::translate('job.dh_pro_exec'),'DateTime','=');
            $this->_columns->add('status', 'job', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('job.status'),'String','=');

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