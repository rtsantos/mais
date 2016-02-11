<?php

   class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

       protected function _initPlaceholders() {
           /**
            * Dentro do Bootstrap inicializo uma instância de View
            * para adicionar headLinks e outros recursos de Views presentes em todas as telas da aplicação
            * Dentro desse processo eu crio uma instância do frontController onde consigo acessar o caminho
            * dinâmico da raiz do meu projeto, para resolver problemas de caminho de arquivos 
            */
           $this->bootstrap('View');
           $this->bootstrap('frontController');

           $view = $this->getResource('View');
           $front = $this->getResource("frontController");

           $front->registerPlugin(new ZendT_Plugin_Charset());

           $doctypeHelper = new Zend_View_Helper_Doctype();
           $doctypeHelper->doctype('XHTML1_STRICT');

           /**
            * 1 -  Adiciono o título genérico 
            * 2 -  Adiciono o core do jQuery e o core do jQuery UI
            *          E os habilito para que sempre sejam incluídos na View
            *          porque como default eles só são incluídos se há algum objeto do ZendT sendo utilizado na tela
            *          fazendo não funcionar outros objetos que usam o framework e o UI mas não estão dentro do ZendT
            */
           $view->doctype()->setDoctype('XHTML1_TRANSITIONAL');
       }

       protected function _initDbRegistry() {
           $this->bootstrap('multidb');
           $multidb = $this->getPluginResource('multidb');
           Zend_Registry::set('db.mais', $multidb->getDb('mais'));
       }

   }
   