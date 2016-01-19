<?php
    /**
     * Arquivo de inicialização do módulo Monitor
     * 
     * @package Zend
     * @subpackage ZendT
     * @category Monitor
     * @copyright Transportadora Americana Ltda
     */
    class Monitor_Bootstrap extends Zend_Application_Module_Bootstrap{
        /**
         * Inicializa a configuração de tradução ao módulo
         */
        protected function _initTranslate(){
            $translate = new Zend_Translate(
                    'array',
                    APPLICATION_PATH . '/modules/monitor/languages/pt_BR.php',
                    'pt_BR'
            );

            Zend_Registry::set('translate_monitor', $translate);
        }
    
        protected function _initResourceLoader() 
        { 
            $this->_resourceLoader->addResourceType( 'report', 'reports', 'Report' ); 
            $this->_resourceLoader->addResourceType( 'context', 'contexts', 'Context' ); 
            $this->_resourceLoader->addResourceType( 'dataview', 'data-views', 'DataView' ); 
        }    
    }
?>