<?php

    class Auth_Model_User_Logon extends Auth_Model_Conta_Mapper {

        /**
         * Faz autenticação de usuário no sistema
         * 
         * @param string $user
         * @param string $pass
         * @return boolean
         * @throws ZendT_Exception_Alert
         */
        public function authenticate($user, $pass) {
            $this->newRow()->setNome($user)->retrieve();

            if (!$this->getId(true)->toPhp()) {
                throw new ZendT_Exception_Alert(_i18n('Usuário "%user" não encontrado!', $user));
            }

            if ($this->getSenha(true)->toPhp() != $pass) {
                throw new ZendT_Exception_Alert(_i18n('Senha do usuário "%user" não confere!', $user));
            }

            Auth_Session_User::refresh($this->getNome()->get());

            return true;
        }

        public function logout() {
            Auth_Session_User::refresh('GUEST');

            return true;
        }

        public function changePassword($user, $pass, $newPass) {
            $this->newRow()->setNome($user)->retrieve();

            if (!$this->getId(true)->toPhp()) {
                throw new ZendT_Exception_Alert(_i18n('Usuário "%user" não encontrado!', $user));
            }

            if ($this->getSenha(true)->toPhp() != $pass) {
                throw new ZendT_Exception_Alert(_i18n('Senha do usuário "%user" não confere!', $user));
            }

            $this->setSenha($newPass)->update();

            return true;
        }

        public function forgetPassword($user) {
            $this->newRow()->setNome($user)->retrieve();

            if (!$this->getId(true)->toPhp()) {
                throw new ZendT_Exception_Alert(_i18n('Usuário "%user" não encontrado!', $user));
            }

            if ($this->getEmail(true)->toPhp()) {
                throw new ZendT_Exception_Alert(_i18n('Não existe um e-mail configurado para o usuário "%user", entre em contato com o Administrador!', $user));
            }

            $_mail = new ZendT_Mail();
            $_mail->addTo($this->getEmail(true)->get(), $this->getDescricao(true)->get());
            $_mail->setSubject(_i18n('Recuperação de Senha'));
            $_mail->setBody(_i18n('Usuário: "%user"<br />Senha: "%pass"', $this->getNome()->get(), $this->getSenha()->get()));
            $_mail->send();

            return _i18n('Senha enviada para o e-mail "%email"!', $this->getEmail(true)->get());
        }

    }
    