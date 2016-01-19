<?php
    ini_set('soap.wsdl_cache_enabled', '0');
    class MailController extends Zend_Controller_Action {

        public function soapAction() {
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
            $params = $this->getRequest()->getParams();

            $service = 'ZendT_Mail_Service';
            $this->getResponse()->setHeader('Content-Type', 'text/xml;charset=utf-8', true);
            if (isset($params['wsdl'])) {
                $autodiscover = new Zend_Soap_AutoDiscover('Zend_Soap_Wsdl_Strategy_ArrayOfTypeComplex');
                $autodiscover->setUri(ZendT_Url::getUri());
                $autodiscover->setClass($service);
                $autodiscover->handle();
            } else {
                $server = new Zend_Soap_Server();
                #$wsdl = ZendT_Url::getUri() . "?wsdl";
                $wsdl = APPLICATION_PATH . '/controllers/Mail_v1.wsdl';
                $server->setWsdl($wsdl);
                $server->setClass($service);
                $server->handle();
            }
        }

        public function testAction() {
            $conn = new ZendT_Mail_Service_Connection();
            $conn->host = 'postmail.tanet.net.br';
            $conn->user = 'ta.nfe';
            $conn->pass = 'mail2110';

            $mail = new ZendT_Mail_Service();
            echo date('d/m/Y H:i:s');

            #$result = $mail->moveMessage('TUFJTFNFUlZFUg==',$conn, '<20140225120244.AEE0E3C6818B@saturno.tanet.com.br>', 'INBOX.Itens descartados');
            #$result = $mail->forwardMessage('TUFJTFNFUlZFUg==',$conn, 1281, 'rafael.santos@tanet.com.br');
            $result = $mail->listHeaderMessages('TUFJTFNFUlZFUg==',$conn);
            #$result = $mail->getMessage('TUFJTFNFUlZFUg==',$conn, 1281);

            echo '<pre>';
            print_r($result);
            echo '</pre>';
            
            echo date('d/m/Y H:i:s');

            exit;
        }

    }

    