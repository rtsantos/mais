<?php

   /**
    * 
    * @category    ZendT
    * @author      rsantos
    */
   class ZendT_View_Helper_FileUpload extends ZendX_JQuery_View_Helper_UiWidget {

       private function _prepareName($name, $sufix) {
           if ($sufix) {
               if (substr($name, (strlen($name) - 1), 1) == ']') {
                   $name = substr($name, 0, (strlen($name) - 1)) . '_' . $sufix . ']';
               } else {
                   $name.= '_' . $sufix;
               }
           }
           return $name;
       }

       /**
        * Cria cria um campo hidden, um campo para id, um para descrição e um botão para a busca no seeker.
        *
        * @param  string $id
        * @param  string $value
        * @param  array  $params jQuery Widget Parameters
        * @param  array  $attribs HTML Element Attributes
        * @return string
        */
       public function fileUpload($id, $value = null, array $attribs = array()) {

           /* echo '<pre>';
             print_r($attribs);
             echo '</pre>';
             exit; */

           if ($value instanceof ZendT_Type_FileSystem) {
               $_file = $value->getFile();
               if ($_file) {
                   $attribs['jQueryParams']['data']['name'] = $_file->getName();
                   $attribs['jQueryParams']['data']['type'] = $_file->getType();
                   $attribs['jQueryParams']['data']['id'] = $_file->getId();
                   $attribs['jQueryParams']['data']['filename'] = $_file->toFilenameCrypt();
                   $value = $_file->getName();
               } else {
                   $value = "";
               }
           }

           $params = $attribs['jQueryParams'];
           unset($attribs['jQueryParams']);

           if (!isset($attribs['name'])) {
               $attribs['name'] = $attribs['id'];
           }

           $id = $this->view->escape($id);
           $name = $this->view->escape($attribs['name']);

           $list = '<ul id="' . $id . '_menu" class="dropdown-menu position" role="' . $id . '" style="width: 270px;">';
           $list.= '   <li class="ui-no-hover dropdown-menu-group footer">';
           $list.= '      <ul class="facescroll" style="width: 260px; height: 130px;" id="files-selected-' . $id . '">';
           $list.= '      </ul>';
           $list.= '      <button type="button" id="clear-files-' . $id . '" class="ui-button ok ui-state-default">';
           $list.= '         <span class="ui-icon ui-icon-close"></span>';
           $list.= '         <span class="ui-text">Limpar</span>';
           $list.= '      </button>';
           $list.= '      &nbsp;';
           $list.= '   </li>';
           $list.= '</ul>';

           $inputAuto = "ui-input-auto";
           $xhtml = '<input style="width: 270px;" type="text" id="' . $id . '" name="' . $name . '_display" class="item ' . $inputAuto . '" placeholder="' . $value . '" />';

           if ($params['load_id']) {
               $xhtml .= '<input type="hidden" name="' . $name . '[id]" id="' . $id . '_id" />
                          <input type="hidden" name="' . $name . '[file]" id="' . $id . '_file" />
                          <input type="hidden" name="' . $name . '[type]" id="' . $id . '_type" />
                          <input type="hidden" name="' . $name . '[name]" id="' . $id . '_name" />';
           } else {
               $nameType = $this->_prepareName($name, 'type');
               $nameName = $this->_prepareName($name, 'name');
               $nameId = $this->_prepareName($name, 'id');

               $xhtml .=
                     '<input type="hidden" name="' . $name . '"     id="' . $id . '_file" />
                         <input type="hidden" name="' . $nameType . '" id="' . $id . '_type" />
                         <input type="hidden" name="' . $nameName . '" id="' . $id . '_name" />
                         <input type="hidden" name="' . $nameId . '"   id="' . $id . '_id" />';
           }

           /* if ($params['multiple']) {
             $xhtml.= $list;
             $xhtml.= '<button type="button" id="dropdown-files-' . $id . '" class="ui-button item ui-state-default"><span class="ui-icon ui-icon ui-icon-triangle-1-s"></button>';
             } else {
             $xhtml.= '<button type="button" id="download-files-' . $id . '" class="ui-button item ui-state-default"><span class="ui-icon ui-icon-arrowthickstop-1-s"></button>';
             $xhtml.= '<button type="button" id="clear-files-' . $id . '" class="ui-button item ui-state-default"><span class="ui-icon ui-icon-close"></button>';
             } */
           $xhtml.= $list;
           //$xhtml.= '<button type="button" id="dropdown-files-' . $id . '" class="ui-button item ui-state-default"><span class="ui-icon ui-icon ui-icon-triangle-1-s"></button>';
           $xhtml.= '<button type="button" id="select-files-' . $id . '" class="ui-button item ui-state-default"><span class="ui-icon ui-icon-folder-open"></button>';
           $xhtml.= '<div style="clear:both">';
           $xhtml.= '  <label class="error" id="error-'.$id.'"></label>';
           $xhtml.= '</div>';

           $params['elements']['container'] = 'group-' . $id;
           $params['elements']['files-selected'] = 'files-selected-' . $id;
           $params['elements']['selectFiles'] = 'select-files-' . $id;
           $params['elements']['clearFiles'] = 'clear-files-' . $id;
           $params['elements']['startUpload'] = 'start-upload-' . $id;
           $params['elements']['id'] = $id;
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/plupload/plupload.js');
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/plupload/plupload.gears.js');
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/plupload/plupload.silverlight.js');
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/plupload/plupload.flash.js');
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/plupload/plupload.html4.js');
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/plupload/plupload.html5.js');
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/layout/jquery/widget/TJQuery.js');
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/layout/jquery/widget/TFileUpload.js');
           $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/layout/jquery/widget/TDropdown.js');

           $this->jquery->addOnLoad('jQuery("#' . $id . '").TFileUpload(' . ZendT_JS_Json::encode($params) . ');');
           //if ($params['multiple']) {
           $this->jquery->addOnLoad('jQuery("#' . $id . '_menu").TDropdown({configsHideShow:{events:[\'focus\']}});');
           //}
           return '<div class="ui-form-group">' . $xhtml . '</div>';
       }

   }
   