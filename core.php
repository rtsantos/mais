<?php

    /**
     * Remove acentos de um texto
     *
     * @param string $value
     * @return string
     */
    function removeAccent($value) {
        return ZendT_Lib::removeAccent($value);
    }

    function filterNumber($value) {
        return ZendT_Lib::filterNumber($value);
    }

    function sql2json($value) {
        $_parse = new ZendT_Db_Adapter_ParseSQL();
        $data = $_parse->toArray($value);
        return ZendT_JS_Json::encode($data);
    }

    function clearAccent($value) {
        $newValue = '';
        for ($i = 0; $i < strlen($value); $i++) {
            $caracter = $value[$i];
            if (ereg("[0-9]", $caracter)) {
                $newValue.= $caracter;
            } elseif (ereg("[a-z]", $caracter)) {
                $newValue.= $caracter;
            } elseif (ereg("[A-Z]", $caracter)) {
                $newValue.= $caracter;
            }
        }
        return $newValue;
    }

    /**
     *
     * @param string $value
     * @param string|array $search
     * @param string|array $replace
     * @return string
     */
    function replace($value, $search, $replace) {
        return str_replace($search, $replace, $value);
    }

    function getBrowser() {
        $useragent = $_SERVER['HTTP_USER_AGENT'];

        if (preg_match('|MSIE ([0-9].[0-9]{1,2})|', $useragent, $matched)) {
            $browser_version = $matched[1];
            $browser = 'IE';
        } elseif (preg_match('|Opera/([0-9].[0-9]{1,2})|', $useragent, $matched)) {
            $browser_version = $matched[1];
            $browser = 'Opera';
        } elseif (preg_match('|Firefox/([0-9\.]+)|', $useragent, $matched)) {
            $browser_version = $matched[1];
            $browser = 'Firefox';
        } elseif (preg_match('|Chrome/([0-9\.]+)|', $useragent, $matched)) {
            $browser_version = $matched[1];
            $browser = 'Chrome';
        } elseif (preg_match('|Safari/([0-9\.]+)|', $useragent, $matched)) {
            $browser_version = $matched[1];
            $browser = 'Safari';
        } else {
            $browser_version = 0;
            $browser = 'other';
        }
        return $browser . " " . $browser_version;
    }

    function text_decode($value) {
        return $value;
    }

    function text_encode($value) {
        return $value;
    }

    function _i18n() {
        $args = func_get_args();
        $message = call_user_func_array('sprintf', $args);
        return $message;
    }

?>
