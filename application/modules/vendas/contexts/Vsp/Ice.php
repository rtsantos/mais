<?php

   class Vendas_Context_Vsp_Ice {

       /**
        *
        * @var Zend_Http_Client
        */
       protected $_client = null;

       /**
        * 
        */
       public function __construct() {
           $this->_client = new Zend_Http_Client();
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
           $_veiculo = new Frota_DataView_Veiculo_MapperView();
           $_veiculo->setPlaca($data->placa);
           if (!$_veiculo->exists()) {
               $_veiculo->setRenavam($data->renavam)
                     ->setChassi($data->numeroChassi)
                     ->insert();
           } else {
               $_veiculo->setRenavam($data->renavam)
                     ->setChassi($data->numeroChassi)
                     ->update();
           }
           return $_veiculo->getId();
       }
       
       protected function _funcionario($data) {
           $_pessoa = new Ca_DataView_Pessoa_MapperView();
           $_pessoa->setNome($data->nomeVistoriador);
           if (!$_pessoa->exists()) {
               $_pessoa->setNome($data->nomeVistoriador)
                       ->setCodigo('11111111111')
                       ->setPapelFuncionario(1)
                       ->insert();
           }
           return $_pessoa->getId();
       }


       protected function _cliente($data) {
           $_pessoa = new Ca_DataView_Pessoa_MapperView();
           $_pessoa->setCodigo($data->cnpjCliente);
           if (!$_pessoa->exists()) {
               $_pessoa->setNome($data->razaoSocialCliente)
                     ->setPapelCliente(1)
                     ->insert();
           }
           return $_pessoa->getId();
       }
       
       private function _toDate($value){
           list($ano,$mes,$dia) = explode('-', $value);
           return new ZendT_Type_Date($dia.'/'.$mes.'/'.$ano);
       }

       protected function _pedido($data) {
           $idVeiculo = $this->_veiculo($data);
           $idCliente = $this->_cliente($data);
           $idFuncionario = $this->_funcionario($data);
           $dtEmis = $this->_toDate($data->dataVistoria);
           
           $_pedido = new Vendas_DataView_Pedido_MapperView();
           
           $ini = clone $dtEmis;
           $fim = clone $dtEmis;
           $ini->addDay(-7);
           $fim->addDay(+7);
           
           $_where = new ZendT_Db_Where();
           $_where->addFilter('cv_pedido.id_veiculo', $idVeiculo)
                  ->addFilter('cv_pedido.dt_emis',array($ini,$fim),'BETWEEN');
           if (!$_pedido->exists()){
               $_pedido->setIdCliente($idCliente)
                       ->setIdFuncionario($idFuncionario)
                       ->setDtEmis($dtEmis)
                       ->insert();
           } else {
               $_pedido->setIdCliente($idCliente)
                       ->setIdFuncionario($idFuncionario)
                       ->update();
           }
           
           return $_pedido->getId();
       }

       public function _vistoria($data) {
           $idPedido = $data->_vistoria($data);
           
           $_vistoria = new Vendas_DataView_Vistoria_MapperView();
           $_vistoria->setIdPedido($idPedido);
           if (!$_vistoria->exists()){
               $_vistoria->setNumero($data->numeroVistoria)
                         ->setDtEmis($data->dataVistoria)
                         ->setStatus($data->resultadoVistoria)
                         ->setObservacao($data->statusVistoria)
                         ->setLocal($data->localVistoria)
                         ->insert();
           }
           
           return true;
       }

       public function _consultorias() {
           $params = array();
           $params['header']['Authorization'] = 'bearer ' . $this->_token;
           $params['get']['Placa'] = '';
           $params['get']['DataInicio'] = ZendT_Type_Date::nowDate()->addDay(-2)->getValueToDb();
           $params['get']['DataFim'] = ZendT_Type_Date::nowDate()->getValueToDb();
           $result = $this->_request('https://servicos.vistoriasp.com.br/ECVCommunicationService/api/vistoria/consultaVistoria', $params, Zend_Http_Client::GET);

           if (count($result) > 0){
               foreach($result as $data){
                   $this->_pedido($data);
               }
           }

           return $result;
       }

       public function run() {
           $this->_token = $this->_doLogin();

           $result = $this->_consultorias();
           var_dump($result);
       }

   }
   