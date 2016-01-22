<?php

class ZendT_Form_Decorator_Textare extends ZendX_JQuery_Form_Decorator_UiWidgetContainer {

    protected $_format = '<div id="group-%1$s" class="form-group">
                             <label for="%1$s">%2$s</label><br />
                             <textarea name="%3$s" class="%5$s %6$s" %7$s/>%4$s</textarea>
                          </div>';

    /**
     * Convert options to tag attributes
     *
     * @return string
     */
    protected function _htmlAttribs(array $attribs) {
        $xhtml = '';
        foreach ((array) $attribs as $key => $val) {
            $key = htmlspecialchars($key);
            if (is_array($val)) {
                if (array_key_exists('callback', $val)
                        && is_callable($val['callback'])
                ) {
                    $val = call_user_func($val['callback'], $this);
                } else {
                    $val = implode(' ', $val);
                }
            }
            $val = htmlspecialchars($val);
            $xhtml .= " $key=\"$val\"";
        }
        return $xhtml;
    }

    public function render($content) {
        $element = $this->getElement();
        $name = htmlentities($element->getFullyQualifiedName());
        $label = $element->getLabel();
        $id = htmlentities($element->getId());
        $value = htmlentities($element->getValue());
        $required = $element->isRequired();

        $xhtmlAttribs = $this->_htmlAttribs($element->getAttribs());
        $css = '';

        $markup = sprintf($this->_format, $id, $label, $name, $value, $css, $required,$xhtmlAttribs);
        return $markup;
    }

}