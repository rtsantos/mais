<?php
    /**
     * Classe de visão da tabela profile_object_view_priv
     */
    class Profile_DataView_ObjectViewPriv_MapperView extends Profile_DataView_ObjectViewPriv_Crud_MapperView
    {
        protected function _getSettingsDefault() {
            $profile = parent::_getSettingsDefault();
            $profile['width']['nome_profile_object_view'] = '250';
            $profile['width']['nome_papel'] = '350';
            $profile['hidden'][] = 'id';
            return $profile;
        }
    }
?>