<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Json
 *
 * @author rsantos
 */
class ZendT_JS_Json {
    /**
     * @param array $data
     * @return string
     */
    public static function encode($data,$defaultQuote=true){
        $result = '';
        if($defaultQuote){
            $quote='"';
        }
        if (!is_array($data) && !is_object($data)){
            return $data;
        }else{
            foreach ($data as $key=>$value){                
                if ($value instanceof ZendT_Type){
                    $value = $value->get();                    
                }
                if (is_numeric($value) && (strlen((int)$value) == strlen($value))){
                    $result.= ','.$quote.$key.$quote.': '.$value;
                }else if (is_bool($value)){
                    $result.= ','.$quote.$key.$quote.': '.($value?'true':'false');
                }else if ($value instanceof ZendT_JS_Command){
                    $result.= ','.$quote.$key.$quote.': '.$value->render();
                }else if (is_array ($value) || is_object($value)){
                    $result.= ','.$quote.$key.$quote.': '.ZendT_JS_Json::encode($value,$defaultQuote);
                }else{
                    // Escape these characters with a backslash:
                    // " \ / \n \r \t \b \f
                    $search  = array('\\', "\n", "\t", "\r", "\b", "\f", '"', '/');
                    $replace = array('\\\\', '\\n', '\\t', '\\r', '\\b', '\\f', '\"', '\\/');
                    $value  = str_replace($search, $replace, $value);

                    // Escape certain ASCII characters:
                    // 0x08 => \b
                    // 0x0c => \f
                    $value = str_replace(array(chr(0x08), chr(0x0C)), array('\b', '\f'), $value);

                    $result.= ','.$quote.$key.$quote.': "'.$value.'"';
                }
            }            
        }
        return '{'.substr($result,1).'}';
    }
}

?>
