<?php
    class ZendT_Form_Decorator extends Zend_Form_Decorator_Abstract implements ZendX_JQuery_Form_Decorator_UiWidgetElementMarker{
        /**
        * Render an element using its associated view helper
        *
        * Determine view helper from 'helper' option, or, if none set, from
        * the element type. Then call as
        * helper($element->getName(), $element->getValue(), $element->getAttribs())
        *
        * @param  string $content
        * @return string
        * @throws Zend_Form_Decorator_Exception if element or view are not registered
        */
        public function render($content){
            $element = $this->getElement();
            $view    = $element->getView();
            if (null === $view) {
                return $content;
            }
            $options = '';
            $separator = '';
            if (isset($element->options)){
                $options = $element->options;
                $separator = $element->getSeparator();
            }
            return $view->{$element->helper}($element->getId(), $element->getValue(), $element->getAttribs(), $options, $separator);
        }
    }