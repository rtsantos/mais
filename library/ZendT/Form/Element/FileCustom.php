<?php

    /**
     * 
     *
     * @category    ZendT
     * @author      ksantoja
     */

    /**
     * Form Element para gerenciar arquivos customizado
     *
     * 
     */
    class ZendT_Form_Element_FileCustom extends ZendT_Form_Element {

        /**
         * Define o helper
         */
        public $helper = "fileCustom";

        /**
         *
         * @param type $spec
         * @param type $options 
         */
        public function __construct($spec, $options = null) {
            parent::__construct($spec, $options);
            $this->setAttrib('urlDownload', ZendT_Url::getBaseUrl() . '/file/download');
            $this->setAttrib('urlUpload', ZendT_Url::getBaseUrl() . '/file');
            $this->setAttrib('urlDelete', ZendT_Url::getBaseUrl() . '/file/delete');
        }

    }