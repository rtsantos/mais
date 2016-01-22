<?php

class ZendT_Form_Decorator_Seeker extends ZendX_JQuery_Form_Decorator_UiWidgetContainer {
    /**
     *
     * @param string $element
     * @param string $suffix
     * @return string 
     */
    private function _renderElement($element,$suffix,$prefix){
        if ($suffix){
            $name = $element->getName();
            $name.= '_'.$suffix;
            $element->setName($name);
        }
        if ($prefix){
            $name = $prefix.'_'.$element->getName();
            $element->setName($name);
        }
        $element->addStyle('top','0px');
        return $element->render();
    }
    /**
     *
     * @param string $content
     * @return string 
     */
    public function render($content) {
        $element = $this->getElement();
        $attribs = $element->getAttribs();
        
        $search = $attribs['propSearch'];
        
        $name = $element->getFullyQualifiedName();
        $suffix = $attribs['suffix'];
        $prefix = $attribs['prefix'];
        if (!$suffix && !$prefix) 
            $suffix = $name;
        
        #$id = htmlentities($element->getId());
        #$value = $element->getValue();
        
        if ($element->isRequired()){
            $search->setRequired();            
        }
        
        $xhtmlElements = '';
        
        $renderKeys = array('propId','propSearch','propDisplay');
        foreach ($renderKeys as $key){
            if (isset($attribs[$key])){
                $field = $attribs[$key]->getAttrib('field');
                $xhtmlElements.= $this->_renderElement($attribs[$key],$suffix,$prefix);
                unset($attribs['fields'][$field]);
            }
        }        
        
        foreach ($attribs['fields'] as $field){
            $key = 'prop'.ucfirst($field);
            $xhtmlElements.= $this->_renderElement($attribs[$key],$suffix,$prefix);
            unset($attribs[$key]);
        }
        
        $attribs['button']->addStyle('top','-1px');
        $attribs['button']->addStyle('height','20px');
        $attribs['button']->addStyle('width','20px');
        $attribs['button']->addStyle('margin','0px');
        $attribs['button']->addStyle('padding','0px');
        //$attribs['button']->addStyle('position','absolute');
        if ($suffix){
            $nameButton = $attribs['button']->getName();
            $nameButton.= '_'.$suffix;
            $attribs['button']->setName($nameButton);
        }
        if ($prefix){
            $nameButton = $prefix.'_'.$attribs['button']->getName();
            $attribs['button']->setName($nameButton);
        }
        $xhtmlElements.= $attribs['button']->render();
        unset($attribs['button']);
        
        $id = $search->getAttrib('id');
        if (!$id){
            $id = ZendT_View_Html::normalizeId($search->getName());
        }
        /**
         * 
         */
        $xhtml = '
            <div id="group-'.$id.'" class="form-group">
                <label for="'.$id.'" class="t-element">'.$element->getLabel().'</label>
                <div style="position: relative;">
                    '.$xhtmlElements.'
                    <div style="clear:both"></div>
                </div>
            </div>
        ';
        unset($attribs['propId']);
        unset($attribs['propSearch']);
        unset($attribs['propDisplay']);
        return $xhtml;
    }
}