<?php

class ZendT_Form_Decorator_DateTime extends ZendX_JQuery_Form_Decorator_UiWidgetContainer {

    protected $_style = array();
    protected $_format = '<div id="group-%1$s" class="form-group">
                            <label for="%1$s" style="float:left;">%2$s </label><br>
                            <input id="%1$s" name="%3$s" type="text" value="%4$s" class="%5$s %6$s" nofocus="true" style="display:none;"/>
                            <input type="text" name="%3$s_date" id="%1$s_date" %7$s/>
                            <input type="text" name="%3$s_time" id="%1$s_time" %8$s/>
                            <div style="clear:both">
                            </div>
                          </div>';    

    public function render($content) {
        $element = $this->getElement();
        $name = $element->getFullyQualifiedName();
        $label = $element->getLabel();
        $id = htmlentities($element->getId());
        $valueInput = $element->getValue();
        $required = $element->isRequired();
        //$css     = htmlentities($element->getCssClass());

        $css = '';
        if ($required) {
            $required = ' required ';
        }

        $attribs = $element->getAttribs();

        if (is_array($attribs)) {
            $timeAttribs = '';
            $dateAttribs = '';
            foreach ($attribs as $key => $value) {
                $var = substr($key, -5);
                if (substr($key, 0,-5) != 'value') {
                    if(substr($key, -5) == '_date') {
                        $dateAttribs.= $this->_attribsMask(substr($key, 0,-5),$value,'date');
                    } else if (substr($key, -5) == '_time') {
                        $timeAttribs.= $this->_attribsMask(substr($key, 0,-5),$value,'time');
                    }
                }
            }
        }

        $markup = sprintf($this->_format, $id, $label, $name, $valueInput, $css, $required, $dateAttribs.' style="'.$this->_style['date'].'"', $timeAttribs.' style="'.$this->_style['time'].'"');
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

