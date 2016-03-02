<?php

   class IndexController extends Zend_Controller_Action {

       public function init() {
           $this->view->baseUrl = ZendT_Url::getBaseUrl();
       }

       public function indexAction() {
           $this->_redirect('/index/auth');
       }
       
       public function authAction() {
           Zend_Layout::getMvcInstance()->setLayout('simple');
           $this->view->message = $this->getRequest()->getParam('message');
           $this->view->user = $this->getRequest()->getParam('user');
       }

   }
   