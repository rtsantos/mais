<?php

    /**
     * Form Element para Autocomplete do ZendT
     *
     * 
     */
    class ZendT_Form_Element_AutoComplete extends ZendT_Form_Element {

        public $helper = "autocomplete";

        /**
         *
         * @param array $data
         * @return \ZendT_Form_Element_Autocomplete 
         */
        public function setDataSource($data) {
            $this->setJQueryParam('source', $data);
            return $this;
        }
        /**
         * 
         * @param bool $value
         * @return \ZendT_Form_Element_AutoComplete
         */
        public function enableButtonSearch($value = true){
            $this->setJQueryParam('showButtonSearch', $value);
            return $this;
        }
        /**
         *
         * @param string $function
         * @return \ZendT_Form_Element_Autocomplete 
         */
        public function setOnFormatItem($function) {
            $this->setJQueryParam('onFormatItem', new ZendT_JS_Command($function));
            return $this;
        }

        /**
         * Procedimento para formatar a saída que do usuário
         *
         * @param string $function
         * @return \ZendT_Form_Element_Autocomplete 
         */
        public function setOnFormatResult($function) {
            $this->setJQueryParam('onFormatResult', new ZendT_JS_Command($function));
            return $this;
        }

        /**
         * Procedimento que será ligado quando selecionado um resultado
         *
         * @param string $function
         * @return \ZendT_Form_Element_Autocomplete 
         */
        public function setOnResult($function) {
            $this->setJQueryParam('onResult', new ZendT_JS_Command($function));
            return $this;
        }

        /**
         *
         * @param string $function
         * @return \ZendT_Form_Element_Autocomplete 
         */
        public function setOnFormatMatch($function) {
            $this->setJQueryParam('onFormatMatch', new ZendT_JS_Command($function));
            return $this;
        }

        /**
         *
         * @param type $key
         * @param type $command
         * @return \ZendT_Form_Element_Autocomplete 
         */
        public function addExtraParams($key, $command) {
            $extraParams = $this->getJQueryParam('extraParams');
            $extraParams[$key] = new ZendT_JS_Command($command);
            $this->setJQueryParam('extraParams', $extraParams);
            return $this;
        }

    }