<?php

    /**
     * Arquivo de inicialização do módulo Tools
     * 
     * @package Zend
     * @subpackage ZendT
     * @category Tools
     * @copyright Transportadora Americana Ltda
     */
    class Tools_Bootstrap extends Zend_Application_Module_Bootstrap {

        /**
         * Inicializa a configuração de tradução ao módulo
         */
        protected function _initTranslate() {
            $translate = new Zend_Translate(
                    'array', APPLICATION_PATH . '/modules/tools/languages/pt_BR.php', 'pt_BR'
            );

            Zend_Registry::set('translate_tools', $translate);
        }

        protected function _initResourceLoader() {
            $this->_resourceLoader->addResourceType('dataview', 'data-views', 'DataView');
            $this->_resourceLoader->addResourceType('interface', 'interfaces', 'Interface');
        }

    }

?>