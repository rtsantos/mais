<?php

    class ZendT_Form_Element_Seeker_Url {

        /**
         *
         * @var string 
         */
        private $_grid;

        /**
         *
         * @var string 
         */
        private $_search;

        /**
         *
         * @var string 
         */
        private $_retrieve;

        /**
         *
         * @var string 
         */
        private $_local;

        /**
         *
         * @var string 
         */
        private $_where;

        /**
         *
         * @var string 
         */
        private $_autoComplete;

        /**
         *
         * @param type $local 
         */
        public function __construct($local = false) {
            if (!$local) {
                $local = ZendT_Url::getBaseUrl();
            }
            $this->_local = $local;
            $this->_where = null;
        }

        /**
         *
         * @param type $local
         * @return type 
         */
        private function urlLocal($local) {
            if (!$local) {
                $local = $this->_local;
            } else {
                $local = '';
            }
            return $local;
        }

        /**
         *
         * @param type $value
         * @param type $local
         * @return \ZendT_Form_Element_Seeker_Url 
         */
        public function setGrid($value, $local = false) {
            $this->_grid = $this->urlLocal($local) . $value;
            return $this;
        }

        /**
         *
         * @param type $value
         * @param type $local
         * @return \ZendT_Form_Element_Seeker_Url 
         */
        public function setSearch($value, $local = false) {
            $this->_search = $this->urlLocal($local) . $value;
            return $this;
        }

        /**
         *
         * @param type $value
         * @param type $local
         * @return \ZendT_Form_Element_Seeker_Url 
         * @deprecated since version 1.1
         */
        public function setRetrive($value, $local = false) {
            return $this->setRetrieve($value, $local);
        }        
        /**
         *
         * @param type $value
         * @param type $local
         * @return \ZendT_Form_Element_Seeker_Url 
         */
        public function setRetrieve($value, $local = false) {
            $this->_retrieve = $this->urlLocal($local) . $value;
            return $this;
        }

        /**
         *
         * @param type $value
         * @param type $local
         * @return \ZendT_Form_Element_Seeker_Url 
         */
        public function setAutoComplete($value, $local = false) {
            $this->_autoComplete = $this->urlLocal($local) . $value;
            return $this;
        }

        /**
         * Retorna o filtro json, codificado em URL
         * 
         * @return string 
         */
        private function _getFilter() {
            $urlJson = '';
            if ($this->_where instanceof ZendT_Db_Where) {
                $urlJson = 'filter_json=' . urlencode($this->_where->toJson());
            }
            return $urlJson;
        }

        /**
         * Retorna a url do Grid
         * 
         * @return string 
         */
        public function getGrid() {
            $paramSep = (strpos($this->_grid, '?') === false) ? '?' : '&';
            return $this->_grid . $paramSep . $this->_getFilter();
        }

        /**
         * Retorna a URl de Busca dos dados Digitados ao Input
         * 
         * @return string
         */
        public function getSearch() {
            $paramSep = (strpos($this->_search, '?') === false) ? '?' : '&';
            return $this->_search . $paramSep . $this->_getFilter();
        }

        /**
         * Retorna a URL que popula os dados na Seeker
         * 
         * @return string
         * @deprecated since version 1.1
         */
        public function getRetrive() {
            return $this->_retrieve;
        }
        /**
         * 
         * @return string
         */
        public function getRetrieve(){
            return $this->_retrieve;
        }
        /**
         * Retorna a URL que pega os dados para auto-completar
         * 
         * @return boolean|string
         */
        public function getAutoComplete() {
            if ($this->_autoComplete) {
                $paramSep = (strpos($this->_autoComplete, '?') === false) ? '?' : '&';
                return $this->_autoComplete . $paramSep . $this->_getFilter();
            }
            return false;
        }

        /**
         * Habilita o auto-completar com base na URL base do Grid,
         * desta maneira não precisa informar o parâmetro setAutoComplete 
         * 
         * @return \ZendT_Form_Element_Seeker_Url 
         */
        public function enableAutoComplete() {
            if (!$this->_autoComplete) {
                $url = $this->_grid;
                $pos = strpos($url, '?');
                if ($pos !== false) {
                    $url = substr($url, 1, $pos);
                }
                $url = str_replace('/grid', '/auto-complete', $url);
                $this->setAutoComplete($url, true);
            }
            return $this;
        }

        /**
         *
         * @return \ZendT_Form_Element_Seeker_Url 
         */
        public function enableMultiple() {
            if (strpos($this->_grid, '/multiple') === false) {
                $this->_grid = str_replace('/grid', '/grid/multiple/1', $this->_grid);
            }
            return $this;
        }

        /**
         * Adiciona um Where para restringir o acesso aos dados
         * 
         * @param ZendT_Db_Where $where
         * @return \ZendT_Form_Element_Seeker_Url 
         */
        public function setWhere(ZendT_Db_Where $where = null) {
            $this->_where = $where;
            return $this;
        }

        /**
         *
         * @return array 
         */
        public function toArray() {
            $aRetorno = array();
            if ($this->_grid) {
                $aRetorno['grid'] = $this->getGrid();
            }
            if ($this->_search) {
                $aRetorno['search'] = $this->getSearch();
            }
            if ($this->_retrieve) {
                $aRetorno['retrieve'] = $this->getRetrieve();
            }
            if ($this->_autoComplete) {
                $aRetorno['autoComplete'] = $this->getAutoComplete();
            }
            return $aRetorno;
        }

    }