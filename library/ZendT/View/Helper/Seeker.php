<?php

   /**
    * 
    * @category    ZendT
    * @author      ksantoja
    */

   /**
    * jQuery ativação do seeker
    *
    */
   class ZendT_View_Helper_Seeker extends ZendX_JQuery_View_Helper_UiWidget {

       private $_arrayName = '';

       /**
        *
        * @param string $element
        * @param string $suffix
        * @return string 
        */
       private function _renderElement($element, $value, $suffix, $prefix = '', $searchId = '') {
           /**
            * Remove as expressões colcoadas em filtros do Grid
            * Exemplo: id >2
            */
           if ($value && !is_array($value) && !is_numeric($value)) {
               $value = '';
           }


           if ($suffix) {
               $name = $element->getName();
               $name.= '_' . $suffix;
               if ($this->_arrayName) {
                   $name = $this->_arrayName . '[' . $name . ']';
               }
               $element->setName($name);
           }

           if ($prefix) {
               $name = $prefix . '_' . $element->getName();
               if ($this->_arrayName) {
                   $name = $this->_arrayName . '[' . $name . ']';
               }
               $element->setName($name);
           }

           $field = $element->getAttrib('field');
           if (isset($value[$field])) {
               $_value = $value[$field];
               if ($_value instanceof ZendT_Type) {
                   $_value = $_value->get();
               }
               $element->setValue($_value)
                     ->setAttrib('valueold', $_value);
           }
           $element->addClass('item');
           if ($searchId)
               $element->setAttrib('searchId', $searchId);
           return $element->render();
       }

       /**
        *
        * @param string $content
        * @return string 
        */
       public function seeker($id, $value = null, array $attribs = array()) {
           if ($value == '!') {
               $value = '';
           }

           if ($value && (is_numeric($value) || $value instanceof ZendT_Type) && isset($attribs['mapperView']) && !$value instanceof ZendT_Db_Recordset) {
               $mapper = new $attribs['mapperView']();
               $value = $mapper->setId($value)->retrieveRow();
           }
           if ($value instanceof ZendT_Db_Recordset) {
               $data = array();
               while ($row = $value->getRow()) {
                   $item = array();
                   foreach ($row as $itemKey => $itemValue) {
                       $item[$itemKey] = $itemValue->get();
                   }
                   $data[] = $item;
               }
               $value = $data;
               if (!$attribs['multiple']) {
                   $value = $value[0];
               }
           }
           
           /*$post = Zend_Controller_Front::getInstance()->getRequest()->getParams();
           var_dump($post);
           var_dump($value);*/
           
           $params = array();
           $params['elements'] = array();
           /**
            * @todo implementar o value 
            */
           $search = $attribs['propSearch'];
           $suffix = $attribs['suffix'];
           $prefix = $attribs['prefix'];
           $this->_arrayName = $attribs['arrayName'];
           if (!$suffix && !$prefix)
               $suffix = $id;

           if ($attribs['required']) {
               $search->setRequired();
           }
           $xhtmlElements = '';


           $labels = array();

           /**
            * Cria o elemento de Search 
            */
           $field = $attribs['propSearch']->getAttrib('field');
           $attribs['propSearch']->setAttrib('noLabelError', true);
           $params['fields'][] = $field;
           if (isset($attribs['belongsTo'])) {
               $attribs['propSearch']->setBelongsTo($attribs['belongsTo']);
           }
           
           if (isset($attribs['style'])){
               $attribs['propSearch']->setAttrib('style',$attribs['style']);
           }
           
           if (isset($attribs['readonly'])){
               $attribs['propSearch']->setAttrib('readonly',$attribs['readonly']);
           }
           
           $xhtmlElements.= $this->_renderElement($attribs['propSearch'], $value, $suffix, $prefix);
           unset($attribs['fields'][$field]);
           $searchId = $attribs['propSearch']->getId();

           $labels[] = $attribs['propSearch']->getAttrib('label');
           if (isset($attribs['propDisplay'])) {
               $labels[] = $attribs['propDisplay']->getAttrib('label');
           }
           /**
            * 
            */
           $renderKeys = array('propId', 'propDisplay');
           foreach ($renderKeys as $key) {
               if (isset($attribs[$key])) {
                   $field = $attribs[$key]->getAttrib('field');
                   $params['fields'][] = $field;


                   if (isset($attribs['belongsTo'])) {
                       $attribs[$key]->setBelongsTo($attribs['belongsTo']);
                   }
                   $xhtmlElements.= $this->_renderElement($attribs[$key], $value, $suffix, $prefix, $searchId);
                   if ($key == 'propId') {
                       $nameId = $attribs['propId']->getId();
                   }
                   unset($attribs['fields'][$field]);
               }
           }

           $params['elements']['others'] = array();
           foreach ($attribs['fields'] as $field) {
               $key = 'prop' . ucfirst($field);
               $labels[] = $attribs[$key]->getAttrib('label');

               if (isset($attribs['belongsTo'])) {
                   $attribs[$key]->setBelongsTo($attribs['belongsTo']);
               }
               $xhtmlElements.= $this->_renderElement($attribs[$key], $value, $suffix, $prefix, $searchId);

               $params['fields'][] = $field;
               $params['elements']['others'][] = $attribs[$key]->getId();

               unset($attribs[$key]);
           }

           $attribs['button']->addClass('ui-button item ui-state-default last');
           if ($suffix) {
               $nameButton = $attribs['button']->getName();
               $nameButton.= '_' . $suffix;
               $attribs['button']->setName($nameButton);
           }
           if ($prefix) {
               $nameButton = $prefix . '_' . $attribs['button']->getName();
               $attribs['button']->setName($nameButton);
           }
           $attribs['button']->setAttrib('searchId', $searchId);
           $xhtmlElements.= $attribs['button']->render();

           $params['elements']['div'] = str_replace('btSearch_', 'div_grid_', $nameButton);
           $xhtmlElements.= '<div id="' . $params['elements']['div'] . '" style="display:none" class="div-grid-seeker" searchId="' . $searchId . '"></div>';
           $xhtmlElements.= '<label class="error" for="' . $searchId . '" generated="true" style="display:none"></label>';
           if ($attribs['multiple']) {
               $xhtmlElements.= '<input type="hidden" name="' . $nameId . '-multiple" id="' . $nameId . '-multiple" />';
               
               $tableTitles = '<tr id="table-title-' . $attribs['id'] . '-multiple" class="ui-corner-all ui-state-default" style="display:none;">';
               foreach ($labels as $label) {
                   $tableTitles.= '<th>';
                   $tableTitles.= $label;
                   $tableTitles.= '</th>';
               }
               $tableTitles.= '</tr>';

               $xhtmlElements.= '<div id="div-' . $attribs['id'] . '-multiple" style="float:left;clear:both;">
                <table id="table-' . $attribs['id'] . '-multiple" boder="0" cellspacing="0" cellpadding="2">
                    ' . $tableTitles . '
                </table>
                </div>';
           }
           /**
            * Inicio da montagem de parâmetros do TSeeker 
            */
           $params['name'] = $searchId;
           if (isset($attribs['onFilter'])) {
               //$attribs['onFilter'] = str_replace("'", "\'", $attribs['onFilter']);
               $params['onFilter'] = new ZendT_JS_Command($attribs['onFilter']);
           }
           if (isset($attribs['onSearchValid'])) {
               $params['onSearchValid'] = new ZendT_JS_Command($attribs['onSearchValid']);
           }
           if (isset($attribs['onChange'])) {
               $params['onChange'] = new ZendT_JS_Command($attribs['onChange']);
           }
           if (isset($attribs['autoComplete']['onResult'])) {
               $params['autoComplete']['onResult'] = new ZendT_JS_Command($attribs['autoComplete']['onResult']);
           }
           if (isset($attribs['autoComplete']['onFormat'])) {
               $params['autoComplete']['onFormat'] = new ZendT_JS_Command($attribs['autoComplete']['onFormat']);
           }
           if (isset($attribs['autoComplete']['extraParams'])) {
               $params['autoComplete']['extraParams'] = $attribs['autoComplete']['extraParams'];
           }
           if (isset($attribs['onNotFound'])) {
               $params['onNotFound'] = new ZendT_JS_Command($attribs['onNotFound']);
           }
           if (isset($attribs['multiple'])) {
               $params['multiple'] = $attribs['multiple'];
           }
           if (isset($attribs['filterRefer'])) {
               $params['filterRefer'] = $attribs['filterRefer'];
           }
           $params['elements']['id'] = $attribs['propId']->getId();
           $params['elements']['search'] = $searchId;
           $params['elements']['button'] = $attribs['button']->getId();
           if (isset($attribs['propDisplay'])) {
               $params['elements']['display'] = $attribs['propDisplay']->getId();
           } else {
               $params['elements']['display'] = '';
           }
           $params['modal'] = $attribs['jQueryParams']['modal'];
           $params['modal']['type'] = strtoupper($params['modal']['type']);
           if (!in_array($params['modal']['type'], array('DIV', 'WINDOW'))) {
               $params['modal']['type'] = 'WINDOW';
           }
           $params['url'] = $attribs['jQueryParams']['url'];
           if ($attribs['multiple']) {
               $params['data'] = $value;
           }
           /**
            * Cria os parâmetros para renderizar o seeker no jQuery
            */
           $this->view->headLink()->appendStylesheet(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/extra/jquery.autocomplete.css');
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/extra/jquery.autocomplete.js');
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TAutocomplete.js');
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TSeeker.js');

           $params = ZendT_JS_Json::encode($params);
           $params = str_replace('{id}', $searchId, $params);

           $js = 'jQuery("#' . $searchId . '").TSeeker(' . $params . ');';
           $this->jquery->addOnLoad($js);
           /**
            * Limpa a memória 
            */
           unset($attribs['button']);
           unset($attribs['propId']);
           unset($attribs['propSearch']);
           unset($attribs['propDisplay']);
           unset($attribs['onFilter']);
           unset($attribs['onChange']);
           unset($attribs['onNotFound']);
           unset($attribs['onResult']);
           unset($attribs['onSearchValid']);
           unset($attribs['filterRefer']);
           unset($attribs['where']);

           return '<div class="ui-form-group">' . $xhtmlElements . '</div>';
       }

   }
   