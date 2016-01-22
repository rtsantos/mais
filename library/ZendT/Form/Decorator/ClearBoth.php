<?php
    class ZendT_Form_Decorator_ClearBoth extends ZendX_JQuery_Form_Decorator_UiWidgetContainer implements ZendX_JQuery_Form_Decorator_UiWidgetElementMarker{
        /**
        *
        * @param type $content
        * @return string 
        */
        public function render($content) {
            $xhtml = '<div style="clear:both"></div>';
            return $xhtml;
        }
    }