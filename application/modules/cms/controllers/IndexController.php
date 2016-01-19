<?php

   class Cms_IndexController extends ZendT_Controller_Action {

       /**
        *
        * @var Cms_Model_Conteudo_Mapper 
        */
       protected $_conteudo;

       public function init() {
           $this->_init();
           $this->_startupAcl();
           $this->_conteudo = new Cms_Model_Conteudo_Mapper();

           $_menu = new Cms_DataView_Menu_MapperView();
           $_menu->load(false);
       }

       public function _getContent($key) {
           $this->_conteudo->newRow()->setChave($key)->retrieve();
           $result = array();
           $result['titulo'] = $this->_conteudo->getTitulo(true)->get();
           $result['corpo'] = $this->_conteudo->getCorpo(true)->get();

           return $result;
       }

       public function indexAction() {
           $debug = $this->getRequest()->getParam('debug');
           $this->view->topApps = Auth_Session_User::getInstance()->getApps(false);
           $this->view->allApps = Auth_Session_User::getInstance()->getApps();
           if ($debug) {
               $this->view->banners = array();
               $this->view->noticias = array();
               $this->view->paraVoce = array();
               $this->view->qualidade = array();
           } else {
               $this->view->banner = $this->_getContent('banner');
               $this->view->noticia = $this->_getContent('noticias');
               $this->view->paraVoce = $this->_getContent('com-voce');
               $this->view->qualidade = $this->_getContent('com-qualidade');
           }
           $this->setLayout(ZendT_Controller_Action::LAYOUT_INTRANET);
       }

   }

?>
