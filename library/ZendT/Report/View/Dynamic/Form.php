<?php

   /**
    * Classe de relatÃ³rio baseado no MapperView
    *
    * @package ZendT
    * @subpackage Report
    */
   class ZendT_Report_View_Dynamic_Form extends ZendT_Report_Dynamic {

       public function __construct($driver, $mapperView, $options) {
           $this->_options = $options;
           $this->_mapper = $mapperView;

           $this->_mapper->parseExprProfile($options);

           $configColumns = $this->_mapper->getColumns()->toArray();
           $this->_configColumns = $configColumns;

           $this->_columns = array();

           // Validar

           $iCols = 'cols-values';
           if (isset($options['cols-measures'])) {
               $iCols = 'cols-measures';
           }
           if ($options[$iCols]['fields']) {
               foreach ($options[$iCols]['fields'] as $columnName => &$column) {

                   $configColumn = $configColumns[$columnName];
                   foreach ($column as $key => $value) {
                       $configColumn[$key] = $value;
                   }

                   $this->_columns[$columnName . '_' . $column['tipo']] = $configColumn;
               }
           }

           $this->_report = ZendT_Report::factory('ZendT_Report_Pdf_Form' . $this->_options['advanced']);
       }

       /**
        * Busca os dados da consulta
        */
       protected function _make() {
           $rs = $this->_getRecordset();
           $row = $rs->getRow();
           $numRows = 0;
           if ($row) {
               do {
                   $numRows++;
                   $this->_mapper->addRowForm($row, $this->_report);
               } while ($row = $rs->getRow());
           }
       }

   }

?>