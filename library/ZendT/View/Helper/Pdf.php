<?php

   class ZendT_View_Helper_Pdf {

       public function pdf($id, $filename, $prop=array()) {

           if (!isset($prop['zoom'])) {
               $prop['zoom'] = 98;
           }

           if (!isset($prop['min-height'])) {
               $prop['min-height'] = '500px';
               $prop['min-height-iframe'] = '465px';
           }

           $xhtml = "";
           $xhtml.= '<div id="' . $id . '" class="ui-view" style="min-height: ' . $prop['min-height'] . ';">';
           $xhtml.= '   <div class="header">';
           $xhtml.= '      <div class="ui-box-logo">';
           $xhtml.= '          <img src="/Mais/public/images/logo-tanet.gif" />';
           $xhtml.= '      </div>';
           $xhtml.= '      <div class="ui-box-action">';
           $xhtml.= '      <button onClick="fullWindow(jQuery(this),jQuery(\'#' . $id . '\'));" type="button" class="ui-button ui-state-default">';
           $xhtml.= '          <span class="ui-icon ui-icon-arrow-4-diag"></span>';
           $xhtml.= '      </button>';
           $xhtml.= '      </div>';
           $xhtml.= '   </div>';
           $xhtml.= '   <div class="content" style="min-height: ' . $prop['min-height-iframe'] . ';z-index:1;position:relative;">';
           $xhtml.= '      <iframe class="ui-cover-pdf" style="min-height: ' . $prop['min-height-iframe'] . ';z-index:1;position:relative;" width="100%" height="100%" frameborder="0" align="left" scrolling="off" noresize="noresize" border="0" src="' . $filename . '?wmode=transparent#zoom=' . $prop['zoom'] . '" id="ifr-viewer-pdf" name="ifr-viewer-pdf"></iframe>';
           $xhtml.= '   </div>';
           $xhtml.= '</div>';
           return $xhtml;
       }

   }
   