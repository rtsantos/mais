<?php

   /*
    * @category    ZendT
    * @author      jcarlos
    * 
    */

   class ZendT_Grid_Toolbar implements ZendT_JS_Interface {

       /**
        * Receberá todos os botões adicionados na Navigator bar
        * do grid em questão
        * 
        * @var type ZendT_Grid_Button[]
        */
       private $_buttons;

       /**
        *
        * @var type integer
        */
       private $_idGrid;

       /**
        * Irá receber o js para renderização desta instância
        * que servirá para implementação no grid
        * 
        * @var type string
        */
       private $_js;

       public function __construct($idGrid) {
           $this->setIdGrid($idGrid);
       }

       /**
        *
        * @return ZendT_Grid_Button[]
        */
       public function getButtons() {
           return $this->_buttons;
       }

       public function setButtons($_buttons) {
           $this->_buttons = $_buttons;
           return $this;
       }

       public function setButton($key, $button, $group) {
           if (!$group) {
               $group = 'default';
           }
           $this->_buttons[$group][$key] = $button;
           return $this;
       }

       /**
        *
        * @param string $key
        * @return ZendT_Grid_Button 
        */
       public function getButton($key) {
           foreach($this->_buttons as $buttons){
               if (isset($buttons[$key])){
                   return $buttons[$key];
               }
           }
           return false;
       }

       /**
        * Remove um botão da Toolbar
        * 
        * @param string $key
        * @return \ZendT_Grid_Toolbar 
        */
       public function removeButton($key) {
           foreach($this->_buttons as $group=>$buttons){
               if (isset($buttons[$key])){
                   unset($this->_buttons[$group][$key]);
               }
           }
           return $this;
       }

       public function getIdGrid() {
           return $this->_idGrid;
       }

       public function setIdGrid($idGrid) {
           $this->_idGrid = $idGrid;
           return $this;
       }

       public function getHtml() {
           return $this->_html;
       }

       public function setHtml($html) {
           $this->_html = $html;
           return $this;
       }

       public function getJs() {
           return $this->_js;
       }

       public function setJs($js) {
           $this->_js = $js;
           return $this;
       }

       public function createJS() {

           $buttons = $this->getButtons();
           if (!empty($buttons)) {
               foreach ($buttons as $group => $groups) {
                   $name = str_replace(' ','-',strtolower($group));
                   $js.= '<div id="'.$name.'" class="ui-group">';
                   foreach ($groups as $button) {
                       $js.= $button->addClass('item')->renderHtml();
                   }
                   $js.= '</div>';
               }
           }
           $js = ".appendToolbar('" . $this->getIdGrid() . "','".str_replace(array(chr(10),chr(13),"'"), '',  $js)."')";
           return $js;
       }

       public function render() {
           $this->setJs($this->createJS());
           return $this->getJs();
       }

   }

?>
