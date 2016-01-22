<?php

    /**
     * 
     *
     * @category    ZendT
     * @author      rsantos
     */
    class ZendT_Form_Element_FileUpload extends ZendT_Form_Element {

        /**
         * Define o helper
         */
        public $helper = "fileUpload";

        public function __construct($spec, $options = null) {
            parent::__construct($spec, $options);
            $this->enableUploadList(true);
        }

        public function setRequired($value = true) {
            if ($value == true) {
                $this->addClass('plUploadValidator');
            }
            return parent::setRequired($value);
        }

        /**
         *
         * @param string $title
         * @param string $extensions
         * @return \ZendT_Form_Element_FileUpload 
         */
        public function addFilterExtensions($title, $extensions = '') {
            if (!$extensions) {
                $extensions = $title;
            }
            $extensions = str_replace(' ', '', $extensions);
            $jQueryParams = $this->getAttrib('jQueryParams');
            $jQueryParams['filters'][] = array(
                'title' => $title,
                'extensions' => $extensions
            );
            $this->setAttrib('jQueryParams', $jQueryParams);
            return $this;
        }

        /**
         *
         * @param bool $value
         * @return \ZendT_Form_Element_FileUpload 
         */
        public function enableMultiple($value = true) {
            $jQueryParams = $this->getAttrib('jQueryParams');
            $jQueryParams['multiple'] = $value;
            $this->setAttrib('jQueryParams', $jQueryParams);
            return $this;
        }

        /**
         *
         * @param int $value
         * @return \ZendT_Form_Element_FileUpload 
         */
        public function setMaxFileSize($value = 100) {
            $jQueryParams = $this->getAttrib('jQueryParams');
            $jQueryParams['max_file_size'] = $value . 'mb';
            $this->setAttrib('jQueryParams', $jQueryParams);
            return $this;
        }

        /**
         *
         * @param bool $value
         * @return \ZendT_Form_Element_FileUpload 
         */
        public function enableUploadList($value = true) {
            $jQueryParams = $this->getAttrib('jQueryParams');
            $jQueryParams['upload-list'] = $value;
            $this->setAttrib('jQueryParams', $jQueryParams);
            return $this;
        }

        public function setOnComplete($value) {
            if(!$value instanceof ZendT_JS_Command){
                $value = new ZendT_JS_Command($value);
            }
                
            $jQueryParams = $this->getAttrib('jQueryParams');
            $jQueryParams['onComplete'] = $value;
            $this->setAttrib('jQueryParams', $jQueryParams);
            return $this;
        }
        
        public function setLoadId($value){
            $jQueryParams = $this->getAttrib('jQueryParams');
            $jQueryParams['load_id'] = $value;
            $this->setAttrib('jQueryParams', $jQueryParams);
            return $this;
        }

    }