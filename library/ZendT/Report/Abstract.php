<?php

   /*
    * @category    ZendT
    * @author   
    */

   abstract class ZendT_Report_Abstract {

       /**
        * Titulo do relátorio
        * 
        * @var string
        */
       protected $_title;

       /**
        * Nome do arquivo de saida
        * 
        * @var string
        */
       protected $_outputName;

       /**
        * Recebe as linhas do relatorio
        * 
        * @var array
        */
       protected $_cells;

       /**
        * Empresa do relatório
        * 
        * @var string
        */
       private $_empresa;

       /**
        * Estabelece o cursor teorico do relatorio
        * 
        * @var int 
        */
       protected $_virtualIndex;

       /**
        * Estabelece o cursor real do relatorio
        * 
        * @var int 
        */
       protected $_realIndex;

       /**
        * Estabelece o curso de linha do arquivo
        * 
        * @var int 
        */
       protected $_lineIndex;

       /**
        * Tratamento de erro
        * 
        * @var int 
        */
       protected $_error;

       /**
        * Estabelece o driver a ser usado
        * 
        * @var class
        */
       protected $_driver;

       /**
        * Recebe as funções de header do relatorio
        * 
        * @var array
        */
       protected $_headerFunctions;

       /**
        * Recebe as funções de footer do relatorio
        * 
        * @var array 
        */
       protected $_footerFunction;

       /**
        * Recebe as opções default das celulas do relatório
        * 
        * @var arrat 
        */
       protected $_cellDefault = array();

       /**
        * Construtor da classe, recebe um array ou um variavel para configurar o relatorio
        * 
        * @param array|string $options 
        */
       public function __construct() {
           
       }

       /**
        * @return ZendT_Report_Abstract  
        */
       public function addPage() {
           return $this;
       }

       /**
        * Adiciona um array de celulas
        * 
        * @param array $_cell    
        * @return ZendT_Report_Abstract  
        */
       public function addCells(array $_cell) {
           foreach ($_cell as $cell) {
               $this->addCell($cell);
           }
           return $this;
       }

       /**
        * Define os parametros defauls para uma nova celula
        * 
        * @param array $defaults 
        */
       abstract protected function setCellDefault(array $defaults);

       /**
        * Seta um nome para o arquivo de saida
        * 
        * @param string
        * @return ZendT_Report_Abstract
        */
       abstract public function setOutputName($value);

       /**
        * Define a empresa do relatorio
        * 
        * @param string $value
        * @return ZendT_Report_Abstract
        */
       abstract public function setEmpresa($value = false);

       /**
        * Inprime as celulas de uma determinada linha
        * @return ZendT_Report_Abstract
        */
       abstract public function printCells($zebra = false, $title = false);

       /**
        * Desenha uma linha entre $_xStart e $_xFinish
        * 
        * @param float $start
        * @param float $finish
        * @param int $height 
        * @return ZendT_Report_Abstract
        */
       abstract public function drawLine($start = null, $finish = null, $height = 3);

       /**
        * @param int $height
        * @return ZendT_Report_Abstract
        */
       abstract public function ln($height = 3);

       /**
        * Imprime o relatorio
        * 
        * @param string
        * @return string     
        */
       abstract public function output($name = '', $dest = 'I');

       /**
        * Retorna o driver que esta sendo utilizado
        *  
        */
       abstract protected function getDriver();

       /**
        * Adiciona várias celulas (array) ao relatório
        * 
        * @param object $cell
        * @return ZendT_Report_Abstract
        */
       abstract public function addCell(ZendT_Report_Cell $cell);

       /**
        *
        * @param string $title
        * @return ZendT_Report_Abstract
        */
       public function setTitle($title) {
           $this->_title = $title;
           return $this;
       }

   }

?>
