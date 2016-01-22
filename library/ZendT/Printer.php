<?php

   /**
    * Essa classe tem como finalidade controlar o processo de impressão
    * de documento, jogando diretamente para impressora ou em documento
    * PDF ou RAW.
    * 
    * A classe faz uma ponte com o servidor de impressão que passa os
    * dados que serão colocados sobre a imagem(PDF).
    *
    * @author rsantos
    * @package ZendT
    * @subpackage Printer
    */
   class ZendT_Printer {

       /**
        *
        * @var string 
        */
       private $_uri = 'http://impressao.tanet.com.br/';
       private $_uriPhp = 'http://impressao.tanet.com.br/';

       /**
        *
        * @var Zend_Soap_Client 
        */
       private $_client = null;

       /**
        *
        * @var string
        */
       private $_output = 'raw';

       /**
        *
        * @var int 
        */
       private $_idDocument = null;

       /**
        * 
        */
       public function __construct() {
           //$this->_uri = 'http://localhost:115/';
           //$this->_uriPhp = 'http://localhost/';

           $this->_client = new Zend_Soap_Client($this->_uri . 'TA/Printer/wsPreparePrintServer/Server.asmx?wsdl');
       }

       /**
        * Inicializa o processo de impressão
        *
        * @param string $output example pdf|raw|device|printer
        * @param ZendT_Printer_Config $config
        * @return \ZendT_Printer
        * @throws ZendT_Exception_Error 
        */
       public function startDocument($output = 'raw', $config = null) {
           $this->_output = strtolower($output);

           $param = array();
           $param['pPDF']['Zip'] = 0;
           $param['pPDF']['Concat'] = 0;
           $param['pNumDocByPage'] = 1;
           $param['pIdServer'] = '192.168.1.246';
           $param['pPrinter']['Name'] = '';
           $param['pPrinter']['DocumentName'] = '';
           $param['pPrinter']['DataType'] = '';
           if (in_array($this->_output, array('pdf', 'raw'))) {
               $param['pPDF']['Generate'] = 1;
           } else {
               if ($config instanceof ZendT_Printer_Config) {
                   if ($config->getName() == '') {
                       throw new ZendT_Exception_Error('Informe a propriedade $config->setName(), que representa o nome da impressora!');
                   }

                   if ($config->getIp() == '') {
                       throw new ZendT_Exception_Error('Informe a propriedade $config->setIp(), que representa o ip do servidor!');
                   }

                   $param['pPDF']['Generate'] = 0;

                   $param['pPrinter']['Name'] = $config->getName();
                   $param['pPrinter']['DocumentName'] = $config->getDocumentName();
                   $param['pIdServer'] = $config->getIp();
                   $param['pNumDocByPage'] = $config->getNumDocByPage();
               } else {
                   throw new ZendT_Exception_Error('Informe a propriedade $config que é do tipo ZendT_Printer_Config!');
               }
           }

           $result = $this->_client->StartDocument($param);
           if (!$result->StartDocumentResult->IdDocument) {
               throw new ZendT_Exception_Error('(' . $result->StartDocumentResult->ErrorCode . ') :: ' . $result->StartDocumentResult->ErrorMessage . ' :: Erro ao iniciar processo de impressão. ');
           }
           $this->_idDocument = $result->StartDocumentResult->IdDocument;

           return $this;
       }

       /**
        * Adiciona um conteúdo sobre o documento de impressão
        *
        * @param ZendT_Printer_Document $document
        * @return \ZendT_Printer
        * @throws ZendT_Exception_Error 
        */
       public function addContent(ZendT_Printer_Document $document) {
           if (!$this->_idDocument) {
               throw new ZendT_Exception_Error('Para executar esse procedimento e preciso chamar o método startDocument!');
           }

           $param = array();
           $param['pIdDocument'] = $this->_idDocument;
           $param['pDocument']['Content'] = $document->getContent();
           $param['pDocument']['Duplex'] = $document->getDuplex();
           $param['pDocument']['Paper'] = $document->getPaper();
           $param['pDocument']['FormName'] = $document->getFormName();
           $param['pDocument']['FileName'] = $document->getFileName();
           $param['pDocument']['Param'] = $document->getParam();
           $param['pDocument']['CmdPrinter'] = $document->getCmdPrinter();
           $param['pDocument']['Resolution'] = $document->getResolution();
           $param['pDocument']['InputSlot'] = $document->getInputSlot();
           $param['pDocument']['MediaType'] = $document->getMediaType();
           $param['pDocument']['Copies'] = $document->getCopies();
           #$param['pDocument']['PrintDriverName'] = $document->getPrintDriverName();

           $result = $this->_client->AddContent($param);
           if ($result->AddContentResult->ErrorCode) {
               throw new ZendT_Exception_Error('(' . $result->AddContentResult->ErrorCode . ') :: ' . $result->AddContentResult->ErrorMessage . ' :: Erro ao iniciar processo de impressão. ');
           }
           return $this;
       }

       /**
        * Finaliza o processo de impressao, enviando o documento para
        * impressora ou arquivo
        *
        * @return boolean
        * @throws ZendT_Exception_Error 
        */
       public function endDocument() {
           if (!$this->_idDocument) {
               throw new ZendT_Exception_Error('Para executar esse procedimento e preciso chamar os métodos startDocument e addContent ');
           }

           if ($this->_output == 'pdf') {
               $client = new Zend_Http_Client($this->_uriPhp . 'wsPrintServer/Pdf.php?IdDocument=' . $this->_idDocument, array(
                  'timeout' => (10 * 60) // in seconds -> 10 minuts
               ));

               $response = $client->request();
               $pdf = $response->getBody();
               $pos = strpos($pdf, '%PDF');
               if (!$pos)
                   $pos = 0;
               return substr($pdf, $pos);
           }elseif ($this->_output == 'raw') {
               $client = new Zend_Http_Client($this->_uriPhp . 'wsPrintServer/Raw.php?IdDocument=' . $this->_idDocument, array(
                  'timeout' => (10 * 60) // in seconds -> 10 minuts
               ));

               $response = $client->request();
               return $response->getBody();
           } else {
               $param = array();
               $param['pIdDocument'] = $this->_idDocument;
               $result = $this->_client->EndDocument($param);
               if ($result->EndDocumentResult->ErrorCode) {
                   throw new ZendT_Exception_Error('(' . $result->EndDocumentResult->ErrorCode . ') :: ' . $result->EndDocumentResult->ErrorMessage . ' :: Erro ao iniciar processo de impressão. ');
               } else {
                   return true;
               }
           }
       }

       /**
        *
        * @param int $idFilial
        * @param int $idPostoAvancado
        * @return array
        */
       public function getPrintersByFilial($idFilial = '', $idPostoAvancado = 0) {
           if (!$idFilial) {
               $idFilial = $_SESSION['logon']['filial']['id'];
           }
           $idPostoAvancado = (int) $idPostoAvancado;
           $db = Zend_Registry::get('db.projta');

           $sql = "SELECT *
                      FROM TABLE(wsapi.ws_printserver.getprinternamelist((SELECT ip
                                                                            FROM (SELECT serv.ip,
                                                                                         NVL(serv.id_posto_avancado, 0) AS id_posto_avancado
                                                                                    FROM wsls_servidor serv
                                                                                   WHERE serv.id_filial = :id_filial
                                                                                     AND DECODE(:id_posto_avancado, 0, NVL(serv.id_posto_avancado, 0)) = NVL(serv.id_posto_avancado, 0)
                                                                                     AND serv.padrao = 'S'
                                                                                     AND serv.status = 'A'
                                                                                   ORDER BY NVL(serv.id_posto_avancado, 0) ASC)
                                                                           WHERE ROWNUM <= 1),3 ))
                   WHERE NAME LIKE '%' || (SELECT e.sigla || f.sigla FROM filial f JOIN empresa e ON (f.id_empresa = e.id) WHERE f.id = :id_filial) || '%' ";

           $bind = array(
              'id_filial' => $idFilial,
              'id_posto_avancado' => $idPostoAvancado
           );

           $rs = $db->fetchAll($sql, $bind);

           return $rs;
       }

       /**
        *
        * @param int $ipServer
        * @return array
        */
       public function getPrintersByServer($ipServer) {

           $db = Zend_Registry::get('db.projta');

           $sql = "SELECT * FROM TABLE(wsapi.ws_printserver.getprinternamelist(:ip_server))";

           $bind = array(
              'ip_server' => $ipServer,
           );

           $rs = $db->fetchAll($sql, $bind);

           return $rs;
       }

       /**
        * 
        * @param string $id
        * @param int $idFilial
        * @param string $filter
        * @return string
        */
       public function getComboboxPrinters($id = 'qz_printer', $idFilial = '', $filter = '') {
           if (!$idFilial) {
               $idFilial = $_SESSION['logon']['filial']['id'];
           }
           $printers = $this->getPrintersByFilial($idFilial);
           $selectPrinter = new ZendT_View_Printer($id);
           $selectPrinter->setServerPrinters($printers);
           return $selectPrinter->render();
       }

       /**
        * 
        * @param string $printerName
        * @return string
        */
       public function getIpServer($printerName) {
           $db = Zend_Registry::get('db.projta');
           $sql = "SELECT ip FROM wsls_servidor WHERE id = as_helper_pkg_v2.get_id_servidor(:printerName)";
           $bind = array(
              'printerName' => $printerName
           );
           $ip = $db->fetchOne($sql, $bind);
           return $ip;
       }

       /**
        * 
        * @param Zend_Db_Adapter_Abstract $db
        */
       private function _clearDocuments($db) {
           $sql = "begin wsapi.ws_printserver_pkg.cleardocuments; end;";
           $db->prepare($sql)->execute();
       }

       /**
        * 
        * @param Zend_Db_Adapter_Abstract $db
        * @param string $printerName
        * @param string $ipServer
        * @return boolean
        * @throws ZendT_Exception_Error
        */
       private function _printDocuments($db, $printerName, $ipServer) {
           $sql = "declare
                      message varchar2(500);
                   begin
                      wsapi.ws_printserver_pkg.print(pprintername => :printername,
                                                     pipserver => :ipserver);
                      :erro      := 0;
                      :message   := NULL;
                   exception when others then
                      :erro      := 1;
                      :message   := sqlerrm;
                   end;";
           $stmt = $db->prepare($sql);
           $stmt->bindParam('printername', $printerName);
           $stmt->bindParam('ipserver', $ipServer);
           $stmt->bindValue('erro', $erro);
           $stmt->bindValue('message', $message);
           $stmt->execute();
           if ($erro) {
               throw new ZendT_Exception_Error($message);
           }
           return true;
       }

       /**
        * 
        * @param string $printerName
        * @param \ZendT_Printer_Document[] $documents
        * @return boolean
        * @throws ZendT_Exception_Error
        */
       public function printDocuments($printerName, $documents) {
           if (substr($printerName, 0, 4) == 'WSPS') {
               $ipServer = $this->getIpServer($printerName);

               $db = Zend_Registry::get('db.wsapi');
               $this->_clearDocuments($db);
               $i = 0;
               foreach ($documents as $document) {
                   $i++;
                   $sql = "begin
                             wsapi.ws_printserver_pkg.adddocument(pcontent => :content,
                                                                  pformname => :formname,
                                                                  pfilename => :filename);
                           end;";
                   $stmt = $db->prepare($sql);
                   $stmt->bindParam(':content', new ZendT_Type_Clob($document->getContent()));
                   $stmt->bindParam(':formname', $document->getFormName());
                   $stmt->bindParam(':filename', $document->getFileName());
                   $stmt->execute();

                   if ($i == 30) {
                       $this->_printDocuments($db, $printerName, $ipServer);
                       $this->_clearDocuments($db);
                       $i = 0;
                   }
               }
               if ($i > 0) {
                   $this->_printDocuments($db, $printerName, $ipServer);
                   $this->_clearDocuments($db);
               }
               return true;
           }else{
               $this->startDocument();
               foreach ($documents as $document) {
                   $this->addContent($document);
               }
               $contentRaw = $this->endDocument();
               $_file = new ZendT_File('', $contentRaw);
               $result = $_file->toUrlDownload();
               return $result;
           }
       }

   }
   