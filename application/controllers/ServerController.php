<?php
ini_set('soap.wsdl_cache_enabled', '0');
class ServerController extends Zend_Controller_Action {
    public function soapAction() {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->layout()->disableLayout();
        $params = $this->getRequest()->getParams();        

        $service = 'ZendT_Service_Crud';
        if (isset($params['service'])){
            $service = $params['service'];
        }
        
        $this->getResponse()->setHeader('Content-Type', 'text/xml;charset=utf-8', true);        
        if (isset($params['wsdl'])) {
            $autodiscover = new Zend_Soap_AutoDiscover('Zend_Soap_Wsdl_Strategy_ArrayOfTypeComplex');
            $autodiscover->setUri(ZendT_Url::getUri());
            $autodiscover->setClass($service);
            $autodiscover->handle();
        } else {
            $wsdl = ZendT_Url::getUri() . "/service/".$service."?wsdl";
            if (isset($params['version'])){
                $version = str_replace('.','_',$params['version']);
                $names = explode('_',$service);
                $fileWsdl = APPLICATION_PATH . '/modules/' . strtolower($names[0]).'/'.strtolower($names[1]).'s/'.$names[2].'/wsdl/'.$names[3].'_v'.$version.'.wsdl';
                if (file_exists($fileWsdl)){
                    $wsdl = str_replace("\\","/",$fileWsdl);
                }
            }
            $server = new Zend_Soap_Server();            
            $server->setWsdl($wsdl);
            $server->setClass($service);
            $server->handle();
        }        
    }
}

