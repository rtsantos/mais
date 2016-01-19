<?php
    /**
     * Arquivo de inicialização do módulo Wf
     * 
     * @package Zend
     * @subpackage ZendT
     * @category Wf
     * @copyright Transportadora Americana Ltda
     */
    class Wf_Bootstrap extends Zend_Application_Module_Bootstrap
    {
        protected function _initTranslate(){
            $translate = new Zend_Translate(
                    'array',
                    APPLICATION_PATH . '/modules/wf/languages/pt_BR.php',
                    'pt_BR'
            );

            Zend_Registry::set('translate_wf', $translate);
        }
    }
?>