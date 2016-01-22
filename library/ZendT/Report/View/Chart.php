<?php

    /**
     * Classe de relatório baseado no MapperView
     *
     * @package ZendT
     * @subpackage Report
     */
    class ZendT_Report_View_Chart extends ZendT_Report_View_Dynamic {
        /**
         * 
         * @return string
         */
        public function render(){            
            $rs = $this->_getRecordset();
            
            if (!isset($this->_options['height'])) {
                $this->_options['height'] = 500;
            }
            
            $typeGraph = array();
            $typeGraph['line'] = 'serial';
            $typeGraph['column'] = 'serial';
            $typeGraph['pie'] = 'pie';
            
            $colors = array();
            $graphs = array();
            $graphs['serial'] = array();
            if (isset($this->_options['advanced']['colors'])){                
                $lines = explode("\n",$this->_options['advanced']['colors']);
                foreach($lines as $line){
                    $cols = explode('=',$line);
                    $colors[$cols[0]] = $cols[1];
                }
                $graphs['serial']['colors'] = $colors;
            }
            $graphs['serial']['x_title'] = $this->_options['advanced']['x_title'];
            $graphs['serial']['y_title'] = $this->_options['advanced']['y_title'];
            $graphs['serial']['zoom'] = $this->_options['advanced']['zoom'];
            $graphs['serial']['title'] = $this->_report->getTitle();
            $graphs['serial']['type'] = 'serial';
            $graphs['serial']['category'] = 'category';
            if (isset($this->_options['categoryFontSize'])){
                $graphs['serial']['categoryFontSize'] = $this->_options['categoryFontSize'];
            }
            $graphs['serial']['adicionaLegenda'] = $this->_options['adicionaLegenda'];
            $graphs['serial']['categoryAxisLabelRotation'] = $this->_options['categoryAxisLabelRotation'];
            $graphs['serial']['titleSize'] = $this->_options['titleSize'];
            $graphs['serial']['labelFontSize'] = $this->_options['labelFontSize'];
            $graphs['serial']['legendFontSize'] = $this->_options['legendFontSize'];
            $graphs['serial']['legendMarkerSize'] = $this->_options['legendMarkerSize'];
            $graphs['serial']['legendValueWidth'] = $this->_options['legendValueWidth'];
            $graphs['serial']['legendValueText'] = $this->_options['legendValueText'];
            $graphs['serial']['legendAlign'] = $this->_options['legendAlign'];
            $graphs['serial']['formatBalloon'] = $this->_options['formatBalloon'];
            $graphs['pie'] = array();
            
            $iValues = 0;
            while ($row = $rs->getRow()) {
                $category = ' - Geral';
                if ($this->_options['cols-axis']['fields']){
                    $category = '';
                    foreach ($this->_options['cols-axis']['fields'] as $columnName => $column) {
                        $category.= ' - '.$row[$columnName]->get();
                    }
                }
                $category = new ZendT_Type_Default(substr($category,3));
                
                if ($this->_options['cols-measures']['fields']){
                    foreach ($this->_options['cols-measures']['fields'] as $columnName => $column) {
                        $column['type'] = $column['tp_chart'];
                        if (!$column['type']){
                            $column['type'] = 'column';
                        }
                        if ($column['tipo'] == '' || $column['tipo'] == 'count_distinct'){
                            $column['tipo'] = 'count';
                        }
                        if ($typeGraph[$column['type']] == 'serial'){
                            $graphs['serial']['measures'][$columnName] = $column;
                            $graphs['serial']['values'][$iValues]['category'] = $category;
                            $graphs['serial']['values'][$iValues][$columnName] = $row[$columnName.'_'.$column['tipo']];
                        }else{
                            if ($category->get()) {
                                $graphs['pie'][$column['label']]['measures'][$columnName] = $column;
                                $graphs['pie'][$column['label']]['values'][$iValues]['category'] = $category->get();
                                $graphs['pie'][$column['label']]['values'][$iValues][$columnName] = $row[$columnName.'_'.$column['tipo']];
                            }
                        }
                    }
                }
                $iValues++;
            }
            #
            #
            #
            $name = trim(str_replace(' ', '-', $this->_report->getTitle()));
            $charts = array();
            #
            # Gráfico Serial
            #
            if (isset($graphs['serial']['measures'])){
                $charts[] = new ZendT_View_Chart('serial-' . $name, $graphs['serial'], $graphs['serial']['values']);
            }
            
            if (count($graphs['pie']) > 0){
                foreach($graphs['pie'] as $key => $value){
                    if ($key) {
                        $graphs['pie'][$key]['title'] = $this->_report->getTitle() . ' - ' . $key;
                    } else {
                        $graphs['pie'][$key]['title'] = $this->_report->getTitle();
                    }
                    $graphs['pie'][$key]['type'] = 'pie';
                    $graphs['pie'][$key]['category'] = 'category';
                    $graphs['pie'][$key]['adicionaLegenda'] = $this->_options['adicionaLegenda'];
                    $graphs['pie'][$key]['legendFontSize'] = $this->_options['legendFontSize'];
                    $graphs['pie'][$key]['legendMarkerSize'] = $this->_options['legendMarkerSize'];
                    $graphs['pie'][$key]['legendValueWidth'] = $this->_options['legendValueWidth'];
                    $graphs['pie'][$key]['legendValueText'] = $this->_options['legendValueText'];
                    $graphs['pie'][$key]['legendAlign'] = $this->_options['legendAlign'];
                    $graphs['pie'][$key]['formatBalloon'] = $this->_options['formatBalloon'];
                    $graphs['pie'][$key]['pieLabelText'] = $this->_options['pieLabelText'];
                    $graphs['pie'][$key]['pieFontSize'] = $this->_options['pieFontSize'];
                    $graphs['pie'][$key]['depth3D'] = $this->_options['depth3D'];
                    $graphs['pie'][$key]['angle'] = $this->_options['angle'];
                    $graphs['pie'][$key]['titleSize'] = $this->_options['titleSize'];
                    if (count($colors) > 0){
                        $graphs['pie'][$key]['colors'] = $colors;
                    }
                    $charts[] = new ZendT_View_Chart('pie-' . $graphs['pie'][$key]['title'], $graphs['pie'][$key], $graphs['pie'][$key]['values']);
                }
            }
            
            if ($charts) {
                $cmdCharts = '<table width="100%" border="0">';

                if ($this->_labelFilters && count($this->_labelFilters) > 0){
                    $displayParameters = '';
                    if (!$this->_options['show_parameters']){
                        $displayParameters = ' style="display:none"';
                    }
                    $cmdCharts.= '<tr class="graph_filter"'.$displayParameters.'><td class="ui-corner-all ui-userdata ui-state-default" style="padding:5px;">';
                    $cmdCharts.= '<table width="100%" border="0">';
                    foreach($this->_labelFilters as $label){
                        $cmdCharts.= '<tr>';
                        $cmdCharts.= '<td width="170"><b>';
                        $cmdCharts.= $label['field'].':';
                        $cmdCharts.= '</b></td>';
                        $cmdCharts.= '<td>';
                        $cmdCharts.= str_replace('%',' ',$label['value']);
                        $cmdCharts.= '</td>';
                        $cmdCharts.= '</tr>';
                    }
                    $cmdCharts.= '</table>';
                    $cmdCharts.= '</td></tr>';
                }
                
                $propWidth = '';
                if (isset($this->_options['width'])){
                    $propWidth = ' width="'.$this->_options['width'].'" ';
                }

                $cmdCharts.= '<tr><td class="ui-corner-all ui-widget-content" '.$propWidth.' height="'.$this->_options['height'].'">';
                foreach($charts as $chart){                
                    $cmdCharts.= $chart->render();                
                }          
                $cmdCharts.= '</td></tr></table>';
            }
            
            /*$refresh = $this->_options['advanced']['refresh'];
            if($refresh){
				$refresh *= 1000;
                $cmdCharts .= "<script>
                                jQuery(document).ready(function () {
                                    setTimeout(function(){
                                        window.location.reload(1);
                                    }, {$refresh});
                                });
                                </script>";
            }*/
            
            return $cmdCharts;
        }
    }
?>