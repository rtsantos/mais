<?php

/**
 * Essa classe tem como finalidade trabalhar com ID "virtual"
 * 
 * @package ZendT
 * @subpackage String
 * @author tesilva
 */
class ZendT_Type_RowId extends ZendT_Type_String {

    public function __construct($value = null, $options = array(), $locale = null) {
        if (!isset($options['filterDb'])) {
            $options['filterDb'] = array();
        }
        $options['filterDb'][] = 'chartorowid';

        if (!isset($options['format'])) {
            $options['format'] = array();
        }
        $options['format'][] = 'urlencode';

        if (!isset($options['filter'])) {
            $options['filter'] = array();
        }
        $options['filter'][] = 'urldecode';

        parent::__construct($value, $options, $locale);
    }

}

?>