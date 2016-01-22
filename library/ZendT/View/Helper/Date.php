<?php

   /**
    * 
    * @category    ZendT
    * @author      ksantoja
    */

   /**
    * jQuery para criação do Date
    *
    */
   class ZendT_View_Helper_Date extends ZendX_JQuery_View_Helper_UiWidget {

       /**
        *  Cria um campo texto com validador de data e datepicker
        *
        * @param  string $id
        * @param  string $value
        * @param  array  $params jQuery Widget Parameters
        * @param  array  $attribs HTML Element Attributes
        * @return string
        */
       public function date($id, $value = null, array $attribs = array()) {
           $data = date('dmy');
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/layout/jquery/widget/TDate.js?' . $data);

           $params = ZendX_JQuery::encodeJson($attribs['jQueryParams']);
           unset($attribs['jQueryParams']);
           
           $attribs['class'].=' ui-input-date';

           $xhtml.= '<div class="ui-form-group">'
                  . $this->view->formText($id, $value, $attribs)
                  . '</div>';

           $this->jquery->addOnLoad('jQuery("#' . $id . '").TDate(' . $params . ');');
           return $xhtml;
       }

   }
   