<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    class ZendT_Url{
        /**
        * Retorna o HostName que está sendo solicitado
        * @return string
        */
        public static function getHostName($putHttp=true){
            if(isset($_SERVER['HTTP_HOST'])) {
                $host = $_SERVER['HTTP_HOST'];
            } else {
                $host = $_SERVER['SERVER_NAME'];
            }
            if (!is_numeric(strpos($host,'http')) && $putHttp){
                $host = 'http://'.$host;
            }
            return $host;
        }
        /**
         * 
         */
        public static function getDomain(){
            $dns = ZendT_Url::getHostName(false);
            return substr($dns,  strpos($dns, '.')+1);
        }
        /**
         * Retorna a url base que está sendo solicitado
         * @return string 
         */
        public static function getBaseUrl(){
            return ZendT_Controller_Front::getInstance()->getBaseUrl();
        }
       
        /**
         * Retorna a url base que está sendo solicitado, para acesso ao diretório publico
         * @return string 
         */
        public static function getBaseDiretoryPublic(){
            $public = str_replace('/index.php','',ZendT_Controller_Front::getInstance()->getBaseUrl());
            $public.= '/public';
            return $public;
        }
        /**
         * Retorna a URL de acesso
         * 
         * @param bool $removeAction
         * @return string 
         */
        public static function getUri($removeAction=false){
            $uri = ZendT_Url::getHostName();
            $uri.= ZendT_Url::getBaseUrl();
            $route = ZendT_Controller_Front::getInstance()->getRequest()->getParams();
            $uri.= '/'.$route['module'];
            $uri.= '/'.$route['controller'];
            if (!$removeAction)
                $uri.= '/'.$route['action'];
            return $uri;
        }
    }
?>
