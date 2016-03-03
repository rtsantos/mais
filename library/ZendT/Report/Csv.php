<?php

   /**
    * ZendT_Report_Csv
    * 
    * @package ZendT
    * @subpackage ZendT_Report 
    * @author rsantos
    * @version 2
    *
    */
   class ZendT_Report_Csv extends ZendT_Report_Abstract {

       /**
        * Define a empresa para colocação do logo
        * 
        * @var string @example TA,TAE,TAL,WIN
        */
       private $_empresa;

       /**
        *
        * @var string
        */
       protected $_rows;

       /**
        * Controle de memória
        * @var Zend_Memory 
        */
       protected $_memoryManager;

       /**
        * Controle de memória
        * @var memoryObj 
        */
       protected $_memObject;

       /**
        * Guarda os caracteres que necessitam ser substituidos
        * 
        * @var array 
        */
       protected $_badString;

       /**
        * Guarda os caracteres pelos quais devem ser substituidos
        * 
        * @var array 
        */
       protected $_espapedString;

       /**
        * Guarda as linhas de filtro
        * 
        * @var array
        */
       protected $_filters;

       /**
        * Guarda o arquivo que está sendo trabalhado
        * 
        * @var pointer
        */
       protected $_fileStream;

       /**
        * Guarda o nome do arquivo trabalhado
        * 
        * @var string 
        */
       protected $_fileName;

       public function __construct($options = false) {
           $this->_driver = 'CSV';

           $this->_badString = array(';', chr(10), chr(13));
           $this->_espapedString = array(' ', ' ', ' ');

           $this->_memoryManager = Zend_Memory::factory('none');
           $this->_memObject = $this->_memoryManager->create();
           try {
               $this->_fileName = 'Report_Excel_' . date('dmyhis') . '.csv';
               $file = new ZendT_File($this->_fileName);
               $this->_fileName = $file->getFilename();
               if (!$this->_fileName) {
                   throw new ZendT_Exception('Impossivel criar aquivo', '2');
               }
           } catch (Exception $e) {
               throw new ZendT_Exception($e->getMessage(), $e->getCode());
           }
       }

       /**
        * Retorna o titulo do documento
        * 
        * @return string 
        */
       public function getTitle() {
           return $this->_title;
       }

       /**
        * Define um titulo para o documento
        * 
        * @param string $title
        * @return \ZendT_Report_Xls 
        */
       public function setTitle($title) {
           $this->_title = $title;
           return $this;
       }

       /**
        * Define um novo nome para o arquivo de saida
        * 
        * @param string $value
        * @return \ZendT_Report_Xls 
        */
       public function setOutputName($value) {
           $this->_outputName = $value;
           return $this;
       }

       /**
        * Retorna o driver sendo utilizado (neste caso nenhum)
        * 
        * @return type 
        */
       public function getDriver() {
           return $this->_driver;
       }

       /**
        * Desenha uma linha entre $_xStart e $_xFinish
        * 
        * @param float $start
        * @param float $finish
        * @param int $height 
        * @return ZendT_Report_Abstract
        */
       public function drawLine($start = null, $finish = null, $height = 3) {
           foreach ($this->_cells as $column) {
               $this->_memObject->value.= ';';
           }
           $this->_memObject->value.= "\n";
           $this->_rows++;
       }

       /**
        *
        * @param int $height 
        * @return ZendT_Report_Abstract
        */
       public function ln($height = 3) {
           $cell = new ZendT_Report_Cell();
           $this->addCell($cell);
           $this->printCells();
           return $this;
       }

       /**
        *
        * @param string $string
        * @return string
        */
       protected function _escapeString($string) {
           return str_replace($this->_badString, $this->_espapedString, $string);
       }

       /**
        * Adiciona uma nova celula a tabela
        * @param ZendT_Report_Cell $cell
        * @return \ZendT_Report_Xls 
        */
       public function addCell(ZendT_Report_Cell $cell) {
           $this->_cells[] = $cell;
           return $this;
       }

       /**
        * Adiciona uma linha de titulo a tabela
        *  
        */
       protected function _titleLine() {
           if ($this->_title) {
               if ($this->_title instanceof ZendT_Report_Cell) {
                   $this->_memObject->value.= $this->_escapeString($this->_title->getValue());
               } else {
                   $this->_memObject->value.= $this->_escapeString($this->_title);
               }
               $this->_memObject->value.= "\n";
               $this->_rows++;
           } else {
               $this->drawLine();
           }
       }

       /**
        * Adiciona os filtros ao cabeçalho do xls
        */
       protected function _printFilters() {
           if (is_array($this->_filters) && count($this->_filters) > 0) {
               foreach ($this->_filters as $filterline) {
                   $linha = $filterline['field'] . ' ' . $filterline['operation'] . ' ' . $filterline['value'];
                   if (trim($linha)) {
                       $this->_memObject->value.= $linha . ';';
                   }
                   $this->_memObject->value.= "\n";
                   $this->_rows++;
               }
               $this->drawLine();
               $this->drawLine();
           }
       }

       /**
        * Coloca as celulas em uma linha
        * @return \ZendT_Report_Xls 
        */
       public function printCells() {
           if ($this->_rows < 1) {
               if (($this->_empresa || $this->_title)) {
                   $this->drawLine();
                   $this->drawLine();
                   $this->_titleLine();
                   $this->drawLine();
                   $this->drawLine();
               }
               $this->_printFilters();
           }
           foreach ($this->_cells as $column) {
               $value = $column->getValue();
               if ($value instanceof ZendT_Type_String) {
                   $column->setValue(utf8_encode($this->_escapeString($column->getValue()->get())), 'String');
               } elseif ($value instanceof ZendT_Type) {
                   $column->setValue($this->_escapeString($column->getValue()->get()), 'String');
               }
               $value = $column->getValue();
               if (trim($value)) {
                   $this->_memObject->value.= $value . ';';
               } else {
                   $this->_memObject->value.= ';';
               }
           }
           $this->_memObject->value.= "\n";
           if ($this->_rows % 500 == 0) {
               $this->_writeData($this->_memObject->value);
               $this->_memObject->value = '';
           }
           $this->_rows++;

           $this->_cells = array();
           return $this;
       }

       /**
        *
        * @param string $content 
        */
       private function _writeData($content) {
           file_put_contents($this->_fileName, $content, FILE_APPEND);
       }

       /**
        * Finaliza e imprime o arquivo xls
        * 
        * @param string $name
        * @param boolean $dest
        * @throws ZendT_Exception 
        */
       public function output($name = 'planilha', $dest = 'S') {
           if ($name == 'planilha' && $this->_outputName != '') {
               $name = $this->_outputName;
           } else if ($name == '') {
               $name = 'planilha';
           }
           /**
            * 
            */
           try {
               $name = 'Report_Excel_' . date('dmyhis') . '.csv';
               $this->_writeData($this->_memObject->value);
               $this->_memObject->value = '';
               $content = file_get_contents($this->_fileName);
               unlink($this->_fileName);
               if ($dest == 'S') {
                   return $content;
               } else {
                   ob_end_clean();
                   header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                   header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                   header("Cache-Control: no-cache");
                   header("Cache-Control: post-check=0, pre-check=0");
                   header("Pragma: no-cache");
                   header("Content-Type: application/vnd.ms-excel");
                   header("Content-Disposition: attachment; filename=" . $name . ".csv");
                   echo $content;
               }
           } catch (Exception $e) {
               throw new ZendT_Exception($e->getMessage(), $e->getCode());
           }
       }

       /**
        *
        * @return type 
        */
       public function getNumRows() {
           return $this->_rows;
       }

       /**
        *
        * @param string $value 
        * @return \ZendT_Report_Xls 
        */
       public function setEmpresa($value = 'TA') {
           $this->_empresa = $value;
       }

       /**
        *
        * @param array $defaults 
        */
       public function setCellDefault(array $defaults) {
           
       }

       /**
        *
        * @param ZendT_Db_Where $where 
        * @return \ZendT_Report_Xls 
        */
       public function setWhereHeaderFilter($where) {
           $this->_filters = $where;
           return $this;
       }

       /**
        *
        * @param string $string
        * @param string $filename 
        */
       protected function prepend($string, $filename) {
           $context = stream_context_create();
           $fp = fopen($filename, 'r', 1, $context);
           $tmpname = str_replace('.csv', '.tmp', $filename);
           file_put_contents($tmpname, $string);
           file_put_contents($tmpname, $fp, FILE_APPEND);
           fclose($fp);
           unlink($filename);
           rename($tmpname, $filename);
       }

   }

?>
