<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela profile_job_dest
 */
class Profile_Form_JobDest_Elements extends Profile_Form_JobDest_Crud_Elements
{
    public function getIdPapel() {
        /* @var ZendT_Form_Element_Seeker */
        $element = parent::getIdPapel();
        $element->enableAutoComplete('/auth/conta/auto-complete');
        return $element;
    }
}
?>