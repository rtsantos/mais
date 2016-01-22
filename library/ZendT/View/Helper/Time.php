<?php

    /**
     * jQuery para criação do Time
     * 
     * @category    ZendT
     * @author      ksantoja
     */
    class ZendT_View_Helper_Time extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         *  Cria um campo de hora, com validador de horarios e opção de selecionar uma hora via Autcomplete
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function time($id, $value = null, array $attribs = array()) {
            $data = date('dmy');
            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/layout/jquery/widget/TTime.js?' . $data);

            $params = ZendX_JQuery::encodeJson($attribs['jQueryParams']);
            unset($attribs['jQueryParams']);
            $attribs['class'].=' ui-input-time';
            $xhtml.= '<div class="ui-form-group">'
                    . $this->view->formText($id, $value, $attribs)
                    . '</div>';
            $this->jquery->addOnLoad('jQuery("#' . $id . '").TTime(' . $params . ');');
            return $xhtml;
        }

    }
    