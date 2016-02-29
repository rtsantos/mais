<?php

   class Vendas_Interface_Vsp_Ice {

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
           $config = array('useragent' => 'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/44.0',
              'encodecookies' => false,
              'timeout' => 180);

           $this->_client = new Zend_Http_Client(null, $config);
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

           $this->_hlog = fopen(DOCUMENT_ROOT . '/job/logs/ice_vsp_' . date('Y_m_d') . '.txt', 'a+');
           set_time_limit(0);
       }

       public function __destruct() {
           if ($this->_hlog) {
               @fclose($this->_hlog);
           }
       }

       private function _log($message) {
           echo $message . "<br />\n";
           if ($this->_hlog) {
               @fwrite($this->_hlog, $message . "\n");
           }
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
           #echo $result . "\n\n <br>"; 
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
           $idPedido = 0;
           try {
               $idVeiculo = $this->_veiculo($data);
               //$this->_log('Veiculo OK');

               $idCliente = $this->_cliente($data);
               //$this->_log('Cliente OK');

               $idFuncionario = $this->_funcionario($data);
               //$this->_log('Funcionario OK');

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


               if (!$exists) {
                   $itemPedido = array();
                   $itemPedido['id_produto'] = $this->_produto->getId();
                   $itemPedido['qtd_item'] = 1;
                   $this->_pedido->setItemPedido($itemPedido);

                   $pagtoPedido = array();
                   $pagtoPedido['id_forma_pagto'] = $this->_formaPagto->getId();
                   $this->_pedido->setPagamento($pagtoPedido);
                   //echo 'Inserindo' . "\n";
                   $this->_pedido->insert();
                   //echo 'Inserido' . "\n";
               } else {
                   //echo 'Atualizando' . "\n";
                   $this->_pedido->update();
                   //echo 'Atualizado' . "\n";
               }
               //$this->_log('Pedido OK');

               $data->id_pedido = $this->_pedido->getId();
               $data->id_veiculo = $idVeiculo;

               //echo "Pedido: " . $data->id_pedido;

               $this->_vistoria($data);
               //$this->_log('Vistoria OK');

               $idPedido = $this->_pedido->getId();
           } catch (Exception $ex) {
               $this->_log('Placa: ' . $data->placa . '. Erro: ' . $ex->getMessage());
           }

           return $idPedido;
       }

       public function _vistoria($data) {
           $this->_vistoria->newRow();
           $this->_vistoria->setIdPedido($data->id_pedido);
           $this->_vistoria->setIdVeiculo($data->id_veiculo);
           $exists = $this->_vistoria->exists();

           $this->_vistoria->setNumero($data->numeroVistoria)
                 ->setDtEmis($data->dataVistoria)
                 ->setStatus($data->resultadoVistoria)
                 ->setObservacao($data->statusVistoria);
           /*
             ->setLocal($data->localVistoria)
            */

           if ($this->_vistoria->getLaudo(true)->toPhp() == '') {
               $laudo = $this->_laudo($data->numeroVistoria);
               if ($laudo) {
                   $_laudo = new ZendT_File(str_replace(array('-', '/'), '_', $data->numeroVistoria) . '.pdf'
                         , $laudo
                         , 'application/pdf');
                   $dataLaudo = array();
                   $dataLaudo['file'] = $_laudo;
                   $this->_vistoria->setLaudo($dataLaudo);
                   //echo "Laudo disponivel\n";
               } else {
                   //echo "Laudo nao disponivel\n";
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

       protected function _consultorias($dtIni = '', $dtFim = '', $placa = '') {
           if (!$dtIni) {
               $dtIni = ZendT_Type_Date::nowDate()->addDay(-3)->getValueToDb();
           }

           if (!$dtFim) {
               $dtFim = ZendT_Type_Date::nowDate()->getValueToDb();
           }

           $params = array();
           $params['header']['Authorization'] = 'bearer ' . $this->_token;
           $params['get']['Placa'] = $placa;
           $params['get']['DataInicio'] = $dtIni;
           $params['get']['DataFim'] = $dtFim;

           #echo print_r($params);
           #echo "\n <br>";

           $result = $this->_request('https://servicos.vistoriasp.com.br/ECVCommunicationService/api/vistoria/consultaVistoria', $params, Zend_Http_Client::GET);

           #print_r($result);

           return $result;
       }

       public function run($where = array()) {
           $this->_log('Iniciado: ' . date('d/m/Y H:s:i'));

           Auth_Session_User::refresh('JOB_VSP');
           $this->_token = $this->_doLogin();

           if (!isset($where['dtIni']))
               $where['dtIni'] = '';
           if (!isset($where['dtFim']))
               $where['dtFim'] = '';
           if (!isset($where['placa']))
               $where['placa'] = '';

           $result = $this->_consultorias($where['dtIni'], $where['dtFim'], $where['placa']);

           if (isset($result->exceptionMessage)) {
               $message = 'Data: ' . var_export($where, true) . "\n";
               $message.= 'Erro: ' . $result->exceptionMessage;
               Tools_Model_LogErro_Mapper::log('Vendas_Interface_Vsp_Ice', $message);
               $this->_log($message);
           } else {
               if (count($result) > 0) {
                   $total = count($result);
                   $this->_log("Quantidade de Vistorias: " . $total);
                   foreach ($result as $seq => $data) {
                       try {
                           $this->_log("Processando " . ($seq + 1) . " de " . $total . ". Placa: " . $data->placa);
                           $this->_pedido($data);
                       } catch (Exception $ex) {
                           $message = 'Data: ' . var_export($data, true) . "\n";
                           $message.= 'Mensagem: ' . $ex->getMessage() . "\n";
                           $message.= 'Erro: ' . $ex->getTraceAsString();
                           $this->_log($message);
                           Tools_Model_LogErro_Mapper::log('Vendas_Interface_Vsp_Ice', $message);
                       }
                   }
               }
               echo 'OK';
           }
           $this->_log('Finalizado: ' . date('d/m/Y H:s:i'));
       }

       public function runLaudos($where = array()) {
           $this->_log('Iniciado: ' . date('d/m/Y H:s:i'));

           Auth_Session_User::refresh('JOB_VSP');
           $this->_token = $this->_doLogin();

           $_pedido = new Vendas_DataView_Pedido_MapperView();
           $_vistoria = new Vendas_DataView_Vistoria_MapperView();

           $_where = new ZendT_Db_Where();
           $_where->addFilter('pedido.id_empresa', Auth_Session_User::getInstance()->getIdEmpresa());
           if (isset($where['placa'])) {
               $_where->addFilter('veiculo.placa', $where['placa']);
           } else {
               $_where->addFilter('pedido.status_edi', 'N');
           }

           if (isset($where['cnpj_cliente']) && $where['cnpj_cliente']) {
               $_where->addFilter('cliente.codigo', $where['cnpj_cliente']);
               //33164021000100
           }

           if (isset($where['dt_emis']) && $where['dt_emis']) {
               if (!is_array($where['dt_emis'])){
                   $where['dt_emis'] = array($where['dt_emis']);
               }
               $where['dt_emis'][0] = new ZendT_Type_Date($where['dt_emis'][0], 'Date');
               if (!isset($where['dt_emis'][1])) {
                   $where['dt_emis'][1] = $where['dt_emis'][0];
               } else {
                   $where['dt_emis'][1] = new ZendT_Type_Date($where['dt_emis'][1], 'Date');
               }
               $_where->addFilter('pedido.dt_emis', $where['dt_emis'], 'BETWEEN');
           }

           $sql = "(SELECT 1"
                 . "  FROM " . Vendas_DataView_Vistoria_MapperView::$table . " as vistoria "
                 . " WHERE vistoria.id_pedido = pedido.id"
                 . "   AND vistoria.laudo IS NULL)";
           $_where->addFilterExists($sql);

           $_pedido->findAll($_where, '*');

           $total = $_pedido->getCountRows();
           $seq = 1;
           while ($row = $_pedido->fetch()) {
               try {
                   $this->_log("Processando " . $seq . " de ".$total.", Placa: " . $row['placa_veiculo']);
                   
                   $_vistoria->newRow();
                   $_vistoria->setIdPedido($row['id'])->retrieve();

                   if ($_vistoria->getLaudo(true)->toPhp() == '' && $_vistoria->getNumero(true)->toPhp() != '') {
                       $laudo = $this->_laudo($_vistoria->getNumero()->get());
                       if ($laudo) {
                           $_laudo = new ZendT_File(str_replace(array('-', '/'), '_', $_vistoria->getNumero()->get()) . '.pdf'
                                 , $laudo
                                 , 'application/pdf');
                           $dataLaudo = array();
                           $dataLaudo['file'] = $_laudo;
                           $_vistoria->setLaudo($dataLaudo);
                           $_vistoria->update();
                       }
                   }

               } catch (Exception $ex) {
                   $message = 'Mensagem: ' . $ex->getMessage() . "\n";
                   $message.= 'Erro: ' . $ex->getTraceAsString() . "\n";

                   Vendas_Model_LogPedido_Mapper::log($_pedido->getId(), $ex->getMessage());
                   Tools_Model_LogErro_Mapper::log('Vendas_Interface_Vsp_Tokio', $message);
                   $this->_log('Placa: ' . $row['placa_veiculo'] . ', Erro: ' . $message);
               }
               $seq++;
           }
           $this->_log('Finalizado: ' . date('d/m/Y H:s:i'));
           echo "OK";
       }

   }
   