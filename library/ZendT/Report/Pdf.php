<?php

   /**
    * ZendT_Report_Pdf
    * 
    * @package ZendT
    * @subpackage ZendT_Report 
    * @author ksantoja
    * @version 1
    *
    */
   class ZendT_Report_Pdf extends ZendT_Report_Abstract {

       /**
        * Sentido de orientção do relátorio (p|portrait|l|landscape)
        * 
        * @var string
        */
       private $_orientation;

       /**
        * Sentido de orientção do relátorio (p|portrait|l|landscape)
        * 
        * @var string
        */
       private $_zebra;

       /**
        * Largura da pagina em px
        * 
        * @var int 
        */
       private $_pageWidth;

       /**
        * Maximo de colunas por linha
        * 
        * @var int 
        */
       private $_maxPerLine;

       /**
        * Unidade de medida do relátorio (pt|mm|cm|in)
        * 
        * @var string
        */
       private $_unit;

       /**
        * Tamanho da página do relátorio (a3|a4|a5|letter|legal)
        * 
        * @var string
        */
       private $_size;

       /**
        * Define a largura maxima da linha
        * 
        * @var int 
        */
       private $_maxLineWidth;

       /**
        * Define um footer para o documento
        * 
        * @param \ZendT_Report_Cell $options 
        */
       private $_footer;

       /**
        *
        * @var ZendT_Report_Fpdf 
        */
       protected $_driver;

       /**
        * Construtor da classe
        * 
        * @return void
        */
       public function __construct($options = false) {
           if ($options['template']) {
               $this->_driver = new $options['template']();
           } else {
               $this->_driver = new ZendT_Report_Fpdf();
           }

           if ($options['orientation'] == 'P') {
               $_widthTitle = 195;
           } else {
               $_widthTitle = 285;
           }

           //Parametros idênticos ao padrão css para facilitar o uso.
           //$options pode ser um array de opções ou o titulo do relatório
           $default = array(
              'empresa' => 'TA',
              'orientation' => 'P',
              'title' => array(
                 'fontSize' => 10,
                 'bold' => true,
                 'width' => $_widthTitle,
                 'align' => 'center',
                 'value' => 'Título do Relatório'),
              'unit' => 'mm',
              'size' => 'A4',
              'outputName' => 'relatorio',
              'lineIndex' => 0,
              'maxPerLine' => 5
           );
           if (is_array($options)) {
               $options = array_merge($default, $options);
           } else {
               $options = $default;
           }
           foreach ($options as $key => $value) {
               $this->{'_' . $key} = $value;
           }
           if ($this->_orientation == 'L') {
               $this->_pageWidth = 1625;
           } else {
               $this->_pageWidth = 1120;
           }

           if (is_array($this->_title)) {
               if (!$this->_title['fontSize']) {
                   $this->_title['fontSize'] = $default['title']['fontSize'];
               }
               if (!$this->_title['width']) {
                   $this->_title['width'] = $default['title']['width'];
               }
               if (!$this->_title['align']) {
                   $this->_title['align'] = $default['title']['align'];
               }
           }

           $this->_driver->setFooter($this->_footer);
           $this->_driver->setTitulo($this->_title);
           $this->_driver->setEmpresa($this->_empresa);
           $this->_driver->setOrientation($this->_orientation);
           $this->_driver->FPDF($this->_orientation);
           $this->_driver->SetMargins(5, 5, 5);
       }

       /**
        * 
        */
       public function addPage() {
           $this->getDriver()->AddPage();
           return $this;
       }

       /**
        * Define a configuração padrão para o documento
        * 
        * @param array $defaults 
        * @return ZendT_Report_Pdf
        */
       public function setCellDefault(array $defaults) {
           $this->_cellDefault = $defaults;
           return $this;
       }

       /**
        * @param string $title
        * @return ZendT_Report_Pdf
        */
       public function setTitle($title) {
           $this->_title['value'] = utf8_decode($title);
           parent::setTitle($this->_title);
           $this->_driver->setTitulo($this->_title);
           return $this;
       }

       /**
        * Seta um valor para a empresa do relatorio
        * 
        * @param string
        * @return ZendT_Report_Pdf
        */
       public function setEmpresa($value = false) {
           $this->_empresa = $value;
           return $this;
       }

       /**
        * Seta um valor para a orientação do relatorio
        * 
        * @param string
        * @return ZendT_Report_Pdf
        */
       public function setOrientation($value = false) {
           $this->_orientation = $value;
           return $this;
       }

       /**
        * Seta um valor para a unidade de medida do relatorio
        * 
        * @param string
        * @return ZendT_Report_Pdf
        */
       public function setUnit($value = false) {
           $this->_unit = $value;
           return $this;
       }

       /**
        * Seta um valor para o tamanho da folha do relatorio
        * 
        * @param string
        * @return ZendT_Report_Pdf
        */
       public function setSize($value = false) {
           $this->_size = $value;
           return $this;
       }

       /**
        * Define o nome do arquivo de saida
        * 
        * @param string $value
        * @return \ZendT_Report_Pdf 
        */
       public function setOutputName($value) {
           $this->_outputName = $value;
           return $this;
       }

       /**
        * Define o tamanho maximo da linha
        * 
        * @param int $value
        * @return \ZendT_Report_Pdf 
        */
       public function setMaxLineWidth(int $value) {
           $this->_maxLineWidth = $value;
           return $this;
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
           $x1 = $this->getDriver()->GetX();
           $y1 = $this->getDriver()->GetY();
           ;
           $y2 = $y1;
           if ($start !== null) {
               $y1+= $start;
           }
           if ($finish !== null) {
               $x2 = $finish;
           } else {
               $x2 = $this->getDriver()->w - $this->getDriver()->lMargin - $this->getDriver()->rMargin;
           }
           $this->getDriver()->Line($x1, $y1, $x2, $y2);
           //$this->getDriver()->Ln($height);
           return $this;
       }

       /**
        *
        * @param type $height 
        * @return ZendT_Report_Abstract
        */
       public function ln($height = 3) {
           $this->getDriver()->Ln($height);
           return $this;
       }

       /**
        * Imprime as celulas do relatorio
        * @return ZendT_Report_Abstract
        */
       public function printCells($zebra = false, $title=false) {
           $options = array();
           if ($this->_zebra && $zebra) {
               if (!$this->_colorZebra) {
                   $options['backgroundColor'] = '#FFFFFF';
                   $this->_colorZebra = 1;
               } else {
                   $options['backgroundColor'] = '#efefef';
                   $this->_colorZebra = 0;
               }
           }
           for ($iLine = 0; $iLine < $this->_cells['maxLine']; $iLine++) {
               $defaultWidth = $this->_pageWidth / count($this->_cells['cell']);
               if ($this->_cells['cell']) {
                   foreach ($this->_cells['cell'] as $key => $celula) {
                       $values = $this->_cells['values'][$key][$iLine];
                       $celulaOk = $this->_driver->makeCell($celula, $options);
                       $borders = $celulaOk['border'];
                       if ($iLine != ($this->_cells['maxLine'] - 1)) {
                           $borders = str_ireplace('B', '', $borders);
                       }
                       if ($iLine != 0) {
                           $borders = str_ireplace('T', '', $borders);
                       }
                       if (!$celulaOk['celula']->getWidth()) {
                           $celulaOk['celula']->setWidth($defaultWidth);
                       }
                       $celulaOk['url'] = $celulaOk['celula']->getUrl();
                       if ($celulaOk['url']) {
                           if(strpos($celulaOk['url'], "typeModal") === false){
                               $celulaOk['url'].= '&typeModal=PDF#zoom=120';
                           }
                       }
                       
                       $cell = array();
                       $cell['width'] = $this->_pxToCm($celulaOk['celula']->getWidth());
                       $cell['height'] = $celulaOk['celula']->getHeight();
                       $cell['value'] = $values;
                       $cell['border'] = $borders;
                       $cell['align'] = $celulaOk['celula']->getTextAlign();
                       $cell['color'] = $celulaOk['color'];
                       $cell['url'] = $celulaOk['url'];
                       $cell['fontName'] = $celulaOk['celula']->getFontName();
                       $cell['style'] = $celulaOk['celula']->getStyle();
                       $cell['fontSize'] = $celulaOk['celula']->getFontSize();
                       
                       $this->_driver->Cell($cell['width'], 
                                            $cell['height'], 
                                            $cell['value'], 
                                            $cell['border'], 
                                            0, 
                                            $cell['align'], 
                                            $cell['color'], 
                                            $cell['url']);
                       if ($title){
                           $this->_driver->addCellTitle($cell);
                       }
                   }
               }
               $this->_driver->Ln();
               if ($title){
                   $this->_driver->addLineTitle();
               }
           }
           $this->_cells = array();
           return $this;
       }
       /**
        * Adiciona uma celula
        * 
        * @param ZendT_Report_Cell $_cell 
        * @return ZendT_Report_Abstract
        */
       public function addCell(ZendT_Report_Cell $_cell) {
           $this->_driver->SetFont($_cell->getFontName(), $_cell->getStyle(), $_cell->getFontSize());
           $value = $_cell->getValue();
           if ($value instanceof ZendT_Type) {
               $value = utf8_decode($value->get());
           } else {
               $value = utf8_decode($value);
           }
           if (strtoupper($value) == $value) {
               $width = $this->_driver->GetStringWidth('Z');
           } else {
               $width = $this->_driver->GetStringWidth('z');
           }
           if ($_cell->getWidth()) {
               $space = $_cell->getWidth();
           } else {
               $space = $this->_pageWidth / $this->_maxPerLine;
           }
           $numCaracter = round($this->_pxToCm($space) / $width);
           $arrayValues = array();
           $this->_wordWrap($value, $numCaracter, $arrayValues);
           if (count($arrayValues) > $this->_cells['maxLine']) {
               $this->_cells['maxLine'] = count($arrayValues);
           }
           $this->_cells['values'][] = $arrayValues;
           $this->_cells['cell'][] = $_cell;
           return $this;
       }

       /**
        * Imprime o relatorio
        * 
        * @param string $nomeArquivo 
        * @param string $dest
        */
       public function output($name = '', $dest = 'S') {
           ob_end_clean();
           if (stripos(strtoupper($name), '.PDF') === false) {
               $name.= '.pdf';
           }
           return $this->_driver->Output($name, $dest);
       }

       /**
        * Pega o width de uma determinada linha. Por default retorna a linha atual
        * 
        * @param int $line
        * @return int 
        */
       public function getLineWidth($line = false) {
           if (!$line) {
               $line = $this->_lineIndex;
           }
           return $this->_lines[$this->_lineIndex]['width'];
       }

       /**
        * Retorna a quantidade de linha atual do relátorio
        * 
        * @return int
        */
       public function countLines() {
           return count($this->_lines);
       }

       /**
        * Retorna o driver do pdf para uso direto
        * 
        * @return FPDF 
        */
       public function getDriver() {
           return $this->_driver;
       }

       /**
        * Converte px para cm com base em 150 dpi
        * 
        * @param int $value
        * @return int 
        */
       private function _pxToCm($value) {
           return $value * 0.264583333; //($value*25.4)/150;
       }

       /**
        * Quebra uma string com base a na quantidade de caracter informando
        * retornando um array de valores com as linhas a serem impressas.
        *
        * @param string|int $value
        * @param int $numCaracter número de caracteres para efetuar a quebra
        * @param array $arrayValues variável passada como referência, que receberá os valores quebrados em linha
        * 
        * @return void
        */
       private function _wordWrap($value, $numCaracter, &$arrayValues) {
           if (strlen($value) > $numCaracter && $numCaracter != 0) {
               if (substr($value, $numCaracter, 1) == ' ') {
                   $arrayValues[] = substr($value, 0, $numCaracter);
                   $value = ltrim(substr($value, $numCaracter + 1, strlen($value)));
               } elseif (substr($value, $numCaracter + 1, 1) == ' ') {
                   $arrayValues[] = substr($value, 0, $numCaracter + 1);
                   $value = ltrim(substr($value, $numCaracter + 2, strlen($value)));
               } else {
                   $i = $numCaracter - 1;
                   while (substr($value, $i, 1) != ' ' and $i > 0) {
                       $i--;
                   }
                   if ($i > 0) {
                       $arrayValues[] = substr($value, 0, $i);
                       $value = ltrim(substr($value, $i, strlen($value) + 1));
                   } else {
                       $arrayValues[] = substr($value, 0, $numCaracter);
                       $value = ltrim(substr($value, $numCaracter, strlen($value) + 1));
                   }
               }
               $this->_wordWrap($value, $numCaracter, $arrayValues);
           } else {
               $arrayValues[] = $value;
           }
       }

   }

?>
