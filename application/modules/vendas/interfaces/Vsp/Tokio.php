<?php

   class Vendas_Interface_Vsp_Tokio {

       /**
        *
        * @var Zend_Http_Client
        */
       protected $_client = null;

       /**
        *
        * @var array
        */
       protected $_cookies;

       /**
        *
        * @var string
        */
       protected $_baseUrl = 'https://portal.tokiomarine.com.br/';

       /**
        *
        * @var bool
        */
       private $_authenticated = false;

       public function __construct() {
           $this->_hlog = fopen(DOCUMENT_ROOT . '/job/logs/tokio_vsp_' . date('Y_m_d') . '.txt', 'a+');
           set_time_limit(0);
       }

       public function __destruct() {
           if ($this->_hlog) {
               @fclose($this->_hlog);
           }
       }

       private function _log($message) {
           if ($this->_hlog) {
               @fwrite($this->_hlog, $message . "\n");
           }
       }

       /**
        * 
        * @param string $url
        * @param array $param
        * @param string $method
        * @return string
        */
       protected function _request($url, $param = array(), $method = Zend_Http_Client::POST) {

           if ($this->_client === null) {
               $config = array('useragent' => 'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/44.0',
                  'encodecookies' => false,
                  'timeout' => 180);

               $this->_client = new Zend_Http_Client($url, $config);
               $this->_client->setCookieJar();
           }

           $this->_client->resetParameters()
                 ->setUri($url);

           if (count($param['post']) > 0) {
               foreach ($param['post'] as $name => $value) {
                   $this->_client->setParameterPost($name, $value);
               }
           }

           if (count($param['get']) > 0) {
               foreach ($param['get'] as $name => $value) {
                   $this->_client->setParameterPost($name, $value);
               }
           }

           if (count($param['file']) > 0) {
               foreach ($param['file'] as $name => $value) {
                   $this->_client->setFileUpload($value, $name);
               }
           }

           if (count($param['cookie']) > 0) {
               foreach ($param['cookie'] as $name => $value) {
                   $this->_client->setCookie($name, $value);
               }
           }

           if (count($this->_cookies) > 0) {
               foreach ($this->_cookies as $cookie) {
                   $this->_client->setCookie($cookie);
               }
           }

           $response = $this->_client->request($method);
           $this->_cookies = $this->_client->getCookieJar()->getAllCookies();

           return $response->getBody();
       }

       private function _getParamGrid($html = '') {

           if (!$html) {
               $html = file_get_contents(APPLICATION_PATH . '/modules/vendas/contexts/Vsp/grid.html');
           }
           $documentDOM = new ZendT_HtmlDom_SimpleHtmlDom($html);

           $td = $documentDOM->find('table[id=dados_processos] tbody tr td');
           if (!$td) {
               throw new ZendT_Exception_Error('Não foi possível localizar o veículo/sinistro na tela de pesquisa.');
           }

           $inputs = $td[8]->find('input');
           $itens = array();
           $seq = $inputs[0]->attr['name'];
           $seq = '_form' . substr($seq, strrpos($seq, '_'));

           $param = array();
           $param['post']['cd_aviso'] = '';
           $param['post']['cd_caracteristica_bem_segur'] = '2';
           $param['post']['cd_letra_sinistro'] = 'E';
           $param['post']['cd_local_contabil'] = '10';
           $param['post']['cd_ramo'] = '53';
           $param['post']['cd_reclamante_sinistro'] = '1';
           $param['post']['cd_salvado_auto_sinistro'] = '1';
           $param['post']['cd_sequencia_solicitacao'] = '89998';
           $param['post']['cd_sinistro'] = '10953';
           $param['post']['cd_status_alterado'] = '99-S';
           $param['post']['cd_status_processo'] = '99-S';
           $param['post']['cd_tipo_bem_segur'] = '1';
           $param['post']['cd_tipo_servico'] = '99';
           $param['post']['cd_tipo_servico_retorno'] = '48';
           $param['post']['chassi'] = '9C2KC08108R287836';
           $param['post']['ds_status'] = 'AGUARDANDO';
           $param['post']['ds_tipo_perda'] = 'Irrecuperável';
           $param['post']['ds_tipo_servico'] = 'VISTORIA ECV-EMPRESA CREDENCIADA DE VISTORIA';
           $param['post']['ds_veiculo'] = 'CG 150 TITAN ES';
           $param['post']['dt_solicitacao'] = '29/01/2016';
           $param['post']['periodo_final'] = '15/02/2016';
           $param['post']['periodo_inicial'] = '17/12/2015';
           $param['post']['placa'] = 'ECI5838';
           foreach ($inputs as $input) {
               $name = $input->attr['name'];
               $value = ($input->attr['value']);
               $param['post'][$name] = $value;

               $name = str_replace($seq, '', $input->attr['name']);
               $param['post'][$name] = $value;
           }

           $param['post']['cd_status_alterado'] = '99-S';
           $param['post']['cd_status_processo'] = '99-S';

           return $param;
       }

       private function _getParamDetail($html = '') {
           if (!$html) {
               $html = file_get_contents(APPLICATION_PATH . '/modules/vendas/contexts/Vsp/detail.html');
           }
           $documentDOM = new ZendT_HtmlDom_SimpleHtmlDom($html);

           $inputs = $documentDOM->find('form[id=parametros] input');
           if (!$inputs) {
               throw new ZendT_Exception_Error('Não foi possível localizar os parâmetros da tela de Detalhe.');
           }

           $param = array();
           foreach ($inputs as $input) {
               $name = $input->attr['name'];
               $value = ($input->attr['value']);
               $param['post'][$name] = $value;
           }

           $param['post']['dt_conclusao'] = date('d/m/Y');

           return $param;
       }

       /**
        * Faz login no site da Tokio
        * 
        * @return boolean
        * @throws ZendT_Exception_Error
        */
       protected function _doLogin() {
           if ($this->_authenticated) {
               return true;
           }

           $this->_request('https://portal.tokiomarine.com.br/acesso/prestador');
           $documentDOM = new ZendT_HtmlDom_SimpleHtmlDom($html);

           /* enviar=Enviar
             idSistema=5
             login=31295013800
             password=094712
             userid= */
           $param = array();
           $param['post']['enviar'] = 'Enviar';
           $param['post']['idSistema'] = '5';
           $param['post']['login'] = '31295013800';
           $param['post']['password'] = '094712';
           $param['post']['userid'] = '';
           $json = $this->_request('https://portal.tokiomarine.com.br/acesso/efetuarLogin', $param);
           $json = json_decode($json);
           if (!$json) {
               throw new ZendT_Exception_Error('Erro ao fazer login no site da Tokio!');
           }

           if ($json->userid == '') {
               throw new ZendT_Exception_Error($json->mensagem);
           }

           $param = array();
           $param['post']['enviar'] = 'Enviar';
           $param['post']['idSistema'] = '5';
           $param['post']['login'] = '31295013800';
           $param['post']['password'] = '094712';
           $param['post']['userid'] = $json->userid;
           $param['cookie']['ObSSOCookie'] = 'loggedout';
           $result = $this->_request('https://sso.tokiomarine.com.br/loginprestador', $param);

           $this->_authenticated = true;
           return true;
       }

       public function postPdf($placa, $sinistro, $pdf, $dtConclusao) {
           //QBH-9686
           //D 10 31 52505
           /**
            * trata placa do veículo
            */
           if (is_string($placa) && strlen($placa) == 7) {
               $_string = new ZendT_Type_String($placa, array('mask' => '@@@-9999'));
               $placa = $_string->get();
           }
           /**
            * trata número do sinistro
            */
           $sinistro = trim($sinistro);
           if ($sinistro) {
               if (strpos($sinistro, ' ')) {
                   list($cd_letra_sinistro, $cd_local_contabil, $cd_ramo, $cd_sinistro) = explode(' ', $sinistro);
               } else {
                   $cd_letra_sinistro = substr($sinistro, 0, 1);
                   $cd_local_contabil = substr($sinistro, 1, 2);
                   $cd_ramo = substr($sinistro, 3, 2);
                   $cd_sinistro = substr($sinistro, 5);
               }
           }
           /**
            * Faz login no site
            */
           $this->_doLogin();
           /**
            * Pesquisa o Veículo
            */
           $param['post']['cd_aviso'] = '';
           $param['post']['cd_caracteristica_bem_segur'] = '';
           $param['post']['cd_letra_sinistro'] = $cd_letra_sinistro;
           $param['post']['cd_local_contabil'] = $cd_local_contabil;
           $param['post']['cd_ramo'] = $cd_ramo;
           $param['post']['cd_reclamante_sinistro'] = '';
           $param['post']['cd_salvado_auto_sinistro'] = '';
           $param['post']['cd_sequencia_solicitacao'] = '';
           $param['post']['cd_sinistro'] = $cd_sinistro;
           $param['post']['cd_status_alterado'] = '99-S';
           $param['post']['cd_status_processo'] = '99-S';
           $param['post']['cd_tipo_bem_segur'] = '';
           $param['post']['cd_tipo_servico'] = '99';
           $param['post']['cd_tipo_servico_retorno'] = '';
           $param['post']['chassi'] = '';
           $param['post']['ds_status'] = '';
           $param['post']['ds_tipo_perda'] = '';
           $param['post']['ds_tipo_servico'] = '';
           $param['post']['ds_veiculo'] = '';
           $param['post']['dt_solicitacao'] = '';
           $param['post']['periodo_final'] = date('d/m/Y');
           $param['post']['periodo_inicial'] = '15/12/2015';
           $param['post']['placa'] = $placa;
           $result = $this->_request('https://portal.tokiomarine.com.br/portalSalvadosPrestador/vistoriador/pesquisa/grid', $param);
           /**
            * Monta os parâmetros para exibir os detalhes do sinistro/veículo
            */
           $param = $this->_getParamGrid($result);
           $result = $this->_request('https://portal.tokiomarine.com.br/portalSalvadosPrestador/vistoriador/consultarDetalhes', $param);
           #echo $result;
           /**
            * Posta arquivo PDF no site
            */
           $param = $this->_getParamDetail($result);
           $param['file']['file_comprovante_documento'] = $pdf;
           $param['post']['dt_conclusao'] = $dtConclusao;
           //$param['post']['dt_conclusao'] = '25/02/2016';
           $result = $this->_request('https://portal.tokiomarine.com.br/portalSalvadosPrestador/vistoriador/salvarEntregaVistoriador', $param);
           //echo $result;

           $documentDOM = new ZendT_HtmlDom_SimpleHtmlDom($result);

           $error = $documentDOM->find('strong[id=stackTrace]');
           if (count($error) > 0) {
               throw new ZendT_Exception_Error('Erro ao postar o arquivo no site da Tokio. ' . $error[0]->innertext());
           } else {
               $message = $documentDOM->find('p[class=msg green] strong');
               //$message = $message->innettext();
               if (!$message) {
                   throw new ZendT_Exception_Error('Erro ao postar o arquivo no site da Tokio. ' . $message);
               }
           }
           //var_dump($message);

           return true;
       }

       public function run($where = '') {
           $this->_log('Iniciado: ' . date('d/m/Y H:s:i'));

           Auth_Session_User::refresh('JOB_VSP');

           $_pedido = new Vendas_DataView_Pedido_MapperView();
           $_vistoria = new Vendas_DataView_Vistoria_MapperView();

           $_where = new ZendT_Db_Where();
           $_where->addFilter('pedido.id_empresa', Auth_Session_User::getInstance()->getIdEmpresa());
           $_where->addFilter('cliente.codigo', '33164021000100');
           if (isset($where['placa'])) {
               $_where->addFilter('veiculo.placa', $where['placa']);
           } else {
               $_where->addFilter('pedido.status_edi', 'N');
           }

           if (isset($where['dt_emis']) && $where['dt_emis']) {
               if (!is_array($where['dt_emis'])) {
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
                 . "   AND vistoria.laudo IS NOT NULL)";
           $_where->addFilterExists($sql);

           $_pedido->findAll($_where, '*');
           $total = $_pedido->getCountRows();
           $seq = 1;
           while ($row = $_pedido->fetch()) {
               try {
                   $this->_log("Processando " . $seq . " de " . $total . ", Placa: " . $row['placa_veiculo']);

                   $_vistoria->newRow()->setIdPedido($_pedido->getId())->retrieve();
                   $pdf = $_vistoria->getLaudo()->getFile();
                   $fileName = $pdf->getFilename();
                   $dtConclusao = date("d/m/Y", $_vistoria->getDtEmis()->toPhp());

                   /* var_dump($fileName);
                     exit; */


                   $this->postPdf($row['placa_veiculo'], $row['sinistro'], $fileName, $dtConclusao);
                   $_pedido->setStatusEdi('T');
               } catch (Exception $ex) {
                   $message = 'Mensagem: ' . $ex->getMessage() . "\n";
                   //$message.= 'Erro: ' . $ex->getTraceAsString() . "\n";

                   $_pedido->setStatusEdi('E');
                   Vendas_Model_LogPedido_Mapper::log($_pedido->getId(), $ex->getMessage());
                   Tools_Model_LogErro_Mapper::log('Vendas_Interface_Vsp_Tokio', $message);
                   $this->_log('Placa: ' . $row['placa_veiculo'] . ', Erro: ' . $message);
               }
               $_pedido->update();
               $seq++;
           }
           echo "OK";
           $this->_log('Finalizado: ' . date('d/m/Y H:s:i'));
       }

       public function test() {
           $this->postPdf('QBH-9686'
                 , 'D 10 31 52505'
                 , APPLICATION_PATH . '/modules/vendas/contexts/Vsp/QBH9686.pdf');
       }

       public function importXls($fileName = '') {
           $cnpj = '';

           $_pessoa = new Ca_Model_Pessoa_Mapper();
           $_pessoa->setCodigo($cnpj)->retrieve();
           $idCliente = $_pessoa->getId();

           if (!$fileName) {
               $fileName = APPLICATION_PATH . '/modules/vendas/contexts/Vsp/tokio.xls';
           }

           $objReader = ZendT_Excel_IOFactory::createReader('Excel5');
           $objPHPExcel = $objReader->load($fileName);
           $data = $objPHPExcel->getSheet()->toArray(null, true, true, true);

           if (count($data) > 0) {
               $_pedido = new Vendas_DataView_Pedido_MapperView();
               $_veiculo = new Frota_DataView_Veiculo_MapperView();
               unset($data[0]);
               foreach ($data as $row) {
                   $_veiculo->newRow()
                         ->setPlaca($row['D']);

                   if ($_veiculo->exists()) {
                       $_veiculo->setDescricao($row['C'])
                             ->setChassi($row['E'])
                             ->setChassi()
                             ->update();
                   } else {
                       $_veiculo->setDescricao($row['C'])
                             ->setChassi($row['E'])
                             ->setChassi()
                             ->insert();
                   }

                   $_pedido->newRow()
                         ->setIdCliente($idCliente)
                         ->setDtEmis($row['A'])
                         ->setSinistro($row['B'])
                         ->setIdVeiculo($_veiculo->getId());

                   if (!$_pedido->exists()) {
                       $_pedido->insert();
                   }
               }
           }
           echo '<pre>';
           print_r($data);
           echo '</pre>';
       }

   }
   