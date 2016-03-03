<?php

   /**
    * 
    */
   class ZendT_Report {

       /**
        *
        * @param string $adapter
        * @param array $options
        * @return \ZendT_Report_Abstract
        * @throws ZendT_Exception_Error 
        */
       public static function factory($adapter, $options = array()) {
           if (strpos($adapter, '_') === false) {
               $adapter = 'ZendT_Report_' . ucfirst(strtolower($adapter));
           }
           $obj = new $adapter($options);
           if ($obj instanceof ZendT_Report_Abstract) {
               
           } else {
               throw new ZendT_Exception_Error('Adaptador "' . $adapter . '" não tem implementado a classe "ZendT_Report_Abstract"');
           }
           return $obj;
       }

   }

?>
