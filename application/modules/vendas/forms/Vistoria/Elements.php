<?php

    /**
     * Classe de mapeamento dos pontos de entrada da tabela cv_vistoria
     */
    class Vendas_Form_Vistoria_Elements extends Vendas_Form_Vistoria_Crud_Elements {

        public function getLaudo() {
            $element = new ZendT_Form_Element_FileUpload('laudo');
            $element->setLabel($this->_translate->_('vistoria.laudo') . ':');
            $element->enableMultiple(false);
            $element->setLoadId(true);
            return $element;
        }

    }

?>