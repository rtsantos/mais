<?php
    class Layout_Lib {
        public static function isIntranet(){
            $aux = explode('.',$_SERVER['SERVER_NAME']);
            if ($aux[0] == 'di' || $aux[0] == 'intranet' || $aux[0] == 'intranet-teste' || $aux[0] == 'intranet-homo'){
                return true;
            }else{
                return false;
            }
        }
		
        public static function isSite(){
            $aux = explode('.',$_SERVER['SERVER_NAME']);
            if ($aux[0] == 'www' || $aux[0] == 'www-teste'){
                return true;
            }else{
                return false;
            }
        }
        
        public static function getServerNameShort(){
            $aux = explode('.',$_SERVER['SERVER_NAME']);
            return $aux[1];
        }
    }
?>
