<?php

   /**
    * ObjetoController
    * 
    * @author Luiz Gustavo Botardo
    * @package ACL
    * @subpackage Objeto
    * @version 1.0
    */
   require_once 'Zend/Controller/Action.php';

   class Auth_MakeResourcesController extends Zend_Controller_Action {

       public function getArrayAZ() {
           return array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Z', 'K', 'W', 'Y');
       }

       public function getModules() {
           $moduleName = $this->getRequest()->getParam('module_name');

           $modules = array();

           $path = APPLICATION_PATH . '/modules/';
           echo $path . "<br />\n";
           $dir_handle = opendir($path);
           while ($file = readdir($dir_handle)) {
               if ($file != '.' && $file != '..' && $file != '.svn') {
                   echo $path . $file . "<br />\n";
                   if (is_dir($path . $file)) {
                       if ($moduleName != '') {
                           if ($moduleName == $file) {
                               $modules[] = $file;
                           }
                       } else {
                           $modules[] = $file;
                       }
                   }
               }
           }
           closedir($dir_handle);
           return $modules;
       }

       public function getControllers($module) {
           $path = APPLICATION_PATH . '/modules/' . $module . '/controllers/';
           echo $path . "<br />\n";
               
           $controllers = glob($path . "*Controller.php");
           $result = array();
           $i = 0;
           foreach ($controllers as &$controller) {               
               $fileName = str_replace($path, '', $controller);
               echo $fileName . "<br />\n";
               if ($fileName != 'ErrorController.php') {
                   $result[$i]['path'] = $path;
                   $result[$i]['fileName'] = $fileName;
                   $result[$i]['className'] = str_replace('Controller.php', '', $result[$i]['fileName']);
                   $az = $this->getArrayAZ();
                   foreach ($az as $letra) {
                       $result[$i]['className'] = str_replace($letra, '-' . strtolower($letra), $result[$i]['className']);
                   }
                   if (substr($result[$i]['className'], 0, 1) == '-') {
                       $result[$i]['className'] = substr($result[$i]['className'], 1);
                   }
                   $i++;
               }
           }
           return $result;
       }

       function getActions($className) {
           $methods = get_class_methods($className);
           $result = array();
           foreach ($methods as &$method) {
               if (strpos($method, 'Action') > 0) {
                   $az = $this->getArrayAZ();
                   $method = str_replace('Action', '', $method);
                   foreach ($az as $letra) {
                       $method = str_replace($letra, '-' . strtolower($letra), $method);
                   }
                   $result[] = $method;
               }
           }
           return $result;
       }

       public function getResources() {
           $resources = array();
           $modules = $this->getModules();
           $idx = 0;
           foreach ($modules as $module) {
               $resources[$idx]['name'] = $module;
               $resources[$idx]['parent'] = '';
               $resources[$idx]['type'] = 'MODULE';
               $resources[$idx]['module'] = $module;
               $idx++;
               $controllers = $this->getControllers($module);
               foreach ($controllers as $controller) {
                   $resources[$idx]['name'] = $module . '.' . $controller['className'];
                   $resources[$idx]['parent'] = $module;
                   $resources[$idx]['type'] = 'CONTROLLER';
                   $resources[$idx]['module'] = $module;
                   $idx++;

                   $controllers = $this->getControllers($module);
                   require_once($controller['path'] . $controller['fileName']);
                   $className = str_replace('.php', '', $controller['fileName']);

                   if ($module != 'default') {
                       $className = $module . '_' . $className;
                   }
                   $actions = $this->getActions($className);
                   foreach ($actions as $action) {
                       $resources[$idx]['name'] = $module . '.' . $controller['className'] . '.' . $action;
                       $resources[$idx]['parent'] = $module . '.' . $controller['className'];
                       $resources[$idx]['type'] = 'ACTION';
                       $resources[$idx]['module'] = $module;
                       $idx++;
                   }
               }
               ZendT_Acl::getInstance()->clearCache($module);
           }
           return $resources;
       }

       public function indexAction() {
           set_time_limit(0);
           $resources = $this->getResources();

           $resource = new Auth_Model_Recurso_Table();
           $resource->saveByLote($resources);
           echo 'Dados inseridos no Banco!';
           exit;
       }

   }
   