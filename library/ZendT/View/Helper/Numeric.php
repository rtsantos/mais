<?php

   /**
    * 
    * @category    ZendT
    * @author      ksantoja
    */

   /**
    * jQuery para criação do Numeric
    *
    */
   class ZendT_View_Helper_Numeric extends ZendX_JQuery_View_Helper_UiWidget {

       /**
        *  Cria um campo texto para numeros, com incremento, verificação, valor maximo e outro (ler arquivo TNumeric.js)
        *
        * @param  string $id
        * @param  string $value
        * @param  array  $params jQuery Widget Parameters
        * @param  array  $attribs HTML Element Attributes
        * @return string
        */
       public function numeric($id, $value = null, array $attribs = array()) {
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TNumeric.js');
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/extra/autoNumeric.js');

           $params = ZendX_JQuery::encodeJson($attribs['jQueryParams']);
           unset($attribs['jQueryParams']);

           $this->jquery->addOnLoad('jQuery("#' . $id . '").TNumeric(' . $params . ');');

           /*$styles = explode(';', $attribs['style']);
           if ($styles) {
               foreach ($styles as $style) {
                   list($styleName,$styleValue) = explode(':',$style);
                   if ($styleName == 'width'){
                       $old = $style;
                       $width = (str_replace('px', '', trim($styleValue)) * 1);
                       $styleValue = $width - 25;
                       $new = 'width:'.$styleValue.'px';
                   }
               }
               $attribs['style'] = str_replace($old,$new,$attribs['style']);
           }
           
           if (!$width){
               $width = 100;
               $attribs['style'].= 'width:75px;';
           }*/
           
           $attribs['class'].= ' item ui-input-num icon';


           $btns = ' <span class="item numeric"> '
                 . '   <div class="ui-button ui-state-default up" nofocus="1" parent="' . $id . '" onClick="if(!$(this).attr(\'disabled\')){jQuery(\'#\' + $(this).attr(\'parent\')).Tdata(\'TNumeric\').incNumber();}" type="button"> '
                 . '      <span class="ui-icon ui-icon-triangle-1-n"/> '
                 . '   </div> '
                 . '   <div class="ui-button ui-state-default down" nofocus="1" parent="' . $id . '" onClick="if(!$(this).attr(\'disabled\')){jQuery(\'#\' + $(this).attr(\'parent\')).Tdata(\'TNumeric\').decNumber();}" type="button"> '
                 . '      <span class="ui-icon ui-icon-spinner-down"/> '
                 . '   </div> '
                 . ' </span> ';

           $xhtml = '<div class="ui-form-group"> '
                  . '     ' . $this->view->formText($id, $value, $attribs)
                  . $btns
                  . '</div>';
           return $xhtml;
       }

   }
   