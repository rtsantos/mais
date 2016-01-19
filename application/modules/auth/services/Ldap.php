<?php

    class Auth_Service_Ldap {

        /**
         * 
         * @param string $token
         * @param string $user
         * @param string $pass
         * @return \Auth_Service_Ldap_ResultAuth
         */
        public function authenticate($token, $user, $pass) {
            $_result = new Auth_Service_Ldap_ResultAuth();
            $_result->service = __METHOD__;
            try {
                $bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
                $config = $bootstrap->getOptions();
                $config = $config['auth']['ldap'];

                $adapter = new Zend_Auth_Adapter_Ldap($config, $user, $pass);
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($adapter);
                $_result->id = ($result->isValid() ? 1 : 0);
                $_result->success = 1;

                $messages = $result->getMessages();
                //Adicionado essa tratativa pois estava retornando msg's em branco e no implode ficaca ",,,"
                for ($i = 0; $i < count($messages); $i++) {

                    if ($messages[$i] === "") {
                        unset($messages[$i]);
                    }
                }

                $message = implode(',', $messages);
                if (!$_result->id) {
                    throw new ZendT_Exception_Alert("Usuário ou Senha inválida! Verifique se a Senha é a mesma utilizada na Rede.", $result->getCode());
                } else {
                    $ldap = new ZendT_Acl_Ldap();
                    $_rsUserProperties = $ldap->getUser($user);
                    $_result->name = $_rsUserProperties->name;
                    $_result->accountExpires = $_rsUserProperties->accountExpires;
                    $_result->badPwdCount = $_rsUserProperties->badPwdCount;
                    $_result->enable = $_rsUserProperties->enable;
                    $_result->lastLogon = $_rsUserProperties->lastLogon;
                    $_result->userName = $_rsUserProperties->username;
                }
            } catch (ZendT_Exception $ex) {
                $_result->success = 0;
                $_result->message->code = $ex->getCode();
                $_result->message->message = $ex->getMessage();
                $_result->message->notification = $ex->getNotification();
            }

            return $_result;
        }

        //@todo: Patrick-> Implementar quando o AD oferecer suporte.
        public function changePass($token, $user, $pass, $newPass) {
            
        }

    }
    