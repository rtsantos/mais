<?php

    /**
     * 
     * @category    ZendT
     * @author      ksantoja
     */

    /**
     * jQuery para criação do Autocomplete
     *
     */
    class ZendT_View_Helper_Autocomplete extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         * Cria um campo texto com autocomplete customizado
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function autocomplete($id, $value = null, array $attribs = array()) {

            $params = $attribs['jQueryParams'];
            unset($attribs['jQueryParams']);

            if (!isset($params['source'])) {
                if (isset($params['url'])) {
                    $params['source'] = $params['url'];
                    unset($params['url']);
                } else if (isset($params['data'])) {
                    $params['source'] = $params['data'];
                    unset($params['data']);
                } else {
                    require_once "ZendX/JQuery/Exception.php";
                    throw new ZendX_JQuery_Exception(
                    "O parametro Source é obrigatório"
                    );
                }
            }

            if ($params['showButtonSearch']) {
                $xhtml = '<button id="search-' . $id . '" type="button" class="ui-button ui-state-default item" nofocus="true"><span class="ui-icon ui-icon-carat-1-s"></span></button>';
            } else {
                $xhtml = '';
            }
            $xscript = '';
            if ($params['multiple']) {
                $onResult = 'function(event, row, formatted){
                            jQuery("#' . $id . '").Tdata("TAutocomplete").addElement("' . $id . '", row[0]);
                        }';
                $params['onResult'] = new ZendT_JS_Command($onResult);

                $xhtml.= '<div id="sel-elements-' . $id . '" class="" style="text-wrap: normal;">
                        <input id="' . $id . '-multiple" name="' . $id . '-multiple" type="hidden" value="">
                      </div>';

                $xscript.= 'jQuery("#sel-elements-' . $id . '").width(jQuery("#' . $id . '").width());';
            }

            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/extra/jquery.autocomplete.js');
            $this->view->headLink()->appendStylesheet(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/extra/jquery.autocomplete.css');
            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TAutocomplete.js');

            $params = ZendT_JS_Json::encode($params);
            $params = str_replace('{id}', $id, $params);

            $this->jquery->addOnLoad('jQuery("#' . $id . '").TAutocomplete(' . $params . ');' . $xscript);
            $attribs['class'].= ' item';
            return '<div class="ui-form-group"> ' . $this->view->formText($id, $value, $attribs) . $xhtml . '</div>';
        }

    }
    