<?php

   /**
    * Classe de relatório baseado no MapperView
    *
    * @package ZendT
    * @subpackage Report
    */
   class ZendT_Report_View {

       /**
        *
        * @param string $driver
        * @param ZendT_Mapper $mapperView
        * @param array $options  
        */
       protected $_configColumns;

       /**
        * @var ZendT_Report_Abstract
        */
       protected $_report;

       /**
        * Objeto ZendT_Db_Mapper
        * 
        * @var ZendT_Db_Mapper
        */
       protected $_mapper;

       /**
        * Colunas
        * 
        * @var array 
        */
       protected $_columns;

       /**
        * Colunas de Quebra
        *
        * @var array
        */
       protected $_columnsBreak;

       /**
        * Colunas de Contadores da Quebra
        *
        * @var array
        */
       protected $_columnsBreakCount;

       /**
        *
        * @var ZendT_Log_Report 
        */
       protected $_log;

       /**
        *
        * @var int
        */
       protected $_fontSize;

       /**
        * @var array
        */
       protected $_options;

       /**
        *
        * @var array
        */
       protected $_total;

       /**
        *
        * @var array
        */
       protected $_columnsRepeat = array();

       /**
        *
        * @var array
        */
       protected $_columnsJumped = array();

       /**
        *
        * @var array
        */
       protected $_columnsTitle = array();

       /**
        * 
        * @var array
        */
       protected $_columnsGroup = array();

       /**
        *
        * @var array
        */
       protected $_columnsTotal = array();

       /**
        *
        * @var array
        */
       protected $_columnsPivot = array();

       /**
        *
        * @var array
        */
       protected $_labelFilters;

       /**
        * Analisa se o Mapper faz tratamento de estilo da linha
        * a ser impressa
        *
        * @var bool
        */
       protected $_styleRow;

       /**
        *
        * @var string
        */
       protected $_labelBreak;

       /**
        * Construtor da Classe
        * 
        * @param string $driver
        * @param Zend_Db_Mapper $mapperView
        * @param string $title 
        */
       public function __construct($driver, $mapperView, $options) {
           $this->_options = $options;

           if (!isset($this->_options['log'])) {
               $this->_options['log'] = true;
           }

           if ($driver == '')
               $driver = 'PDF';
           $this->_report = ZendT_Report::factory($driver, $options);
           $this->_report->setTitle($options['title']['value']);
           $this->_report->addPage();
           $this->_mapper = $mapperView;
           $this->_columns = $this->_mapper->getColumns()->toArray();

           $this->_fontSize = $options['fontSize'];
           if (!$this->_fontSize) {
               $this->_fontSize = 7;
           }

           if ($this->_options['log']) {
               $this->_log = new ZendT_Log_Report(get_class($this->_mapper), $options['title']['value']);
           }
           $this->_total = array();
           $this->_type = array();
           $this->_styleRow = false;

           if (method_exists($mapperView, 'getStylesRow')) {
               $this->_styleRow = true;
           }

           $this->_driver = $driver;
       }

       /**
        * Exibe parâmetros no cabeçalho do relatório 
        */
       protected function _printParams() {
           if ($this->_options['advanced']['printParams'] !== '0') {
               $params = array();

               if (method_exists($this->_mapper, 'getParamsToReport')) {
                   $params = $this->_mapper->getParamsToReport();
               }

               if ($this->_options['advanced']['orientation'] == 'P') {
                   $_width = 610;
               } else {
                   $_width = 1070;
               }

               if ($params) {
                   foreach ($params as $param) {
                       $_cell = new ZendT_Report_Cell();
                       $_cell->setValue($param['title'] . ': ' . $param['value']);
                       $_cell->setWidth($_width);
                       $_cell->setTextAlign('left');
                       $_cell->setType('string');
                       $_cell->setFontWeight(true);
                       $_cell->setFontSize($this->_fontSize);
                       $this->_report->addCell($_cell);
                       $this->_report->printCells();
                   }
                   #$this->_report->drawLine();
               }

               if (count($this->_labelFilters) > 0) {
                   foreach ($this->_labelFilters as $label) {
                       $_cell = new ZendT_Report_Cell();
                       $label['value'] = new ZendT_Type_String($label['value']);
                       $_cell->setValue($label['field'] . ' ' . $label['operation'] . ' ' . str_replace('%', ' ', $label['value']->get()));
                       $_cell->setWidth($_width);
                       $_cell->setTextAlign('left');
                       $_cell->setType('string');
                       $_cell->setFontWeight(true);
                       $_cell->setFontSize($this->_fontSize);
                       $this->_report->addCell($_cell);
                       $this->_report->printCells();
                   }
                   $this->_report->ln();
               }
           }
       }

       protected function _verifyLineJump(&$row) {
           $this->_columnsOrig = $row;
           foreach ($this->_columns as $column => $atributes) {
               if ($atributes['jump_record']) {
                   if (!isset($this->_columnsJumped[$column])) {
                       /* Tratamento do título */
                       $this->_columnsJumped[$column] = array();
                       $unsetNext = false;
                       $copyRow = $row;
                       foreach ($copyRow as $newColumn => $newAtribute) {
                           if ($unsetNext) {
                               unset($this->_columns[$newColumn]);
                               unset($this->_columnsTitle[$newColumn]);
                               break;
                           }
                           if ($newColumn == $column) {
                               $unsetNext = true;
                           }
                       }
                       $row = $copyRow;
                   } else {
                       if (!in_array($row[$column]->toPhp(), $this->_columnsJumped[$column])) {
                           $this->_columnsJumped[$column][] = $row[$column]->toPhp();
                           $copyRow = $row;
                           $unsetNext = false;
                           foreach ($copyRow as $newColumn => $newAtribute) {
                               if ($unsetNext) {
                                   unset($copyRow[$newColumn]);
                               }
                               if ($newColumn == $column) {
                                   $unsetNext = true;
                               }
                           }
                           $this->_addRow($copyRow, false);
                       }
                       foreach ($row as $newColumn => $newAtribute) {
                           if ($copyNext) {
                               $row[$copyNext] = $row[$newColumn];
                               break;
                           }
                           if ($newColumn == $column) {
                               $copyNext = $column;
                           }
                       }
                   }
               }
               /* if ($atributes['first_record']) {
                 if ($row[$column] instanceof ZendT_Type) {
                 $value = $row[$column]->getValueToDb();
                 if ($this->_columnsRepeat[$column] == $value) {
                 $row[$column]->set(NULL);
                 }
                 $this->_columnsRepeat[$column] = $value;
                 }
                 } */
           }
           return $row;
       }

       private function _configBorder(&$cell, $border) {
           if ($border) {
               list($left, $right, $top, $bottom) = explode(' ', $border);
               $left = $left * 1;
               $right = $right * 1;
               $top = $top * 1;
               $bottom = $bottom * 1;

               if ($left > 0) {
                   $cell->setBorderLeft($left, 'solid', '#000000');
               }
               if ($right > 0) {
                   $cell->setBorderRight($right, 'solid', '#000000');
               }
               if ($top > 0) {
                   $cell->setBorderTop($top, 'solid', '#000000');
               }
               if ($bottom > 0) {
                   $cell->setBorderBottom($bottom, 'solid', '#000000');
               }
           }
       }

       /**
        * Cria linhas no relatório
        * 
        * @param array $columns
        * @param bool $title
        */
       protected function _addRow($columns, $title = false, $subtotal = false, $columnsTitle = array(), $borderTop = true) {
           $styles = array();
           if ($this->_styleRow && !$title) {
               $styles = $this->_mapper->getStylesRow($columns, $this->_options['id'], $subtotal);
           }

           if ($title && count($this->_columnsTitle) > 0) {
               foreach ($this->_columnsTitle as $column) {
                   $_cell = new ZendT_Report_Cell();
                   $_cell->setValue($column['label']);
                   $_cell->setWidth($column['width']);
                   if ($column['colspan']) {
                       $_cell->setColspan(($column['colspan'] - 1));
                   }
                   $_cell->setTextAlign('center');
                   $_cell->setFontWeight(true);
                   $_cell->setFontSize($this->_fontSize);

                   //$this->_configBorder($_cell,$column['border']);

                   $this->_report->addCell($_cell);
               }
               $this->_report->printCells(false, $title);
           }

           /* echo '<pre>';
             print_r($columns);
             echo '</pre>';
             $this->count++;
             if ($this->count > 3) {
             exit;
             } */

           foreach ($this->_columns as $column => $atributes) {
               /**
                * @todo Verificar qual o melhor lugar para colocar o replace abaixo 
                */
               $column = str_replace('-distinct', '', $column);
               $column = str_replace('_distinct', '', $column);

               if ($title) {
                   $value = $atributes['label'];
               } else {
                   if (isset($columns[$column]))
                       $value = $columns[$column];
                   else
                       $value = '';
               }

               $_cell = new ZendT_Report_Cell();
               if ($title) {
                   $column = 'title_' . $column;
               }
               if ($subtotal) {
                   $column = 'total_' . $column;
               }
               $_cell->setName($column);

               $_cell->setValue($value);

               $parseUrl = false;
               if ($value instanceof ZendT_Type) {
                   $valueColumn = $value->getValueToDb();
                   if (isset($this->_columnsJumped[$column])) {
                       $jumpedRow = in_array($valueColumn, $this->_columnsJumped[$column]);
                   }
                   if ($atributes['first_record'] && $valueColumn) {
                       if ($this->_columnsRepeat[$column] == $valueColumn) {
                           $_cell->setValue(NULL);
                       }
                       $this->_columnsRepeat[$column] = $valueColumn;
                   }
                   $parseUrl = true;
               }

               $url = str_replace("?", "&", $atributes['url']);
               $urlView = current(explode('&', $url));
               if ($urlView) {
                   $isUrlView = (strpos($urlView, "view=") || is_numeric($urlView));
                   if ($isUrlView) {
                       $urlParams = explode('&', substr($url, strpos($url, "&") + 1));
                       $newParams = '';
                       foreach ($urlParams as $key => $val) {
                           $data = explode("=", $urlParams[$key]);
                           if ($data[0] && $data[1]) {
                               $newParams[$data[0]] = $data[1];
                           }
                       }
                       $urlView = end(explode("view=", $urlView));
                       $urlParams = $newParams;
                       $atributes['url'] = '';
                       foreach ($this->_params as $param => $key) {
                           $atributes['url'] .= "&{$param}=:{$param}";
                       }
                       if (!$this->_arrayUrl) {
                           foreach ($this->_columnsOrig as $param => $key) {
                               if (!$key['subtotal']) {
                                   $this->_arrayUrl[] = $param;
                               }
                           }
                       }
                       if ($subtotal) {
                           if ($this->_labelBreak == 'Subtotal') {
                               foreach ($this->_columnsBreak as $param => $key) {
                                   $atributes['url'] .= "&{$param}=:{$param}";
                               }
                           } else if ($this->_labelBreak == 'Total') {
                               
                           }
                       } else {
                           foreach ($this->_arrayUrl as $key => $param) {
                               $atributes['url'] .= "&{$param}=:{$param}";
                           }
                       }

                       if ($urlParams) {
                           foreach ($urlParams as $key => $val) {
                               if ($key == $val) {
                                   $val = ":{$val}";
                               }
                               $atributes['url'] .= "&{$key}={$val}";
                           }
                       }
                   }
               }
               if ($atributes['input'] && $this->_configColumns[$column]['input'] != null) {
                   $atributes['input'] = $this->_configColumns[$column]['input'];
               }
               $_cell->setInput($atributes['input']);
               if ($atributes['url'] && !$title && $parseUrl) {
                   $url = trim($atributes['url']);
                   if (strpos($url, ':') !== false) {
                       preg_match_all("/\:(.*?)\&/", $url . "&", $params);

                       #print_r($params);die;

                       list($aliasName, $aliasName2) = explode('_', $column);

                       $paramKey = array();
                       $paramValues = array();
                       foreach ($params[1] as $paramName) {

                           $paramValue = '';
                           if (isset($this->_columnsOrig[$paramName])) {
                               $paramValue = $this->_columnsOrig[$paramName];
                           } else if (isset($columns[$paramName])) {
                               $paramValue = $columns[$paramName];
                           } else if (isset($this->_columnsPivot[$paramName]['labels'][$aliasName])) {
                               $paramValue = $this->_columnsPivot[$paramName]['labels'][$aliasName];
                           } else if (isset($this->_columnsPivot[$paramName]['labels'][$aliasName2])) {
                               $paramValue = $this->_columnsPivot[$paramName]['labels'][$aliasName2];
                           } else if (isset($this->_params[$paramName])) {
                               $paramValue = $this->_params[$paramName];
                           } else {
                               foreach ($this->_columns as $column => $keys) {
                                   if ($keys['columnName'] == $paramName) {
                                       $subtotalColumn = $paramName . "_" . $keys['subtotal'];
                                       if ($columns[$paramName]) {
                                           $paramValue = $columns[$paramName]->get();
                                       } else if ($columns[$subtotalColumn]) {
                                           $paramValue = $columns[$subtotalColumn]->get();
                                       }
                                   }
                               }
                           }

                           /* if (substr($paramName,0,3) == 'exp'){
                             $paramValue = utf8_decode($paramValue);
                             } */

                           $paramKey[] = ':' . $paramName;
                           $paramValues[] = utf8_decode($paramValue);
                       }
                       $url = str_replace($paramKey, $paramValues, $url);
                   } else {
                       $url.= $value;
                   }
                   if ($isUrlView) {
                       $url = ZendT_Url::getUri() . "?profile=" . $urlView . $url;
                   }
                   $url = str_replace('{host}', ZendT_Url::getHostName(), $url);
                   $url = str_replace('{baseUrl}', ZendT_Url::getHostName() . ZendT_Url::getBaseUrl(), $url);
                   $_cell->setUrl($url);
               }
               if ($atributes['width']) {
                   if (strpos($atributes['width'], ',') !== false) {
                       $atributes['width'] = (double) str_replace(array('.', ','), array('', '.'), $atributes['width']);
                   }
                   $_cell->setWidth($atributes['width']);
               } else {
                   $_cell->setWidth($atributes['width']);
               }
               $_cell->setTextAlign($atributes['align']);
               $_cell->setFontWeight(($title || $subtotal || $jumpedRow));

               $this->_configBorder($_cell, $atributes['border']);

               if ($title) {
                   $_cell->setBorderBottom(0.4, 'solid', '#000000');
               }

               if ($this->firstLine) {
                   $_cell->setBorderTop(0.2, 'solid', '#000000');
               }

               if ($subtotal && $borderTop) {
                   $_cell->setBorderTop(0.2, 'solid', '#000000');
               }

               if ($atributes['font-size']) {
                   if (strpos($atributes['font-size'], ',') !== false) {
                       $atributes['font-size'] = (double) str_replace(array('.', ','), array('', '.'), $atributes['font-size']);
                   }
                   $_cell->setFontSize($atributes['font-size']);
               } else {
                   $_cell->setFontSize($this->_fontSize);
               }
               if (isset($styles[$column])) {
                   $_cell->setStyles($styles[$column]);
               }
               $this->_report->addCell($_cell);

               if ($atributes['subtotal'] && $subtotal == false && ($value instanceof ZendT_Type_Number || $value instanceof ZendT_Type_NumberTime)) {
                   if (!isset($this->_total[$column])) {
                       $this->_total[$column] = clone $value;
                   }
                   if (isset($atributes['calctotal'])) {
                       $this->_total[$column]->setTotalCalc($columns, $atributes['calctotal']);
                   } else {
                       $this->_total[$column]->setTotal($value, $atributes['subtotal']);
                   }

                   if (count($this->_columnsBreak) > 0) {
                       foreach ($this->_columnsBreak as &$columnBreak) {
                           if (!isset($columnBreak['subtotal'][$column])) {
                               $columnBreak['subtotal'][$column] = clone $value;
                           }
                           if (isset($atributes['calctotal'])) {
                               $columnBreak['subtotal'][$column]->setTotalCalc($columns, $atributes['calctotal']);
                           } else {
                               $columnBreak['subtotal'][$column]->setTotal($value, $atributes['subtotal']);
                           }
                       }
                   }
               }
           }
           $zebra = true;
           if ($subtotal && $borderTop) {
               $zebra = false;
           }
           if ($title) {
               $this->firstLine = true;
               $zebra = false;
           } else {
               $this->firstLine = false;
           }

           $this->_report->printCells($zebra, $title);
       }

       /**
        *
        * @return ZendT_Db_Recordset
        */
       protected function _getRecordset() {
           set_time_limit(3600);
           return $this->_mapper->recordset(null);
       }

       /**
        * Avalia se a visão irá retornar algum registro.
        * Usado para diparar e-mail do relatório
        */
       public function found() {
           set_time_limit(60);
           $postData = array();
           $postData['sidx'] = 1;
           $postData['sord'] = 'ASC';
           $postData['rows'] = 1;
           $postData['page'] = false;
           $postData['count'] = false;
           $data = $this->_mapper->getDataGrid($this->getWhere(), $postData, false, true);
           $found = $data->getRow();
           if (!$found) {
               return false;
           } else {
               return true;
           }
       }

       /**
        * Busca os dados da consulta
        */
       protected function _make() {
           $rs = $this->_getRecordset();

           $this->_printParams();
           $this->_verifyLineJump($this->_columns);
           $this->_addRow($this->_columns, true);

           if ($this->_options['driver'] == 'PDF') {
               #$this->_report->drawLine();
           }

           $row = $rs->getRow();

           if ($this->_options['log']) {
               $this->_log->finishDb();
           }

           $numRows = 0;
           if ($row) {
               if (count($this->_columnsBreak) > 0) {

                   $current = '';
                   $orderBreak = array();
                   foreach ($this->_columnsBreak as $columnName => &$columnBreak) {
                       $orderBreak[] = $columnName;

                       $current.= $row[$columnName]->get();
                       $columnBreak['prev'] = $current;
                   }
                   $orderBreakReverse = array_reverse($orderBreak);
               }

               do {
                   $numRows++;

                   if (count($this->_columnsBreak) > 0) {
                       $current = '';
                       foreach ($this->_columnsBreak as $columnName => &$columnBreak) {
                           $current.= $row[$columnName]->get();
                           $columnBreak['current'] = $current;
                       }

                       foreach ($orderBreakReverse as $columnName) {
                           if ($this->_columnsBreak[$columnName]['current'] != $this->_columnsBreak[$columnName]['prev']) {

                               if ($this->_options['advanced']['order_column'] == '' && $this->_columnsBreak[$columnName]['subtotal']) {
                                   $rowBreak = array();
                                   $this->_labelBreak = 'Subtotal';
                                   $rowBreak[$columnName] = $this->_labelBreak;
                                   foreach ($this->_columnsBreak[$columnName]['subtotal'] as $column => $total) {
                                       $rowBreak[$column] = $total->getTotal($this->_mapper->getModel()->getAdapter());
                                       $this->_columnsBreak[$columnName]['subtotal'] = null;
                                   }
                                   $this->_addRow($rowBreak, false, true, array(), false);
                                   /**
                                    * Pula uma linha
                                    */
                                   foreach ($rowBreak as &$value) {
                                       $value = '';
                                   }
                                   $this->_addRow($rowBreak, false, true, array(), true);
                                   #$this->_report->drawLine();
                               }

                               $this->_columnsBreak[$columnName]['prev'] = $this->_columnsBreak[$columnName]['current'];
                           }
                       }
                   }

                   $this->_verifyLineJump($row);
                   $this->_addRow($row, false);
               } while ($row = $rs->getRow());
           }

           if ($this->_options['log']) {
               $this->_log->finish($numRows);
           }


           if (count($this->_columnsBreak) > 0) {
               foreach ($orderBreakReverse as $columnName) {
                   if ($this->_options['advanced']['order_column'] == '' && $this->_columnsBreak[$columnName]['subtotal']) {
                       $rowBreak = array();
                       $this->_labelBreak = 'Subtotal';
                       $rowBreak[$columnName] = $this->_labelBreak;
                       foreach ($this->_columnsBreak[$columnName]['subtotal'] as $column => $total) {
                           $rowBreak[$column] = $total->getTotal($this->_mapper->getModel()->getAdapter());
                           $this->_columnsBreak[$columnName]['subtotal'] = null;
                       }
                       $this->_addRow($rowBreak, false, true);
                       #$this->_report->drawLine();
                   }
               }
           }

           if (count($this->_total) > 0) {
               #$this->_report->drawLine();
               $row = array();
               foreach ($this->_columns as $column => $atributes) {
                   break;
               }

               $this->_labelBreak = 'Total';
               $row[$column] = $this->_labelBreak;
               foreach ($this->_total as $columnName => $total) {
                   $row[$columnName] = $total->getTotal($this->_mapper->getModel()->getAdapter());
               }
               $this->_addRow($row, false, true);
           }
       }

       /**
        * Gera o relatório
        * 
        * @param string $dest
        * @return string 
        */
       public function show($dest = 'S') {
           $this->_make();
           return $this->_report->output('relatorio', $dest);
       }

       /**
        *
        * @return string
        */
       public function render() {
           return $this->show();
       }

   }

?>