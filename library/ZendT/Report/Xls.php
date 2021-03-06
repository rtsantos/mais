<?php

   /**
    * ZendT_Report_Xls
    * 
    * @package ZendT
    * @subpackage ZendT_Report 
    * @author rsantos
    * @version 2
    *
    */
   class ZendT_Report_Xls extends ZendT_Report_Abstract {

       /**
        * Define a empresa para colocação do logo
        * 
        * @var string @example TA,TAE,TAL,WIN
        */
       private $_empresa;

       /**
        * Conterá a estrutura do arquivo XLS
        * de acordo com os padrões da microsoft
        * 
        * @var string
        */
       protected $__estruturaAntes;

       /**
        * Conterá a estrutura do arquivo XLS
        * de acordo com os padrões da microsoft
        * 
        * @var string
        */
       protected $__estruturaDepois;

       /**
        *
        * @var Object[]
        */
       protected $_columns;

       /**
        * Numero de colunas total
        * 
        * @var int 
        */
       protected $_numColumns = 1;

       /**
        * Indica em qual linha estamos trabalhando
        * 
        * @var type 
        */
       protected $_lineIndex;

       /**
        *
        * @var string
        */
       protected $_rows;

       /**
        * Array com tipos possiveis de celular
        * 
        * @var array
        */
       protected $_cellType;

       /**
        * Array de estilos de celulas
        * 
        * @var array 
        */
       protected $_styles;

       /**
        * Array com as propriedades de estilos da celula
        * 
        * @var array 
        */
       protected $_objStyles;

       /**
        * String com os styles da tabela
        * 
        * @var string 
        */
       protected $_tastyles;

       /**
        * Array de alinhamentos
        * 
        * @var Array 
        */
       protected $_alignArray;

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

           $default = array(
              'empresa' => 'TA',
              'orientation' => 'P',
              'unit' => 'mm',
              'size' => 'A4',
              'outputName' => 'relatorio',
              'lineIndex' => 0,
           );

           $this->_badString = array('&', '<', '>', "'", '"', 'ª', 'º', '¿');
           $this->_espapedString = array('&amp;', '&lt;', '&gt;', '&apos;', '&quot;', '', '', '');

           $this->_memoryManager = Zend_Memory::factory('none');
           $this->_memObject = $this->_memoryManager->create();
           $this->_numColumns = 1;

           if (is_array($options)) {
               $options = array_merge($default, $options);
           } else {
               $options = $default;
           }
           foreach ($options as $key => $value) {
               $this->{'_' . $key} = $value;
           }

           $this->_objStyles = array(
              'FontName',
              'FontSize',
              'FontColor',
              'FontBold',
              'FontItalic',
              'TextDecoration',
              'BackgroundColor',
              'BorderTop',
              'BorderLeft',
              'BorderRight',
              'BorderBottom',
              'TextAlign',
              'Type');

           $this->_alignArray = array('L' => 'Left', 'R' => 'Right', 'C' => 'Center');

           $this->_estruturaAntes = '<?xml version="1.0" encoding="UTF-8"?>
    <?mso-application progid="Excel.Sheet"?>
    <Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
    xmlns:o="urn:schemas-microsoft-com:office:office"
    xmlns:x="urn:schemas-microsoft-com:office:excel"
    xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
    xmlns:html="http://www.w3.org/TR/REC-html40">
    <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
    <Author>TA</Author>
    <LastAuthor>TA</LastAuthor>
    <Created>' . date('Y-m-d') . 'T' . date('H:i:s') . 'Z</Created>
    <Company>TA</Company>
    <Version>11.5606</Version>
    </DocumentProperties>
    <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
    <AllowPNG/>
    </OfficeDocumentSettings>
    <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
    <WindowHeight>9345</WindowHeight>
    <WindowWidth>11340</WindowWidth>
    <WindowTopX>480</WindowTopX>
    <WindowTopY>60</WindowTopY>
    <ProtectStructure>False</ProtectStructure>
    <ProtectWindows>False</ProtectWindows>
    </ExcelWorkbook>
    <Styles>
    <Style ss:ID="Default" ss:Name="Normal">
    <Alignment ss:Vertical="Bottom"/>
    <Borders/>
    <Font/>
    <Interior/>
    <NumberFormat/>
    <Protection/>
    </Style>
    <Style ss:ID="Title">
    <Font x:Family="Swiss" ss:Bold="1"/>
    </Style>
    <Style ss:ID="String">
        <Font ss:FontName="Arial" ss:Size="7" ss:Color="#000000"/>
        <Alignment ss:Horizontal="Left" ss:Indent="0"/>    
    </Style>
    <Style ss:ID="Numeric">

    </Style>
    <Style ss:ID="Integer"></Style>
    <Style ss:ID="Date">
    <NumberFormat ss:Format="Short Date"/>
    </Style>
    <Style ss:ID="DateTime">
    <NumberFormat ss:Format="d/m/yy\ h:mm;@"/>
    </Style>
    <Style ss:ID="Time">
    <NumberFormat ss:Format="Short Time"/>
    </Style>
    <Style ss:ID="NumberTime">
    <NumberFormat ss:Format="[hh]:mm:ss"/>
    </Style>
    TaStyles
    </Styles>
    <Worksheet ss:Name="titleFile">
    <Table ss:ExpandedColumnCount="columnQuantity" ss:ExpandedRowCount="rowQuantity" x:FullColumns="1" x:FullRows="1">
    columns';
           $this->_estruturaDepois = '
    </Table>
    <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
    <PageSetup>
        <Header x:Margin="0.49212598499999999"/>
        <Footer x:Margin="0.49212598499999999"/>
        <PageMargins x:Bottom="0.984251969" x:Left="0.78740157499999996" x:Right="0.78740157499999996" x:Top="0.984251969"/>
    </PageSetup>
    <Print>
        <ValidPrinterInfo/>
        <PaperSizeIndex>9</PaperSizeIndex>
        <HorizontalResolution>600</HorizontalResolution>
        <VerticalResolution>600</VerticalResolution>
    </Print>
    <Selected/>
    <Panes>
        <Pane>
        <Number>3</Number>
        <ActiveRow>12</ActiveRow>
        <ActiveCol>6</ActiveCol>
        </Pane>
    </Panes>
    <ProtectObjects>False</ProtectObjects>
    <ProtectScenarios>False</ProtectScenarios>
    </WorksheetOptions>
    </Worksheet>
    <Worksheet ss:Name="Plan2">
    <Table ss:ExpandedColumnCount="1" ss:ExpandedRowCount="1" x:FullColumns="1"
    x:FullRows="1" ss:DefaultRowHeight="15">
    </Table>
    <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
    <PageSetup>
        <Header x:Margin="0.49212598499999999"/>
        <Footer x:Margin="0.49212598499999999"/>
        <PageMargins x:Bottom="0.984251969" x:Left="0.78740157499999996" x:Right="0.78740157499999996" x:Top="0.984251969"/>
    </PageSetup>
    <ProtectObjects>False</ProtectObjects>
    <ProtectScenarios>False</ProtectScenarios>
    </WorksheetOptions>
    </Worksheet>
    <Worksheet ss:Name="Plan3">
    <Table ss:ExpandedColumnCount="1" ss:ExpandedRowCount="1" x:FullColumns="1"
    x:FullRows="1" ss:DefaultRowHeight="15">
    </Table>
    <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
    <PageSetup>
        <Header x:Margin="0.49212598499999999"/>
        <Footer x:Margin="0.49212598499999999"/>
        <PageMargins x:Bottom="0.984251969" x:Left="0.78740157499999996" x:Right="0.78740157499999996" x:Top="0.984251969"/>
    </PageSetup>
    <ProtectObjects>False</ProtectObjects>
    <ProtectScenarios>False</ProtectScenarios>
    </WorksheetOptions>
    </Worksheet>
    </Workbook>
    ';
           $this->_lineIndex = 0;
           $this->_memObject->value = '';
           $this->_cellType = array(
              'NumberTime' => 'DateTime',
              'Numbertime' => 'DateTime',
              'Time' => 'DateTime',
              'Datetime' => 'DateTime',
              'DateTime' => 'DateTime',
              'Date' => 'DateTime',
              'Number' => 'Number',
              'Integer' => 'Number',
              'Numeric' => 'Number',
              'String' => 'String'
           );
           try {
               $this->_name = 'Report_Excel_' . time() . '.xml';
               $file = new ZendT_File($this->_name);
               $this->_fileName = $file->getFilename();
               if (!$this->_fileName) {
                   throw new ZendT_Exception('Impossivel criar aquivo', '2');
               }
               //$this->_fileStream = fopen($this->_fileName, 'r+');
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
           $this->_memObject->value.= "<Row>\n";
           foreach ($this->_cells as $column) {
               $styleId = $column->getTaStyle();
               if (!$styleId)
                   $styleId = 'String';
               $this->_memObject->value.= '<Cell ss:StyleID="' . $styleId . '"/>' . "\n";
           }
           $this->_memObject->value.= "</Row>\n\n";
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
        * Checa se o estilo da celula já existe, se não chama a função para criar os estilos novos.
        * Retorna o nome do novo estilo ou do estilo já existente
        * 
        * @param ZendT_Report_Cell $cell
        * @return string 
        */
       private function _checkStyle(ZendT_Report_Cell $cell) {
           $styleName = false;
           $cellStyleName = $cell->getStyleName();
           if (is_array($this->_styles) && in_array($cellStyleName, $this->_styles)) {
               $styleName = $cellStyleName;
           } else {
               $styleName = $cellStyleName;
               $this->_styles[count($this->_styles)] = $cellStyleName;
               $this->_createStyle($cell, $styleName);
           }
           return $styleName;
       }

       /**
        * Cria um novo estilo para celulas baseado em um obj ZendT_Report_Cell
        * 
        * @param ZendT_Report_Cell $cell
        * @param string $styleName 
        */
       private function _createStyle(ZendT_Report_Cell $cell, $styleName) {
           $border = $cell->getBorders();
           $cellType = $cell->getType();
           $wrapText = '0';
           $this->_tastyles.= '<Style ss:ID="' . $styleName . '">' . "\n";
           if ($border['borders'] != '') {
               $this->_tastyles.= "<Borders>\n";
               if ($cell->getBorderTop()) {
                   $thisBorder = $cell->getBorderTop();
                   $this->_tastyles.= $this->_createStyleBorders('Top', $thisBorder);
               }
               if ($cell->getBorderBottom()) {
                   $thisBorder = $cell->getBorderBottom();
                   $this->_tastyles.= $this->_createStyleBorders('Bottom', $thisBorder);
               }
               if ($cell->getBorderRight()) {
                   $thisBorder = $cell->getBorderRight();
                   $this->_tastyles.= $this->_createStyleBorders('Right', $thisBorder);
               }
               if ($cell->getBorderLeft()) {
                   $thisBorder = $cell->getBorderLeft();
                   $this->_tastyles.= $this->_createStyleBorders('Left', $thisBorder);
               }
               $this->_tastyles.= "</Borders>\n";
           }
           if ($cell->getFontName()) {
               $fontStyle = '<Font';
               $fontStyle.= ' ss:FontName="' . $cell->getFontName() . '"';
           }
           if ($cell->getFontSize()) {
               if (!$fontStyle) {
                   $fontStyle = '<Font';
               }
               $fontStyle.= ' ss:Size="' . $cell->getFontSize() . '"';
           }
           if ($cell->getFontColor()) {
               if (!$fontStyle) {
                   $fontStyle = '<Font';
               }
               $fontStyle.= ' ss:Color="' . $cell->getFontColor() . '"';
           }
           if ($cell->getFontBold()) {
               if (!$fontStyle) {
                   $fontStyle = '<Font';
               }
               $fontStyle.= ' ss:Bold="1"';
           }
           if ($cell->getFontItalic()) {
               if (!$fontStyle) {
                   $fontStyle = '<Font';
               }
               $fontStyle.= ' ss:Italic="1"';
           }
           if ($cell->getTextDecoration()) {
               if (!$fontStyle) {
                   $fontStyle = '<Font';
               }
               $fontStyle.= ' ss:Underline="Single"';
           }
           if ($fontStyle) {
               $fontStyle.= '/>' . "\n";
               $this->_tastyles.= $fontStyle;
           }
           if ($cell->getBackgroundColor()) {
               $this->_tastyles.= '<Interior ss:Color="' . $cell->getBackgroundColor() . '" ss:Pattern="Solid"/>' . "\n";
           }
           if ($cellType == 'String') {
               $wrapText = '1';
           }
           if ($cell->getTextAlign()) {
               $this->_tastyles.= '<Alignment ss:Vertical="Center" ss:Horizontal="' . $this->_alignArray[$cell->getTextAlign()] . '" ss:Indent="0" ss:WrapText="' . $wrapText . '"/>' . "\n";
           }
           if ($cellType == 'Date') {
               $this->_tastyles.= '<NumberFormat ss:Format="Short Date"/>';
           } else if ($cellType == 'Time') {
               $this->_tastyles.= '<NumberFormat ss:Format="Short Time"/>';
           } else if ($cellType == 'NumberTime' || $cellType == 'Numbertime') {
               $this->_tastyles.= '<NumberFormat ss:Format="[hh]:mm:ss"/>';
           } else if ($cellType == 'DateTime' || $cellType == 'Datetime') {
               $this->_tastyles.= '<NumberFormat ss:Format="dd/mm/yy\ hh:mm;@"/>';
           } else if ($cellType == 'Numeric' || $cellType == 'Integer') {
               if ($cell->getValue() instanceof ZendT_Type_Number) {
                   $options = $cell->getValue()->getOptions();
                   if (isset($options['numDecimal'])) {
                       if ($options['numDecimal'] > 0) {
                           $this->_tastyles.= '<NumberFormat ss:Format="#,##0.' . str_repeat('0', $options['numDecimal']) . '"/>';
                       } else {
                           $this->_tastyles.= '<NumberFormat ss:Format="#,##0"/>';
                       }
                   }
               } else {
                   if ($cellType == 'Integer') {
                       $this->_tastyles.= '<NumberFormat ss:Format="0"/>';
                   } else if ($cellType == 'Numeric') {
                       $this->_tastyles.= '<NumberFormat ss:Format="#,##0.00"/>';
                   }
               }
           }
           $this->_tastyles.= '</Style>' . "\n";
           return null;
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
        * Cria um estilo novo de borda, baseado em um array
        * 
        * @param string $side
        * @param array $thisBorder
        * @return string 
        */
       private function _createStyleBorders($side, $thisBorder) {
           $retorno .= '<Border';
           if ($thisBorder['width']) {
               $retorno.= ' ss:Weight="' . $thisBorder['width'] . '" ';
           }
           if ($thisBorder['style']) {
               $retorno.= ' ss:LineStyle="Continuous" ';
           }
           if ($thisBorder['color']) {
               $retorno.= ' ss:Color="' . $thisBorder['color'] . '" ';
           }
           $retorno .= ' ss:Position="' . $side . '"/>' . "\n";
           return $retorno;
       }

       /**
        * Adiciona uma nova celula a tabela
        * @param ZendT_Report_Cell $cell
        * @return \ZendT_Report_Xls 
        */
       public function addCell(ZendT_Report_Cell $cell) {
           if ($this->_rows < 1) {
               if ($cell->getType() == '') {
                   $cell->setType('Title');
               }
           }
           $cell->setTaStyle($this->_checkStyle($cell));
           $this->_cells[] = $cell;
           if (count($this->_cells) > $this->_numColumns) {
               $this->_numColumns = count($this->_cells);
               $this->_columns = '';
               foreach ($this->_cells as $key => $cell) {
                   $this->_columns.= '<Column ss:AutoFitWidth="0" ss:Width="';
                   if ($cell->getWidth() > 0) {
                       if ($key == 0 && $cell->getWidth() < 170) {
                           $this->_columns.= '170';
                       } else {
                           $this->_columns.= $cell->getWidth();
                       }
                   } else {
                       $this->_columns.= '170';
                   }
                   $this->_columns.= '"';
                   if ($cell->getColspan() > 0) {
                       $this->_columns.= ' ss:MergeAcross="' . $cell->getColspan() . '"';
                   }
                   $this->_columns.= '/>' . "\n";
               }
           }
           return $this;
       }

       /**
        * Adiciona uma linha de titulo a tabela
        *  
        */
       protected function _titleLine() {
           if ($this->_title) {
               $this->_memObject->value.= "<Row>\n";
               $this->_memObject->value.= '<Cell/>' . "\n";
               if ($this->_title instanceof ZendT_Report_Cell) {
                   $cellType = $this->_title->getType();
                   $this->_title->setTaStyle($this->_checkStyle($this->_title));
                   if ($this->_cellType[$cellType]) {
                       $tipo = $this->_cellType[$cellType];
                       $this->_title->setValue($this->_formatData($this->_title->getValue(), $cellType));
                   } else {
                       $value = $this->_title->getValue();
                       if ($value instanceof ZendT_Type_String) {
                           $this->_title->setValue(utf8_encode($this->_escapeString($this->_title->getValue()->get())), 'String');
                       } elseif ($value instanceof ZendT_Type) {
                           $this->_title->setValue($this->_escapeString($this->_title->getValue()->get()), 'String');
                       } else {
                           $this->_title->setValue(utf8_encode($this->_title->getValue()), 'String');
                       }
                       $tipo = 'String';
                   }
                   $value = $this->_title->getValue();
                   $estilo = $this->_title->getTaStyle();
                   if ($estilo) {
                       $estilo = 'ss:StyleID="' . $estilo . '"';
                   }
                   if (trim($value)) {
                       $this->_memObject->value.= '<Cell ' . $estilo . '><Data ss:Type="' . $tipo . '">' . $value . '</Data></Cell>' . "\n";
                   } else {
                       $this->_memObject->value.= '<Cell ' . $estilo . '/>' . "\n";
                   }
               } else {
                   $_cell = new ZendT_Report_Cell();
                   $_cell->setFontWeight('bold')
                         ->setFontSize(14);
                   $_cell->setTaStyle($this->_checkStyle($_cell));
                   $styleId = $_cell->getTaStyle();
                   if (!$styleId)
                       $styleId = 'String';
                   $this->_memObject->value.= '<Cell ss:StyleID="' . $styleId . '"><Data ss:Type="String">' . $this->_escapeString($this->_title) . '</Data></Cell>' . "\n";
               }
               $this->_memObject->value.= "</Row>\n\n";
               $this->_rows++;
           } else {
               $this->drawLine();
           }
       }

       protected function _dateLine() {
           $_cell = new ZendT_Report_Cell();
           $_cell->setTextAlign('center');
           $_cell->setFontSize(7);
           $_cell->setTaStyle($this->_checkStyle($_cell));
           $styleId = $_cell->getTaStyle();
           if (!$styleId)
               $styleId = 'String';
           $date = ZendT_Type_Date::nowDateTime()->get();
           $this->_memObject->value.= "<Row>\n";
           $this->_memObject->value.= '<Cell ss:StyleID="' . $styleId . '"><Data ss:Type="String">' . $this->_escapeString($date) . '</Data></Cell>' . "\n";
           $this->_memObject->value.= "</Row>\n\n";
           $this->_rows++;
       }

       /**
        * Adiciona os filtros ao cabeçalho do xls
        */
       protected function _printFilters() {
           if (is_array($this->_filters) && count($this->_filters) > 0) {
               foreach ($this->_filters as $filterline) {
                   $this->_memObject->value.= "<Row>\n";
                   $linha = $filterline['field'] . ' ' . $filterline['operation'] . ' ' . $filterline['value'];
                   if (trim($linha)) {
                       $this->_memObject->value.= '<Cell ><Data ss:Type="String">' . $linha . '</Data></Cell>' . "\n";
                   }
                   $this->_memObject->value.= "</Row>\n\n";
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
       public function printCells($zebra = false, $title = false) {
           if ($this->_rows < 1) {
               if (($this->_empresa || $this->_title)) {
                   $this->_dateLine();
                   $this->drawLine();
                   #$this->drawLine();
                   $this->_titleLine();
                   $this->drawLine();
                   $this->drawLine();
               }
               $this->_printFilters();
           }
           $this->_memObject->value.= "<Row>\n";
           foreach ($this->_cells as $column) {
               if ($this->_cellType[$column->getType()]) {
                   $tipo = $this->_cellType[$column->getType()];
                   $column->setValue($this->_formatData($column->getValue(), $column->getType()));
               } else {
                   $value = $column->getValue();
                   if ($value instanceof ZendT_Type_String) {
                       $column->setValue(utf8_encode($this->_escapeString($column->getValue()->get())), 'String');
                   } elseif ($value instanceof ZendT_Type) {
                       $column->setValue($this->_escapeString($column->getValue()->get()), 'String');
                   }
                   $tipo = 'String';
               }
               $value = $column->getValue();
               $styleId = $column->getTaStyle();
               if (!$styleId)
                   $styleId = 'String';

               $href = '';
               $url = $column->getUrl();
               if ($url && strlen($url) <= 150) {
                   $href = ' ss:HRef="' . $url . '"';
               }
               $mergeAcross = '';
               $colspan = $column->getColspan();
               if ($colspan > 0) {
                   $mergeAcross = ' ss:MergeAcross="' . $colspan . '"';
               }

               if (trim($value)) {
                   $this->_memObject->value.= '<Cell ss:StyleID="' . $styleId . '"' . $href . $mergeAcross . '><Data ss:Type="' . $tipo . '">' . $value . '</Data></Cell>' . "\n";
               } else {
                   $this->_memObject->value.= '<Cell ss:StyleID="' . $styleId . '"' . $href . $mergeAcross . '/>' . "\n";
               }
           }
           $this->_memObject->value.= "</Row>\n\n";
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
        * @param string $value
        * @param string $type
        * @return string 
        */
       private function _formatData($value, $type) {
           if ($value instanceof ZendT_Type_String) {
               $value = $this->_escapeString($value->get());
           } elseif ($value instanceof ZendT_Type_Date) {
               $value = $value->getW3C();
               if ($value) {
                   if (strpos($value, ' ') === false) {
                       $value.= 'T00:00:00.000';
                   } else {
                       $value.= ':00.000';
                       $value = str_replace(' ', 'T', $value);
                   }
               }
           } elseif ($value instanceof ZendT_Type_Number) {
               $value = $value->toPhp();
               if ($value == '') {
                   $value = '0.00';
               }
           } elseif (($value instanceof ZendT_Type_NumberTime) || ($type == 'Numbertime' || $type == 'NumberTime')) {
               $value = $value->getExcel();
           } elseif ($value instanceof ZendT_Type) {
               $value = $value->get();
           } else {
               if (trim($value)) {
                   if ($type == 'Date') {
                       $value = substr($value, -4) . '-' . substr($value, 3, 2) . '-' . substr($value, 0, 2) . 'T00:00:00.000';
                   } else if ($type == 'Time') {
                       if (strlen($value) == 5) {
                           $value.= ':00.000';
                       } else if (strlen($value) == 8) {
                           $value.= '.000';
                       }
                       $value = '1899-12-31T' . $value;
                   } else if ($type == 'Datetime' || $type == 'DateTime') {
                       $date = substr($value, 6, 4) . '-' . substr($value, 3, 2) . '-' . substr($value, 0, 2);
                       $time = substr($value, 11);
                       if ($time == '') {
                           $time = '00:00:00';
                       }
                       if (strlen($time) == 5) {
                           $time.= ':00';
                       }
                       $value = $date . 'T' . $time . '.000';
                   } else if ($type == 'Number' || $type == 'Integer' || $type == 'Numeric') {
                       $value = str_replace(',', '.', str_replace('.', '', $value));
                   } else {
                       $value = ($value);
                   }
               }
           }
           return $value;
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
               $this->_writeData($this->_memObject->value);
               $this->_memObject->value = '';
               $this->_writeData($this->_estruturaDepois);

               $content = preg_replace('#titleFile#', $name, $this->_estruturaAntes);
               $content = preg_replace('#columns#', $this->_columns, $content);
               $content = preg_replace('#columnQuantity#', ($this->_numColumns + 20), $content);
               $content = preg_replace('#rowQuantity#', $this->_rows, $content);
               $content = preg_replace('#TaStyles#', $this->_tastyles, $content);

               $this->_mergeFile($content);
               $content = file_get_contents($this->_fileName);


               /* @$conn = ftp_connect('impressao02.tanet.com.br');
                 if (!$conn) {
                 throw new ZendT_Exception(error_get_last());
                 }
                 @$result = ftp_login($conn, 'wsoffice', 'w5t@off7c3');
                 if (!$result) {
                 throw new ZendT_Exception(error_get_last());
                 }
                 $fileNameServer = 'xml/' . $this->_name;
                 @$result = ftp_put($conn, $fileNameServer, $this->_fileName, FTP_BINARY);
                 if (!$result) {
                 throw new ZendT_Exception(error_get_last());
                 }
                 @$result = ftp_close($conn);

                 require_once('Extra/NuSoap/nusoap.php');
                 $client = new nusoapclient('http://impressao02.tanet.com.br/wsOffice/excel.php', false, false, false, false, false, 12000, 12000);
                 $imageName = '';
                 if ($this->_empresa == 'WIN' || $this->_empresa == 'TAA'){
                 $this->_empresa = 'TAE';
                 }
                 if (in_array($this->_empresa, array('TA', 'TAE', 'TAL', 'TLG'))) {
                 $imageName = 'logo-' . strtolower($this->_empresa) . '.gif';
                 }

                 $param = array(
                 'p_val_auth' => 'W5_T@_OFF7C3',
                 'p_content' => $fileNameServer,
                 'p_format_out' => 43,
                 'p_image_name' => $imageName
                 );

                 $result = $client->call('Convert', $param);
                 //echo '<pre>' . $client->debug_str . '</pre>';

                 if ($result['error'] == 1) {
                 throw new ZendT_Exception($result['message']);
                 } else {
                 @$conn = ftp_connect('impressao02.tanet.com.br');
                 if (!$conn) {
                 throw new ZendT_Exception(error_get_last());
                 }
                 @$result_login = ftp_login($conn, 'wsoffice', 'w5t@off7c3');
                 if (!$result_login) {
                 throw new ZendT_Exception(error_get_last());
                 }
                 $fileNameLocal = str_ireplace('.xml','.xls',$this->_fileName);
                 @$result = ftp_get($conn, $fileNameLocal, $result['content'], FTP_BINARY);
                 if (!$result) {
                 throw new ZendT_Exception(error_get_last());
                 }
                 @$result = ftp_close($conn);
                 $content = file_get_contents($fileNameLocal);

                 unlink($fileNameLocal);
                 unlink($this->_fileName);
                 } */
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
                   header("Content-Disposition: attachment; filename=" . $this->_name);
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
        * @param string $content 
        */
       private function _writeData($content) {
           file_put_contents($this->_fileName . 'x', $content, FILE_APPEND);
       }

       /**
        *
        * @param string $string
        * @param string $filename 
        */
       protected function _mergeFile($content) {
           file_put_contents($this->_fileName, $content);

           $context = stream_context_create();
           $fp = fopen($this->_fileName . 'x', 'r', 1, $context);
           file_put_contents($this->_fileName, $fp, FILE_APPEND);
           fclose($fp);

           unlink($this->_fileName . 'x');
       }

   }

?>
