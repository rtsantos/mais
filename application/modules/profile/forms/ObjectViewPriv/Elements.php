<?php
    /**
     * Classe de mapeamento dos pontos de entrada da tabela profile_object_view_priv
     */
    class Profile_Form_ObjectViewPriv_Elements extends Profile_Form_ObjectViewPriv_Crud_Elements
    {

        public function getIdPapel(){
            $element = parent::getIdPapel();
            $element->enableAutoComplete('/auth/conta/auto-complete');
            return $element;
        }
    }
?>