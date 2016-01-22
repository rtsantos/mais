<?php

    /**
     * 
     * @category    ZendT
     * @author      ksantoja
     */

    /**
     * jQuery para criação do Date
     *
     */
    class ZendT_View_Helper_DateMonthYear extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         *  Cria um campo texto com validador de data e datepicker
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function dateMonthYear($id, $value = null, array $attribs = array()) {
            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/extra/jquery.maskedinput-1.4.1.min.js');
            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TDateMonthYear.js');

            $params = ZendX_JQuery::encodeJson($attribs['jQueryParams']);
            unset($attribs['jQueryParams']);

            $this->jquery->addOnLoad('jQuery("#' . $id . '").TDateMonthYear(' . $params . ');');
            return $this->view->formText($id, $value, $attribs);
        }

    }

    