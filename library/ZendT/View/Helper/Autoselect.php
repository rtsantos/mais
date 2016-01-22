<?php

   /**
    * 
    * @category    ZendT
    * @author      rsantos
    */

   /**
    * jQuery para criação do AutoSelect
    *
    */
   class ZendT_View_Helper_Autoselect extends ZendX_JQuery_View_Helper_UiWidget {

       /**
        * Cria um campo texto com autocomplete customizado
        *
        * @param  string $id
        * @param  string $value
        * @param  array  $params jQuery Widget Parameters
        * @param  array  $attribs HTML Element Attributes
        * @return string
        */
       public function autoselect($id, $value = null, array $attribs = array()) {
           $params = $attribs['jQueryParams'];
           $attribs['class'] .= ' ui-input-auto';
           
           unset($attribs['jQueryParams']);
           unset($attribs['autocomplete']);
           unset($attribs['options']);
           unset($attribs['button']);
           //unset($attribs['fields']);
           unset($attribs['propId']);
           unset($attribs['propSearch']);
           unset($attribs['autoComplete']);
           unset($attribs['belongsTo']);
           
           /*echo '<pre>';
           print_r($attribs);
           echo '</pre>';*/


           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/layout/jquery/widget/TAutoSelect.js');

           $params = array();
           $fields = array();
           foreach ($attribs['fields'] as $field) {
               array_push($fields, $field);
           }
           if ($attribs['mapperView']) {
               $_mapper = new $attribs['mapperView']();
               $_where = new ZendT_Db_Where();
               if ($attribs['where']){
                   if (substr($attribs['where'],0,11) == 'expression:'){
                       $_where->addFilter(' ',substr($attribs['where'],11),'EXPRESSION');
                   }else{
                       $_where->addFilter('id', $attribs['where']);
                   }
               }
               if ($attribs['fieldLevel']){
                   $fields[] = $attribs['fieldLevel'];
               }
               if ($attribs['fieldOrder']){
                   $order = $attribs['fieldOrder'];
               }else{
                   $order = $fields[1];
               }
			   Zend_Controller_Front::getInstance()->getRequest()->setParam('autoselectFilter', true);
               $_mapper->findAll($_where, $fields, $order);
			   Zend_Controller_Front::getInstance()->getRequest()->setParam('autoselectFilter', false);
               
               $sourceData = array();
               while ($_mapper->fetch()) {
                   $data = $_mapper->getData();
                   $row = array();
                   $row['value'] = $data[$fields[0]]->get();
                   $row['desc'] = $data[$fields[1]]->get();
                   if ($attribs['fieldLevel']){
                       $row['level'] = $data[$fields[2]]->toPhp();
                   }else{
                       $row['level'] = 0;
                   }
                   $sourceData[] = $row;
                   if ($value == $row['value']) {
                       $params['loadValue'] = $row['desc'];
                   }
               }
           }
           
           if (isset($attribs['sourceData'])){
               $sourceData = $attribs['sourceData'];
               unset($attribs['sourceData']);
           }
           
           /*if (count($sourceData) == 0 || !is_array($sourceData)){
               throw new ZendT_Exception('Propriedade "sourceData" não definida!');
           }*/
           
           if ($attribs['suffix']){
               $nameId = 'id_' . $attribs['suffix'];               
           }
           
           if ($attribs['prefix']){
               $nameId = $attribs['prefix'] . '_id';
           }
           
           /**
            * @todo encontrar a melhor maneira de implementação
            */
           $required = $attribs['required'];
           $attribs['class'] = str_replace('required','',$attribs['class']);
           
           unset($attribs['fields']);
           unset($attribs['mapperView']);
           unset($attribs['suffix']);
           unset($attribs['prefix']);
           unset($attribs['caption']);
           unset($attribs['required']);
           unset($attribs['where']);
           unset($attribs['fieldLevel']);
           unset($attribs['fieldOrder']);
           
           $params['sourceData'] = $sourceData;
           $params['fieldValue'] = $nameId;
           $attribs['TAutoSelect'] = '1';
           $attribs['role'] = '';
           //var_dump($params);
           $params = ZendT_JS_Json::encode($params);
           $this->jquery->addOnLoad('jQuery("#' . $id . '").TAutoSelect(' . $params . ');');
           return $this->view->formText($id, '', $attribs) . 
                  $this->view->formHidden($nameId, '',array('required'=>$required
                                                           ,'TAutoSelect'=>'1'
                                                           ,'role'=>$id));
       }

   }
   