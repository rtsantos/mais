<?php

   /**
    * ZendT_Report_Cell
    * 
    * @package ZendT
    * @subpackage ZendT_Report 
    * @author rsantos
    * @version 3
    *
    */
   class ZendT_Report_Cell {

       const TYPE_STRING = 'String';
       const TYPE_INT = 'Int';

       /**
        * Valor a ser impresso
        * 
        * @var string|int|double
        */
       private $_value;

       /**
        *
        * @var string
        */
       private $_input;

       /**
        *
        * @var string
        */
       private $_name;

       /**
        * Largura a ser reservado para impressão do valor
        * 
        * @var int
        */
       private $_width;

       /**
        * Altura a ser reservado para impressão do valor
        * 
        * @var int
        */
       private $_height;

       /**
        * Nome da fonte  
        * 
        * @var string @example Arial
        */
       private $_fontName;

       /**
        * Guarda o nome dinamico do estilo da celula
        * 
        * @var string 
        */
       private $_styleName;

       /**
        * Tamanho da fonte
        * 
        * @var int
        */
       private $_fontSize;

       /**
        * Cor da fonte, pode-se passar em formato HTML
        * 
        * @var string
        */
       private $_fontColor;

       /**
        * Se a fonte deve ficar em negrito
        * 
        * @var string
        */
       private $_bold;

       /**
        * Se a fonte deve ficar em itálico
        * 
        * @var string
        */
       private $_italic;

       /**
        * Se a fonte deve ficar sublinhada
        * 
        * @var string
        */
       private $_underline;

       /**
        * Cor de fundo do texto, pode-se passar em formato HTML
        * 
        * @var string
        */
       private $_backgroundColor;

       /**
        * Borda de cima.
        * 
        * @var int
        */
       private $_borderTop;

       /**
        * Borda da direita
        * 
        * @var int
        */
       private $_borderRight;

       /**
        * Borda da esquerda.
        * 
        * @var int
        */
       private $_borderLeft;

       /**
        * Borda do baixo.
        * 
        * @var int
        */
       private $_borderBottom;

       /**
        * Tipo da célula, será usado no Excel.
        * 
        * @var string
        */
       private $_type;

       /**
        * Cor principal do documento
        * 
        * @var string 
        */
       private $_mainColor;

       /**
        * Alinhamento da coluna
        * 
        * @var string
        */
       private $_align;

       /**
        * Array com os possiveis alinhamentos
        * 
        * @var array
        */
       private $_arrayAlign;

       /**
        * String com o caminho de uma imagem
        * 
        * @var string
        */
       private $_image;

       /**
        * Guarda a classe da celula
        * 
        * @var string
        */
       protected $_style;

       /**
        * 
        * @var string
        */
       protected $_url;

       /**
        * Construtor da classe, recebendo como parâmetros. 
        * as configurações das colunas
        * 
        * @param array $options
        * @return void
        */
       public function __construct($options = null) {
           $default = array(
              'value' => '',
              'height' => 4,
              'fontName' => 'Arial',
              'fontSize' => 10,
              'fontColor' => '#000000',
              'mainColor' => '#000000'
           );

           if (is_string($options)) {
               $default['value'] = $options;
               $options = null;
           }

           $this->_style = array();
           $this->_arrayAlign = array('left' => 'L', 'center' => 'C', 'right' => 'R');
           $this->_align = 'left';
           if ($options != null) {
               $options = array_merge($default, $options);
           } else {
               $options = $default;
           }

           if (is_array($options['border'])) {
               if (is_array($options['border'][3])) {
                   $this->setBorder($options['border'][0], $options['border'][1], $options['border'][2], $options['border'][3]);
               } else {
                   $this->setBorder($options['border'][0], $options['border'][1], $options['border'][2]);
               }
           }

           foreach ($options as $key => $value) {
               $this->{'_' . $key} = $value;
           }
       }

       /**
        * Seta o valor a ser impresso
        * retorna o objeto para permitir que vários propriedades sejam configuradas na mesma linha
        * @example $this->setValue('Teste')->setWidth(100);
        * 
        * @param string|int|double $value
        * @return ZendT_Report_Cell
        */
       public function setValue($value) {
           $this->_value = $value;
           if ($value instanceof ZendT_Type) {
               $this->setType($value->getType());
           }
           return $this;
       }

       /**
        * Seta o valor de largura da celula
        * retorna o objeto para permitir que vários propriedades sejam configuradas na mesma linha
        * @example $this->setValue('Teste')->setWidth(100);
        * 
        * @param int $value
        * @return ZendT_Report_Cell
        */
       public function setWidth($value) {
           if (strpos($value, ',') !== false) {
               $value = str_replace(array('.', ','), array('', '.'), $value);
           }
           $this->_width = $value;
           $this->_addStyleName('width', $value);
           return $this;
       }

       /**
        * Retorna o Width da celula
        * 
        * @return int 
        */
       public function getWidth() {
           if ($this->_width) {
               return $this->_width;
           }
       }

       /**
        * Seta o valor de altura da celula
        * retorna o objeto para permitir que vários propriedades sejam configuradas na mesma linha
        * @example $this->setValue('Teste')->setHeight(100);
        * 
        * @param int $value
        * @return ZendT_Report_Cell
        */
       public function setHeight($value) {
           $this->_height = $value;
           $this->_addStyleName('height', $value);
           return $this;
       }

       /**
        * Retorna a height da celula
        * 
        * @return int 
        */
       public function getHeight() {
           return $this->_height;
       }

       /**
        * Define a cor principal do documento
        * 
        * @param string $color 
        * @return ZendT_Report_Cell
        */
       public function setMainColor($color) {
           $this->_mainColor = $color;
           $this->_addStyleName('mainColor', str_replace('#', '', $color));
           return $this;
       }

       /**
        * Retorna o valor principal da celula
        * 
        * @return type 
        */
       public function getMainColor() {
           return $this->_mainColor;
       }

       /**
        * Seta o nome da fonte
        * retorna o objeto para permitir que vários propriedades sejam configuradas na mesma linha
        * @example $this->setValue('Teste')->setFontName('arial');
        * 
        * @param string $name
        * @return ZendT_Report_Cell
        */
       public function setFontName($name) {
           $this->_fontName = $name;
           $this->_addStyleName('fontName', $name);
           return $this;
       }

       /**
        * Seta o nome da fonte
        * retorna o objeto para permitir que vários propriedades sejam configuradas na mesma linha
        * 
        * @param string $name
        * @return Z\endT_Report_Cell 
        */
       public function setFontFamily($name) {
           $this->_addStyleName('fontFamily', $name);
           return $this->setFontName($name);
       }

       /**
        * Define o tamanho da fonte da celula
        * 
        * @param string|numeric $size
        * @return \ZendT_Report_Cell 
        */
       public function setFontSize($size) {
           if ($size == null || !$size)
               $size = 7;
           $this->_fontSize = $size;
           $this->_addStyleName('fontSize', $size);
           return $this;
       }

       /**
        * Define a cor da fonte da celula
        * 
        * @param string $color
        * @return \ZendT_Report_Cell 
        */
       public function setColor($color) {
           $this->_fontColor = $color;
           $this->_addStyleName('color', str_replace('#', '', $color));
           return $this;
       }

       /**
        * Define a quantidade de colunas que será mesclada
        * 
        * @param int $colspan
        * @return \ZendT_Report_Cell 
        */
       public function setColspan($colspan) {
           $this->_colspan = $colspan;
           $this->_addStyleName('colspan', $colspan);
           return $this;
       }

       /**
        * Define a cor da fonte da celula
        * 
        * @param string $color
        * @return \ZendT_Report_Cell 
        */
       public function setFontColor($color) {
           $this->_addStyleName('fontColor', str_replace('#', '', $color));
           return $this->setColor($color);
       }

       /**
        * Define se a fonte estará em negrito
        * Valores aceitos: nulo, 'bold',false,true
        * 
        * @param string $bold
        * @return \ZendT_Report_Cell 
        */
       public function setFontWeight($bold) {
           $this->_addStyleName('fontWeight', $bold);
           $this->_bold = $bold;
           return $this;
       }

       /**
        * Define se a fonte estará em negrito
        * Valores aceitos: nulo, 'bold',false,true
        *  
        * @param string $bold
        * @return \ZendT_Report_Cell 
        */
       public function setFontBold($bold) {
           return $this->setFontWeight($bold);
       }

       /**
        * Define se a fonte estará em italico
        * Valores aceitos: nulo, 'italic',false,true
        * 
        * @param string $italic
        * @return \ZendT_Report_Cell 
        */
       public function setFontStyle($italic) {
           $this->_italic = $italic;
           $this->_addStyleName('fontStyle', $italic);
           return $this;
       }

       /**
        * Define se a fonte estará em italico
        * Valores aceitos: nulo, 'italic',false,true 
        * @param string $italic
        * @return \ZendT_Report_Cell 
        */
       public function setFontItalic($italic) {
           return $this->setFontStyle($italic);
       }

       /**
        * Define se a fonte estará sublinhada
        * Valores aceitos: nulo, 'underline',false,true
        * 
        * @param string $underline
        * @return \ZendT_Report_Cell 
        */
       public function setTextDecoration($underline) {
           $this->_addStyleName('textDecoration', $underline);
           $this->_underline = $underline;
           return $this;
       }

       /**
        * Define se a fonte estará sublinhada
        * Valores aceitos: nulo, 'underline',false,true
        * 
        * @param string $underline
        * @return \ZendT_Report_Cell 
        */
       public function setFontUndeline($underline) {
           return $this->setTextDecoration($underline);
       }

       /**
        * Define a cor de fundo da celula
        * 
        * @param string $color
        * @return \ZendT_Report_Cell 
        */
       public function setBackgroundColor($color) {
           $this->_backgroundColor = $color;
           $this->_addStyleName('backgroundColor', str_replace('#', '', $color));
           return $this;
       }

       /**
        * Define a borda de uma celula
        * 
        * @param string|numeric $width
        * @param string|numeric $style
        * @param string $color
        * @param array $side
        * @return \ZendT_Report_Cell 
        * 
        */
       public function setBorder($width = false, $style = false, $color = false, $side = array('Top', 'Left', 'Right', 'Bottom')) {
           //A propriedade Style da borda ainda não é suportada pela FPDF
           $this->_setBorderAuto($width, $style, $color, $side);
           return $this;
       }

       /**
        * Faz a definição das bordas da celula
        * 
        * @param string|numeric  $width
        * @param string|numeric  $style
        * @param string $color
        * @param array $side 
        */
       private function _setBorderAuto($width, $style, $color, $side) {
           //A propriedade Style da borda ainda não é suportada pela FPDF
           if (is_array($side)) {
               foreach ($side as $value) {
                   $uSide = '_border' . ucfirst(strtolower($value));
                   $this->{$uSide}['width'] = $width;
                   $this->{$uSide}['style'] = $style;
                   $this->{$uSide}['color'] = $color;
                   $this->_addStyleName($uSide, $color . $width . $style);
               }
           } else {
               $uSide = '_border' . ucfirst(strtolower($side));
               $this->{$uSide}['width'] = $width;
               $this->{$uSide}['style'] = $style;
               $this->{$uSide}['color'] = $color;
               $this->_addStyleName($uSide, $color . $width . $style);
           }
       }

       /**
        * Define as propriedades da borda superior da celula
        * 
        * @param string|numeric $width
        * @param string|numeric $style
        * @param string $color
        * @return \ZendT_Report_Cell 
        */
       public function setBorderTop($width, $style, $color) {
           $this->_setBorderAuto($width, $style, $color, 'Top');
           return $this;
       }

       /**
        * Define as propriedades da borda esquerda da celula
        * 
        * @param string|numeric $width
        * @param string|numeric $style
        * @param string $color
        * @return \ZendT_Report_Cell 
        */
       public function setBorderLeft($width, $style, $color) {
           $this->_setBorderAuto($width, $style, $color, 'Left');
           return $this;
       }

       /**
        * Define as propriedades da borda direita da celula
        * 
        * @param string|numeric $width
        * @param string|numeric $style
        * @param string $color
        * @return \ZendT_Report_Cell 
        */
       public function setBorderRight($width, $style, $color) {
           $this->_setBorderAuto($width, $style, $color, 'Right');
           return $this;
       }

       /**
        * Define as propriedades da borda inferior da celula
        * 
        * @param string|numeric $width
        * @param string|numeric $style
        * @param string $color
        * @return \ZendT_Report_Cell 
        */
       public function setBorderBottom($width, $style, $color) {
           $this->_setBorderAuto($width, $style, $color, 'Bottom');
           return $this;
       }

       /**
        * Define o tipo da celula
        * 
        * @param type $type
        * @return \ZendT_Report_Cell 
        */
       public function setType($type) {
           $this->_type = ucfirst(strtolower($type));
           if ($this->_value instanceof ZendT_Type_Date && !in_array($this->_type, array('Date', 'Datetime', 'Time'))) {
               $this->_type = $this->_value->getType();
           }
           $this->_addStyleName('type', $this->_type);
           return $this;
       }

       /**
        * Seta o nome, o tamanho e a cor da fonte
        * retorna o objeto para permitir que vários propriedades sejam configuradas na mesma linha
        * @example $this->setValue('Teste')->setFont('arial', 20, '#000000');
        * 
        * @param int $value
        * @return ZendT_Report_Cell
        */
       public function setFont($name = false, $size = false, $color = false, $weight = false, $style = false) {
           $this->setFontName($name)
                 ->setFontSize($size)
                 ->setFontColor($color)
                 ->setFontWeight($weight)
                 ->setFontStyle($style);
           return $this;
       }

       /**
        * Define o alinhamento do texto na celula
        * 
        * @param string $align
        * @return \ZendT_Report_Cell 
        */
       public function setTextAlign($align) {
           $this->_align = $align;
           $this->_addStyleName('align', $align);
           return $this;
       }

       /**
        * Define uma imagem para exibição
        * 
        * @param string $image
        * @return \ZendT_Report_Cell 
        */
       public function setImage($image) {
           $this->_image = $image;
           return $this;
       }

       /**
        * Define uma URL para o Texto
        * 
        * @param string $url
        * @return \ZendT_Report_Cell 
        */
       public function setUrl($url) {
           if (mb_detect_encoding($url, 'UTF-8', true) == 'UTF-8') {
               $url = utf8_decode($url);
           }
           $this->_url = $url;
           return $this;
       }

       /**
        * Retorna a URL do Texto
        * 
        * @return string
        */
       public function getUrl() {
           return $this->_url;
       }

       /**
        * 
        * @param string $value @example text|numeric
        * @return \ZendT_Report_Cell
        */
       public function setInput($value) {
           $this->_input = $value;
           return $this;
       }

       /**
        * 
        * @return string
        */
       public function getInput() {
           return $this->_input;
       }

       /**
        * Configura o nome da célula
        * @param string $value
        * @return \ZendT_Report_Cell
        */
       public function setName($value) {
           $this->_name = $value;
           return $this;
       }

       /**
        * 
        * @return string
        */
       public function getName() {
           return $this->_name;
       }

       /**
        * Retorna o tipo da celula
        * 
        * @return string 
        */
       public function getType() {
           return $this->_type;
       }

       /**
        * Retorna a imagem definida com setImage
        * 
        * @return string
        */
       public function getImage() {
           return $this->_image;
       }

       /**
        * Retorna o valor da celula
        * 
        * @return string
        */
       public function getValue() {
           return $this->_value;
       }

       /**
        * Retorna a cor do fundo da celula
        * 
        * @return string
        */
       public function getBackgroundColor() {
           if ($this->_backgroundColor && substr($this->_backgroundColor, 0, 1) != '#') {
               $this->_backgroundColor = '#' . $this->_backgroundColor;
           }
           return $this->_backgroundColor;
       }

       /**
        * Define o alinhamento do texto na celula
        * 
        * @return string
        */
       public function getTextAlign() {
           return $this->_arrayAlign[strtolower($this->_align)];
       }

       /**
        * Retorna a cor da fonte
        * 
        * @return string 
        */
       public function getFontColor() {
           if ($this->_fontColor && substr($this->_fontColor, 0, 1) != '#') {
               $this->_fontColor = '#' . $this->_fontColor;
           }
           return $this->_fontColor;
       }

       /**
        * Retorna a cor da fonte
        * 
        * @return string 
        */
       public function getColor() {
           return $this->_fontColor;
       }

       /**
        *
        * @return int
        */
       public function getColspan() {
           return $this->_colspan;
       }

       /**
        * Retorna o tamanho da fonte
        * 
        * @return int 
        */
       public function getFontSize() {
           return $this->_fontSize;
       }

       /**
        * Retorna o nome da fonte
        * 
        * @return string
        */
       public function getFontName() {
           return $this->_fontName;
       }

       /**
        * Retorna o nome da fonte
        * 
        * @return string
        */
       public function getFontFamily() {
           return $this->_fontName;
       }

       /**
        * Retorna se a fonte é bold
        * 
        * @return string
        */
       public function getFontWeight() {
           return $this->_bold;
       }

       /**
        * Retorna se a fonte é bold
        * 
        * @return string
        */
       public function getFontBold() {
           return $this->_bold;
       }

       /**
        * Retorna se a fonte é italica
        * 
        * @return string
        */
       public function getFontStyle() {
           return $this->_italic;
       }

       /**
        * Retorna se a fonte é italica
        * 
        * @return string
        */
       public function getFontItalic() {
           return $this->_italic;
       }

       /**
        * Retorna se a fonte estará sublinhada
        * 
        * @return string
        */
       public function getFontUnderline() {
           return $this->_underline;
       }

       /**
        * Retorna se a fonte estará sublinhada
        * 
        * @return string
        */
       public function getTextDecoration() {
           return $this->_underline;
       }

       /**
        * Retorna o Style da celula
        * 
        * @return string 
        */
       public function getStyle() {
           $retorno = '';
           if ($this->_bold) {
               $retorno.= 'B';
           }
           if ($this->_italic) {
               $retorno.= 'I';
           }
           if ($this->_underline) {
               $retorno.= 'U';
           }
           return $retorno;
       }

       /**
        * Retorna as propriedades da borda superior
        * 
        * @return array
        */
       public function getBorderTop() {
           return $this->_borderTop;
       }

       /**
        * Retorna as propriedades da borda inferior
        * 
        * @return array
        */
       public function getBorderBottom() {
           return $this->_borderBottom;
       }

       /**
        * Retorna as propriedades da borda esquerda
        * 
        * @return array
        */
       public function getBorderLeft() {
           return $this->_borderLeft;
       }

       /**
        * Retorna as propriedades da borda direita
        * 
        * @return array
        */
       public function getBorderRight() {
           return $this->_borderRight;
       }

       /**
        * Retorna as bordas da celula
        * 
        * @return array
        */
       public function getBorders() {
           //A propriedade Style da borda ainda não é suportada pela FPDF
           $bordasOn = false;
           $corBorda = $this->_mainColor;
           if (is_array($this->_borderBottom)) {
               $bordasOn.= 'B';
               if ($this->_borderBottom['color']) {
                   $corBorda = $this->_borderBottom['color'];
               }
               if ($this->_borderBottom['width']) {
                   $larguraBorda = $this->_borderBottom['width'];
               }
               if ($this->_borderBottom['width']) {
                   $larguraBorda = $this->_borderBottom['width'];
               }
           }
           if (is_array($this->_borderLeft)) {
               $bordasOn.= 'L';
               if ($this->_borderLeft['color']) {
                   $corBorda = $this->_borderLeft['color'];
               }
               if ($this->_borderLeft['width']) {
                   $larguraBorda = $this->_borderLeft['width'];
               }
           }
           if (is_array($this->_borderRight)) {
               $bordasOn.= 'R';
               if ($this->_borderRight['color']) {
                   $corBorda = $this->_borderRight['color'];
               }
               if ($this->_borderRight['width']) {
                   $larguraBorda = $this->_borderRight['width'];
               }
           }

           if (is_array($this->_borderTop)) {
               $bordasOn.= 'T';
               if ($this->_borderTop['color']) {
                   $corBorda = $this->_borderTop['color'];
               }
               if ($this->_borderTop['width']) {
                   $larguraBorda = $this->_borderTop['width'];
               }
           }
           return array('width' => $larguraBorda, 'color' => $corBorda, 'borders' => $bordasOn);
       }

       /**
        * Configura o estilo da célula
        * 
        * @param string $name
        * @param string $value
        * @return \ZendT_Report_Cell 
        */
       public function setStyle($name, $value) {
           if (is_array($value)) {
               foreach ($value as $name => $val) {
                   $properties = explode('-', $name);
                   $name = '';
                   foreach ($properties as $propName) {
                       $name.= ucfirst($propName);
                   }
                   $name = 'set' . $name;
                   if (method_exists($this, $name)) {
                       $this->$name($val);
                   }
               }
           } else {
               $properties = explode('-', $name);
               $name = '';
               foreach ($properties as $propName) {
                   $name.= ucfirst($propName);
               }
               $name = 'set' . $name;
               if (method_exists($this, $name)) {
                   $this->$name($value);
               }
           }
           return $this;
       }

       /**
        *
        * @param array $styles
        * @return \ZendT_Report_Cell 
        */
       public function setStyles($styles) {
           foreach ($styles as $name => $value) {
               $this->setStyle($name, $value);
           }
           return $this;
       }

       /**
        *
        * @param type $style
        * @return \ZendT_Report_Cell 
        */
       public function setTaStyle($style) {
           $this->_style = $style;
           return $this;
       }

       /**
        * Retorna se o 
        * @return type 
        */
       public function getTaStyle() {
           if (is_array($this->_style)) {
               $this->_style = implode('', $this->_style);
           }
           return $this->_style;
       }

       /**
        * Adiciona uma string ao nome do estilo
        * 
        * @param string $value 
        */
       private function _addStyleName($prop, $value = '') {
           $this->_style[$prop] = $value;
           return $this;
       }

       /**
        * Retorna o nome do estilo
        * 
        * @return string 
        */
       public function getStyleName() {
           if ($this->_styleName) {
               return $this->_styleName;
           } else if (is_array($this->_style)) {
               $this->_style = implode('', $this->_style);
           }
           return $this->_style;
       }

       /**
        *
        * @param type $name
        * @return \ZendT_Report_Cell 
        */
       public function setStyleName($name) {
           $this->_styleName = $name;
           return $this;
       }

   }
   