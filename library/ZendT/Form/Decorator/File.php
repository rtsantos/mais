<?php

class ZendT_Form_Decorator_File extends ZendX_JQuery_Form_Decorator_UiWidgetContainer {

    protected $_style = array();
    protected $_format = '<div id="group-%1$s" class="form-group">
                             <label for="%1$s">%2$s</label><br />
                             <input name="%3$s" type="file" value="%4$s" class="%5$s %6$s" %7$s/>
                             <div style="clear:both"></div>
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
            $xhtml .= $this->_attribsMask($key,$val);
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


        //print_r($element);
        $xhtmlAttribs = $this->_htmlAttribs($element->getAttribs());

        //$css     = htmlentities($element->getCssClass());
        if ($required) {
            $required = ' required ';
        }
        $css = '';

        $markup = sprintf($this->_format, $id, $label, $name, $value, $css, $required, $xhtmlAttribs.' style="'.$this->_style['default'].'"');
        return $markup;
    }

    private function _attribsMask($key, $value, $elemento = 'default') {
        if (substr($key, 0, 4) == 'css-') {
            $this->_style[$elemento].= '' . substr($key, 4) . ':' . $value . ';';
        } else {
            $retorno = ' ' . $key . '="' . $value . '" ';
        }
        return $retorno;
    }

}