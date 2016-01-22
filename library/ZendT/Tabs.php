<?php

/*
 * @category    ZendT
 * @author      ksantoja
 * 
 */

class ZendT_Tabs implements ZendT_JS_Interface {

    private $_error;
    private $_tabs;
    private $_indexTabs = 0;
    private $_options;
    private $_id;
    private $_disabledAll = true;
    private $_idGrid = array();
    private $_loadMsg;

    /**
     * Construtor da classe
     * 
     * @param string $id
     * @param array $options 
     */
    public function __construct($id, $options = array()) {        
        $this->_options = $options;
        $this->_id = $id;
    }

    /**
     * Define um Grid para uma aba
     * 
     * @param numeric|string $index
     * @param string $value
     * @return \ZendT_Tabs 
     */
    public function setGridId($index, $url) {
        $this->_idGrid[$index] = $url;
        return $this;
    }

    /**
     * Define Grids para tabs atraves de um array
     * 
     * @param array $values
     * @return \ZendT_Tabs 
     */
    public function setGridIds($values) {
        foreach ($values as $index => $url) {
            $this->setGridId($index, $url);
        }
        return $this;
    }

    /**
     * Adiciona uma aba nova
     * 
     * @param string $label
     * @param string $url
     * @return \ZendT_Tabs 
     */
    public function addTab($label, $url, $type = 'ajax', $content = false) {
        $this->_tabs[$this->_indexTabs]['label'] = $label;
        $this->_tabs[$this->_indexTabs]['url'] = $url;
        $this->_tabs[$this->_indexTabs]['type'] = $type;
        $this->_tabs[$this->_indexTabs]['content'] = $content;
        $this->_indexTabs++;
        return $this;
    }

    /**
     * Adiciona um array de tabs
     * 
     * @param array $arrayTabs
     * @return \ZendT_Tabs 
     */
    public function addTabs(array $arrayTabs) {
        foreach ($arrayTabs as $values) {
            $this->addTab($values['label'], $values['url'], $values['type'], $values['content']);
        }
        return $this;
    }

    /**
     * Habilita ou desabilita as tabs
     * 
     * @param type $value 
     * @return \ZendT_Tabs
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
     * @return \ZendT_Tabs 
     */
    public function addOption($option, $value) {
        $this->_options[$option] = $value;
        return $this;
    }

    /**
     * Define uma mensagem de erro
     * 
     * @param string $msg
     * @return \ZendT_Tabs 
     */
    public function setOnError($msg) {
        $this->_error = $msg;
        return $this;
    }
    
    /**
     * Define mensagem de carregamento
     * 
     * @param string $value
     * @return \ZendT_Tabs 
     */
    public function setLoadMsg($value=''){
        $this->_loadMsg = $value;
        return $this;
    }
    
    /**
     * Retorna mensagem de carregamento
     * 
     * @return type 
     */
    public function getLoadMsg(){
        return $this->_loadMsg;
    }

    /**
     * Cria o script JS para a execução dos tabs
     * 
     * @return string 
     */
    public function createJS() {
        if ($this->_disabledAll) {
            if (count($this->_tabs) > 2) {
                for ($i = 2; $i < count($this->_tabs); $i++) {
                    $this->_options['disabled'][] = $i;
                }
            } else {
                unset($this->_options['disabled']);
            }
        }
        $js = '$("div#' . $this->_id . '").TTabs(';
        if (count($this->_options) > 0) {
            $js.= json_encode($this->_options);
        }
        $js.= ');' . "\n";
        foreach ($this->_tabs as $index => $tabs) {
            if (is_array($tabs['content'])) {
                $linkField = current($tabs['content']);
                $linkTable = key($tabs['content']);
            }
            if ($tabs['type'] == 'grid') {
                $arrayTableSchema = $this->_formatTableGrid($tabs['url']);
                $urlTabs.= $index . ': {"url":"' . $this->_formatUrlGrid($tabs['url']) . '/grid?typeModal=AJAX&filter_json=","type":"grid","table":"' . $arrayTableSchema[1] . '","mapper":"' . $this->_formatMapperGrid($tabs['url']) . '","schema":"' . $arrayTableSchema[0] . '","fieldLink":"' . $linkField . '","tableLink":"' . $linkTable . '"},';
            } else if ($tabs['type'] == 'ajax' && is_array($tabs['content'])) {
                $urlTabs.= $index . ': {"url":"' . $tabs['url'] . '","type":"ajax","table":"","mapper":"","schema":"","fieldLink":"' . $linkField . '","tableLink":"' . $linkTable . '"},';
            }
        }
        if ($urlTabs) {
            $js.= 'arrayUrlIndex' . $this->_id . ' = {' . substr($urlTabs, 0, -1) . '};' . "\n";
            $js.= '$("#' . $this->_id . '").bind("tabsselect", function(event, ui) {
                 $(ui.panel).html("'.$this->_loadMsg.'");
                 if(window.arrayUrlIndex' . $this->_id . '[ui.index] !== undefined){
                    var tabTable = arrayUrlIndex' . $this->_id . '[ui.index]["table"];
                    var tabMapper = arrayUrlIndex' . $this->_id . '[ui.index]["mapper"];
                    var tabSchema = arrayUrlIndex' . $this->_id . '[ui.index]["schema"];
                    var tabLink = arrayUrlIndex' . $this->_id . '[ui.index]["tableLink"];
                    var tabFieldLink = arrayUrlIndex' . $this->_id . '[ui.index]["fieldLink"];                      
                    var idTabSel = $("#grid_"+tabLink.replace(/_/g,"").toLowerCase()).jqGrid("getGridParam","selrow");
                    var jsonFilter = idTabSel;
                    if(arrayUrlIndex' . $this->_id . '[ui.index]["type"] == "grid"){
                        if(tabLink != ""){
                            var where = new TWhere("AND")
                            where.addFilter({
                            field: tabLink+"."+tabFieldLink,
                            value: idTabSel,
                            operation: "=",
                            mapper: tabSchema+"_Model_"+tabMapper+"_Mapper"
                            });
                            jsonFilter = where.toJson()
                        }
                     }
                     $("#' . $this->_id . '").TTabs("changeUrl", arrayUrlIndex' . $this->_id . '[ui.index]["url"]+encodeURIComponent(jsonFilter) ,ui.index);                    
                 }
               });
            ';
        }
        return '<script type = "text/javascript">' . "\n" . $js . '</script>';
    }

    /**
     * Formata o nome de uma tabela como uma url
     * 
     * @param string $url
     * @return string 
     */
    private function _formatUrlGrid($url) {
        $strUrl = '';
        for ($i = 0; $i <= substr_count($url, '/'); $i++) {
            $strUrl.= '../';
        }
        $strUrl.= str_replace('_', '-', $url);
        return $strUrl;
    }

    /**
     * Formata o nome de uma tabela como um mapper
     * 
     * @param string $table
     * @return string 
     */
    private function _formatMapperGrid($table) {
        $arraytabs = explode('/', $table);
        $table = str_replace('_', ' ', end($arraytabs));
        $table = ucwords($table);
        $table = str_replace(' ', '', $table);
        return $table;
    }

    /**
     * Retorna a tabela e o schema separados
     * 
     * @param string $table
     * @return array 
     */
    private function _formatTableGrid($table) {
        $arraytabs = explode('/', $table);
        $arraytabs[0] = ucfirst($arraytabs[0]);
        return $arraytabs;
    }

    /**
     * Cria o HTMl para as tabs
     * 
     * @return string 
     */
    public function createHtml() {
        $divTab = '';
        $html = "<div id='" . $this->_id . "'>
                    <ul>\n";
        foreach ($this->_tabs as $value) {

            if ($value['type'] != 'ajax' && $value['type'] != 'grid') {
                $divTab.= "<div id='" . $value['url'] . "'>" . $value['content'] . "</div>\n";
                $value['url'] = '#' . $value['url'];
            }
            $url = $value['url'];
            if ($value['type'] == 'grid') {
                $url = $this->_formatUrlGrid($url) . '/grid?typeModal=AJAX';
            }
            $html.= "<li><a href='" . $url . "'>" . $value['label'] . "</a></li>\n";
        }
        $html.= "   </ul>
            " . $divTab . "
            </div>\n";
        return $html;
    }

    /**
     * Rendeniza
     * 
     * @return string 
     */
    public function render() {
        return $this->createHtml() . ' ' . $this->createJS();
    }

}

?>