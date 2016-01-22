<?php

    /**
     * 
     * @category    ZendT
     * @author      tesilva
     */

    /**
     * jQuery para criação do Date
     *
     */
    class ZendT_View_Helper_DateDynamic extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         *  Cria um campo texto com validador de data e datepicker
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function dateDynamic($id, $value = null, array $attribs = array()) {
            $params = $attribs['jQueryParams'];
            unset($attribs['jQueryParams']);
            $params['helper_script'] = 'TDateDynamic';

            $data = date('dmy');
            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/layout/jquery/widget/TDateDynamic.js?' . $data);
            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/layout/jquery/widget/TButtonsDynamic.js?' . $data);
            $this->jquery->addOnLoad('jQuery("#' . $id . '").TButtonsDynamic(' . ZendT_JS_Json::encode($params) . ');');
            $attribs['style'].= 'float:left;';
            $attribs['class'].= ' ui-input-date item';
            return '<div class="ui-form-group">'.$this->view->formText($id, $value, $attribs).'</div>';
        }

    }
    