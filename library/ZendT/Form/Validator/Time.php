<?php

class ZendT_Form_Validator_Time extends Zend_Validate_Abstract {

    const TIME = 'time';

    protected $_messageTemplates = array(
        self::TIME => "'%value%' não é uma hora valida"
    );

    public function isValid($value) {
        $this->_setValue($value);
        $arrayHora = explode(':', $value);
        if ($hora[0] > 24 && $hora[1] > 59 || $hora[2] > 59) {
            $this->_error();
            return false;
        } else if (!mktime($hora[0],$hora[1],$hora[2])) {
            $this->_error();
            return false;
        }
        return true;
    }

}