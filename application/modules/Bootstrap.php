<?php
    /**
     * Arquivo de inicialização do módulo 
     * 
     * @package Zend
     * @subpackage ZendT
     * @category 
     * @copyright Transportadora Americana Ltda
     */
    class _Bootstrap extends Zend_Application_Module_Bootstrap{
        /**
         * Inicializa a configuração de tradução ao módulo
         */
        protected function _initTranslate(){
            $translate = new Zend_Translate(
                    'array',
                    APPLICATION_PATH . '/modules/languages/pt_BR.php',
                    'pt_BR'
            );

            Zend_Registry::set('translate_', $translate);
        }
    }
?>