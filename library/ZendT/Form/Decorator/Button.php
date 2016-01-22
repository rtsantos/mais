<?php

class ZendT_Form_Decorator_Button extends ZendX_JQuery_Form_Decorator_UiWidgetContainer implements ZendX_JQuery_Form_Decorator_UiWidgetElementMarker{
    /**
     *
     * @param type $content
     * @return string 
     */
    public function render($content) {
        $element = $this->getElement();
        $view    = $element->getView();
        if (null === $view) {
            return $content;
        }
        $id = $element->getId();
        $options = '';
        $separator = '';
        if (isset($element->options)){
            $options = $element->options;
            $separator = $element->getSeparator();
        }
        $attribs = $element->getAttribs();
        $cmdAttribs = '';
        if (isset($attribs['box']) && $attribs['box']){
            $box = $attribs['box'];
            unset($attribs['box']);
            /**
             * Trata os casos de style
             */
            foreach($box as $key=>$value){
                if (substr($key,0,3) == 'css'){
                    $box['style'].= substr($key,4) . ':' . $value . ';';
                    unset($box[$key]);
                }
            }
            foreach($box as $key=>$value){
                $cmdAttribs.= ' '.$key.'="'.$value.'"';
            }
        }
        
        $xhtmlElement = $view->{$element->helper}($id, $element->getValue(), $attribs, $options, $separator);
        $xhtml = '
            <div id="group-'.$id.'" class="form-group"'.$cmdAttribs.'>
                '.$xhtmlElement.'
                <div style="clear:both"></div>
            </div>
        ';
        return $xhtml;
    }
}