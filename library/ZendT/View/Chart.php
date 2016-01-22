<?php

    /**
     * Cria um objeto do tipo Tab (Orelha)
     * 
     * @package ZendT
     * @subpackage Tabs
     * @category View
     *  
     */
    class ZendT_View_Chart extends ZendT_View_Html {
        /**
         * Tipos possíveis de Gráficos
         */

        const SERIAL = 'serial';
        const PIE = 'pie';

        protected static $_chartTypes = array(
            self::SERIAL,
            self::PIE,
        );

        /**
         * @var array
         */
        protected $_options;

        /**
         *
         * @var string
         */
        protected $_type;

        /**
         *
         * @var string
         */
        protected $_title;
        
        /**
         *
         * @var string
         */
        protected $_titleSize = 13;

        /**
         *
         * @var string
         */
        protected $_chartData;

        /**
         *
         * @var string
         */
        protected $_js;

        /**
         * @var int
         */
        protected $_color;
        /**
         *
         * @var string 
         */
        private $_varNameJs;
        /**
         *
         * @var type 
         */
        private $_zoom;
        /**
         *
         * @param string $id
         * @param array $options
         * @param array $data 
         */
        public function __construct($id, $options, $data) {
            
            $id = clearAccent($id);
            $this->setZoom($options['zoom']);
            $this->setId($id);
            $this->setType($options['type']);
            $this->setTitle($options['title']);
            
            if (!isset($options['adicionaLegenda'])) {
                $options['adicionaLegenda'] = true;
            }
            
            if (!isset($options['categoryAxisLabelRotation'])) {
                $options['categoryAxisLabelRotation'] = 45;
            }
            
            if (!isset($options['depth3D'])) {
                $options['depth3D'] = 15;
            }
            
            if (!isset($options['angle'])) {
                $options['angle'] = 30;
            }

            if (isset($options['titleSize'])) {
                $this->setTitleSize($options['titleSize']);
            }
            
            if (!isset($options['labelFontSize'])) {
                $options['labelFontSize'] = 10;
            }
            
            if (!isset($options['legendFontSize'])) {
                $options['legendFontSize'] = 10;
            }
            
            if (!isset($options['legendMarkerSize'])) {
                $options['legendMarkerSize'] = 16;
            }
            
            if (!isset($options['legendValueWidth'])) {
                $options['legendValueWidth'] = 80;
            }
            
            if (!isset($options['legendValueText'])) {
                $options['legendValueText'] = '[[value]]';
            }
            
            if (!isset($options['legendAlign'])) {
                $options['legendAlign'] = 'left';
            }
            
            if (!isset($options['pieLabelText'])) {
                $options['pieLabelText'] = '[[title]]: [[value]] ([[percents]]%)';
            }
            
            if (!isset($options['pieFontSize'])) {
                $options['pieFontSize'] = 11;
            }
            
            $this->_varNameJs = $id;
            $this->_options = $options;
            $this->_color = -1;

            $this->_load($data);
        }

        public function __toString() {
            return $this->_js;
        }
        /**
         *
         * @param int $value
         * @return \ZendT_View_Chart 
         */
        public function setZoom($value){
            $this->_zoom = $value;
            return $this;
        }

        /**
         *
         * @param array $data 
         */
        public function setChartData(array $data) {
            $this->_chartData = '';

            foreach ($data as $column) {

                $cmdData = '';

                foreach ($column as $key => $value) {

                    $cmdData.= ',';

                    if ($value instanceof ZendT_Type_Number) {
                        $num = $value->toPhp();
                        if (!$num){
                            $num = 0;
                        }
                        $cmdData.= "'$key': {$num}";
                    } else if ($value instanceof ZendT_Type) {
                        $cmdData.= "'$key': '{$value->get()}'";
                    } else {
                        $cmdData.= "'$key': '{$value}'";
                    }
                }
                $color = '';
                if (count($this->_options['colors']) > 1){
                    $_category = $column['category'];
                    $_color = '';
                    @$_color = $this->_options['colors'][$_category];
                    if ($_color){
                        $color.= ',color: "'.$_color.'"';
                    }
                }
                $this->_chartData.= ',{' . substr($cmdData, 1) . $color . '}' . "\n";                
            }
        }

        public function getChartData() {
            $this->_chartData = trim($this->_chartData);
            $this->_chartData = ltrim($this->_chartData, ',');
            $this->_chartData = "[{$this->_chartData}];\n";
            return $this->_chartData;
        }

        /**
         *
         * @param type $type
         * @throws ZendT_Exception_Alert 
         */
        public function setType($type) {

            if (!in_array($type, self::$_chartTypes)) {
                throw new ZendT_Exception_Alert("O tipo informado ($type) não é válido!");
            }

            $this->_type = $type;
        }

        /**
         *
         * @return type 
         */
        public function getType() {
            return $this->_type;
        }

        public function setTitle($title) {
            $this->_title = $title;
        }

        public function getTitle() {
            return $this->_title;
        }
        
        public function setTitleSize($value) {
            $this->_titleSize = $value;
        }

        public function getTitleSize() {
            return $this->_titleSize;
        }

        /**
         *
         * @param type $data 
         */
        protected function _load($data) {
            $this->setChartData($data);

            $this->_js = "\n\nvar chart".$this->_varNameJs."Data = " . $this->getChartData();
            if ($this->_zoom){
                $this->_js .= " var chartCursor = {}; \n";
            }
            $this->_js .= " var chart".$this->_varNameJs." = {}; \n";
            $this->_js .= "AmCharts.ready(function () {\n";

            switch ($this->getType()) {

                case self::PIE:
                    $this->createPieChart($name, $chartData, $field, $value);
                    break;

                case self::SERIAL;
                    $this->createSerialChart();
                    break;
            }

            if ($this->_options['adicionaLegenda']) {
                $this->_js .= "var legend = new AmCharts.AmLegend();\n";
                $this->_js .= "legend.position = 'bottom';\n";
                $this->_js .= "legend.fontSize = ".$this->_options['legendFontSize'].";\n";
                $this->_js .= "legend.markerSize = ".$this->_options['legendMarkerSize'].";\n";
                $this->_js .= "legend.valueWidth = ".$this->_options['legendValueWidth'].";\n";
                $this->_js .= "legend.valueText = '".$this->_options['legendValueText']."';\n";                
                $this->_js .= "legend.align = '".$this->_options['legendAlign']."';\n";
                $this->_js .= "chart".$this->_varNameJs.".addLegend(legend, 'legendDiv2');\n";
            }
            
            $this->_js .= "chart".$this->_varNameJs.".write('{$this->getId()}');\n";
            $this->_js .= "\n});";
        }

        /**
         *
         * @return string 
         */
        public function getColor() {
            $this->_color++;
            $_colors[] = '#FF6600';
            $_colors[] = '#105239';
            $_colors[] = '#81acd9';
            $_colors[] = '#ADD981';
            return $_colors[$this->_color];
        }

        /**
         * 
         */
        public function createSerialChart() {

            /**
             * Declaração do Gráfico
             */
            $this->_js .= "chart".$this->_varNameJs." = new AmCharts.AmSerialChart();\n";
            $this->_js .= "chart".$this->_varNameJs.".addTitle('{$this->getTitle()}', {$this->getTitleSize()});\n";
            $this->_js .= "chart".$this->_varNameJs.".dataProvider = chart".$this->_varNameJs."Data;\n";
            $this->_js .= "chart".$this->_varNameJs.".categoryField = '" . $this->_options['category'] . "';\n";
            $this->_js .= "chart".$this->_varNameJs.".startDuration = 1;\n";
            if (!$this->_zoom){
                $this->_js .= "chart".$this->_varNameJs.".depth3D = 10;\n";
                $this->_js .= "chart".$this->_varNameJs.".angle = 50;\n";
            }            
            $this->_js .= "chart".$this->_varNameJs.".rotate = false;\n"; # @todo
            
            if ($this->_options['formatBalloon']) {
                $this->_js .= "var balloon = chart".$this->_varNameJs.".balloon;";
                $this->_js .= "balloon.cornerRadius = 0;";
                $this->_js .= "balloon.fontSize = 16;";

                $this->_js .= "var chartCursor = new AmCharts.ChartCursor();\n";
                $this->_js .= "chartCursor.categoryBalloonEnabled = false;\n";
                $this->_js .= "chartCursor.cursorAlpha = 0;\n";
                $this->_js .= "chartCursor.zoomable = false;\n";
                $this->_js .= "chartCursor.valueBalloonsEnabled = false;\n";
                $this->_js .= "chart".$this->_varNameJs.".addChartCursor(chartCursor);\n";
            }

            /**
             * Configuração do Eixo Y
             */
            $this->_js .= "var valueAxis = new AmCharts.ValueAxis();\n";
            $this->_js .= "valueAxis.title = '" . $this->_options['y_title'] . "';\n";
            if ($this->_options['categoryFontSize']){
                //$this->_js .= "valueAxis.titleFontSize = ".$this->_options['categoryFontSize'].";\n";
            }
            $this->_js .= "chart".$this->_varNameJs.".addValueAxis(valueAxis);\n";

            /**
             * Configuração do Eixo X
             */
            $this->_js .= "var categoryAxis = chart".$this->_varNameJs.".categoryAxis;\n";
            $this->_js .= "categoryAxis.title = '" . $this->_options['x_title'] . "';\n";
            $this->_js .= "categoryAxis.labelRotation = ".$this->_options['categoryAxisLabelRotation'].";\n";
            if ($this->_options['categoryFontSize']){
                $this->_js .= "categoryAxis.fontSize = ".$this->_options['categoryFontSize'].";\n";
            }
            $this->_js .= "chart".$this->_varNameJs.".addValueAxis(categoryAxis);\n";

            /**
             * Medidas
             */
            $measures = $this->_options['measures'];
            /*echo '<pre>';
            print_r($measures);
            echo '</pre>';
            exit;*/

            foreach ($measures as $alias => $config) {

                $this->_js .= "var $alias = new AmCharts.AmGraph();\n";

                $type = $config['type'];
                $label = $config['label'];
                $column = $config['column'];
                $function = $config['function'];
                $color = $config['color'];
                $fontSize = $config['fontsize'];
                if (isset($config['font-size'])){
                    $fontSize = $config['font-size'];
                }
                
                if(!$fontSize){
                    $fontSize = $this->_options['labelFontSize'];
                }
                $exibeTotal = $config['showtotal'];
                if (isset($config['show-total'])){
                    $exibeTotal = $config['show-total'];
                }
                $exibePorcentagem = $config['showpercent'];
                if (isset($config['show-percent'])){
                    $exibePorcentagem = $config['show-percent'];
                }
                
                $labelPosition = $config['position'];
                $fontColor = $config['fontcolor'];
                if (isset($config['font-color'])){
                    $fontColor = $config['font-color'];
                }

                $columnName = ($function) ? $alias . '_' . $function : $alias;
                
                if (count($this->_options['colors']) > 1){
                    $this->_js .= "$alias.colorField = 'color';\n";
                }
                
                if ($color){
                    if ($type == 'line') {
                        $this->_js .= "$alias.lineColor = '".$color."';\n";
                    }   
                    $this->_js .= "$alias.fillColors = '".$color."';\n";
                }
                
                if($fontColor){
                    $this->_js .= "$alias.color = '{$fontColor}';\n";
                }

                if ($type == 'line') {
                    #$this->_js .= "$alias.lineColor = '#FF0055';\n"; # @todo trabalhar com cores pré-definidas
                    $this->_js .= "$alias.fillAlphas = 0;\n"; # @todo Preencher quando for gráfico de áreas
                    $this->_js .= "$alias.lineThickness = 2;\n";
                    $this->_js .= "$alias.bullet = 'round';\n";
                }

                if ($type == 'column') {

                    #$this->_js .= "$alias.fillColors = '#FF0055';";  # @todo trabalhar com cores pré-definidas
                    $this->_js .= "$alias.lineAlpha = 0;\n";
                    $this->_js .= "$alias.fillAlphas = 1;\n";
                }

                $this->_js .= "$alias.type = '$type';\n";
                $this->_js .= "$alias.title = '$label';\n";
                //$this->_js .= "$alias.labelPosition = 'inside';\n";                
                $this->_js .= "$alias.valueField = '$columnName';\n";
                $this->_js .= "$alias.balloonText = '[[title]]: [[value]] ";
                if($exibeTotal){
                    $this->_js .= "\\n Total: [[total]]";
                }
                if($exibePorcentagem){
                    $this->_js .= " \\n Porcentagem:  [[percents]]% ";
                }
                $this->_js .= " ';\n";
                if($labelPosition){
                    $this->_js .= "$alias.labelPosition = '{$labelPosition}';\n";
                }
                $this->_js .= "$alias.labelText = '[[value]]';\n";
                $this->_js .= "$alias.fontSize = ".$fontSize."\n";
                
                $this->_js .= "chart".$this->_varNameJs.".addGraph($alias);\n";
                
                if ($this->_zoom){
                    $this->_js .= "chartCursor = new AmCharts.ChartCursor();\n";
                    $this->_js .= "chartCursor.cursorPosition = 'mouse';\n";
                    $this->_js .= "chart".$this->_varNameJs.".addChartCursor(chartCursor);\n";

                    $this->_js .= "var scrollbar{$alias} = new AmCharts.ChartScrollbar();\n";
                    $this->_js .= "scrollbar{$alias}.graph = {$alias};\n";
                    $this->_js .= "scrollbar{$alias}.scrollbarHeight = 40;\n";
                    $this->_js .= "scrollbar{$alias}.color = '#FFFFFF';\n";
                    $this->_js .= "scrollbar{$alias}.autoGridCount = true;\n";
                    $this->_js .= "chart".$this->_varNameJs.".addChartScrollbar(scrollbar{$alias});\n";
                }
            }
            if ($this->_zoom){
                $this->_js .= "chart".$this->_varNameJs.".pathToImages = '/Mais/public/scripts/amcharts/images/';\n";
                $this->_js .= "chart".$this->_varNameJs.".zoomOutButton = {\n";
                $this->_js .= " backgroundColor: '#000000',\n";
                $this->_js .= " backgroundAlpha: 0.15\n";
                $this->_js .= " };\n";
                $this->_js .= "chart".$this->_varNameJs.".addListener('dataUpdated',zoomChart);\n";
                
                $this->_js .= "function zoomChart(){\n";
                $this->_js .= "   chart".$this->_varNameJs.".zoomToIndexes(chart".$this->_varNameJs."Data.length - 40, chart".$this->_varNameJs."Data.length - 1);\n";
                $this->_js .= "}\n";                
            }
        }

        public function createPieChart() {

            /**
             * Recupera a configuração de medida
             */
            $measure = $this->_options['measures'];
            $aliasMeasure = key($measure);
            $aliasMeasure = (isset($measure[$aliasMeasure]['function'])) ? $aliasMeasure . '_' . $measure[$aliasMeasure]['function'] : $aliasMeasure;

            /**
             * Recupera a configuração de Agrupamento
             */
            $category = $this->_options['category'];
            $aliasCategory = $category;

            /**
             * Declaração do Gráfico
             */
            $this->_js .= "var chart".$this->_varNameJs." = new AmCharts.AmPieChart();\n";
            if (count($this->_options['colors']) > 1){
                $this->_js .= "chart".$this->_varNameJs.".colorField = 'color';\n";
            }
            $this->_js .= "chart".$this->_varNameJs.".addTitle('{$this->getTitle()}', {$this->getTitleSize()});\n";
            $this->_js .= "chart".$this->_varNameJs.".dataProvider = chart".$this->_varNameJs."Data;\n";
            $this->_js .= "chart".$this->_varNameJs.".titleField = '" . $aliasCategory . "';\n";
            $this->_js .= "chart".$this->_varNameJs.".valueField = '$aliasMeasure';\n";
            $this->_js .= "chart".$this->_varNameJs.".fontSize = ".$this->_options['pieFontSize'].";\n";
            $this->_js .= "chart".$this->_varNameJs.".balloonText = '[[title]]: [[value]] ([[percents]]%)';\n";
            $this->_js .= "chart".$this->_varNameJs.".balloon.fontSize = ".$this->_options['legendFontSize'].";\n";
            $this->_js .= "chart".$this->_varNameJs.".labelText = '".$this->_options['pieLabelText']."';\n";
            $this->_js .= "chart".$this->_varNameJs.".outlineColor = '#FFFFFF';\n";
            $this->_js .= "chart".$this->_varNameJs.".outlineAlpha = 0.8;\n";
            $this->_js .= "chart".$this->_varNameJs.".outlineThickness = 2;\n";
            $this->_js .= "chart".$this->_varNameJs.".depth3D = ".$this->_options['depth3D'].";\n";
            $this->_js .= "chart".$this->_varNameJs.".angle = ".$this->_options['angle'].";\n";            
        }

        /**
         * Cria o HTML para as tabs
         * 
         * @return string 
         */
        public function createHtml() {
            $html = '<div id="' . $this->getId() . '" style="width: 100%; height: 100%;"></div>' . "\n";
            /*if ($this->_zoom){
                $html.= "<script>\n";
                $html.= "function setPanSelect(select) {\n";
                $html.= "   alert('SSS ' ||  select);if(select){\n";
                $html.= "      chartCursor.pan = false;chartCursor.zoomable = true;\n";
                $html.= "   }else{\n";
                $html.= "      chartCursor.pan = true;\n";
                $html.= "   }\n";
                $html.= "   chart".$this->_varNameJs.".validateNow();\n";
                $html.= "}\n";
                $html.= "</script>\n";
                $html.= '<select onChange="alert(this.value);setPanSelect(this.value);"><option value="0">Move</option><option value="1">Seleção</option></select>';
            }*/
            return $html;
        }

        /**
         * Renderiza
         * 
         * @return string 
         */
        public function render() {
            $this->addHeadScriptFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/amcharts/amcharts.js');
            $this->addHeadScript($this->getId(), $this->__toString());
            return $this->createHtml();
        }

    }

?>