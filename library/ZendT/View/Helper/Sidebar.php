<?php

   class ZendT_View_Helper_Sidebar {

       public function sidebar($array, $select = "") {
           
           /*echo '<pre>';
           print_r($array);
           echo '</pre>';*/
           
           $xhtml = "";
           $xhtml .= '<div class="ui-column ui-sidebar" id="div_painel_esquerda">';
           $xhtml .= $this->_getHtml($array, $select);
           $xhtml .= '</div>';
           return $xhtml;
       }

       protected function _getHtml(&$array, $select, $level = 0, &$isActive = '', $parentId = 'menu-root') {
           $classActive = "active hover";

           if ($level == 0) {
               $ulProp = ' class="ui-nav"';
           } else if ($level == 1) {
               $ulProp = ' class="sidebar-menu" role="' . $parentId . '"';
           } else {
               $ulProp = '';
           }

           $xhtml = '<ul' . $ulProp . '>';
		   if(count($array[$parentId])){
			   foreach ($array[$parentId] as $key => $value) {
				   $active = '';
				   if ($value['id'] == $select) {
					   $active = $classActive;
					   $isActive = true;
				   }

				   $go = '';
				   $itens = '';
				   if (isset($array[$value['id']])) {
					   $levelItem = $level + 1;
					   $isActive = false;
					   $itens.= $this->_getHtml($array, $select, $levelItem, $isActive, $value['id']);
					   if ($isActive) {
						   $active = $classActive;
					   }
				   } else {
					   $go = ' t-href="' . $value['url'] . '"';
				   }

				   $xhtml.= '<li id="' . $value['id'] . '" class="' . $active . ' ui-helper-clearfix"' . $go . '>&nbsp;' . "\n";

				   $class = '';
				   if ($level == 1 && $itens) {
					   $class = ' class="item-li"';
				   }
				   if ($level > 0) {
					   $xhtml.= '<span class="ui-icon">&nbsp;</span>';
				   }
				   $xhtml.= '<span' . $class . '>' . $value['desc'] . '</span>' . "\n";
				   if ($level == 0 && $itens) {
					   if ($isActive) {
						   $xhtml.= '<span class="ui-icon go open">&nbsp;</span>';
					   } else {
						   $xhtml.= '<span class="ui-icon go">&nbsp;</span>';
					   }
				   }
				   $xhtml.= $itens . "\n";
				   $xhtml.= '</li>' . "\n";
				   unset($array[$parentId][$key]);
			   }
		   }
           unset($array[$parentId]);
           $xhtml.= '</ul>';
           return $xhtml;
       }

   }
   