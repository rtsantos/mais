<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    class ZendT_Plugin_Charset extends Zend_Controller_Plugin_Abstract{
        public function dispatchLoopShutdown() {
            $response = $this->getResponse();
            $headers = $response->getHeaders();
            $setContentType = true;
            if (count($headers) > 0){
                foreach ($headers as $header){
                    if ($header['name'] == 'Content-Type'){
                        $setContentType = false;
                    }
                }
            }
            if ($setContentType)
                $response->setHeader('Content-Type','text/html;charset=utf-8');
        }
    }
?>
