<?php

    /**
     * 
     * @category    ZendT
     * @author      ksantoja
     */

    /**
     * jQuery para criação de um campo Text 
     *
     */
    class ZendT_View_Helper_Button extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         *  Cria um campo texto
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function button($id, $value = null, array $attribs = array()) {
            if (!isset($attribs['caption']) && $value != '') {
                $attribs['caption'] = $value;
            }
            $_button = new ZendT_View_Button($id, $attribs['caption']);
            $_button->setIcon($attribs['icon']);
            unset($attribs['icon']);
            unset($attribs['caption']);
            unset($attribs['jQueryParams']);
            unset($attribs['options']);
            foreach ($attribs as $name => $value) {
                $_button->setAttr($name, $value);
            }
            return $_button->render();
        }

    }