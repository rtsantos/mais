<?php

    /**
     * Classe de mapeamento dos pontos de entrada da tabela usuario
     */
    class Auth_Form_Usuario_Elements extends Auth_Form_Usuario_Crud_Elements {

        public function getAvatar() {
            $element = new ZendT_Form_Element_FileUpload('avatar');
            $element->setLabel($this->_translate->_('usuario.avatar') . ':');
            $element->enableMultiple(false);
            $element->setLoadId(true);
            return $element;
        }

    }

?>