<?php
   require_once 'Extra/PEAR/PEAR.php';
   require_once 'Extra/PEAR/XML/Parser.php';
   require_once('Extra/PEAR/XML/Unserializer.php');
   require_once('Extra/PEAR/XML/Serializer.php');
   
   class ZendT_Xml {
       
       public static function encodeXml(&$array){
           $search = array('&','<','>',"'",'"','ª','º',chr(160),'¿');
           $replace = array('&amp;','&lt;','&gt;',"",'&quot;','','','','');
           foreach($array as &$value){
               if (is_array($value)){
                   ZendT_Xml::encodeXml($value);
               }else if (is_string($value)){
                   $value = str_replace($search, $replace, $value);
               }
           }
       }

       /**
        * 
        * @param array $array
        * @return string
        */
       public static function serialize($array) {
           $config = new Zend_Config_Writer_Xml();
           ZendT_Xml::encodeXml($array);
           $config->setConfig(new Zend_Config($array));
           $xml = $config->render();
           return $xml;
           
           
           /*$serializer = new XML_Serializer(array(XML_SERIALIZER_OPTION_ROOT_NAME=>'config'));
           $result = $serializer->serialize($array);
           if ($result){
               $xml = $serializer->getSerializedData();
           }
           return $xml;*/
       }

       /**
        * 
        * @param string $xml
        * @return array
        */
       public static function unserialize($xml) {
           if ($xml instanceof ZendT_Type) {
               $xml = $xml->get();
           }
           
           $unserializer = new XML_Unserializer();
           $status = $unserializer->unserialize($xml);

           if ($status) {
               $array = $unserializer->getUnserializedData();
           }

           return $array;
       }

   }
   