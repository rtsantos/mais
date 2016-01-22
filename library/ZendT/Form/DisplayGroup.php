<?php

class ZendT_Form_DisplayGroup extends Zend_Form_DisplayGroup
{
     public function loadDefaultDecorators()
    {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }

        $decorators = $this->getDecorators();
        if (empty($decorators)) {
             $this->addDecorator('FormElements');
             $this->addDecorator(new ZendT_Form_Decorator_FieldsetT);
        }
        return $this;
    }
}
