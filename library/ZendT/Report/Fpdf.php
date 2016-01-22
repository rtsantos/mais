<?php
 
require_once 'Extra/Pdf/fpdf.php';

class ZendT_Report_Fpdf extends FPDF {

    /**
     * Recebe a empresa
     * 
     * @var string 
     */
    private $_empresa;

    /**
     * Recebe o titulo do relátorio
     * 
     * @var ZendT_Report_Cell 
     */
    private $_titulo;

    /**
     * Recebe o rodapé do relátorio
     * 
     * @var ZendT_Report_Cell
     */
    private $_footer;

    /**
     * Recebe a orientação da pagina 
     * 
     * @var string
     */
    private $_pOrientation;
    /**
     *
     * @var array
     */
    protected $_cellsTitle;
    /**
     *
     * @var int
     */
    protected $_iTitle = 0;

    /**
     * Header
     * 
     * @return void
     */
    function Header() {
        switch ($this->_empresa) {
            case 'TA': $this->Image("public/images/logo_ta.jpg", 8, 5, 30);
                break;
            case 'TAE': $this->Image("public/images/logo_tae.jpg", 8, 5, 30);
                break;
            case 'TAL':
            case 'TLG': $this->Image("public/images/logo_tal.jpg", 8, 5, 30);
                break;
            case 'WIN': $this->Image("public/images/logo_tae.jpg", 8, 5, 30);
                break;
            case 'TAA': $this->Image("public/images/logo_tae.jpg", 8, 5, 30);
                break;
            default: $this->Image("public/images/logo_ta.jpg", 8, 5, 30);
                break;
        }
        $this->Ln(10);

        if (isset($this->_titulo) && $this->_titulo != '') {
            $this->SetY(5);
            $this->SetX(5);
            $rodape = $this->makecell($this->_titulo);
            $this->Cell($rodape['celula']->getWidth(), $rodape['celula']->getHeight(), $rodape['celula']->getValue(), $rodape['border'], 0, $rodape['celula']->getTextAlign(), $rodape['color']);
            $this->Ln(10);
        }
        
        if (count($this->_cellsTitle) > 0){
            foreach($this->_cellsTitle as $line){
                foreach($line as $cell){
                    $this->SetFont($cell['fontName'], $cell['style'], $cell['fontSize']);
                    $this->Cell( $cell['width']
                               , $cell['height']
                               , $cell['value']
                               , $cell['border']
                               , 0
                               , $cell['align']
                               , $cell['color']);
                }
                $this->Ln();
            }
        }
    }
    /**
     * 
     * @param array $value
     * @return \ZendT_Report_Fpdf
     */
    function addCellTitle($value){
        $this->_cellsTitle[$this->_iTitle][] = $value;
        return $this;
    }
    /**
     * 
     * @return \ZendT_Report_Fpdf
     */
    function addLineTitle(){
        $this->_iTitle++;
        return $this;
    }

    function setOrientation($valor) {
        $this->_pOrientation = $valor;
    }

    /**
     * Define um titulo para o cabeçalho
     * 
     * @param string $titulo
     * @return \ZendT_Report_Fpdf 
     */
    public function setTitulo($titulo) {
        $this->_titulo = $titulo;
        return $this;
    }
    /**
     * 
     * @param array $value
     * @return \ZendT_Report_Fpdf
     */
    public function setCellsTitle($value){
        $this->_cellsTitle = $value;
        return $this;
    }

    /**
     * Define a empresa do relátorio, isso influencia a nova imagem do cabeçalho
     * 
     * @param string $empresa
     * @return \ZendT_Report_Fpdf 
     */
    public function setEmpresa($empresa) {
        if ($empresa == 'WIN' || $empresa == 'TAA'){
            $empresa = 'TAE';
        }
        $this->_empresa = $empresa;
        return $this;
    }

    /**
     * Define um rodapé para o pdf
     * 
     * @param type $footer
     * @return \ZendT_Report_Fpdf 
     */
    public function setFooter($footer) {
        $this->_footer = $footer;
        return $this;
    }

    /**
     * Footer
     * 
     * @return void
     */
    function Footer() {
        if (isset($this->_footer)  && $this->_footer != '') {
            $this->SetY(-10);
            $rodape = $this->makecell($this->_footer);
            $this->Cell($rodape['celula']->getWidth(), $rodape['celula']->getHeight(), $rodape['celula']->getValue(), $rodape['border'], 0, $rodape['celula']->getTextAlign(), $rodape['color']);
        } else {
            if ($this->_pOrientation == 'L') {
                $pageWidth = 138;
            } else {
                $pageWidth = 95;
            }
            $this->SetY(-10);
            $css = array(
                'fontSize' => 8,
                'width' => $pageWidth,
                'value' => date('d/m/Y H:i:s'),
                'align' => 'left'
            );
            $celRodape = new ZendT_Report_Cell($css);
            $rodape = $this->makecell($celRodape);
            $this->Cell($rodape['celula']->getWidth(), $rodape['celula']->getHeight(), $rodape['celula']->getValue(), $rodape['border'], 0, $rodape['celula']->getTextAlign(), $rodape['color']);
            $css = array(
                'fontSize' => 8,
                'width' => $pageWidth,
                'value' => 'Pagina ' . $this->PageNo(),
                'align' => 'right'
            );
            $celRodape = new ZendT_Report_Cell($css);
            $rodape = $this->makecell($celRodape);
            $this->Cell($rodape['celula']->getWidth(), $rodape['celula']->getHeight(), $rodape['celula']->getValue(), $rodape['border'], 0, $rodape['celula']->getTextAlign(), $rodape['color']);
        }
    }

    /**
     * Esta função pega uma ZendT_Report_Cell e transforma um array pronto para ser impresso como celula
     * 
     * @param ZendT_Report_Cell $cell
     * @return array 
     */
    public function makeCell($celula,$options=false) {
        if (!($celula instanceof ZendT_Report_Cell)){
            $celula = new ZendT_Report_Cell($celula);
        }
        $borders = $celula->getBorders();
        $this->SetFont($celula->getFontName(), $celula->getStyle(), $celula->getFontSize());
        $corFonteCelula = $this->hex2RGB($celula->getColor());
        $this->SetTextColor($corFonteCelula['red'], $corFonteCelula['green'], $corFonteCelula['blue']);
        if ($borders['borders']) {
            if (!$borders['color']) {
                $borders['color'] = '#000000';
            }
            $corBorda = $this->hex2RGB($borders['color']);
            $this->SetDrawColor($corBorda['red'], $corBorda['green'], $corBorda['blue']);
            $this->SetLineWidth($borders['width'] . 'px');
        }
        $backgroundColor = $celula->getBackgroundColor();
        if ($backgroundColor) {
            $colorFill = 1;
            $backgroundColor = $this->hex2RGB($backgroundColor);
            $this->SetFillColor($backgroundColor['red'], $backgroundColor['green'], $backgroundColor['blue']);
        } else {
            if (isset($options['backgroundColor'])){
                $backgroundColor = $this->hex2RGB($options['backgroundColor']);
                $this->SetFillColor($backgroundColor['red'], $backgroundColor['green'], $backgroundColor['blue']);
                $colorFill = 1;
            }else{
                $colorFill = 0;
            }
        }
        return array('celula' => $celula, 'color' => $colorFill, 'border' => $borders['borders']);
    }

    /**
     * Função para transformar as cores em HEX (padrão css) para RGB (padrão pdf).
     * 
     * @param string $hexStr
     * @param bol $returnAsString
     * @param string $seperator
     * @return array|string 
     */
    public function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
        $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr);
        $rgbArray = array();
        if (strlen($hexStr) == 6) {
            $colorVal = hexdec($hexStr);
            $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
            $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
            $rgbArray['blue'] = 0xFF & $colorVal;
        } elseif (strlen($hexStr) == 3) {
            $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
            $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
            $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
        } else {
            return false;
        }
        return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray;
    }

}

?>
