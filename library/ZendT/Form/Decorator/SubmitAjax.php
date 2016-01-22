<?php

    class ZendT_Form_Decorator_SubmitAjax extends ZendX_JQuery_Form_Decorator_UiWidgetContainer {

        protected $_format = '<div id="group-%1$s" class="form-group"><input id="%1$s" name="%3$s" type="button" value="%4$s" class="%5$s"/></div>';

        public function render($content) {
            $element = $this->getElement();
            $name = htmlentities($element->getFullyQualifiedName());
            $label = $element->getLabel();
            $id = htmlentities($element->getId());
            $value = htmlentities($element->getValue());
            if ($value == '') {
                $value = $name;
            }
            //$css     = htmlentities($element->getCssClass());
            $css = '';

            $markup = sprintf($this->_format, $id, $label, $name, $value, $css);
            return $markup;
        }

    }
    