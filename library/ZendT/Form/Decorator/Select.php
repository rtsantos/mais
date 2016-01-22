<?php

    class ZendT_Form_Decorator_Select extends ZendX_JQuery_Form_Decorator_UiWidgetContainer 
    {
        protected $_format = '<div id="group-%1$s" class="form-group">%2$s</div>';

        public function render($content)
        {
            $element = $this->getElement();
            $id      = htmlentities($element->getId());

            $markup  = sprintf($this->_format, $id, $content);
            return $markup;
        }
    }