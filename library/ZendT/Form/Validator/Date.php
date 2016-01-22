<?php

class ZendT_Form_Validator_Date extends Zend_Validate_Abstract {

    const DATE = 'data';

    protected $_messageTemplates = array(
        self::DATE => "'%value%' não é uma data valida"
    );

    public function isValid($value) {
        $this->_setValue($value);
        $data = explode('/',$value);
        if (!checkdate($data[1],$data[0],$data[2])) {
            $this->_error();
            return false;
        }

        return true;
    }

}