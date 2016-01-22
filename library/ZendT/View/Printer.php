<?php

    /**
     * Cria um objeto do tipo Tab (Orelha)
     * 
     * @package ZendT
     * @subpackage Tabs
     * @category View
     *  
     */
    class ZendT_View_Printer extends ZendT_View_Html {

        /**
         *
         * @var array
         */
        protected $_serverPrinters;

        /**
         *
         * @var string
         */
        protected $_filter;

        /**
         * Construtor da classe
         * 
         * @param string $id
         * @param array $options 
         */
        public function __construct($id, $options = array()) {
            $this->_options = $options;
            $this->_serverPrinters = array();
            $this->setId($id);
        }

        /**
         * 
         * @param type $printers
         * @return \ZendT_View_Printer
         */
        public function setServerPrinters($value) {
            $this->_serverPrinters = $value;
            return $this;
        }

        /**
         * 
         * @param type $printers
         * @return \ZendT_View_Printer
         */
        public function setFilter($value) {
            $this->_filter = $value;
            return $this;
        }

        /**
         * Cria o script JS para a execução dos tabs
         * 
         * @return string 
         */
        public function createJS() {
            //$this->addHeadScriptFile('https://www.tanet.com.br/sistemas/printer/js/deployJava.js');
            $this->addHeadScriptFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TPrinter.js?date=' . date('dmy'));
            $js = "jQuery('#" . $this->getId() . "').TPrinter({filter:'" . $this->_filter . "'});";
            return $js;
        }

        /**
         * Cria o HTMl para as tabs
         * 
         * @return string 
         */
        public function createHtml() {

            $html.= '<select id="' . $this->getId() . '" name="' . $this->getId() . '">';
            if (count($this->_serverPrinters) > 0) {
                $html.= '<optgroup id="server_' . $this->getId() . '" label="Impressoras do Servidor">';
                foreach ($this->_serverPrinters as $name) {
                    $add = true;
                    if (isset($name['name'])) {
                        $name = $name['name'];
                    }
                    if ($this->_filter && strpos(strtoupper($name), strtoupper($this->_filter)) === false) {
                        $add = false;
                    }
                    if ($add) {
                        $html.= '    <option value="' . $name . '">' . $name . '</option>';
                    }
                }
                $html.= '</optgroup>';
            }
            $html.= '<optgroup id="local_' . $this->getId() . '" label="Impressoras Locais">';
            $html.= '</optgroup>';
            $html.= '</select>';
            
            $btRefresh = new ZendT_View_Button('btn_' . $this->getId(), '', "jQuery('#" . $this->getId() . "').TPrinter('refreshPrinters');");
            $btRefresh->setIcon('ui-icon-refresh');
            $btRefresh->setTitle('Atualizar lista de impressoras');
            $btRefresh->setCaption('');
            $btRefresh->removeStyle('height');
            $btRefresh->addStyle('margin', '-3px 0 0');
            $btRefresh->addStyle('height', '24px');

            $msg = '<div id="msg_' . $this->getId() . '" style="width:350px;padding:5px;text-align:center;float:left;display:none;" class="ui-state-highlight">';
            $msg.= 'Servidor de impressão não detectado ou requer atualização. <br /> Para instalar, clique <a href = "https://www.tanet.com.br/download/WebServerPrinter.exe">aqui</a>. Em caso de dúvidas entre em contato com o departamento de TI, no telefone 19 2108-9180.';
            $msg.= '</div>';

            return "<div id='cmb_" . $this->getId() . "'>" . $html . $btRefresh->render() . "</div>" . $msg;
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