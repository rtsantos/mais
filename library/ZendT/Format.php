<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ZendT_Format {
    /**
     * Formata uma string passando a máscara
     *
     * @param string $string
     * @param string $mask
     * @param string $charMask
     * @return string
     */
    public static function string($string, $mask, $charMask = '@') {

        $vString = $string;
        $vLenMask = 0;

        $vCharFormat = str_replace($charMask, '', $mask);

        /**
         * Limpa a formatação caso tenha a formatação.
         */
        for ($vIndex = 0; $vIndex < strlen($vCharFormat); $vIndex++) {
            $vString = str_replace(substr($vCharFormat, $vIndex, 1), '', $vString);
        }

        if (strlen($vString) == strlen($mask) - strlen($vCharFormat)) {
            for ($vIndex = 0; $vIndex < strlen($mask); $vIndex++) {
                $Char = substr($mask, $vIndex, 1);
                if ($Char != $charMask) {
                    $ini = substr($vString, 0, $vIndex);
                    $fim = substr($vString, $vIndex);

                    $vString = $ini . $Char . $fim;
                }
            }
            return $vString;
        } else {
            return $string;
        }
    }

}

?>
