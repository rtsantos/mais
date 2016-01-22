<?php
require_once('ZendT/Exception.php');
require_once('ZendT/Acl.php');
require_once('ZendT/Controller/Action.php');
require_once('ZendT/Controller/ActionCrud.php');
require_once('ZendT/Db/Table/Abstract.php');
require_once('ZendT/Acl/Resource/Interface.php');
/**
 * Classe para geração do arquivo View do módulo
 * 
 * @package ZendT
 * @subpackage Tool
 * @category Crud
 * @author rsantos
 */
class ZendT_Tool_Crud_MakeResources {
   public static $module;
   public static $path;
    
   public static function getArrayAZ(){
      return array('A','B','C','D','E','F','G','H','I','J','L','M','N','O','P','Q','R','S','T','U','V','X','Z','K','W','Y');
   }

   public static function getModules(){
      $moduleName = self::$module;

      $modules = array();
      
      $path = self::$path.'./application/modules/';
      $dir_handle = @opendir($path);      
      while ($file = readdir($dir_handle)){
         if ($file != '.' && $file != '..' && $file != '.svn'){
            if (is_dir($path.$file)){
               if ($moduleName != ''){
                  if ($moduleName == $file){
                     $modules[] = $file;
                  }  
               }else{
                  $modules[] = $file;   
               }
            }
         }
      }
      closedir($dir_handle);
      return $modules;
   }
   
   public static function getControllers($module){
      $path = self::$path.'\\application\\modules\\'.$module.'\\controllers\\';
      $controllers = glob($path."*Controller.php");
      $result = array();
      $i = 0;
      foreach ($controllers as &$controller){
         $fileName = str_replace($path,'',$controller);
         if ($fileName != 'ErrorController.php'){
            $result[$i]['path'] = $path;
            $result[$i]['fileName'] = $fileName;
            $result[$i]['className'] = str_replace('Controller.php','',$result[$i]['fileName']);
            $az = self::getArrayAZ();
            foreach ($az as $letra){
               $result[$i]['className'] = str_replace($letra,'-'.strtolower($letra),$result[$i]['className']);
            }
            if (substr($result[$i]['className'],0,1) == '-'){
               $result[$i]['className'] = substr($result[$i]['className'],1);
            }
            $i++;
         }
      }
      return $result; 
   }
   
   public static function getActions($className){
      $methods = get_class_methods($className);
      $result = array();
      foreach ($methods as &$method){
         if (strpos($method,'Action') > 0){
            $az = self::getArrayAZ();
            $method = str_replace('Action','',$method);
            foreach ($az as $letra){
               $method = str_replace($letra,'-'.strtolower($letra),$method);
            }
            $result[] = $method;
         }
      }
      return $result;
   }
   
   public static function getResources(){
      $resources = array();
      $modules = self::getModules();
      $idx=0;
      foreach ($modules as $module){
         $resources[$idx]['name']   = $module;
         $resources[$idx]['parent'] = '';
         $resources[$idx]['type']   = 'MODULE';
         $resources[$idx]['module'] = $module;
         $idx++;
         $controllers = self::getControllers($module);
         foreach ($controllers as $controller){
            $resources[$idx]['name']   = $module.'.'.$controller['className'];
            $resources[$idx]['parent'] = $module;
            $resources[$idx]['type']   = 'CONTROLLER';
            $resources[$idx]['module'] = $module;
            $idx++;
            
            $controllers = self::getControllers($module);
            require_once($controller['path'].$controller['fileName']);
            $className = str_replace('.php','',$controller['fileName']);

            if ($module != 'default'){
               $className = $module.'_'.$className;
            }
            $actions = self::getActions($className);
            foreach ($actions as $action){
               $resources[$idx]['name']   = $module.'.'.$controller['className'].'.'.$action;
               $resources[$idx]['parent'] = $module.'.'.$controller['className'];
               $resources[$idx]['type']   = 'ACTION';
               $resources[$idx]['module'] = $module;
               $idx++;
            }
         }
         ZendT_Acl::getInstance()->clearCache($module);
      }
      return $resources; 
   }
   /**
    *
    * @param type $pathBase
    * @param type $module 
    */
   public static function make($pathBase, $module){
        self::$module = $module;
        self::$path = $pathBase;
        
        $resources = self::getResources();
        require_once 'c:/appweb/htdocs/Mais/application/modules/auth/models/Recurso/Crud/Table.php';
        require_once 'c:/appweb/htdocs/Mais/application/modules/auth/models/Recurso/Table.php';
        $resource = new Auth_Model_Recurso_Table();
        $resource->saveByLote($resources);
    }
}
?>
