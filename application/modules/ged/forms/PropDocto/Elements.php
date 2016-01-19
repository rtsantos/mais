<?php

/**
 * Classe de mapeamento dos pontos de entrada da tabela img_prop_docto
 */
class Ged_Form_PropDocto_Elements extends Ged_Form_PropDocto_Crud_Elements {

    public function getIdAplicacao() {
        $element = parent::getIdAplicacao();
        $element->enableAutoComplete();
        return $element;
    }

}

?>