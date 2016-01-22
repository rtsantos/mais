<?php

/**
 * 
 *
 * @category    ZendT
 * @author      tesilva
 */
class ZendT_Form_Element_SpreadSheet extends ZendT_Form_Element {

    private $_delimiter = "X";
    public $_divParams = array();
    public $helper = "spreadSheet";

    public function __construct($spec, $options = null) {
        parent::__construct($spec, $options);
        $this->setColHeaders(true);
        $this->setRowHeaders(true);
        $this->setContextMenu(true);
        $this->setManualColumnResize(true);
    }

    private function _getCell($columnLine) {
        $columnLine = strtoupper($columnLine);
        if (strpos($columnLine, $this->_delimiter) === false) {
            $columnLine = $columnLine . $this->_delimiter . $columnLine;
        }
        list($column, $line) = explode($this->_delimiter, $columnLine);
        if (!is_numeric($column)) {
            $column = $this->_letterToNumber($column);
        }
        if (!is_numeric($line)) {
            $line = $this->_letterToNumber($line);
        }
        return array("column" => $column, "line" => $line);
    }

    private function _setCellParam($cell, $param, $value) {
        $jQueryParams = $this->getJQueryParams();
        if ($param == 'value') {
            $jQueryParams['data'][$cell['line']][$cell['column']] = $value;
        } else {
            $jQueryParams['properties'][$param][$cell['line']][$cell['column']] = $value;
        }
        $this->setJQueryParams($jQueryParams);
        return $this;
    }

    private function _setParam($param, $value) {
        $jQueryParams = $this->getJQueryParams();
        $jQueryParams[$param] = $value;
        $this->setJQueryParams($jQueryParams);
        return $this;
    }

    private function _getParam($param) {
        $jQueryParams = $this->getJQueryParams();
        return $jQueryParams[$param];
    }

    public function setValue($cell, $value) {
        $this->_setCellParam($this->_getCell($cell), 'value', $value);
        return $this;
    }

    public function callFunctionInPeriod($function, $value, $cellBegin, $cellEnd = '') {
        if (!$cellEnd) {
            $cellEnd = $cellBegin;
        }
        $cellBegin = $this->_getCell($cellBegin);
        $cellEnd = $this->_getCell($cellEnd);

        if ($cellBegin['column'] == $cellBegin['line'] && $cellEnd['column'] == $cellEnd['line']) {
            $onlyColumn = true;
        }

        for ($column = strtoupper($cellBegin['column']); $column <= strtoupper($cellEnd['column']); $column ++) {
            for ($line = strtoupper($cellBegin['line']); $line <= strtoupper($cellEnd['line']); $line ++) {
                if ($onlyColumn) {
                    $cell = $column;
                } else {
                    $cell = $column . $this->_delimiter . $line;
                }
                $this->$function($cell, $value);
            }
        }
        return $this;
    }

    public function setReadOnly($cell, $value = true) {
        $this->_setCellParam($this->_getCell($cell), 'readOnly', $value);
        return $this;
    }

    public function setHiddenColumn($column, $value = true) {
        $jQueryParams = $this->getJQueryParams();
        $jQueryParams['hiddenColumns'][$column] = $value;
        $this->setJQueryParams($jQueryParams);
        return $this;
    }

    public function setBackgroundColor($cell, $value) {
        $this->_setCellParam($this->_getCell($cell), 'backgroundColor', $value);
        return $this;
    }

    public function setType($cell, $type) {
        $this->_setCellParam($this->_getCell($cell), 'type', $type);
        return $this;
    }

    public function setColHeaders($value) {
        $this->_setParam('colHeaders', $value);
        return $this;
    }

    public function getColHeaders() {
        return $this->_getParam('colHeaders');
    }

    public function setRowHeaders($value) {
        $this->_setParam('rowHeaders', $value);
        return $this;
    }

    public function setColWidths($value) {
        $this->_setParam('colWidths', $value);
        return $this;
    }

    public function setManualColumnResize($value) {
        $this->_setParam('manualColumnResize', $value);
        return $this;
    }

    public function setContextMenu($value) {
        /* Obs.: pode ser definido também um array com as opções que devem ser visualizadas
         * http://handsontable.com/demo/contextmenu.html
         */
        $this->_setParam('contextMenu', $value);
        return $this;
    }

    public function setCallback($event, $function) {
        $cell = $this->_getCell($column);
        $jQueryParams = $this->getJQueryParams();
        $jQueryParams['callbacks'][$event] = $function;
        $this->setJQueryParams($jQueryParams);
        return $this;
    }

    public function setAutoComplete($column, $source, $params = array()) {
        $cell = $this->_getCell($column);
        $column = $cell['column'];
        $jQueryParams = $this->getJQueryParams();
        $jQueryParams['columns'][$column]['type'] = 'autocomplete';
        $jQueryParams['columns'][$column]['source'] = $source;
        $jQueryParams['columns'][$column]['strict'] = true;
        foreach ($params as $key => $val) {
            $jQueryParams['columns'][$column][$key] = $val;
        }
        $this->setJQueryParams($jQueryParams);
        return $this;
    }

    public function setContextMenuCallback($function) {
        $jQueryParams = $this->getJQueryParams();
        $jQueryParams['contextMenuCallback'] = $function;
        $this->setJQueryParams($jQueryParams);
        return $this;
    }

    public function addContextMenuKey($key, $label) {
        $jQueryParams = $this->getJQueryParams();
        $jQueryParams['contextMenuKey'][$key]['name'] = $label;
        $this->setJQueryParams($jQueryParams);
        return $this;
    }

    public function setDivParam($param, $value) {
        $divParams = $this->getAttrib('divParams');
        $divParams[$param] = $value;
        $this->setAttrib(divParams, $divParams);
        return $this;
    }
    
    public function setFixedRowsTop($value){
        $this->_setParam('fixedRowsTop', $value);
        return $this;
    }
    
    public function setFixedColumnsLeft($value){
        $this->_setParam('fixedColumnsLeft', $value);
        return $this;
    }

    private function _letterToNumber($value) {
        if ($value)
            return ord(strtolower($value)) - 97;
        else
            return -1;
    }

}
