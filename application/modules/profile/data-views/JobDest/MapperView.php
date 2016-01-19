<?php
    /**
     * Classe de visão da tabela profile_job_dest
     */
    class Profile_DataView_JobDest_MapperView extends Profile_DataView_JobDest_Crud_MapperView
    {
        protected function _getSettingsDefault() {
            $profile = parent::_getSettingsDefault();
            $profile['width']['descricao_profile_job'] = '350';
            $profile['width']['nome_papel'] = '350';
            $profile['hidden'][] = 'id';
            return $profile;
        }
    }
?>