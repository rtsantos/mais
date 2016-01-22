<?php

class ZendT_Form_Decorator_Hidden extends ZendX_JQuery_Form_Decorator_UiWidgetContainer implements ZendX_JQuery_Form_Decorator_UiWidgetElementMarker{
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
        if (isset($element->options)){
            $options = $element->options;
        }
        $xhtmlElement = $view->{$element->helper}($id, $element->getValue(), $element->getAttribs(), $options, '');
        $xhtml = '
            <div id="group-'.$id.'" class="form-group" style="display:none">
                <label for="'.$id.'" class="t-element">'.$element->getLabel().'</label><br />
                '.$xhtmlElement.'
                <div style="clear:both"></div>
            </div>
        ';
        return $xhtml;
    }
}