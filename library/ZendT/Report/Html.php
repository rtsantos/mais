<?php

   /**
    * ZendT_Report_Html
    * 
    * @package ZendT
    * @subpackage ZendT_Report 
    * @author rsantos
    * @version 1
    *
    */
   class ZendT_Report_Html extends ZendT_Report_Abstract {

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
        * saída html
        * 
        * @var string
        */
       private $_output;

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
        * @var array
        */
       private $_styles = array();

       /**
        * Construtor da classe
        * 
        * @return void
        */
       public function __construct($options = false) {

           $this->_decorators = array(new ZendT_Form_Decorator());

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
                 'print' => 1,
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

           $this->_options = $options;

           $this->_title = $default['title'];
           #$this->_driver->setTitulo($this->_title);
           #$this->_driver->setEmpresa($this->_empresa);
           #$this->_driver->setOrientation($this->_orientation);

           switch ($this->_empresa) {
               case 'TA': $logo = ZendT_Url::getBaseDiretoryPublic() . "/images/logo_ta.jpg";
                   break;
               case 'WIN':
               case 'TAA':
               case 'TAE': $logo = ZendT_Url::getBaseDiretoryPublic() . "/images/logo_tae.jpg";
                   break;
               case 'TAL':
               case 'TLG': $logo = ZendT_Url::getBaseDiretoryPublic() . "/images/logo_tal.jpg";
                   break;
               default: $logo = ZendT_Url::getBaseDiretoryPublic() . "/images/logo_ta.jpg";
                   break;
           }

           $cell = new ZendT_Report_Cell();
           $cell->setFontSize($default['title']['fontSize'])
                 ->setFontBold($default['title']['bold'])
                 ->setWidth($default['title']['width'])
                 ->setTextAlign($default['title']['align'])
                 ->setValue($default['title']['value']);

           $this->_output = '<table width="100%" class="htmlReport" border="0" cellpadding="0" cellspacing="0">';
           if ($this->_options['title']['print'] !== '0') {
               $this->_output.= '<tr>';
               $this->_output.= '  <td class="lf logo"><img src="' . $logo . '" /></td>';
               $this->_output.= $this->_writeCell($cell);
               $this->_output.= '</tr>';
           }
       }

       public function getStyleName($cell) {
           $width = $cell->getWidth();
           if (!$width)
               $width = 100;

           $styleName = $cell->getStyleName();
           $styleName.= $width;
           $styleName = 'srpt_' . str_replace(array('#', '.', '', ''), '', $styleName);
           if (!isset($this->_styles[$styleName])) {
               $this->_styles[$styleName] = '.' . $styleName . ', .' . $styleName . ' a {';

               $border = $cell->getBorders();
               if ($border['borders'] != '') {
                   if ($cell->getBorderTop()) {
                       $this->_styles[$styleName].= ' border-top: ' . $cell->getBorderTop() . 'px;';
                   }
                   if ($cell->getBorderBottom()) {
                       $this->_styles[$styleName].= ' border-bottom: ' . $cell->getBorderBottom() . 'px;';
                   }
                   if ($cell->getBorderRight()) {
                       $this->_styles[$styleName].= ' border-right: ' . $cell->getBorderRight() . 'px;';
                   }
                   if ($cell->getBorderLeft()) {
                       $this->_styles[$styleName].= ' border-left: ' . $cell->getBorderLeft() . 'px;';
                   }
               }

               $this->_styles[$styleName].= ' width: ' . ($width + 5) . 'px !important;';
               if ($cell->getFontName()) {
                   $this->_styles[$styleName].= ' font-family: ' . $cell->getFontName() . ';';
               }

               if ($cell->getFontSize()) {
                   $fontSize = $cell->getFontSize() * 1.6;
                   $this->_styles[$styleName].= ' font-size: ' . $fontSize . 'px !important;';
               }

               if ($cell->getFontColor()) {
                   $this->_styles[$styleName].= ' color: ' . $cell->getFontColor() . ' !important;';
               }

               if ($cell->getFontBold()) {
                   $this->_styles[$styleName].= ' font-weight: bold !important;';
               }

               if ($cell->getFontItalic()) {
                   $this->_styles[$styleName].= ' font-style: italic !important;';
               }

               if ($cell->getTextDecoration()) {
                   $this->_styles[$styleName].= ' font-style: oblique !important;';
               }

               if ($cell->getBackgroundColor()) {
                   $this->_styles[$styleName].= ' background: ' . $cell->getBackgroundColor() . ' !important;';
               }

               if ($cell->getTextAlign()) {
                   $align = array(
                      'C' => 'center',
                      'L' => 'left',
                      'R' => 'right'
                   );
                   $this->_styles[$styleName].= ' text-align: ' . $align[$cell->getTextAlign()] . ';';
               }

               $this->_styles[$styleName].= '}';
           }
           return $styleName;
       }

       /**
        * 
        */
       public function addPage() {
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
           $this->_title['value'] = $title;
           parent::setTitle($this->_title);
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
           $this->_writeLine('<hr />', '#FFFFFF', $height);
           return $this;
       }

       /**
        *
        * @param type $height 
        * @return ZendT_Report_Abstract
        */
       public function ln($height = 3) {
           $this->_writeLine(' ', $height);
           return $this;
       }

       /**
        * 
        * @param string $cells
        * @return \ZendT_Report_Html
        */
       private function _writeLine($cells, $height = 3) {
           $this->_output.= '<tr height="' . $height . '">' . $cells . '</tr>';
           return $this;
       }

       private function _writeCell(ZendT_Report_Cell $cell) {
           $styleName = $this->getStyleName($cell);

           $url = $cell->getUrl();
           if ($url) {
               $input = $cell->getInput();
               if ($input) {
                   if ($input instanceof ZendT_Form_Element) {
                       $value = clone $input;
                       $value->addDecorators($this->_decorators);
                       $url = utf8_encode($url);
                       $value = $value->setName($cell->getName())->setAttrib('class', $styleName)->setAttrib('action', $url)->setValue($cell->getValue())->render();
                   } else {
                       $value = '<input type="' . $input . '" name="' . $cell->getName() . '" class="' . $styleName . '" value="' . $cell->getValue() . '" action="' . $url . '" />';
                   }
               } else {
                   $value = '<a href="' . $url . '">' . $cell->getValue() . '</a>';
               }
           } else {
               $value = $cell->getValue();
           }

           $xhtml = '<td id="' . $cell->getName() . '" class="lf ' . $styleName . '">';
           if ($value) {
               $xhtml.= $value;
           } else {
               $xhtml.= ' ';
           }

           $xhtml.= '</td>';
           return $xhtml;
       }

       /**
        * Imprime as celulas do relatorio
        * @return ZendT_Report_Abstract
        */
       public function printCells($zebra = false, $title = false) {
           $backgroundColor = '#FFFFFF';
           if ($this->_zebra && $zebra) {
               if (!$this->_colorZebra) {
                   $backgroundColor = '';
                   $this->_colorZebra = 1;
               } else {
                   $backgroundColor = '#efefef';
                   $this->_colorZebra = 0;
               }
           }
           if (is_array($this->_cells)) {
               $cells = '';
               foreach ($this->_cells as $key => $cell) {
                   if ($backgroundColor) {
                       $cell->setBackgroundColor($backgroundColor);
                   }
                   $cells.= $this->_writeCell($cell);
               }
               $this->_writeLine($cells);
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
           $this->_cells[] = $_cell;
           if (substr($_cell->getName(), 0, 6) == 'title_') {
               $this->_tableWidth += $_cell->getWidth();
           }
           return $this;
       }

       /**
        * Imprime o relatorio
        * 
        * @param string $nomeArquivo 
        * @param string $dest
        */
       public function output($name = '', $dest = 'S') {
           if ($this->_tableWidth) {
               $this->_output = str_replace('width="100%"', 'width="' . $this->_tableWidth . '"', $this->_output);
           }
           $this->_output = '<style>.lf{} ' . implode(' ', $this->_styles) . '</style>' . $this->_output . '</table>';
           return $this->_output;
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

   }

?>