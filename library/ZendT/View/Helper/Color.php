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
    class ZendT_View_Helper_Color extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         * Cria um campo de ComboCustom
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function color($id, $value = null, array $params = array(), array $attribs = array()) {
            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/extra/color/simple-color.js');

            $js = "jQuery('#" . $id . "').simpleColor({
                    boxWidth: '95px',
                    cellMargin: 0,
                    displayColorCode: true,
                    livePreview: true,
                    onSelect: function(hex, element) {
                        jQuery('#" . $id . "').trigger('change');
                    }
               });";

            $this->jquery->addOnLoad($js);

            return $this->view->formText($id, $value, $params);
        }

    }

    