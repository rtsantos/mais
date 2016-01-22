<?php

   require_once('Extra/MPDF/mpdf.php');

   class ZendT_Report_Html_Pdf extends mPDF {

       private function _parseRepeat(&$html, &$vars) {
           $begin = '{beginRepeat}';
           $end = '{endRepeat}';
           while (strpos($html, $begin) !== false) {
               $iBegin = strpos($html, $begin);
               $aux = substr($html,$iBegin);
               $iEnd = strpos($aux, $end) + strlen($end);
               $part = substr($aux, 0, $iEnd);

               preg_match_all("/\{(.*?)\}/", $part, $fields);
               $iMax = 0;
               if (count($fields) > 0) {
                   foreach ($fields[1] as $field) {
                       if (count($vars[$field]) > $iMax) {
                           $iMax = count($vars[$field]);
                       }
                   }
               }

               $parts = array();
               for ($i = 0; $i < $iMax; $i++) {
                   $parts[$i] = str_replace(array($begin, $end), '', $part);
                   foreach ($fields[1] as &$field) {
                       $value = '';
                       if (is_array($vars[$field])) {
                           $value = $vars[$field][$i];
                       } else {
                           $value = $vars[$field];
                       }
                       $parts[$i] = str_replace('{' . $field . '}', $value, $parts[$i]);
                   }
               }

               $parts = implode('', $parts);
               $html = str_replace($part, $parts, $html);
           }
       }

       /**
        * 
        * @param string $html
        * @param array $vars
        */
       public function setHtml($html, $vars=array()) {
           $this->_parseRepeat($html, $vars);
           preg_match_all("/\{(.*?)\}/", $html, $fields);
           $old = array();
           $new = array();
           foreach ($fields[1] as &$field) {
               if (isset($vars[$field])) {
                   $old[] = '{'.$field.'}';
                   $new[] = $vars[$field];
               }
           }
           $html = str_replace($old,$new,$html);
           $this->WriteHTML($html);
       }

       public function render() {
           $this->Output();
       }

       public function __toString() {
           $this->Output();
       }

   }
   