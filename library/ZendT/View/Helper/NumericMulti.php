<?php

    /**
     * 
     * @category    ZendT
     * @author      tesilva
     */

    /**
     * jQuery para criação do NumericMulti
     *
     */
    class ZendT_View_Helper_NumericMulti extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         *  Cria um campo texto para numeros, com incremento, verificação, valor maximo e outro (ler arquivo TNumericMulti.js)
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function numericMulti($id, $value = null, array $attribs = array()) {
            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TNumericMulti.js');
            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/extra/autoNumeric.js');

            $params = ZendX_JQuery::encodeJson($attribs['jQueryParams']);
            unset($attribs['jQueryParams']);

            $this->jquery->addOnLoad('jQuery("#' . $id . '").TNumericMulti(' . $params . ');');

            return $this->view->formText($id, $value, $attribs);
        }

    }