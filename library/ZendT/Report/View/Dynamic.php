<?php

   /**
    * Classe de relatÃ³rio baseado no MapperView
    *
    * @package ZendT
    * @subpackage Report
    */
   class ZendT_Report_View_Dynamic extends ZendT_Report_View {

       /**
        *
        * @var array
        */
       #protected $_profile;
       /**
        *
        * @var array 
        */
       protected $_params = array();

       public function __construct($driver, $mapperView, $options) {
           $this->_options = $options;
           $params = Zend_Controller_Front::getInstance()->getRequest()->getParams();

           if (!isset($this->_options['printLabelFilters'])) {
               $this->_options['printLabelFilters'] = true;
           }

           if (!isset($this->_options['log'])) {
               $this->_options['log'] = true;
           }
           $this->_options['log'] = false;

           $advanced = $options['advanced'];
           $this->_options['refresh'] = $advanced['refresh'];
           if ($driver == '' && $advanced['output']) {
               $driver = $advanced['output'];
           }
           if ($params['typeShow']) {
               $driver = $params['typeShow'];
           }
           $optionsReport = array();
           if ($advanced['orientation']) {
               $optionsReport['orientation'] = $advanced['orientation'];
           }
           if ($advanced['zebra']) {
               $optionsReport['zebra'] = $advanced['zebra'];
           }
           $optionsReport['title']['print'] = $advanced['printTitle'];
           if ($advanced['printParams']) {
               $optionsReport['printParams'] = $advanced['printParams'];
           }
           if ($advanced['empresa']) {
               $optionsReport['empresa'] = $advanced['empresa'];
           } else {
               /**
                * Configuração do estilos padrão
                */
               $dnsEmpresas = array();
               $dnsEmpresas['tanet.com.br'] = 'TA';
               $dnsEmpresas['talog.com.br'] = 'TAL';
               $dnsEmpresas['taexpress.com.br'] = 'TAE';
               $dnsEmpresas['windexpress.com.br'] = 'TAE';
               $dnsEmpresas['tawind.com.br'] = 'TAE';
               $domain = ZendT_Url::getDomain();
               if (isset($dnsEmpresas[$domain])) {
                   $optionsReport['empresa'] = $dnsEmpresas[$domain];
               }
           }
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
           if ($driver == '')
               $driver = 'PDF';
           $this->_options['driver'] = $driver;
           $this->_report = ZendT_Report::factory($driver, $optionsReport);
           $this->_report->setTitle($options['title']);
           $this->_report->addPage();

           $this->_fontSize = $options['fontSize'];
           if (!$this->_fontSize) {
               $this->_fontSize = 7;
           }

           if ($this->_options['log']) {
               $this->_log = new ZendT_Log_Report(get_class($this->_mapper), $options['title']);
           }
       }

       /**
        *
        * @return \ZendT_Db_Where 
        */
       public function getWhere($onlyValidParam = false) {
           $params = Zend_Controller_Front::getInstance()->getRequest()->getParams();

           $columnsMapper = $this->_mapper->getColumns()->toArray();

           $columns = $this->_mapper->getColumns()->getColumnsMapper();
           $columns->add('*', get_class($this->_mapper));

           $paramValid = array();
           $binds = array();

           /**
            * Verifica se no profile existe filtro padrão configurado 
            */
           $columnsFilters = $this->_options['cols-filter']['fields'];
           #var_dump($columnsMapper);die;
           foreach ($params as $key => $val) {
               if (!array_key_exists($key, $columnsFilters)) {
                   if ($columnsMapper[$key]) {
                       $value = $params[$key];
                       if (isset($columnsMapper[$key]['listOptions'][$value])) {
                           $value = $columnsMapper[$key]['listOptions'][$value];
                       }
                       $columnsFilters[$key] = array('label' => $columnsMapper[$key]['label'], 'value' => $value);
                   }
               }
           }
           #var_dump($columnsFilters);die;
           if (isset($columnsFilters)) {
               foreach ($columnsFilters as $columnName => $column) {
                   /* echo $columnName;
                     print_r($this->_options);
                     exit; */

                   if ($columnsMapper[$columnName]['expression']) {
                       $field = 'expression-' . $columnName;
                   } else {
                       $field = str_replace('.', '-', $columnsMapper[$columnName]['column']);
                   }

                   $label = $columnsFilters[$columnName]['label'];
                   if (!$label) {
                       $label = $columnsMapper[$columnName]['label'];
                   }

                   if ($params[$columnName . '-multiple']) {
                       $this->_params[$columnName] = $params[$columnName . '-multiple'];
                       $labelWhere[str_replace('-', '.', $field)] = $label;
                       $labelWhere[$columnName] = $label;
                       $params[$field] = $params[$columnName . '-multiple'];
                       $paramValid[$columnName] = true;
                       unset($params[$columnName . '-multiple']);
                       if (is_array($columnsMapper[$columnName]['bind'])) {
                           $binds[$columnName] = $columnsMapper[$columnName]['bind'];
                       }
                       continue;
                   }
                   if ($params[$columnName]) {
                       $this->_params[$columnName] = $params[$columnName];
                       $labelWhere[str_replace('-', '.', $field)] = $label;
                       $labelWhere[$columnName] = $label;
                       $params[$field] = $params[$columnName];
                       $paramValid[$columnName] = true;
                       if (is_array($columnsMapper[$columnName]['bind'])) {
                           $binds[$columnName] = $columnsMapper[$columnName]['bind'];
                       }
                       unset($params[$columnName]);
                       continue;
                   }
                   if (isset($params[$columnName . '-multiple'])) {
                       unset($params[$columnName . '-multiple']);
                   }
                   #if ($params[str_replace('.','-',$columnsMapper[$columnName]['column'])]){
                   #    continue;
                   #}

                   $valueParse = $columnsFilters[$columnName]['value'];
                   if (in_array($columnsMapper[$columnName]['type'], array('Date', 'DateTime'))) {
                       $values = array();
                       if (strpos($valueParse, ';')) {
                           $sep = ';';
                           $values = explode(';', $valueParse);
                       } else if (strpos($valueParse, ' ')) {
                           $sep = ' ';
                           $values = explode(' ', $valueParse);
                       } else if ($config['value'] != '') {
                           $sep = '';
                           $values = array($valueParse);
                       } else if ($valueParse) {
                           $sep = '';
                           $values = array($valueParse);
                       }
                       $valueParse = '';
                       foreach ($values as $value) {
                           $date = ZendT_Type_Date::parse($value, $columnsMapper[$columnName]['type']);
                           if ($valueParse) {
                               $valueParse.= $sep . str_replace(" ", "-", $date->get());
                           } else {
                               $valueParse = str_replace(" ", "-", $date->get());
                           }
                       }
                   } else if (strtolower(substr($valueParse, 0, 5)) == 'logon') {
                       $levels = explode('.', $valueParse);
                       $_sessionValue = $_SESSION;
                       foreach ($levels as $level) {
                           $_sessionValue = $_sessionValue[$level];
                       }
                       $valueParse = $_sessionValue;
                   }
                   if ($valueParse) {
                       $labelWhere[str_replace('-', '.', $field)] = $label;
                       $labelWhere[$columnName] = $label;
                       $params[$field] = $valueParse;
                       $paramValid[$columnName] = true;
                       $this->_params[$columnName] = $valueParse;


                       if (is_array($columnsMapper[$columnName]['bind'])) {
                           $binds[$columnName] = $columnsMapper[$columnName]['bind'];
                       }
                   }
               }
           }
           #
           foreach ($columnsMapper as $columnName => $column) {
               if ($column['required'] && !$paramValid[$columnName]) {
                   throw new ZendT_Exception_Alert($column['required']);
               }
           }

           #var_dump($params);die;
           $where = ZendT_Db_Where::fromAutoFilter($params, $columns, null, $binds);

           if (method_exists($this->_mapper, 'setWhere')) {
               $this->_mapper->setWhere($where);
           }

           if (method_exists($this->_mapper, 'paramIsValid')) {
               $this->_mapper->paramIsValid($where);
           }

           if ($onlyValidParam) {
               return $where;
           }
           /**
            * Trata parâmetros a serem impressos no PDF e XLS
            */
           #print_r($labelWhere);
           if ($this->_options['printLabelFilters']) {
               $this->_labelFilters = $where->getFriendlyFilter($labelWhere);

               /**
                * Realiza a substituição dos ids pela descrição dos campos configurados na seeker
                */
               foreach ($this->_configColumns as $array => $field) {
                   if (is_array($field['seeker'])) {
                       $newfield = $field['aliasTable'] . "." . $field['columnName'];

                       /*
                        * Monta uma lista dos ids a partir da label atual para aplicar filtro no banco
                        */
                       $value = $this->_labelFilters[$newfield]['value'];
                       $union = '';
                       if (strpos($value, ',') !== false) {
                           $values = explode(',', $value);
                           $union = ',';
                       } else {
                           $values = explode(' e ', $value);
                           $union = ' e ';
                       }
                       $value = implode(';', $values);

                       $_mapperView = new $field['seeker']['mapperView']();
                       $_whereLabel = $_mapperView->getColumns()->mountWhere('id', $value);
                       $data = $_mapperView->recordset($_whereLabel);

                       /**
                        * Define os campos que serão exibidos, conforme a quantidade de labels informada
                        */
                       $countLabels = 0;
                       $maxLabels = (!$field['seeker']['maxLabels'] ? 1 : $field['seeker']['maxLabels']);
                       $fields = array();
                       foreach ($field['seeker']['fields'] as $_field => $_value) {
                           array_push($fields, $_field);
                           if (++$countLabels >= $maxLabels)
                               break;
                       }

                       /**
                        * Monta uma nova label para exibir os campos definidos acima
                        */
                       $newLabel = '';
                       while ($row = $data->getRow()) {
                           if ($newLabel) {
                               $newLabel .= $union;
                           }
                           $labels = '';
                           for ($i = 0; $i < count($fields); $i++) {
                               if ($labels) {
                                   $labels .= ' - ';
                               }
                               $labels .= $row[$fields[$i]]->get();
                           }
                           $newLabel .= $labels;
                       }
                       if ($newLabel) {
                           $this->_labelFilters[$newfield]['value'] = $newLabel;
                       }
                       #echo $newLabel;die;
                   }
               }
           }
           return $where;
       }

       /**
        *
        * @return ZendT_Db_Recordset
        */
       protected function _getRecordset() {
           set_time_limit(3600);
           $order = array();
           $order['column'] = $this->_options['advanced']['order_column'];
           $order['type'] = $this->_options['advanced']['order_type'];
           ///$this->_columnsTotal
           $columnsTitle = array();
           $data = $this->_mapper->recordsetGroup($this->getWhere(), $this->_columnsGroup, $this->_columnsTotal, $order, $this->_columnsPivot, $this->_columns, $columnsTitle);

           if (count($this->_columnsPivot) > 0) {
               $border = '';
               foreach ($this->_columnsPivot as $prop) {
                   $border = $prop['border'];
               }

               $this->_columnsTitle = array();
               foreach ($this->_columnsGroup as $name) {
                   $prop['label'] = '';
                   $prop['width'] = $this->_columns[$name]['width'];
                   $prop['border'] = $border;
                   $this->_columnsTitle[$name] = $prop;
               }
               if (count($this->_columnsTotal) > 0) {
                   foreach ($this->_columnsTotal as $key => $val) {
                       foreach ($this->_columns as $column => &$prop) {
                           if ($prop['column'] == $key) {
                               $width += $prop['width'];
                               $prop['label'] = $prop['label_original'];
                           }
                       }
                   }
                   if ($width) {
                       $columnsTitle['titulo_total'] = array('label' => 'Total', 'colspan' => count($this->_columnsTotal), 'width' => $width, 'border' => $border);
                       //$this->_columns['titulo_total']['border'] = '0.2 0 0 0';
                   }
               }

               foreach ($columnsTitle as $name => $column) {
                   $this->_columnsTitle[$name] = $column;
               }
           }

           /* echo '<pre>';
             print_r($this->_columnsPivot);
             print_r($this->_columnsTotal);
             print_r($this->_columnsTitle);
             echo '</pre>';
             exit; */

           return $data;
       }

       /**
        * Retorna os parÃ¢metros de requisiÃ§Ã£o
        * 
        * @return array
        */
       public function getParams() {
           return $this->_params;
       }

       /**
        * Gera o relatório para um arquivo
        * 
        * @return \ZendT_File 
        */
       public function renderFile($name = '') {
           $content = parent::render();

           $title = $this->_options['title'];
           if (!$name) {
               $name = $title;
           }
           $name = strtolower(str_replace(array(' ', '/'), '-', utf8_decode($name)));
           $driver = strtolower($this->_options['driver']);

           $file = new ZendT_File($name . '.' . $driver, $content, 'application/' . strtolower($driver));
           return $file;
       }

       /**
        *
        * @return string 
        */
       public function render($type = '') {
           $content = parent::render();
           if ($type == 'PDF') {
               return $content;
           }

           $title = $this->_options['title'];
           $name = strtolower(str_replace(array(' '), array('-'), utf8_decode($title)));
           $nameIframe = strtolower('ifr' . clearAccent($name));

           $driver = strtolower($this->_options['driver']);
           $download = Zend_Controller_Front::getInstance()->getRequest()->getParam('download');
           $iframeDownload = Zend_Controller_Front::getInstance()->getRequest()->getParam('iframeDownload');
           $iframeHeight = Zend_Controller_Front::getInstance()->getRequest()->getParam('iframeHeight');

           $file = new ZendT_File($name . '.' . $driver, $content, 'application/' . strtolower($driver));
           $fileUri = $file->toArrayJson();

           $cmdHtml = '';
           $src = ZendT_Url::getBaseUrl() . '/file';
           if ($driver == 'xls' || $download) {
               $src.= '/download';
               $width = 0;
               $height = 0;
               if (!$iframeDownload) {
                   $cmdHtml.= '<div class="ui-widget ui-state-default ui-corner-all" style="height:30px;padding:5px;">' . "\n";
                   $cmdHtml.= '    <span style="float:left;" class="ui-icon ui-icon-arrowstop-1-s"></span>' . "\n";
                   $cmdHtml.= '    <span style="float:left;"><a href="javascript:javascript:downloadReport();">Se o download não iniciar automaticamente clique aqui.</a></span>' . "\n";
                   $cmdHtml.= '    <span style="clear:both"></span>' . "\n";
                   $cmdHtml.= '</div>' . "\n";
               }
           } else if ($driver == 'html') {
               return $content;
           } else {
               $src.= '/pdf';
               $width = '100%';
               $height = '520';

               if (isset($this->_options['width'])) {
                   $width = $this->_options['width'];
               }

               if (isset($this->_options['height'])) {
                   $height = $this->_options['height'];
               }
           }
           $src.= '?filename=' . $fileUri['filename'];
           $src.= '&type=' . $fileUri['type'];
           $src.= '&name=' . $fileUri['name'];
           $src.= '#zoom=120';

           $cmdHtml.= '<iframe';
           $cmdHtml.= ' id="' . $nameIframe . '"';
           $cmdHtml.= ' name="' . $nameIframe . '"';
           $cmdHtml.= ' src="' . $src . '"';
           $cmdHtml.= ' width="' . $width . '"';
           $cmdHtml.= ' height="100%"';
           $cmdHtml.= ' style="min-height:' . $height . 'px"';
           $cmdHtml.= ' border="0"';
           $cmdHtml.= ' frameborder="0"';
           $cmdHtml.= ' align="center"';
           $cmdHtml.= ' noresize="noresize"';
           $cmdHtml.= ' scrolling="yes"';
           if ($iframeDownload) {
               $cmdHtml.= ' onload="history.go(-1);"';
           }
           $cmdHtml.= '></iframe>';
           $cmdHtml.= '<script>function downloadReport(){this.' . $nameIframe . '.location = \'' . $src . '\'; }</script>';

           return $cmdHtml;
       }

   }

?>