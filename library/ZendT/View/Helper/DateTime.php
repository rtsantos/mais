<?php

   /**
    * 
    * @category    ZendT
    * @author      ksantoja
    */

   /**
    * jQuery para criação de um campo Date e um campo Time linkados 
    *
    */
   class ZendT_View_Helper_DateTime extends ZendX_JQuery_View_Helper_UiWidget {

       /**
        *  Cria um campo texto para numeros, com incremento, verificação, valor maximo e outro (ler arquivo TDateTime.js)
        *
        * @param  string $id
        * @param  string $value
        * @param  array  $params jQuery Widget Parameters
        * @param  array  $attribs HTML Element Attributes
        * @return string
        */
       public function dateTime($id, $value = null, array $attribs = array()) {
           $date = $attribs['propDate'];
           $time = $attribs['propTime'];
           $params = $attribs['jQueryParams'];

           unset($attribs['propDate']);
           unset($attribs['propTime']);
           unset($attribs['jQueryParams']);

           $data = date('dmy');
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/extra/jquery.autocomplete.js?' . $data);
           $this->view->headLink()->appendStylesheet(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/extra/jquery.autocomplete.css?' . $data);
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/layout/jquery/widget/TTime.js?' . $data);
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/layout/jquery/widget/TDate.js?' . $data);
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TDateTime.js?' . $data);

           $params = ZendX_JQuery::encodeJson($params);

           $this->jquery->addOnLoad('jQuery("#' . $id . '").TDateTime(' . $params . ');');
           
           $xDate = '<div class="ui-form-group">'
                  . $date->addClass('ui-input-date')->setAttrib('button','btn_' . $date->getId())->setAttrib('noLabelError',1)->render()
                  . '<label class="popover fade bottom in error" for="'.$date->getId().'" generated="true" style="display:none"></label>'
                  . '</div>';
           
           $xTime = '<div class="ui-form-group">'
                  . $time->addClass('ui-input-time')->setAttrib('button','btn_' . $time->getId())->setAttrib('noLabelError',1)->render()
                  . '<label class="popover fade bottom in error" for="'.$time->getId().'" generated="true" style="display:none"></label>'
                  . '</div>';
           
           

           return $this->view->formHidden($id, $value, $attribs)
                 . $xDate
                 . $xTime;
       }

   }