<?php
    /**
    * Static methods for loading classes and files.
    *
    * @category   ZendT
    * @package    ZendT_Loader
    * @author     rsantos
    */
    class ZendT_Loader{
        /**
         *
         * @param string $className
         * @param boolean $once
         * @return boolean 
         */
        public static function loadFile($className,$once=false){
            $className = ltrim($className, '\\');
            $fileName  = '';
            $namespace = '';
            if ($lastNsPos = strrpos($className, '\\')) {
                $namespace = substr($className, 0, $lastNsPos);
                $className = substr($className, $lastNsPos + 1);
                $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
            }
            $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

            if ($once){
                @$result = include_once $fileName;
            }else{
                @$result = include $fileName;
            }            
            if (!$result){
                return false;
            }else{
                return true;
            }
        }
        /**
         *
         * @param type $className 
         */
        public static function autoload($className){
            $result = ZendT_Loader::loadFile($className);
            if (!$result){
                throw new ZendT_Exception(error_get_last());
            }
        }
        /**
         * 
         */
        public static function registerAutoload(){
            spl_autoload_register(array(__CLASS__, 'autoload'));
        }
    }
