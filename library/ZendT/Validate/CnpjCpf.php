<?php

class ZendT_Validate_CnpjCpf extends Zend_Validate_Abstract {

    const CNPJ_CPF = 'CnpjCpf';

    protected $_messageTemplates = array(
        self::CNPJ_CPF => "'%value%' não é um CNPJ ou CPF válido!"
    );
    /**
     * 
     * @param type $value
     * @return boolean 
     */
    public function isValid($value) {
        $this->_setValue($value);
        if (!ZendT_Lib::checkCnpjCpf($value)){
            $this->_error(self::CNPJ_CPF);
            return false;
        }
        return true;
    }

}