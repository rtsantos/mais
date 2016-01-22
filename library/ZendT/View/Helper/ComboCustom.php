<?php

    /**
     * 
     * @category    ZendT
     * @author      ksantoja
     */

    /**
     * jQuery para criação do ComboCustom
     *
     */
    class ZendT_View_Helper_ComboCustom extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         * Cria um campo de ComboCustom
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function comboCustom($id, $value = null, array $params = array(), array $attribs = array()) {
            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TComboCustom.js')
                    ->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TOpenDownBox.js');

            $params = ZendX_JQuery::encodeJson($params);

            $js = sprintf('%s("#%s").TComboCustom(%s);', ZendX_JQuery_View_Helper_JQuery::getJQueryHandler(), $attribs['id'], $params);

            $this->jquery->addOnLoad($js);

            return $this->view->formText($id, $value, $attribs);
        }

    }

    