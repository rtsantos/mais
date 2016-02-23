<?php

   class Vendas_Context_Vsp_Ice {

       /**
        *
        * @var Zend_Http_Client
        */
       protected $_client = null;

       /**
        *
        * @var \Vendas_DataView_Pedido_MapperView 
        */
       private $_pedido;

       /**
        *
        * @var \Vendas_DataView_Vistoria_MapperView 
        */
       private $_vistoria;

       /**
        *
        * @var \Ca_DataView_Pessoa_MapperView 
        */
       private $_pessoa;

       /**
        *
        * @var \Frota_DataView_Veiculo_MapperView 
        */
       private $_veiculo;

       /**
        *
        * @var \Vendas_DataView_Produto_MapperView
        */
       private $_produto;
       
       /**
        *
        * @var \Vendas_DataView_FormaPagamento_MapperView
        */
       private $_formaPagto;

       /**
        * 
        */
       public function __construct() {
           $this->_client = new Zend_Http_Client();
           $this->_pedido = new Vendas_DataView_Pedido_MapperView();
           $this->_vistoria = new Vendas_DataView_Vistoria_MapperView();
           $this->_pessoa = new Ca_DataView_Pessoa_MapperView();
           $this->_veiculo = new Frota_DataView_Veiculo_MapperView();
           $this->_produto = new Vendas_DataView_Produto_MapperView();

           $this->_produto->setIdEmpresa(Auth_Session_User::getInstance()->getIdEmpresa())
                 ->setCodigo('00001')
                 ->retrieve();
           
           $this->_formaPagto = new Vendas_DataView_FormaPagamento_MapperView();
           $this->_formaPagto->setIdEmpresa(Auth_Session_User::getInstance()->getIdEmpresa())
                 ->setPago('N')
                 ->retrieve();
           //A FATURAR
       }

       /**
        * 
        */
       protected function _request($url, $params, $method = Zend_Http_Client::GET) {
           $this->_client->setUri($url)
                 ->resetParameters();

           if (count($params['header'])) {
               foreach ($params['header'] as $name => $value) {
                   $this->_client->setHeaders($name, $value);
               }
           }

           if (count($params['post'])) {
               foreach ($params['post'] as $name => $value) {
                   $this->_client->setParameterPost($name, $value);
               }
           }

           if (count($params['get'])) {
               foreach ($params['get'] as $name => $value) {
                   $this->_client->setParameterGet($name, $value);
               }
           }

           if (count($params['json'])) {
               //$this->_client->setHeaders('Content-type','application/json');
               $rawJson = json_encode($params['json']);
               //$this->_client->setRawData($rawJson);
               $this->_client->setRawData($rawJson, 'application/json');
           }

           $response = $this->_client->request($method);
           $result = $response->getBody();
           return json_decode($result);
       }

       protected function _doLogin() {
           $params = array();
           $params['json']['Login'] = 'ecv.spvistoria';
           $params['json']['Senha'] = 'dlkdl1';
           $result = $this->_request('https://servicos.vistoriasp.com.br/ECVCommunicationService/api/usuario/login', $params, Zend_Http_Client::POST);
           return $result->tokenAcesso;
       }

       protected function _veiculo($data) {
           $this->_veiculo->newRow();
           $this->_veiculo->setPlaca($data->placa);
           $this->_veiculo->setIdEmpresa(Auth_Session_User::getInstance()->getIdEmpresa());
           $exists = $this->_veiculo->exists();

           $this->_veiculo->setRenavam($data->renavam)
                 ->setChassi($data->numeroChassi)
                 ->setDescricao($data->placa);

           if (!$exists) {
               $this->_veiculo->insert();
           } else {
               $this->_veiculo->update();
           }

           return $this->_veiculo->getId();
       }

       protected function _funcionario($data) {
           $this->_pessoa->newRow();

           $this->_pessoa->setNome($data->nomeVistoriador);
           $this->_pessoa->setIdEmpresa(Auth_Session_User::getInstance()->getIdEmpresa());
           if (!$this->_pessoa->exists()) {
               $this->_pessoa->setNome($data->nomeVistoriador)
                     ->setCodigo('11111111111')
                     ->setPapelFuncionario('1')
                     ->insert();
           }
           return $this->_pessoa->getId();
       }

       protected function _cliente($data) {
           $this->_pessoa->newRow();

           $this->_pessoa->setCodigo($data->cnpjCliente);
           $this->_pessoa->setIdEmpresa(Auth_Session_User::getInstance()->getIdEmpresa());
           if (!$this->_pessoa->exists()) {
               $this->_pessoa->setNome($data->razaoSocialCliente)
                     ->setPapelCliente('1')
                     ->insert();
           }
           return $this->_pessoa->getId();
       }

       private function _toDate($value) {
           list($ano, $mes, $dia) = explode('-', $value);
           $dia = substr($dia, 0, 2);
           return new ZendT_Type_Date($dia . '/' . $mes . '/' . $ano);
       }

       protected function _pedido($data) {
           $idVeiculo = $this->_veiculo($data);
           $idCliente = $this->_cliente($data);
           $idFuncionario = $this->_funcionario($data);
           $dtEmis = $this->_toDate($data->dataVistoria);

           $this->_pedido->newRow();

           $ini = clone $dtEmis;
           $fim = clone $dtEmis;
           $ini->addDay(-7);
           $fim->addDay(+7);

           $_where = new ZendT_Db_Where();
           $_where->addFilter('pedido.id_veiculo', $idVeiculo);
           $_where->addFilter('pedido.id_empresa', Auth_Session_User::getInstance()->getIdEmpresa());
           $_where->addFilter('pedido.dt_emis', array($ini, $fim), 'BETWEEN');

           $exists = $this->_pedido->exists($_where);
           $this->_pedido->setIdCliente($idCliente)
                 ->setIdFuncionario($idFuncionario)
                 ->setDtEmis($dtEmis)
                 ->setIdVeiculo($idVeiculo);

           $itemPedido = array();
           $itemPedido['id_produto'] = $this->_produto->getId();
           $itemPedido['qtd_item'] = 1;
           $this->_pedido->setItemPedido($itemPedido);
           
           $pagtoPedido = array();
           $pagtoPedido['id_forma_pagto'] = $this->_formaPagto->getId();
           $this->_pedido->setPagamento($pagtoPedido);
           
           if (!$exists) {
               $this->_pedido->insert();
           } else {
               $this->_pedido->update();
           }


           $data->id_pedido = $this->_pedido->getId();
           $data->id_veiculo = $idVeiculo;
           $this->_vistoria($data);

           return $this->_pedido->getId();
       }

       public function _vistoria($data) {
           $this->_vistoria->newRow();
           $this->_vistoria->setIdPedido($data->id_pedido);
           $this->_vistoria->setIdVeiculo($data->id_veiculo);
           $exists = $this->_vistoria->exists();

           $this->_vistoria->setNumero($data->numeroVistoria)
                 ->setDtEmis($data->dataVistoria)
                 ->setStatus($data->resultadoVistoria)
                 ->setObservacao($data->statusVistoria)
                 ->setLocal($data->localVistoria);

           if ($this->_vistoria->getLaudo(true)->toPhp() == '') {
               $laudo = $this->_laudo($data->numeroVistoria);
               if ($laudo) {
                   $_laudo = new ZendT_File(str_replace(array('-', '/'), '_', $data->numeroVistoria) . '.pdf'
                         , $laudo
                         , 'application/pdf');
                   $dataLaudo = array();
                   $dataLaudo['file'] = $_laudo;
                   $this->_vistoria->setLaudo($dataLaudo);
               }
           }

           if (!$exists) {
               $this->_vistoria->insert();
           } else {
               $this->_vistoria->update();
           }

           return true;
       }

       protected function _laudo($numero) {
           $params = array();
           $params['header']['Authorization'] = 'bearer ' . $this->_token;
           $result = $this->_request('https://servicos.vistoriasp.com.br/ECVCommunicationService/api/vistoria/consultaLaudo/' . $numero, $params, Zend_Http_Client::GET);
           $laudo = base64_decode($result->laudo);
           return $laudo;
       }

       protected function _consultorias($dtIni=false, $dtFim=false) {
           if (!$dtIni){
               $dtIni = ZendT_Type_Date::nowDate()->addDay(-2)->getValueToDb();
           }
           
           if (!$dtFim){
               $dtFim = ZendT_Type_Date::nowDate()->getValueToDb();
           }
           
           $params = array();
           $params['header']['Authorization'] = 'bearer ' . $this->_token;
           $params['get']['Placa'] = '';
           $params['get']['DataInicio'] = $dtIni;
           $params['get']['DataFim'] = $dtFim;
           $result = $this->_request('https://servicos.vistoriasp.com.br/ECVCommunicationService/api/vistoria/consultaVistoria', $params, Zend_Http_Client::GET);

           if (count($result) > 0) {
               foreach ($result as $data) {
                   $this->_pedido($data);
               }
           }

           return $result;
       }

       public function run() {
           Auth_Session_User::refresh('JOB_VSP');
           $this->_token = $this->_doLogin();

           //$result = json_decode('[{"numeroVistoria":"SP002186911-18/2016","placa":"EYA8767","renavam":420032215,"numeroChassi":"9BWAB45ZXC4111803","nomeVistoriador":"JEFERSON EDUARDO FERREIRA DA SILVA","dataVistoria":"2016-02-20T10:12:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"141 - BICUDO CENTER CAR VEICULOS LTDA - 58635376000152 - PQ VEREDAS BANDEIRANTES - SOROCABA - SP","cnpjCliente":"58635376000152","razaoSocialCliente":"BICUDO CENTER CAR VEICULOS LTDA"},{"numeroVistoria":"SP002187052-72/2016","placa":"FGG8635","renavam":507142136,"numeroChassi":"935SLYFYYDB536840","nomeVistoriador":"JEFERSON EDUARDO FERREIRA DA SILVA","dataVistoria":"2016-02-20T11:37:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"141 - BICUDO CENTER CAR VEICULOS LTDA - 58635376000152 - PQ VEREDAS BANDEIRANTES - SOROCABA - SP","cnpjCliente":"58635376000152","razaoSocialCliente":"BICUDO CENTER CAR VEICULOS LTDA"},{"numeroVistoria":"SP002190093-07/2016","placa":"EFR5871","renavam":200138081,"numeroChassi":"9BFZF54P7A8019339","nomeVistoriador":"Maycon Cesar Barbosa","dataVistoria":"2016-02-22T09:04:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SOROCABA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002190891-57/2016","placa":"EBS5757","renavam":157510476,"numeroChassi":"KMHFC41DP9A399695","nomeVistoriador":"Maycon Cesar Barbosa","dataVistoria":"2016-02-22T09:16:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SOROCABA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002192379-51/2016","placa":"BHJ2041","renavam":600738841,"numeroChassi":"9BWZZZ30ZMT106888","nomeVistoriador":"Maycon Cesar Barbosa","dataVistoria":"2016-02-22T09:54:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SOROCABA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002185015-19/2016","placa":"FEL5730","renavam":541353110,"numeroChassi":"9CDCF4FAJDM115854","nomeVistoriador":"Thiago Francisco Moriano","dataVistoria":"2016-02-20T10:42:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SOROCABA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002194133-50/2016","placa":"DPI9280","renavam":879975067,"numeroChassi":"9C2JA04106R816795","nomeVistoriador":"JEFERSON EDUARDO FERREIRA DA SILVA","dataVistoria":"2016-02-22T10:37:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SOROCABA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002195641-34/2016","placa":"CCZ6927","renavam":397770316,"numeroChassi":"8522400227","nomeVistoriador":"JEFERSON EDUARDO FERREIRA DA SILVA","dataVistoria":"2016-02-22T10:48:00","resultadoVistoria":"Reprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SOROCABA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002197234-69/2016","placa":"CWK4754","renavam":380540096,"numeroChassi":"BJ477218","nomeVistoriador":"JEFERSON EDUARDO FERREIRA DA SILVA","dataVistoria":"2016-02-22T11:51:00","resultadoVistoria":"Reprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SOROCABA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002186949-93/2016","placa":"EPC3635","renavam":192212524,"numeroChassi":"93HGM2520AZ117384","nomeVistoriador":"JEFERSON EDUARDO FERREIRA DA SILVA","dataVistoria":"2016-02-20T10:59:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"143 - CAR EXPRESS COMERCIO DE VEICULOS LTDA - 2770829000107 - PQ CAMPOLIM - SOROCABA - SP","cnpjCliente":"2770829000107","razaoSocialCliente":"CAR EXPRESS COMERCIO DE VEICULOS LTDA"},{"numeroVistoria":"SP002187011-03/2016","placa":"ETR1658","renavam":271921730,"numeroChassi":"93HGE8890BZ102240","nomeVistoriador":"JEFERSON EDUARDO FERREIRA DA SILVA","dataVistoria":"2016-02-20T11:25:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"143 - CAR EXPRESS COMERCIO DE VEICULOS LTDA - 2770829000107 - PQ CAMPOLIM - SOROCABA - SP","cnpjCliente":"2770829000107","razaoSocialCliente":"CAR EXPRESS COMERCIO DE VEICULOS LTDA"},{"numeroVistoria":"SP002186991-04/2016","placa":"FHW8733","renavam":1023008790,"numeroChassi":"936CLYFYYFB006883","nomeVistoriador":"JEFERSON EDUARDO FERREIRA DA SILVA","dataVistoria":"2016-02-20T11:12:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"143 - CAR EXPRESS COMERCIO DE VEICULOS LTDA - 2770829000107 - PQ CAMPOLIM - SOROCABA - SP","cnpjCliente":"2770829000107","razaoSocialCliente":"CAR EXPRESS COMERCIO DE VEICULOS LTDA"},{"numeroVistoria":"SP002187286-41/2016","placa":"FGS2175","renavam":504016008,"numeroChassi":"935SLYFYYDB539294","nomeVistoriador":"Osmar Pinese Júnior","dataVistoria":"2016-02-20T11:23:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"456 - ATRIA VEICULOS LTDA - ME - 21411055000164 - VILA JOAQUIM INACIO - CAMPINAS - SP","cnpjCliente":"21411055000164","razaoSocialCliente":"ATRIA VEICULOS LTDA - ME"},{"numeroVistoria":"SP002182489-41/2016","placa":"EFX0282","renavam":972662642,"numeroChassi":"3VWTH21C58M520274","nomeVistoriador":"Osmar Pinese Júnior","dataVistoria":"2016-02-20T09:15:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - CAMPINAS - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002183663-91/2016","placa":"DXC6620","renavam":903524791,"numeroChassi":"9BWHB09NX7P008013","nomeVistoriador":"Luciano Peruca","dataVistoria":"2016-02-20T09:51:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - CAMPINAS - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002184712-64/2016","placa":"ETT6637","renavam":276178220,"numeroChassi":"8AGCB48X0BR136359","nomeVistoriador":"GUILHERME SOUZA TAKAHASHI","dataVistoria":"2016-02-20T10:38:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - NOVA ODESSA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002195006-76/2016","placa":"FDK9894","renavam":470800909,"numeroChassi":"9BGSU19F0CC223752","nomeVistoriador":"GUILHERME SOUZA TAKAHASHI","dataVistoria":"2016-02-22T10:57:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - AMERICANA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002193462-28/2016","placa":"FHU2621","renavam":536007861,"numeroChassi":"935SLYFYYEB506328","nomeVistoriador":"GUILHERME SOUZA TAKAHASHI","dataVistoria":"2016-02-22T10:19:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - AMERICANA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002197381-47/2016","placa":"DBK7019","renavam":729557219,"numeroChassi":"9BD178236Y2077257","nomeVistoriador":"GUILHERME SOUZA TAKAHASHI","dataVistoria":"2016-02-22T11:55:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - AMERICANA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002195854-84/2016","placa":"CHE9245","renavam":665788177,"numeroChassi":"9BGKH08RVTB408231","nomeVistoriador":"GUILHERME SOUZA TAKAHASHI","dataVistoria":"2016-02-22T11:16:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - AMERICANA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002191417-64/2016","placa":"DFR0040","renavam":793002320,"numeroChassi":"9BGRD48X03G137402","nomeVistoriador":"GUILHERME SOUZA TAKAHASHI","dataVistoria":"2016-02-22T09:39:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - AMERICANA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002184997-83/2016","placa":"FXI8283","renavam":1020123114,"numeroChassi":"935SLYFYYFB516307","nomeVistoriador":"GUILHERME SOUZA TAKAHASHI","dataVistoria":"2016-02-20T10:43:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - AMERICANA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002181528-36/2016","placa":"DWG0973","renavam":982755260,"numeroChassi":"9BGXL80809C128022","nomeVistoriador":"GUILHERME SOUZA TAKAHASHI","dataVistoria":"2016-02-20T08:09:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - AMERICANA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002192306-08/2016","placa":"FMH3497","renavam":595142419,"numeroChassi":"9BFZB55P2E8896532","nomeVistoriador":"GABRIEL DE MATOS","dataVistoria":"2016-02-22T09:54:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - AMERICANA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002191090-19/2016","placa":"DGD5533","renavam":774824395,"numeroChassi":"9BGRD08Z02G133828","nomeVistoriador":"GABRIEL DE MATOS","dataVistoria":"2016-02-22T09:31:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - AMERICANA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002198445-00/2016","placa":"DPQ4095","renavam":899557473,"numeroChassi":"9C6KG017070031573","nomeVistoriador":"ANTONIO VERGILIO CABRAL","dataVistoria":"2016-02-22T12:26:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - AMERICANA - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002197992-85/2016","placa":"FRL5621","renavam":1025778747,"numeroChassi":"9BGKS69L0FG222624","nomeVistoriador":"ANDRE LUIS DE CASTRO","dataVistoria":"2016-02-22T11:49:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"425 - Porto Seguro Serviços e Comércio - 9436686000132 - Barra Funda - AMERICANA - SP","cnpjCliente":"9436686000132","razaoSocialCliente":"PORTO SEGURO SERVICOS E COMERCIO S.A"},{"numeroVistoria":"SP002182930-64/2016","placa":"FWT6254","renavam":1059249011,"numeroChassi":"9BWAL45Z6G4011409","nomeVistoriador":"GUILHERME SOUZA TAKAHASHI","dataVistoria":"2016-02-20T09:22:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"279 - AUTO BRASIL GERMANICA SEMINVOS LTDA - 15836008000160 -  - AMERICANA - SP","cnpjCliente":"15836008000160","razaoSocialCliente":"AUTO BRASIL GERMANICA SEMINVOS LTDA"},{"numeroVistoria":"SP002182841-54/2016","placa":"DVA8232","renavam":915581744,"numeroChassi":"9BWKA05Z274122591","nomeVistoriador":"GUILHERME SOUZA TAKAHASHI","dataVistoria":"2016-02-20T09:06:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"279 - AUTO BRASIL GERMANICA SEMINVOS LTDA - 15836008000160 -  - AMERICANA - SP","cnpjCliente":"15836008000160","razaoSocialCliente":"AUTO BRASIL GERMANICA SEMINVOS LTDA"},{"numeroVistoria":"SP002197731-30/2016","placa":"GBD8555","renavam":1071914976,"numeroChassi":"9BWAG4125GT532575","nomeVistoriador":"GABRIEL DE MATOS","dataVistoria":"2016-02-22T11:41:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"280 - AUTO BRASIL GERMANICA SEMINVOS LTDA - 15836008000917 -  - LIMEIRA - SP","cnpjCliente":"15836008000917","razaoSocialCliente":"AUTO BRASIL GERMANICA SEMINVOS LTDA"},{"numeroVistoria":"SP002197697-05/2016","placa":"EYX3105","renavam":406765189,"numeroChassi":"93YBSR7RHCJ996050","nomeVistoriador":"VICTOR ANDRIETA LEMES","dataVistoria":"2016-02-22T10:52:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"27 - Sodré Santoro - 2663775800 - SP 101 KM 21,5 - MONTE MOR - SP","cnpjCliente":"61198164000160","razaoSocialCliente":"PORTO SEGURO COMPANHIA DE SEGUROS GERAIS"},{"numeroVistoria":"SP002197608-27/2016","placa":"FOW1339","renavam":1047115503,"numeroChassi":"2BXNBDD17EV005033","nomeVistoriador":"VICTOR ANDRIETA LEMES","dataVistoria":"2016-02-22T11:46:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"27 - Sodré Santoro - 2663775800 - SP 101 KM 21,5 - MONTE MOR - SP","cnpjCliente":"61198164000160","razaoSocialCliente":"PORTO SEGURO COMPANHIA DE SEGUROS GERAIS"},{"numeroVistoria":"SP002193828-86/2016","placa":"AVS6556","renavam":950036811,"numeroChassi":"93HFA66408Z201071","nomeVistoriador":"HELIO ROBERTO MARCELINO","dataVistoria":"2016-02-22T10:15:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"27 - Sodré Santoro - 2663775800 - SP 101 KM 21,5 - MONTE MOR - SP","cnpjCliente":"61198164000160","razaoSocialCliente":"PORTO SEGURO COMPANHIA DE SEGUROS GERAIS"},{"numeroVistoria":"SP002193583-12/2016","placa":"ERB3726","renavam":213476150,"numeroChassi":"9BWAA05U3BP003911","nomeVistoriador":"HELIO ROBERTO MARCELINO","dataVistoria":"2016-02-22T10:00:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"27 - Sodré Santoro - 2663775800 - SP 101 KM 21,5 - MONTE MOR - SP","cnpjCliente":"61198164000160","razaoSocialCliente":"PORTO SEGURO COMPANHIA DE SEGUROS GERAIS"},{"numeroVistoria":"SP002193639-00/2016","placa":"EAG7364","renavam":978392558,"numeroChassi":"9362AKFW98B065729","nomeVistoriador":"HELIO ROBERTO MARCELINO","dataVistoria":"2016-02-22T10:08:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"27 - Sodré Santoro - 2663775800 - SP 101 KM 21,5 - MONTE MOR - SP","cnpjCliente":"61198164000160","razaoSocialCliente":"PORTO SEGURO COMPANHIA DE SEGUROS GERAIS"},{"numeroVistoria":"SP002197413-60/2016","placa":"EGP1333","renavam":114185468,"numeroChassi":"3FAHP08Z58R253317","nomeVistoriador":"THIAGO SOUZA GRUPO","dataVistoria":"2016-02-22T11:22:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"27 - Sodré Santoro - 2663775800 - SP 101 KM 21,5 - MONTE MOR - SP","cnpjCliente":"8816067000100","razaoSocialCliente":"ITAU SEGUROS DE AUTO E RESIDENCIA S/A"},{"numeroVistoria":"SP002194026-66/2016","placa":"DCK3165","renavam":780912519,"numeroChassi":"9BD27801222809006","nomeVistoriador":"THIAGO SOUZA GRUPO","dataVistoria":"2016-02-22T10:08:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"27 - Sodré Santoro - 2663775800 - SP 101 KM 21,5 - MONTE MOR - SP","cnpjCliente":"8816067000100","razaoSocialCliente":"ITAU SEGUROS DE AUTO E RESIDENCIA S/A"},{"numeroVistoria":"SP002197321-05/2016","placa":"GCK4835","renavam":1073428068,"numeroChassi":"93HRV2830GZ144938","nomeVistoriador":"THIAGO SOUZA GRUPO","dataVistoria":"2016-02-22T11:04:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"27 - Sodré Santoro - 2663775800 - SP 101 KM 21,5 - MONTE MOR - SP","cnpjCliente":"8816067000100","razaoSocialCliente":"ITAU SEGUROS DE AUTO E RESIDENCIA S/A"},{"numeroVistoria":"SP002197290-73/2016","placa":"EER5976","renavam":165718552,"numeroChassi":"9BD15802AA6332844","nomeVistoriador":"THIAGO SOUZA GRUPO","dataVistoria":"2016-02-22T10:19:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"27 - Sodré Santoro - 2663775800 - SP 101 KM 21,5 - MONTE MOR - SP","cnpjCliente":"8816067000100","razaoSocialCliente":"ITAU SEGUROS DE AUTO E RESIDENCIA S/A"},{"numeroVistoria":"SP002193952-71/2016","placa":"DGI4718","renavam":829795081,"numeroChassi":"9BGTT69V05B109058","nomeVistoriador":"THIAGO SOUZA GRUPO","dataVistoria":"2016-02-22T10:14:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"27 - Sodré Santoro - 2663775800 - SP 101 KM 21,5 - MONTE MOR - SP","cnpjCliente":"8816067000100","razaoSocialCliente":"ITAU SEGUROS DE AUTO E RESIDENCIA S/A"},{"numeroVistoria":"SP002197473-00/2016","placa":"NWN0399","renavam":345197445,"numeroChassi":"8AD4DRFJWCG000889","nomeVistoriador":"THIAGO SOUZA GRUPO","dataVistoria":"2016-02-22T11:29:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"27 - Sodré Santoro - 2663775800 - SP 101 KM 21,5 - MONTE MOR - SP","cnpjCliente":"8816067000100","razaoSocialCliente":"ITAU SEGUROS DE AUTO E RESIDENCIA S/A"},{"numeroVistoria":"SP002197388-10/2016","placa":"EDR8238","renavam":977759571,"numeroChassi":"9BFZF26P588301114","nomeVistoriador":"THIAGO SOUZA GRUPO","dataVistoria":"2016-02-22T11:09:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"27 - Sodré Santoro - 2663775800 - SP 101 KM 21,5 - MONTE MOR - SP","cnpjCliente":"8816067000100","razaoSocialCliente":"ITAU SEGUROS DE AUTO E RESIDENCIA S/A"},{"numeroVistoria":"SP002197565-58/2016","placa":"DZZ7093","renavam":951021346,"numeroChassi":"9BWKA05Z184119005","nomeVistoriador":"THIAGO SOUZA GRUPO","dataVistoria":"2016-02-22T11:36:00","resultadoVistoria":"Reprovado","statusVistoria":"Concluído","localVistoria":"27 - Sodré Santoro - 2663775800 - SP 101 KM 21,5 - MONTE MOR - SP","cnpjCliente":"8816067000100","razaoSocialCliente":"ITAU SEGUROS DE AUTO E RESIDENCIA S/A"},{"numeroVistoria":"SP002197689-98/2016","placa":"DFP8425","renavam":794306730,"numeroChassi":"9BGTT75F03C149594","nomeVistoriador":"THIAGO SOUZA GRUPO","dataVistoria":"2016-02-22T11:42:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"27 - Sodré Santoro - 2663775800 - SP 101 KM 21,5 - MONTE MOR - SP","cnpjCliente":"8816067000100","razaoSocialCliente":"ITAU SEGUROS DE AUTO E RESIDENCIA S/A"},{"numeroVistoria":"SP002184231-02/2016","placa":"EYD8468","renavam":330640070,"numeroChassi":"935FCKFVYCB512373","nomeVistoriador":"Thomas Jeffeson Alves de Castro","dataVistoria":"2016-02-20T10:16:00","resultadoVistoria":"Aprovado","statusVistoria":"Concluído","localVistoria":"161 - CAOA MOTOR DO BRASIL LTDA - 16794464000904 - INDIANAPÓLIS - SAO PAULO - SP","cnpjCliente":"16794464000904","razaoSocialCliente":"CAOA MOTOR DO BRASIL LTDA"},{"numeroVistoria":"SP002182514-92/2016","placa":"MYJ5257","renavam":808495526,"numeroChassi":"9BGTT75B03C214282","nomeVistoriador":"Vinicios Botelho Passos","dataVistoria":"2016-02-20T09:09:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002185496-31/2016","placa":"CSR2632","renavam":350392420,"numeroChassi":"BA129795","nomeVistoriador":"Vinicios Botelho Passos","dataVistoria":"2016-02-20T10:50:00","resultadoVistoria":"Reprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002183902-64/2016","placa":"EJJ7090","renavam":138563101,"numeroChassi":"9BGRX08109G292080","nomeVistoriador":"Vinicios Botelho Passos","dataVistoria":"2016-02-20T10:01:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002187650-91/2016","placa":"DWM8477","renavam":931741521,"numeroChassi":"9BD17164G85062160","nomeVistoriador":"Vinicios Botelho Passos","dataVistoria":"2016-02-20T12:53:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002187540-52/2016","placa":"EWI6338","renavam":503171212,"numeroChassi":"9C2NC4310CR072173","nomeVistoriador":"Vinicios Botelho Passos","dataVistoria":"2016-02-20T12:41:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002189679-80/2016","placa":"FKF0055","renavam":941330516,"numeroChassi":"9CDCF47AJ8M033429","nomeVistoriador":"Vinicios Botelho Passos","dataVistoria":"2016-02-22T08:53:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002192549-61/2016","placa":"EML2890","renavam":206629796,"numeroChassi":"935FCKFVYBB509949","nomeVistoriador":"Marcos Vinicius Rodrigues dos Santos","dataVistoria":"2016-02-22T09:59:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002197515-90/2016","placa":"EBY5261","renavam":232178887,"numeroChassi":"93YBSR7RHBJ552973","nomeVistoriador":"Marcos Vinicius Rodrigues dos Santos","dataVistoria":"2016-02-22T11:51:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002196105-07/2016","placa":"DAQ7500","renavam":420623442,"numeroChassi":"BH405114","nomeVistoriador":"Marcos Vinicius Rodrigues dos Santos","dataVistoria":"2016-02-22T11:17:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002198373-94/2016","placa":"AME0178","renavam":784402086,"numeroChassi":"KMJWWH7BP1U334597","nomeVistoriador":"Marcos Vinicius Rodrigues dos Santos","dataVistoria":"2016-02-22T12:20:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002186077-71/2016","placa":"AOF5047","renavam":901083097,"numeroChassi":"9BGRZ08907G185989","nomeVistoriador":"Marcos Vinicius Rodrigues dos Santos","dataVistoria":"2016-02-20T11:23:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002182628-59/2016","placa":"APP1423","renavam":948407166,"numeroChassi":"9C2KC08108R099637","nomeVistoriador":"Marcos Vinicius Rodrigues dos Santos","dataVistoria":"2016-02-20T09:22:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002198347-08/2016","placa":"EUQ0752","renavam":309471613,"numeroChassi":"9BFZF54P9B8190269","nomeVistoriador":"Marcos Vinicius Rodrigues dos Santos","dataVistoria":"2016-02-22T12:06:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002196072-01/2016","placa":"CRX0585","renavam":986905313,"numeroChassi":"9C2KC08508R116103","nomeVistoriador":"ANDRE LUIZ CORDEIRO DE SOUZA","dataVistoria":"2016-02-22T11:17:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002195182-93/2016","placa":"FLM1830","renavam":559467427,"numeroChassi":"9BWAB45Z8E4047604","nomeVistoriador":"ANDRE LUIZ CORDEIRO DE SOUZA","dataVistoria":"2016-02-22T10:54:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002197357-17/2016","placa":"FRA6669","renavam":480646228,"numeroChassi":"93HGE8890DZ203353","nomeVistoriador":"ANDRE LUIZ CORDEIRO DE SOUZA","dataVistoria":"2016-02-22T11:48:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":"SP002197954-54/2016","placa":"DRX3884","renavam":875618073,"numeroChassi":"9CDNF41LJ6M022082","nomeVistoriador":"ANDRE LUIZ CORDEIRO DE SOUZA","dataVistoria":"2016-02-22T12:11:00","resultadoVistoria":"Aprovado","statusVistoria":"Laudo Emitido","localVistoria":" -  -  -  - SAO PAULO - SP","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"EPH6428","renavam":202908640,"numeroChassi":"9BD118121A1102672","nomeVistoriador":"Thomas Jeffeson Alves de Castro","dataVistoria":"2016-02-22T11:26:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"161 - CAOA MOTOR DO BRASIL LTDA - 16794464000904 - INDIANAPÓLIS -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"DSL4956","renavam":881213403,"numeroChassi":"93HGD17407Z105671","nomeVistoriador":"BRUNO SOARES SANTANA","dataVistoria":"2016-02-22T11:26:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"238 - PÁTIO PORTO SEGURO - 61198164010807 - VILA JAGUARA -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"FFU0478","renavam":548708207,"numeroChassi":"9BGPN69M0DB337836","nomeVistoriador":"BRUNO SOARES SANTANA","dataVistoria":"2016-02-22T09:06:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"238 - PÁTIO PORTO SEGURO - 61198164010807 - VILA JAGUARA -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"KZS9854","renavam":898909473,"numeroChassi":"9362EN6A95B017883","nomeVistoriador":"BRUNO SOARES SANTANA","dataVistoria":"2016-02-22T10:36:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"238 - PÁTIO PORTO SEGURO - 61198164010807 - VILA JAGUARA -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"EIN5021","renavam":133389120,"numeroChassi":"9BGRM69409G280556","nomeVistoriador":"BRUNO SOARES SANTANA","dataVistoria":"2016-02-22T11:18:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"238 - PÁTIO PORTO SEGURO - 61198164010807 - VILA JAGUARA -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"EUM3615","renavam":305545299,"numeroChassi":"93HGE6730BZ115681","nomeVistoriador":"BRUNO SOARES SANTANA","dataVistoria":"2016-02-22T10:43:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"238 - PÁTIO PORTO SEGURO - 61198164010807 - VILA JAGUARA -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"FIA9638","renavam":535007841,"numeroChassi":"9BD196283D2148466","nomeVistoriador":"BRUNO SOARES SANTANA","dataVistoria":"2016-02-22T11:08:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"238 - PÁTIO PORTO SEGURO - 61198164010807 - VILA JAGUARA -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"ETZ2806","renavam":324824777,"numeroChassi":"3CZRE2870BG503357","nomeVistoriador":"BRUNO SOARES SANTANA","dataVistoria":"2016-02-22T11:33:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"238 - PÁTIO PORTO SEGURO - 61198164010807 - VILA JAGUARA -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"DML5932","renavam":902906607,"numeroChassi":"93HGD17407Z119397","nomeVistoriador":"BRUNO SOARES SANTANA","dataVistoria":"2016-02-22T10:59:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"238 - PÁTIO PORTO SEGURO - 61198164010807 - VILA JAGUARA -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"DKS7201","renavam":828600511,"numeroChassi":"9BFZE12N748573840","nomeVistoriador":"Maycon Cesar Barbosa","dataVistoria":"2016-02-22T11:49:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"305 - SALETE ZABEU VEICULOS – ME - 9088871000183 - JARDIM EUROPA -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"IUX7572","renavam":588747858,"numeroChassi":"9UK64ED51E0080690","nomeVistoriador":"Luciano Peruca","dataVistoria":"2016-02-22T10:51:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"348 - CARBIZZ – MOBILIDADE AUTOMOTIVA S/A - 9143812000160 - Jardim Cumbica -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"AMI5831","renavam":843571020,"numeroChassi":"9BWKA05Z554056633","nomeVistoriador":"LUIS GUSTAVO MARTINS LITOLDO","dataVistoria":"2016-02-22T12:10:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"348 - CARBIZZ – MOBILIDADE AUTOMOTIVA S/A - 9143812000160 - Jardim Cumbica -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"JIN5357","renavam":226979008,"numeroChassi":"3CZRE1830AG505615","nomeVistoriador":"LUIS GUSTAVO MARTINS LITOLDO","dataVistoria":"2016-02-22T11:35:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"348 - CARBIZZ – MOBILIDADE AUTOMOTIVA S/A - 9143812000160 - Jardim Cumbica -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"PVT0561","renavam":1042424915,"numeroChassi":"93HGK5870FZ254566","nomeVistoriador":"LUIS GUSTAVO MARTINS LITOLDO","dataVistoria":"2016-02-22T11:50:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"348 - CARBIZZ – MOBILIDADE AUTOMOTIVA S/A - 9143812000160 - Jardim Cumbica -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"JVW0886","renavam":149635400,"numeroChassi":"8BCLCN6BYAG504324","nomeVistoriador":"ANDRE LUIS DE CASTRO","dataVistoria":"2016-02-22T11:38:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"348 - CARBIZZ – MOBILIDADE AUTOMOTIVA S/A - 9143812000160 - Jardim Cumbica -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"OVI3012","renavam":568884310,"numeroChassi":"95PJN81EPEB060734","nomeVistoriador":"ANDRE LUIS DE CASTRO","dataVistoria":"2016-02-22T11:10:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"348 - CARBIZZ – MOBILIDADE AUTOMOTIVA S/A - 9143812000160 - Jardim Cumbica -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"HTN7097","renavam":170958981,"numeroChassi":"93HGE6840AZ105663","nomeVistoriador":"Felipe Bonomi Dutra","dataVistoria":"2016-02-22T10:35:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"28 - Sodré Santoro - 2663775800 - Lagoinha -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"FLH7805","renavam":555762840,"numeroChassi":"3N1CN7AD0DL833978","nomeVistoriador":"Felipe Bonomi Dutra","dataVistoria":"2016-02-22T11:00:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"28 - Sodré Santoro - 2663775800 - Lagoinha -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"OQS7565","renavam":568442393,"numeroChassi":"93XJNKB8TDCD77757","nomeVistoriador":"Felipe Bonomi Dutra","dataVistoria":"2016-02-22T10:15:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"28 - Sodré Santoro - 2663775800 - Lagoinha -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"FLU0936","renavam":596430809,"numeroChassi":"9BWAA45ZXE4103870","nomeVistoriador":"Felipe Bonomi Dutra","dataVistoria":"2016-02-22T10:49:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"28 - Sodré Santoro - 2663775800 - Lagoinha -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"FOT7850","renavam":1047612698,"numeroChassi":"9BHBG51CAFP414424","nomeVistoriador":"Felipe Bonomi Dutra","dataVistoria":"2016-02-22T11:05:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"28 - Sodré Santoro - 2663775800 - Lagoinha -  - ","cnpjCliente":"","razaoSocialCliente":null},{"numeroVistoria":null,"placa":"BQW5850","renavam":420660437,"numeroChassi":"9BWZZZ32ZFP222504","nomeVistoriador":"Felipe Bonomi Dutra","dataVistoria":"2016-02-22T10:26:00","resultadoVistoria":"","statusVistoria":"Aguardando Biometria","localVistoria":"28 - Sodré Santoro - 2663775800 - Lagoinha -  - ","cnpjCliente":"","razaoSocialCliente":null}]');
           //var_dump($result);
           $result = $this->_consultorias('2016-02-01','2016-02-02');
           if (count($result) > 0) {
               foreach ($result as $data) {
                   $this->_pedido($data);
               }
           }
       }

   }
   