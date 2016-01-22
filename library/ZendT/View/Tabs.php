<?php

    /**
     * Cria um objeto do tipo Tab (Orelha)
     * 
     * @package ZendT
     * @subpackage Tabs
     * @category View
     *  
     */
    class ZendT_View_Tabs extends ZendT_View_Html {

        protected $_onSelect;
        protected $_error;
        protected $_tabs;
        protected $_indexTabs = 0;
        protected $_options;
        protected $_disabledAll = true;
        protected $_loadMsg;

        /**
         * Construtor da classe
         * 
         * @param string $id
         * @param array $options 
         */
        public function __construct($id, $options = array()) {
            $this->_options = $options;
            $this->setId($id);
        }

        /**
         * Adiciona uma aba nova
         * 
         * @param string $label
         * @param string $url
         * @return \ZendT_View_Tabs 
         */
        public function addTab($label, $content) {
            $this->_tabs[$this->_indexTabs]['label'] = $label;
            $this->_tabs[$this->_indexTabs]['content'] = $content;
            $this->_tabs[$this->_indexTabs]['url'] = '';
            $this->_tabs[$this->_indexTabs]['field'] = '';
            $this->_tabs[$this->_indexTabs]['param'] = '';
            $this->_tabs[$this->_indexTabs]['value'] = '';
            $this->_tabs[$this->_indexTabs]['operation'] = '';
            $this->_tabs[$this->_indexTabs]['mapper'] = '';
            $this->_indexTabs++;
            return $this;
        }

        public function addTabUrl($label, $url) {
            $this->_tabs[$this->_indexTabs]['label'] = $label;
            $this->_tabs[$this->_indexTabs]['content'] = '';
            $this->_tabs[$this->_indexTabs]['url'] = $url;
            $this->_tabs[$this->_indexTabs]['param'] = '';
            $this->_tabs[$this->_indexTabs]['field'] = '';
            $this->_tabs[$this->_indexTabs]['value'] = '';
            $this->_tabs[$this->_indexTabs]['operation'] = '';
            $this->_tabs[$this->_indexTabs]['mapper'] = '';
            $this->_indexTabs++;
            return $this;
        }

        public function addTabWhere($label, $url, $field, $value, $operation = '', $mapper = '') {
            $this->_tabs[$this->_indexTabs]['label'] = $label;
            $this->_tabs[$this->_indexTabs]['url'] = $url;
            $this->_tabs[$this->_indexTabs]['param'] = '';
            $this->_tabs[$this->_indexTabs]['field'] = $field;
            $this->_tabs[$this->_indexTabs]['value'] = $value;
            $this->_tabs[$this->_indexTabs]['operation'] = $operation;
            $this->_tabs[$this->_indexTabs]['mapper'] = $mapper;
            $this->_indexTabs++;
            return $this;
        }

        public function addTabWhereGrid($label, $url, $field, $idGrid, $operation = '', $mapper = '') {
            $value = new ZendT_JS_Command("function(){ return jQuery('#" . $idGrid . "').jqGrid('getGridParam','selrow'); }");
            //$value = new ZendT_JS_Command("getIdGrid('".$idGrid."')");
            $this->addTabWhere($label, $url, $field, $value, $operation, $mapper);
            return $this;
        }

        public function addTabParam($label, $url, $param, $value, $operation = '') {
            $this->_tabs[$this->_indexTabs]['label'] = $label;
            $this->_tabs[$this->_indexTabs]['url'] = $url;
            $this->_tabs[$this->_indexTabs]['field'] = '';
            $this->_tabs[$this->_indexTabs]['param'] = $param;
            $this->_tabs[$this->_indexTabs]['value'] = $value;
            $this->_tabs[$this->_indexTabs]['operation'] = $operation;
            $this->_tabs[$this->_indexTabs]['mapper'] = '';
            $this->_indexTabs++;
            return $this;
        }

        public function addTabParamIframe($label, $url, $param, $value, $operation = '') {
            $this->_tabs[$this->_indexTabs]['label'] = $label;
            $this->_tabs[$this->_indexTabs]['url'] = $url;
            $this->_tabs[$this->_indexTabs]['field'] = '';
            $this->_tabs[$this->_indexTabs]['param'] = $param;
            $this->_tabs[$this->_indexTabs]['value'] = $value;
            $this->_tabs[$this->_indexTabs]['operation'] = $operation;
            $this->_tabs[$this->_indexTabs]['mapper'] = '';
            $this->_tabs[$this->_indexTabs]['iframe'] = true;
            $this->_tabs[$this->_indexTabs]['content'] = "<iframe frameborder='0' id='" . $this->getId() . "_" . $this->_indexTabs . "' src='about:blank' width='100%' height='500'></iframe>";
            $this->_indexTabs++;
            return $this;
        }

        public function addTabParamGrid($label, $url, $param, $idGrid, $multi = false) {
            if (!$multi) {
                $value = new ZendT_JS_Command("function(){ return jQuery('#" . $idGrid . "').jqGrid('getGridParam','selrow'); }");
            } else {
                $value = new ZendT_JS_Command("function(){ return jQuery('#" . $idGrid . "').jqGrid('getGridParam','selarrrow'); }");
                $operation = 'in';
            }
            $this->addTabParam($label, $url, $param, $value, $operation);
            return $this;
        }

        /**
         * Habilita ou desabilita as tabs
         * 
         * @param type $value 
         * @return \ZendT_View_Tabs
         */
        public function disableAll($value) {
            $this->_disabledAll = $value;
            return $this;
        }

        /**
         * Adiciona uma opção para as tabs
         * 
         * @param string $option
         * @param string|numeric $value
         * @return \ZendT_View_Tabs 
         */
        public function addOption($option, $value) {
            $this->_options[$option] = $value;
            return $this;
        }

        /**
         * Define uma mensagem de erro
         * 
         * @param string $msg
         * @return \ZendT_View_Tabs 
         */
        public function setOnError($value) {
            $this->_error = $value;
            return $this;
        }

        /**
         * 
         * @param string|ZendT_JS_Command $value
         * @return \ZendT_View_Tabs
         */
        public function setOnSelect($value) {
            $this->_onSelect = $value;
            return $this;
        }

        /**
         * Define mensagem de carregamento
         * 
         * @param string $value
         * @return \ZendT_View_Tabs 
         */
        public function setLoadMsg($value = '') {
            $this->_loadMsg = $value;
            return $this;
        }

        /**
         * Retorna mensagem de carregamento
         * 
         * @return type 
         */
        public function getLoadMsg() {
            if (!$this->_loadMsg) {
                $this->_loadMsg = 'Aguarde...';
            }
            return $this->_loadMsg;
        }

        /**
         * Cria o script JS para a execução dos tabs
         * 
         * @return string 
         */
        public function createJS() {

            //$this->addHeadScriptFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TTabs.js');

            if ($this->_disabledAll) {
                if (count($this->_tabs) > 2) {
                    for ($i = 2; $i < count($this->_tabs); $i++) {
                        $this->_options['disabled'][] = $i;
                    }
                } else {
                    unset($this->_options['disabled']);
                }
            }


            $options = array();
            if (count($this->_options) > 0) {
                $options = $this->_options;
            }
            if (count($this->_tabs) > 0) {
                $options = array_merge($options, $this->_tabs);
            }
            
            

            $onSelect = $this->_onSelect;
            if ($onSelect instanceof ZendT_JS_Command) {
                $onSelect = 'var onSelect = ' . $onSelect->render() . '; onSelect(event, ui);';
            } else if ($onSelect) {
                $onSelect = new ZendT_JS_Command("function(event, ui){ return $onSelect(event, ui); }");
            }
            
            $options['onSelect'] = $onSelect;

            $js = "jQuery('#" . $this->getId() . "').TTabs(";
            $js.= ZendT_JS_Json::encode($options);
            $js.= ");\n";

            /**
             * 
             */
            $jsTabs = array();
            foreach ($this->_tabs as $index => $tabs) {
                if ($tabs['field'] != '' || $tabs['param'] != '') {
                    $jsTabs[$index]['url'] = $tabs['url'];
                    $jsTabs[$index]['field'] = $tabs['field'];
                    $jsTabs[$index]['param'] = $tabs['param'];
                    $jsTabs[$index]['value'] = $tabs['value'];
                    $jsTabs[$index]['mapper'] = $tabs['mapper'];
                    $jsTabs[$index]['operation'] = $tabs['operation'];
                } else if ($tabs['url'] instanceof ZendT_JS_Command) {
                    $jsTabs[$index]['url'] = $tabs['url'];
                    $jsTabs[$index]['field'] = '';
                    $jsTabs[$index]['param'] = '';
                } else {
                    $jsTabs[$index]['field'] = '';
                    $jsTabs[$index]['param'] = '';
                }
                $jsTabs[$index]['iframe'] = $tabs['iframe'];
            }
            /**
             * 
             */
            /* if (count($jsTabs) > 0) {
              $js.= "$('#" . $this->getId() . "').bind('tabsselect', function(event, ui) {
              ".$onSelect."
              var tabsParam = {};
              tabsParam = " . ZendT_JS_Json::encode($jsTabs) . ";
              if (tabsParam[ui.index].field){
              var where = new TWhere('AND')
              where.addFilter({
              field: tabsParam[ui.index].field,
              value: tabsParam[ui.index].value,
              operation: tabsParam[ui.index].operation,
              mapper: tabsParam[ui.index].mapper
              });
              if (tabsParam[ui.index].iframe){
              var urlGrid = tabsParam[ui.index].url  + '?typeModal=IFRAME&filter_json=' + encodeURIComponent(where.toJson());
              var objWindow = document.getElementById('" . $this->getId() . "_' + ui.index).contentWindow;
              objWindow.document.body.innerHTML = '';
              objWindow.document.write('Carregando...');
              document.getElementById('" . $this->getId() . "_' + ui.index).src = urlGrid;
              }else{
              var urlGrid = tabsParam[ui.index].url  + '?typeModal=AJAX&filter_json=' + encodeURIComponent(where.toJson());
              $(ui.panel).html('" . $this->getLoadMsg() . "');
              $('#" . $this->getId() . "').TTabs('changeUrl', urlGrid,ui.index);
              }
              }else if (tabsParam[ui.index].param){
              var valueParam = '';
              if (typeof tabsParam[ui.index].value == 'function'){
              valueParam = tabsParam[ui.index].value();
              }else{
              valueParam = tabsParam[ui.index].value;
              }

              //$('#" . $this->getId() . "').TTabs('changeUrl', urlGrid,ui.index);
              if (tabsParam[ui.index].iframe){
              var urlGrid = tabsParam[ui.index].url  + '?typeModal=IFRAME&' + tabsParam[ui.index].param + '=' + encodeURIComponent(valueParam);
              var objWindow = document.getElementById('" . $this->getId() . "_' + ui.index).contentWindow;
              objWindow.document.body.innerHTML = '';
              objWindow.document.write('Carregando...');
              document.getElementById('" . $this->getId() . "_' + ui.index).src = urlGrid;
              }else{
              var urlGrid = tabsParam[ui.index].url  + '?typeModal=AJAX&' + tabsParam[ui.index].param + '=' + encodeURIComponent(valueParam);
              $(ui.panel).html('" . $this->getLoadMsg() . "');
              $('#" . $this->getId() . "').TTabs('changeUrl', urlGrid,ui.index);
              }
              }else if (typeof tabsParam[ui.index].url == 'function'){
              var urlGrid = tabsParam[ui.index].url();
              //$('#" . $this->getId() . "').TTabs('changeUrl', urlGrid,ui.index);
              if (tabsParam[ui.index].iframe){
              var objWindow = document.getElementById('" . $this->getId() . "_' + ui.index).contentWindow;
              objWindow.document.body.innerHTML = '';
              objWindow.document.write('Carregando...');
              document.getElementById('" . $this->getId() . "_' + ui.index).src = urlGrid;
              }else{
              $(ui.panel).html('" . $this->getLoadMsg() . "');
              $('#" . $this->getId() . "').TTabs('changeUrl', urlGrid,ui.index);
              }
              }
              });";
              } */
            /*
              if ($onSelect){
              $js.= "$('#" . $this->getId() . "').bind('tabsload', function(event, ui) {
              ".$onSelect."
              });";
              }
             */
            return $js;
        }

        /**
         * Cria o HTMl para as tabs
         * 
         * @return string 
         */
        public function createHtml() {
            $divTab = '';

            $tabs = '';
            $divs = '';
            $active = 'active';
            foreach ($this->_tabs as $key => $value) {
                $id = $this->getId() . '-' . $key;
                $tabs.= '<li id="tab-' . $id . '" role="div-' . $id . '" class="' . $active . '">' . $value['label'] . '</li>';

                $divs.= '<div id="div-' . $id . '" class="ui-helper-clearfix ui-tabs-item ' . $active . '">';
                $divs.= $value['content'];
                $divs.= '</div>';
                $active = '';
            }

            $html = '<div id="' . $this->getId() . '" class="ui-tabs">'
                    . '  <ul class="ui-tabs-header ui-helper-clearfix ui-tabs-nav ui-helper-reset">'
                    . $tabs
                    . '  </ul>'
                    . $divs
                    . '</div> ';

            /* $html = "<div id='" . $this->getId() . "'>
              <ul>\n";
              foreach ($this->_tabs as $key => $value) {
              $id = 'tabs-' . $this->getId() . '-' . $key;
              if ($value['url'] != '' && !$value['iframe']) {
              $url = $value['url'];
              } else {
              $url = '#' . $id;
              $divTab.= "<div id='" . $id . "'>" . $value['content'] . "</div>\n";
              }
              $html.= "<li><a href='" . $url . "'>" . $value['label'] . "</a></li>\n";
              }
              $html.= "   </ul>
              " . $divTab . "
              </div>\n"; */
            return $html;
        }

        /**
         * Rendeniza
         * 
         * @return string 
         */
        public function render() {
            $this->addOnLoad($this->getId(), $this->createJS());
            return $this->createHtml();
        }

    }

?>