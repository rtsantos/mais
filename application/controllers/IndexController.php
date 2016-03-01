<?php

   class IndexController extends Zend_Controller_Action {

       public function init() {
           $this->view->baseUrl = ZendT_Url::getBaseUrl();
       }

       public function indexAction() {
           Zend_Layout::getMvcInstance()->setLayout('simple');
       }

   }
   