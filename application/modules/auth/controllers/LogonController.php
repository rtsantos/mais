<?php

    class Auth_LogonController extends ZendT_Controller_Action {

        public function init() {
            $this->_init();
        }

        public function soapAction() {
            $this->getResponse()->setHeader('Content-Type', 'text/xml;charset=utf-8', true);
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
            $version = $this->getRequest()->getParam('version');
            $wsdl = $this->getRequest()->getParam('wsdl');

            $service = 'Auth_Service_Ldap';

            if ($wsdl) {
                $autodiscover = new Zend_Soap_AutoDiscover('Zend_Soap_Wsdl_Strategy_ArrayOfTypeComplex');
                $autodiscover->setUri(ZendT_Url::getUri());
                $autodiscover->setClass($service);
                $autodiscover->handle();
            } else {
                if (!$version) {
                    $version = '1_0';
                }
                $fileWsdl = APPLICATION_PATH . '/modules/auth/services/Ldap/version_' . $version . '.wsdl';
                if (file_exists($fileWsdl)) {
                    $wsdl = str_replace("\\", "/", $fileWsdl);
                } else {
                    $wsdl = ZendT_Url::getUri() . '?wsdl=1';
                }
                $server = new Zend_Soap_Server();
                $server->setWsdl($wsdl);
                $server->setClass($service);
                $server->handle();
            }
        }

        /**
         *  Action que realiza a Autenticação do Usuário.
         */
        public function authenticateAction() {
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
            $user = $this->getRequest()->getParam('usuario');
            $pass = trim($this->getRequest()->getParam('senha'));
            $field = $this->getRequest()->getParam('nome_campo_pessoal');
            $value = trim($this->getRequest()->getParam('valor_campo_pessoal'));

            $_mapper = new Auth_Model_Usuario_Mapper();
            $jsonResult = $_mapper->authenticateUser($user, $pass, $field, $value);

            echo $jsonResult;
        }

        /**
         *  Action que altera a Senha do Usuário
         */
        public function changePswAction() {
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
            $user = $this->getRequest()->getParam('usuario');
            $pass = $this->getRequest()->getParam('senha');
            $nPsw = $this->getRequest()->getParam('nova_senha');
            $cPsw = $this->getRequest()->getParam('senha_confirma');

            $_mapper = new Auth_Model_Usuario_Mapper();
            echo $_mapper->changePsw($user, $pass, $nPsw, $cPsw);
        }

        /**
         *  Action que irá confirmar as informações adicionais do primeiro login do usuário.
         */
        public function updateInfAdicAction(){
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
            $params = $this->getRequest()->getParams();
            $_mapper = new Auth_Model_Usuario_Mapper();
            echo  $_mapper->changeSolicInf($params['usuario'],'S');
            
        }   
    }

?>
