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
    class ZendT_View_Helper_Text extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         *  Cria um campo texto
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function text($id, $value = null, array $attribs = array()) {
            unset($attribs['required']);            
            $mask = $attribs['jQueryParams']['mask'];
            $charMask = $attribs['jQueryParams']['charMask'];
            unset($attribs['jQueryParams']);
            if ($mask) {
                if (!is_array($mask)){
                    $mask = array($mask);
                }
                $params = array('masks'    => $mask,
                                'charMask' => $charMask);
                $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TMask.js');
                $this->jquery->addOnLoad('jQuery("#' . $id . '").TMask(' . json_encode($params) . ').val(\''.$value.'\');');
            }
            
            $xhtml = $this->view->formText($id, $value, $attribs);
            if (!isset($attribs['noLabelError'])){
                $xhtml.= '<label class="error" for="'.$id.'" generated="true" style="display:none"></label>';
            }
            return $xhtml;
        }

    }