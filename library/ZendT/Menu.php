<?php 
   /**
    * 
    * @author rsantos
    * @category My
    * @package Menu
    *
    */
   class ZendT_Menu {      
      private $_cmd;
      private $_data;
      private $_urlBase;
      /**
	  *
       */
      public function __construct($data,$urlBase){
         $this->_data = $data;
         $this->_urlBase = $urlBase;
      }
      
      public function __destruct(){
         $this->_cmd = null;
         $this->_data = null;
         $this->_urlBase = null;
      }
      
      private function twoLevel($indexParent){
         $this->_cmd.= '<ul>'."\n";         
         foreach ($this->_data[$indexParent] as &$data){            
            if (!isset($this->_data[$data['url']])){
               $this->_cmd.= '<li><a href="#" onclick="document.location.href=\''.$data['url'].'\';">'.$data['desc'].'</a></li>'."\n";
            }else{
               $this->_cmd.= '<li><a href="#">'.$data['desc'].'</a>'."\n";
               $this->twoLevel($data['url']);
               $this->_cmd.= '</li>'."\n";
            }
         }
         unset($this->_data[$indexParent]);
         $this->_cmd.= '</ul>'."\n";
      }
      
      private function oneLevel($indexParent){
         if (isset($this->_data[$indexParent])){
            if (is_array($this->_data[$indexParent])){
               foreach ($this->_data[$indexParent] as &$data){
                  $this->_cmd.= '<div id="div-'.str_replace(array('.','/'),array('_','_'),$data['url']).'" class="hidden">'."\n";
                  if (isset($this->_data[$data['url']])){
                     $this->twoLevel($data['url']);
                  }
                  unset($this->_data[$data['url']]);
                  $this->_cmd.= '</div>'."\n";
               }
            }
         }
      }
      
      public function build(){
         $this->_cmd = '';
         #print_r($this->_data);
         foreach ($this->_data as $key=> &$data){
            if (isset($this->_data[$key])){
               foreach ($data as $menu){               
                  $this->_cmd.= '<div>'."\n";
                  if (isset($this->_data[$menu['url']])){
                     $this->_cmd.= '<a href="#div-'.str_replace(array('.','/'),array('_','_'),$menu['url']).'" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all">'."\n";
                     $this->_cmd.= '<span class="ui-icon ui-icon-triangle-1-s"></span>'."\n";  
                  }else{
                     $this->_cmd.= '<a href="'.$menu['url'].'" class="fg-button ui-state-default">'."\n";
                  }
                  $this->_cmd.= $menu['desc'];
                  $this->_cmd.= '</a>'."\n";
                  $this->_cmd.= '</div>'."\n";
               }
               $this->oneLevel($key);
            }
            unset($this->_data[$key]);
         }
         if ($this->_cmd){
             $this->_cmd.= '<div style="clear:both"></div>'."\n";
         }
         return $this->_cmd;
      }
   }
?>
<?php
/*
class ZendT_Menu {

    private static $_instance;

    public function __construct(){
    }

    public static function getInstance(){

        if( self::$_instance == NULL ){
            self::$_instance = new ZendT_Menu();
        }

        return self::$_instance;
    }
    public function buildMenu( $value ){
        ob_start();
        echo '<ul>';
        if (!is_array($value)){
            $value = array();
        }
        foreach ($value as $key => $item) {
            if(is_array($item)){
                echo '<li>' .
                        '<a href="#" class="submenu-link fg-button fg-button-icon-right ui-state-default mais">' . 
                            utf8_encode(ucfirst(strtolower($key))) .
                            '<span class="ui-icon ui-icon-triangle-1-s right"></span>' .
                        '</a>' .
                        $this->buildMenu($item) .
                        '</li>';
            } else {
                echo    '<li>' .
                            '<a href="' . $key . '">' . 
                                utf8_encode(ucfirst(strtolower($item))) .
                            '</a>' .
                        '</li>';
            }
        }
        echo '</ul>';
        return ob_get_clean();
    }

}*/
?>
