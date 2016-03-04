<?php

   /**
    * Classe de relatÃ³rio baseado no MapperView
    *
    * @package ZendT
    * @subpackage Report
    */
   class ZendT_Report_View_Dynamic_Form extends ZendT_Report_View_Dynamic {

       public function __construct($driver, $mapperView, $options) {
           $this->_mapper = $mapperView;
           $configColumns = $this->_mapper->getColumns()->toArray();
           $this->_configColumns = $configColumns;

           $this->_mapper->parseExprProfile($options);

           $this->_columns = array();

           $this->_columnsGroup = array();
           $this->_columnsBreak = array();
           $this->_columnsBreakCount = array();

           // Validar
           $this->_styleRow = false;
           if (method_exists($mapperView, 'getStylesRow')) {
               $this->_styleRow = true;
           }

           $iCols = 'cols-lines';
           if (isset($options['cols-axis'])) {
               $iCols = 'cols-axis';
           }
           if ($options[$iCols]['fields']) {
               foreach ($options[$iCols]['fields'] as $columnName => $column) {
                   $this->_columnsGroup[] = $columnName;
                   if ($column['break']) {
                       $this->_columnsBreak[$columnName] = array();
                       $this->_columnsBreakCount[$columnName] = array();
                   }

                   $configColumn = $configColumns[$columnName];
                   foreach ($column as $key => $value) {
                       if ($value)
                           $configColumn[$key] = $value;
                   }

                   $this->_columns[$columnName] = $configColumn;
               }
           }
           $this->_columnsPivot = array();
           if ($options['cols-cols']['fields']) {
               foreach ($options['cols-cols']['fields'] as $field => $dataField) {
                   $this->_columnsPivot[$field] = $dataField;
               }
           }
           $this->_columnsTotal = array();

           // Validar

           $iCols = 'cols-values';
           if (isset($options['cols-measures'])) {
               $iCols = 'cols-measures';
           }
           if ($options[$iCols]['fields']) {
               foreach ($options[$iCols]['fields'] as $columnName => &$column) {

                   if ($column['tipo'] == '') {
                       $column['tipo'] = 'count';
                   }

                   /**
                    * Se a coluna nÃ£o for a representaÃ§Ã£o de uma expressÃ£o
                    */
                   $this->_columnsTotal[$columnName] = array(
                      'column' => $columnName,
                      'func' => $column['tipo'],
                      'type' => 'line'
                   );

                   $configColumn = $configColumns[$columnName];
                   foreach ($column as $key => $value) {
                       $configColumn[$key] = $value;
                   }

                   $this->_columns[$columnName . '_' . $column['tipo']] = $configColumn;
               }
           }

           $optionsReport = array();
           $optionsReport['printTitle'] = '1';
           $optionsReport['orientation'] = 'P';
           $optionsReport['printTitle'] = '1';
           $optionsReport['empresa'] = 'MAIS';

           if ($advanced['orientation']) {
               $optionsReport['orientation'] = $advanced['orientation'];
           }

           if (isset($advanced['printTitle'])) {
               $optionsReport['printTitle'] = $advanced['printTitle'];
           }

           if ($advanced['printParams']) {
               $optionsReport['printParams'] = $advanced['printParams'];
           }

           if ($advanced['empresa']) {
               $optionsReport['empresa'] = $advanced['empresa'];
           }

           $this->_report = ZendT_Report::factory('ZendT_Report_Pdf_Form', $optionsReport);
       }

       /**
        * Busca os dados da consulta
        */
       protected function _make() {
           $rs = $this->_getRecordset();
           $rows = array();
           while ($row = $rs->getRow()) {
               $rows[] = $row;
           }

           foreach ($rows as $row) {
               $this->_mapper->addRowForm($row, $this->_report);
               unset($row);
           }
       }

   }

?>