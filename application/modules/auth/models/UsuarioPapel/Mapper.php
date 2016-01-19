<?php

    /**
     * Classe de mapeamento do registro da tabela usuario_papel
     */
    class Auth_Model_UsuarioPapel_Mapper extends Auth_Model_UsuarioPapel_Crud_Mapper {

        protected function _beforeSave() {
            parent::_beforeSave();

            if ($this->_action != 'delete') {
                $_usuario = new Auth_DataView_Usuario_MapperView();
                $_usuario->setId($this->getIdUsuario());
                $_usuario->retrieve();

                if (!$_usuario->getIdPapel(true)->toPhp()) {
                    throw new ZendT_Exception_Alert('O usuário selecionado não possui um papel principal!');
                }

                $_papelUsuario = new Auth_DataView_Papel_MapperView();
                $_papelUsuario->setId($_usuario->getIdPapel());
                $_papelUsuario->retrive();

                $_papel = new Auth_DataView_Papel_MapperView();
                $_papel->setId($this->getIdPapel());
                $_papel->retrive();

                $rootElement = explode('.', $_papelUsuario->getNome());
                unset($rootElement[sizeof($rootElement) - 1]);
                $rootElement = implode(".", $rootElement);

                if (strpos($_papel->getNome(), $rootElement) !== 0) {
                    throw new ZendT_Exception_Alert('Papel Inválido!' .
                    ' O Papel adicional deve pertencer a mesma hierarquia do papel principal! !');
                }
            }
        }

    }

?>