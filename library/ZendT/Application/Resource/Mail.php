<?php

    /**
     * @see Zend_Application_Resource_ResourceAbstract
     */
    require_once 'Zend/Application/Resource/ResourceAbstract.php';

    /**
     * Resource for setting up Acl and default adapter
     *
     * @uses       Zend_Application_Resource_ResourceAbstract
     * @category   ZendT
     * @package    ZendT_Application
     * @subpackage Resource
     */
    class ZendT_Application_Resource_Mail extends Zend_Application_Resource_ResourceAbstract {

        /**
         * @var array
         */
        public static $defaultOptions = null;

        /**
         * Inicializa a classe
         * @return type 
         */
        public function init() {
            if (null === self::$defaultOptions) {
                self::$defaultOptions = $this->getOptions();
            }
        }

    }
    