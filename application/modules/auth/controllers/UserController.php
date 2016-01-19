<?php

    class Auth_UserController extends ZendT_Controller_Action {

        /**
         *
         * @var Auth_Model_User_Logon 
         */
        protected $_mapper;

        public function init() {
            $this->_init();
            $this->_mapper = new Auth_Model_User_Logon();
        }

        public function indexAction() {
            $this->view->form = new Auth_Form_User_Authenticate();
            $this->view->form->loadElements();
        }

        public function logoutAction() {
            $this->_mapper->logout();
            $this->_redirect('/');
        }

        public function authenticateAction() {
            $this->_disableRender();
            $this->setLayout(ZendT_Controller_Action::LAYOUT_AJAX);
            $_result = new ZendT_Json_Result();

            $user = $this->getRequest()->getParam('user');
            $pass = $this->getRequest()->getParam('pass');

            try {
                $this->_mapper->authenticate($user, $pass);
                $_result->setResult(array('ok' => '1'));
            } catch (Exception $ex) {
                $_result->setException($ex);
            }

            echo $_result->render();
        }

        public function forgetPasswordAction() {
            $this->_disableRender();
            $this->setLayout(ZendT_Controller_Action::LAYOUT_AJAX);
            $_result = new ZendT_Json_Result();

            $user = $this->getRequest()->getParam('user');

            try {
                $message = $this->_mapper->forgetPassword($user);
                $_result->setResult(array('message' => $message));
            } catch (Exception $ex) {
                $_result->setException($ex);
            }

            echo $_result->render();
        }

        public function changePasswordAction() {
            $this->_disableRender();
            $this->setLayout(ZendT_Controller_Action::LAYOUT_AJAX);
            $_result = new ZendT_Json_Result();

            $user = $this->getRequest()->getParam('user');
            $pass = $this->getRequest()->getParam('pass');
            $newPass = $this->getRequest()->getParam('new_pass');

            try {
                $message = $this->_mapper->changePassword($user, $pass, $newPass);
                $_result->setResult(array('message' => _i18n('Senha alterada com sucesso!')));
            } catch (Exception $ex) {
                $_result->setException($ex);
            }

            echo $_result->render();
        }

    }
    