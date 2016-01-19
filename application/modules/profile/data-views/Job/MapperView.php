<?php
    /**
     * Classe de visão da tabela profile_job
     */
    class Profile_DataView_Job_MapperView extends Profile_DataView_Job_Crud_MapperView
    {
        protected function _getSettingsDefault() {
            $profile = parent::_getSettingsDefault();
            $profile['width']['nome_profile_object_view'] = '300';
            $profile['width']['descricao'] = '350';
            $profile['order'] = array('id','id_profile_object_view','nome_profile_object_view','descricao','dh_ini_exec','dh_ult_exec','frequencia','dt_fim_exec','tipo');
            $profile['hidden'] = array('id', 'id_profile_object_view');
            return $profile;
        }
    }
?>