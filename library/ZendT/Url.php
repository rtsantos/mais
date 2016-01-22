<?php

    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */

    class ZendT_Url {

        /**
         * Retorna o HostName que está sendo solicitado
         * @return string
         */
        public static function getHostName($putHttp = true) {
            if (isset($_SERVER['HTTP_HOST'])) {
                $host = $_SERVER['HTTP_HOST'];
            } else {
                $host = $_SERVER['SERVER_NAME'];
            }

            if (strpos($host, 'http') === false && $putHttp) {
                if (substr($_SERVER["SCRIPT_URI"], 0, 5) == 'https' || $_SERVER["SERVER_PORT"] == '443') {
                    $host = 'https://' . $host;
                } else {
                    $host = 'http://' . $host;
                }
            }
            return $host;
        }

        /**
         * 
         */
        public static function getDomain() {
            $dns = ZendT_Url::getHostName(false);
            return substr($dns, strpos($dns, '.') + 1);
        }

        /**
         * Retorna a url base que está sendo solicitado
         * @return string 
         */
        public static function getBaseUrl() {
            return Zend_Controller_Front::getInstance()->getBaseUrl();
        }

        /**
         * Retorna a url base que está sendo solicitado, para acesso ao diretório publico
         * @return string 
         */
        public static function getBaseDiretoryPublic() {
            $public = str_replace('/index.php', '', Zend_Controller_Front::getInstance()->getBaseUrl());
            $public.= '/public';
            return $public;
        }

        /**
         * Retorna a URL de acesso
         * 
         * @param bool $removeAction
         * @return string 
         */
        public static function getUri($removeAction = false) {
            $uri = ZendT_Url::getHostName();
            $uri.= ZendT_Url::getBaseUrl();
            $route = Zend_Controller_Front::getInstance()->getRequest()->getParams();
            $uri.= '/' . $route['module'];
            $uri.= '/' . $route['controller'];
            if (!$removeAction)
                $uri.= '/' . $route['action'];
            return $uri;
        }

        /**
         * Retorna a URL de acesso
         * 
         * @param bool $removeAction
         * @return string 
         */
        public static function getUriApp() {
            $uri = ZendT_Url::getBaseUrl();
            if ($uri == null) {
                $uri = 'php-job';
            } else {
                $route = Zend_Controller_Front::getInstance()->getRequest()->getParams();
                $uri.= '/' . $route['module'];
                $uri.= '/' . $route['controller'];
                $uri.= '/' . $route['action'];
            }
            return $uri;
        }

        public static function formatUrl($url) {
            $url = str_replace('{host}', ZendT_Url::getHostName(), $url);
            $baseUrl = ZendT_Url::getBaseUrl();
            $url = str_replace('{baseUrl}', $baseUrl, $url);
            return $url;
        }

    }

?>
