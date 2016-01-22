<?php

   class Layout_Menu {

       /**
        *
        * @var type 
        */
       private $_html;

       /**
        *
        * @var type 
        */
       private $_data;

       /**
        *
        * @var type 
        */
       private $_urlBase;

       /**
        *
        * @var bool
        */
       private $_legado;

       /**
        *
        * @var type 
        */
       private $_filters;

       /**
        *
        * @param array $data
        * @param string $urlBase
        * @param bool $legado 
        */
       public function __construct($data, $urlBase, $legado = false, $filters = array()) {
           $this->_data = $data;
           $this->_urlBase = $urlBase;
           $this->_legado = $legado;
           $this->_filters = $filters;
       }

       /**
        * 
        */
       public function __destruct() {
           $this->_html = null;
           $this->_data = null;
           $this->_urlBase = null;
       }

       /**
        *
        * @param type $value
        * @return type 
        */
       private function _filter($value) {
           $this->_filters = array('utf8_decode');
           if (count($this->_filters) > 0) {
               foreach ($this->_filters as $filter) {
                   $value = $filter($value);
               }
           }
           return $value;
       }

       /**
        *
        * @param string $indexParent 
        */
       private function _renderItensTwo($indexParent) {
           $this->_html.= '<ul>' . "\n";
           foreach ($this->_data[$indexParent] as &$data) {
               if (!isset($this->_data[$data['url']])) {
                   $this->_html.= '<li><a href="#" onclick="document.location.href=\'' . $data['url'] . '\';">' . $this->_filter($data['desc']) . '</a></li>' . "\n";
               } else {
                   $this->_html.= '<li><a href="#">' . $this->_filter($data['desc']) . '</a>' . "\n";
                   $this->_renderItensTwo($data['url']);
                   $this->_html.= '</li>' . "\n";
               }
           }
           unset($this->_data[$indexParent]);
           $this->_html.= '</ul>' . "\n";
       }

       /**
        *
        * @param string $indexParent 
        */
       private function _renderItensOne($indexParent) {
           if (isset($this->_data[$indexParent])) {
               if (is_array($this->_data[$indexParent])) {
                   foreach ($this->_data[$indexParent] as &$data) {
                       $this->_html.= '<div id="div-' . str_replace(array('.', '/', ' ', '\\'), '_', $data['url']) . '" class="hidden">' . "\n";
                       if (isset($this->_data[$data['url']])) {
                           $this->_renderItensTwo($data['url']);
                       }
                       unset($this->_data[$data['url']]);
                       $this->_html.= '</div>' . "\n";
                   }
               }
           }
       }

       /**
        *
        * @return string
        */
       public function _renderPlatform() {
           $this->_html = '';
           #print_r($this->_data);
           foreach ($this->_data as $key => &$data) {
               if (isset($this->_data[$key])) {
                   foreach ($data as $menu) {
                       //$this->_html.= '<div>' . "\n";
                       if (isset($this->_data[$menu['url']])) {
                           $this->_html.= '<a href="#div-' . str_replace(array('.', '/', ' ', '\\'), '_', $menu['url']) . '" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all">' . "\n";
                           $this->_html.= '<span class="ui-icon ui-icon-triangle-1-s"></span>' . "\n";
                       } else {
                           $this->_html.= '<a href="' . $menu['url'] . '" class="fg-button ui-widget ui-state-default ui-corner-all">' . "\n";
                       }
                       $this->_html.= $this->_filter($menu['desc']);
                       $this->_html.= '</a>' . "\n";
                       //$this->_html.= '</div>' . "\n";
                   }
                   $this->_renderItensOne($key);
               }
               unset($this->_data[$key]);
           }
           if ($this->_html) {
               $this->_html.= '<div style="clear:both"></div>' . "\n";
           }
           return $this->_html;
       }

       /**
        *
        * @param array $pdata
        * @param string $plink 
        */
       private function _renderItensLegado(&$itens, $parent = '', $level = 0) {
           $level++;
           if ($level > 1) {
               $this->_html.= '<ul role="' . $parent . '" align="left" class="dropdown-menu tree">' . "\n";
           } else {
               $this->_html.= '<ul role="' . $parent . '" align="left" class="dropdown-menu position ui-no-radius-tr">' . "\n";
           }

           while (list($link, $data) = each($itens)) {
               $link = $this->_urlBase . $this->_filter($link);
               if (is_array($data)) {
                   $id = $parent . str_replace(array(' ', '.', '/', '\\'), '_', strtolower($link));
                   //$id = 'menu-' . removeAccent(strtolower($link));
                   $this->_html.= '<li class="link" id="' . $id . '">';
                   $this->_html.= ' <div class="ui-helper-clearfix">';
                   $this->_html.= '   <span class="ui-text">' . "\n";
                   $this->_html.= $link;
                   $this->_html.= '   </span>' . "\n";
                   if ($level == 0) {
                       $this->_html.= '   <span class="ui-icon ui-icon-carat-1-s">' . "\n";
                   } else {
                       $this->_html.= '   <span class="ui-icon ui-icon-carat-1-e">' . "\n";
                   }
                   $this->_html.= '   </span>' . "\n";
                   $this->_html.= ' </div>' . "\n";
                   $this->_html.= $this->_renderItensLegado($data, $id, $level);
                   $this->_html.= '</li>' . "\n";
               } else {
                   if (strtolower(substr($link, 0, 10)) == 'javascript') {
                       $this->_html.= '<li><a href="#" OnClick="' . substr($link, 11) . '">' . $this->_filter($data) . '</a></li>' . "\n";
                   } else {
                       $this->_html.= '<li><a href="#" OnClick="document.location.href=\'' . $link . '\'">' . $this->_filter($data) . '</a></li>' . "\n";
                   }
               }
           }
           $this->_html.= "</ul>\n";
       }

       /**
        *
        * @return string
        */
       private function _renderLegado() {
           /* echo '<pre>';
             print_r($this->_data);
             echo '</pre>';
             exit; */

           $this->_html = '';
           if (count($this->_data) > 0) {
               while (list($link, $data) = each($this->_data)) {
                   //$this->_html.= '<div>' . "\n";
                   $link = $this->_urlBase . $link;

                   //$id = 'menu-' . removeAccent(strtolower($link));                   
                   if (is_array($data)) {
                       $id = $this->_id($link);
                       $this->_html.= '<li id="' . $id . '" class="default ui-button">' . "\n";
                       $this->_html.= '   <span class="ui-text">' . "\n";
                       $this->_html.= '      ' . $this->_filter($link) . "\n";
                       $this->_html.= '   </span>' . "\n";
                       $this->_html.= '   <span class="ui-icon ui-icon-carat-1-s">' . "\n";
                       $this->_html.= '   </span>' . "\n";
                       $this->_html.= $this->_renderItensLegado($data, $id);
                   } else {
                       $this->_html.= '<li class="default ui-button">' . "\n";
                       $this->_html.= '   <span t-href="' . $link . '" class="ui-text">' . "\n";
                       $this->_html.= '      ' . $this->_filter($data) . "\n";
                       $this->_html.= '   </span>' . "\n";
                   }

                   $this->_html.= '</li>' . "\n";
               }
           }
           return $this->_html;
       }

       private function _id($value) {
           $newId = clearAccent(strtolower($value));
           return 'menu-' . $newId;
       }

       public function _renderItens($parent, $level = 2, $parentGroup = '') {
           $menu = '';
           if (isset($this->_data[$parent])) {

               $itens = $this->_data[$parent];

               if ($level == 2) {
                   $menu.= '<ul role="' . $this->_id($parent) . '" align="left" class="dropdown-menu position ui-no-radius-tr">' . "\n";
               } elseif ($parentGroup) {
                   $menu.= '<ul>' . "\n";
               } else {
                   $menu.= '<ul role="' . $this->_id($parent) . '" align="left" class="dropdown-menu tree">' . "\n";
               }

               $level++;
               foreach ($itens as $key => $item) {
                   $group = '';
                   if ($item['group']) {
                       $group = 'dropdown-menu-group';
                   }

                   if ($item['url']) {
                       $id = $this->_id($item['url']);
                   } else {
                       $id = $this->_id($item['desc']);
                   }
                   
                   $item['desc'] = $this->_filter($item['desc']);

                   if (isset($this->_data[$item['url']])) {
                       if (!$group) {
					       $menu.= '<li id="' . $id . '" class="link">' . "\n";
                           $menu.= '<div class="ui-helper-clearfix">' . "\n";
                           $menu.= '  <span class="ui-text">' . $item['desc'] . '</span>' . "\n";
                           $menu.= '  <span class="ui-icon ui-icon-carat-1-e">' . "\n";
                           $menu.= '</div>' . "\n";
                       } else {
					       $menu.= '<li id="' . $id . '" class="' . $group . '">' . "\n";
                           $menu.= '  <span>' . $item['desc'] . '</span>' . "\n";
                       }
                       $menu.= $this->_renderItens($item['url'], $level, ($parentGroup ? $parentGroup : $group)) . "\n";
                   } else {
				       $menu.= '<li id="' . $id . '" class="' . $group . '">' . "\n";
                       $menu.= ' <a href="' . $item['url'] . '">' . $item['desc'] . '</a>' . "\n";
                   }
                   $menu.= '</li>' . "\n";
                   unset($this->_data[$parent][$key]);
               }

               $menu.= '</ul>' . "\n";
           }
           return $menu;
       }

       /**
        *
        * @return string
        */
       public function _renderIntranet() {
           $this->_html = '';
           foreach ($this->_data as $key => &$data) {
               if (isset($this->_data[$key])) {
                   foreach ($data as &$menu) {
                       $desc = $this->_filter($menu['desc']);
                       if (isset($this->_data[$menu['url']])) {
                           $id = $this->_id($menu['url']);
                       } else {
                           $id = $this->_id($desc);
                       }

                       $link = '';
                       if (isset($this->_data[$menu['url']])) {

                           $this->_html.= '<div id="' . $id . '" class="default ui-button-icon" ' . $link . '>' . "\n";
                           $this->_html.= '   <span t-href="' . $menu['url'] . '" class="ui-text">' . "\n";
                           $this->_html.= '      ' . $desc . "\n";
                           $this->_html.= '   </span>' . "\n";
                           $this->_html.= '   <span class="ui-icon ui-icon-triangle-1-s">' . "\n";

                           $this->_html.= $this->_renderItens($menu['url']) . "\n";
                           unset($this->_data[$menu['url']]);
                       } else {
                           $this->_html.= '<div id="' . $id . '" class="default ui-button-icon" ' . $link . '>' . "\n";
                           $this->_html.= '   <span t-href="' . $menu['url'] . '" class="ui-text">' . "\n";
                           $this->_html.= '      ' . $desc . "\n";
                           $this->_html.= '   </span>' . "\n";
                       }


                       $this->_html.= '</div>' . "\n";
                       unset($menu);
                   }
               }
               unset($this->_data[$key]);
           }
           return $this->_html;
       }

       /**
        *
        * @return string 
        */
       public function render($layout = '') {
           if ($this->_legado) {
               return $this->_renderLegado();
           } else if ($layout == 'intranet') {
               return $this->_renderIntranet();
           } else {
               return $this->_renderPlatform();
           }
       }

   }

?>