<?php
    /**
     * Arquivo de inicialização do módulo Vendas
     * 
     * @package Zend
     * @subpackage ZendT
     * @category Vendas
     * @copyright Transportadora Americana Ltda
     */
    class Vendas_Bootstrap extends Zend_Application_Module_Bootstrap{
        /**
         * Inicializa a configuração de tradução ao módulo
         */
        protected function _initTranslate(){
            $translate = new Zend_Translate(
                    'array',
                    APPLICATION_PATH . '/modules/vendas/languages/pt_BR.php',
                    'pt_BR'
            );

            Zend_Registry::set('translate_vendas', $translate);
        }
    
        protected function _initResourceLoader() 
        { 
            $this->_resourceLoader->addResourceType( 'report', 'reports', 'Report' ); 
            $this->_resourceLoader->addResourceType( 'context', 'contexts', 'Context' ); 
            $this->_resourceLoader->addResourceType( 'dataview', 'data-views', 'DataView' ); 
        }    
    }
?>