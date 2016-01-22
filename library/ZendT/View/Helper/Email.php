<?php

    /**
     * 
     * @category    ZendT
     * @author      ksantoja
     */

    /**
     * jQuery para validação de email
     *
     */
    class ZendT_View_Helper_Email extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         * Cria um campo texto com validador de email
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function email($id, $value = null, array $attribs = array()) {
            $params = $params['jQueryParams'];
            unset($params['jQueryParams']);

            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TEmail.js');
            $params = ZendX_JQuery::encodeJson($params);

            $this->jquery->addOnLoad('jQuery("#' . $id . '").TEmail(' . $params . ');');

            return $this->view->formText($id, $value, $attribs);
        }

    }

    