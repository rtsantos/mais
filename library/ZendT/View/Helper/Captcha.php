<?php

    /**
     * Monta uma entrada de captcha
     * 
     * @category    ZendT
     * @author      rsantos
     */
    class ZendT_View_Helper_Captcha extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         *  Monta uma entrada de captcha
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function captcha($id, $value = null, array $attribs = array()) {

            $sessionId = $value['session_id'];
            $url = $value['url'];
            unset($value['session']);
            unset($value['url']);

            $xhtml = $this->view->formText($id . '[text]', '', $attribs);
            $xhtml.= $this->view->formHidden($id . '[session_id]', $sessionId);
            $xhtml.= $this->view->formHidden($id . '[url]', $sessionId);
            $xhtml.= '<br />';
            $xhtml.= '<img id="' . $id . '-img" src="' . $url . '" border="0" />';

            return $xhtml;
        }

    }