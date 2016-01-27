<?php

   /**
    * Tem tem como finalidade padronizar as ações
    * que são usadas em um Crud
    *
    * @package ZendT
    * @subpackage Controler
    * @category Action
    * @author rsantos
    */
   class ZendT_Controller_ActionCrud extends ZendT_Controller_Action {

       /**
        * Nome do objeto de formulário para pesquisa
        *
        * @var ZendT_Form
        */
       protected $_formSearch;

       /**
        * Nome do objeto de formulário para inclusão e alteração
        *
        * @var ZendT_Form
        */
       protected $_form;

       /**
        * Objeto de listagem dos dados
        *
        * @var ZendT_Grid
        */
       protected $_grid;

       /**
        * Nome da classe de Serviço
        *
        * @var string
        */
       protected $_serviceName;

       /**
        * Nome da classe de formulário
        *
        * @var string
        */
       protected $_formName;

       /**
        * Nome da classe de formulário de pesquisa
        *
        * @var string
        */
       protected $_formSearchName;

       /**
        *
        * @var array
        */
       protected $_subtotal;

       /**
        * 
        */
       protected function _configFormToolbar($form, $buttons) {
           $formName = get_class($form);
           $profile = ZendT_Profile::get($formName, 'F');
           /**
            * Utiliza o profile cadastrado, do contrário utiliza o Form Default
            */
           if ($profile) {
               $form->loadProfile($profile);
           }

           $cmdProfile = '';
           $listProfile = ZendT_Profile::listProfile($formName, 'F');
           $_profile = new ZendT_View_Profile('selProfile', $profile['id'], $listProfile, 'F', $formName);
           $cmdProfile = $_profile->render();

           $buttons = $this->_createButtons($buttons);
           $buttons['buttons'] = $buttons['buttons'] . $cmdProfile;
           $this->view->buttons = $buttons;
       }

       /**
        * Ação :: Formulário de Inclusão e Alteração
        */
       public function formAction() {
           $this->_form = new $this->_formName();

           $module = $this->getRequest()->getModuleName();
           $controller = $this->getRequest()->getControllerName();
           $params = $this->getRequest()->getParams();
           $action = $params['action_form'];
           if ($params['typeModal'] == 'AJAX') {
               Zend_Layout::getMvcInstance()->setLayout('ajax');
           } else if ($params['typeModal'] == 'IFRAME') {
               Zend_Layout::getMvcInstance()->setLayout('iframe');
           } else if ($params['typeModal'] == 'WINDOW') {
               Zend_Layout::getMvcInstance()->setLayout('window');
           }

           $this->view->onLoad = stripslashes(urldecode($params['afterLoad']));
           if (substr($this->view->onLoad, 0, 7) == 'base64:') {
               $this->view->onLoad = base64_decode(substr($this->view->onLoad, 7));
           }

           $event = 'insert';
           $actionForm = Zend_Controller_Front::getInstance()->getRequest()->getParam('action_form');
           if ($actionForm) {
               $event = $actionForm;
           }

           $_buttons = array();
           $first = true;
           if (count($params['buttons']) > 0) {
               foreach ($params['buttons'] as $caption => $button) {
                   $_button = array();
                   $_button['caption'] = $caption;
                   $_button['icon'] = $button['icon'];
                   $_button['onClick'] = $button['onClick'];
                   if ($first) {
                       $first = false;
                       $_button['class'] = 'btn primary';
                   }
                   $_buttons[] = $_button;
               }
           }
           $this->getForm()->loadElements($event);

           $profile = ZendT_Profile::get($this->_formName, 'F');
           /**
            * Utiliza o profile cadastrado, do contrário utiliza o Form Default
            */
           if ($profile) {
               $this->getForm()->loadProfile($profile);
           }

           $listProfile = ZendT_Profile::listProfile($this->_formName, 'F');
           $_profile = new ZendT_View_Profile('selProfile', $profile['id'], $listProfile, 'F', $this->_formName);
           $screenName = $this->view->screenName;
           $this->view->profileMenu = $_profile->render($screenName);
           $this->view->screenName = $screenName;
           $this->view->placeholder('title')->set($screenName);

           /* $screenName = $_profile->render($this->view->screenName);
             $this->view->screenName = $screenName;
             $this->view->placeholder('title')->set($screenName); */

           $this->getForm()->populate($params);

           $hasAction = $this->getForm()->setAction($action);
           if (!$hasAction) {
               $action = ZendT_Url::getBaseUrl() . '/' . $module . '/' . $controller . '/' . $action;
               $this->getForm()->setAction($action);
           }


           $buttons = $this->_createButtons($_buttons);
           $this->view->buttonsLoad = $buttons['buttons'];
           $buttons['buttons'] = $buttons['buttons'];
           $this->view->buttons = $buttons;

           $this->view->grid = '';
           if ($params['grid']) {
               $configColumns = $this->_mapper->getColumns()->toArray();
               foreach ($configColumns as $column => $key) {
                   if ($key['subtotal']) {
                       $this->getGrid()->setFooterRow(true);
                       $this->getGrid()->setUserDataOnFooter(true);
                       break;
                   }
               }

               $this->getColumns();
               $this->configGrid();

               $onCellSelect = "function(){
                                    var grid  = jQuery('#" . $this->getGrid()->getID() . "');
                                    var id = grid.jqGrid('getGridParam','selrow');
                                    jQuery('#" . $this->getForm()->getName() . "').TForm('retrieve',id);
                                }";
               $this->getGrid()->setOnCellSelect($onCellSelect);

               $this->getGrid()->setObjToolbar(null);
               /* getObjToolbar()->removeButton('add');
                 $this->getGrid()->getObjToolbar()->removeButton('edit'); */
               //$this->getGrid()->getT
//                      getToolbarButton('edit')

               $this->view->grid = $this->getGrid();

               $_element = new ZendT_Form_Element_Button('btn_save');
               $_element->setLabel('Salvar');
               $_element->setIcon('ui-icon ui-icon-disk');
               $_element->setAttrib('onClick', "jQuery('#" . $this->getForm()->getName() . "').TForm('save',{grid: '#" . $this->getGrid()->getID() . "'});");
               $this->getForm()->addElement($_element);

               $_element = new ZendT_Form_Element_Button('btn_new');
               $_element->setLabel('Novo');
               $_element->setIcon('ui-icon ui-icon-document');
               $_element->setAttrib('onClick', "jQuery('#" . $this->getForm()->getName() . "').TForm('clear',{});");
               $this->getForm()->addElement($_element);

               if (ZendT_Acl::getInstance()->isAllowed('delete', $this->_resourceBase)) {
                   $_element = new ZendT_Form_Element_Button('btn_delete');
                   $_element->setLabel('Excluir');
                   $_element->setIcon('ui-icon ui-icon-trash');
                   $_element->setAttrib('onClick', "jQuery('#" . $this->getForm()->getName() . "').TForm('delete',{grid: '#" . $this->getGrid()->getID() . "'});");
                   $this->getForm()->addElement($_element);
               }

               $_element = new ZendT_Form_Element_Button('btn_next');
               $_element->setIcon('ui-icon ui-icon-seek-next');
               $_element->addStyle('float', 'right');
               $_element->addClass('ui-button-icon ui-state-default ui-group-item item last');
               $_element->setAttrib('onClick', "jQuery('#" . $this->getForm()->getName() . "').TForm('navByGrid',{grid: '#" . $this->getGrid()->getID() . "',move:'next'});");
               $this->getForm()->addElement($_element);

               $_element = new ZendT_Form_Element_Button('btn_prev');
               $_element->setIcon('ui-icon ui-icon-seek-prev');
               $_element->addStyle('float', 'right');
               $_element->addClass('ui-button-icon ui-state-default ui-group-item item first');
               $_element->setAttrib('onClick', "jQuery('#" . $this->getForm()->getName() . "').TForm('navByGrid',{grid: '#" . $this->getGrid()->getID() . "',move:'prev'});");
               $this->getForm()->addElement($_element);


               $this->getForm()->addDisplayGroup(array('btn_save', 'btn_new', 'btn_delete', 'btn_next', 'btn_prev')
                     , 'group-nav-buttons'
                     , array('id' => 'group-nav-buttons-' . $this->getForm()->getName()
                  , 'class' => 'ui-nav-form'));
           }

           $this->view->form = $this->getForm();
       }

       /**
        * Ação de Pesquisa
        */
       public function searchAction() {
           $this->_formSearch = new $this->_formSearchName();

           $params = $this->getRequest()->getParams();
           if ($params['typeModal'] == 'AJAX') {
               Zend_Layout::getMvcInstance()->setLayout('ajax');
           } else if ($params['typeModal'] == 'WINDOW') {
               Zend_Layout::getMvcInstance()->setLayout('window');
               $this->view->onLoad = stripslashes(urldecode($params['afterLoad']));
               $this->view->buttons = $this->_createButtons(
                     array(
                        'pesquisar' => $params['buttonPesquisar'],
                        'cancelar' => $params['buttonCancelar'],
                        'Limpar' => $params['buttonLimpar']
                     )
               );
           }
           $this->getFormSearch()->loadElements();
           $this->getFormSearch()->populate($params);
           $this->view->form = $this->getFormSearch()->setAction($action);
       }

       /**
        * Cria botões para window
        *
        * @param array $buttons
        * @return array
        */
       protected function _createButtons(array $buttons) {
           $retorno = array();
           foreach ($buttons as $button) {
               if ($button['onClick'] != '') {
                   $button['onClick'] = stripslashes(urldecode($button['onClick']));
                   if (substr($button['onClick'], 0, 7) == 'base64:') {
                       $button['onClick'] = base64_decode(substr($button['onClick'], 7));
                   }

                   $_button = new ZendT_View_Button('button' . str_replace(' ', '_', $button['caption']), $button['caption'], new ZendT_JS_Command($button['onClick']));
                   $_button->setIcon($button['icon']);
                   if (isset($button['class'])) {
                       $_button->addClass($button['class']);
                   }
                   //$idButton = $_button->getId();
                   $retorno['buttons'].= $_button->render();
                   $key = strtolower(substr(trim($button['caption']), 0, 1));
                   if ($key != 'c') {
                       $this->view->hotkeys()->add('key_' . $_button->getId(), 'ctrl+' . $key, "jQuery('#" . $_button->getId() . "').click();");
                   }
                   /* $retorno['functions'].= "$('#" . $idButton . "').click(" .  . ");\n"; */
               }
           }
           return $retorno;
       }

       public function logAction() {
           $id = $this->getRequest()->getParam('id');
           $tableName = $this->getModel()->getTableAlias();
           $url = '/log/log-evento/grid?isSearch=true&typeModal=WINDOW&log_objeto_nome=' . $tableName . '&id_objeto=' . $id;
           $this->_redirect($url);
       }

       /**
        *
        * @param array $colsBreaker
        * @param array $colsDetail
        * @param type $report 
        */
       function setReportHeader(array $colsBreaker, array $valBreaker, array $colsDetail, &$report, &$options) {

           foreach ($colsBreaker as $column) {

               $celula = new ZendT_Report_Cell($options['cellsTitle']);
               $celula->setTextAlign($column->getAlign())
                     ->setWidth($column->getWidth())
                     ->setValue($column->getHeaderTitle() . ': ' . $valBreaker[$column->getName()])
                     ->setStyleName('cellsTitle-' . $column->getName());

               $report->addCell($celula);
           }

           $report->printCells();
           $report->drawLine();

           foreach ($colsDetail as $column) {
               $celula = new ZendT_Report_Cell($options['cellsTitle']);
               $celula->setTextAlign($column->getAlign())
                     ->setWidth($column->getWidth())
                     ->setValue($column->getHeaderTitle())
                     ->setStyleName('cellsTitle' . $column->getName());

               $report->addCell($celula);
           }

           $report->printCells();
       }

       public function configReportProfile($type = 'pdf', $options = false, $config) {

           set_time_limit(3200);
           $columns = $this->getColumns();

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
           $empresa = 'TA';
           if (isset($dnsEmpresas[$domain])) {
               $empresa = $dnsEmpresas[$domain];
           }

           $nameReport = $config['title'];
           $nameReport = removeAccent($nameReport);
           $nameReport = trim(str_replace(' ', '-', $nameReport));

           $default = array(
              'title' => array(
                 'fontSize' => 10,
                 'bold' => true,
                 'width' => 160,
                 'align' => 'center',
                 'value' => utf8_decode($config['title'])), //utf8_decode($this->_translate->_($moduleName . '.' . $controllerName . '.grid'))),
              'default' => array(
                 'fontSize' => 7,
                 'bold' => false,
                 'fontName' => 'Arial',
              ),
              'cellsTitle' => array(
                 'fontSize' => 7,
                 'bold' => true,
                 'align' => 'center'),
              'empresa' => $empresa,
              'maxPerLine' => 4,
              'orientation' => 'P'
           );

           if (is_array($options)) {
               $options = ZendT_Functions::array_merge_recursive_distinct($default, $options);
           } else {
               $options = $default;
           }

           if (is_array($options['title'])) {
               $options['title'] = new ZendT_Report_Cell($options['title']);
               $options['title']->setStyleName('title');
           }

           if (is_array($options['footer'])) {
               $options['footer'] = new ZendT_Report_Cell($options['footer']);
               $options['footer']->setStyleName('footer');
           }
           /**
            * Tratamento para buscar os dados no banco de dados
            */
           $logReport = new ZendT_Log_Report($mapperView, $config['title']);

           $medida = array();

           $cols = $config['cols-detail']['fields'];
           $filters = $config['cols-filter']['fields'];

           foreach ($columns as $column) {
               $name = $column->getName();
               if (isset($cols[$name])) {
                   if ($cols[$name]['align']) {
                       $column->setAlign($cols[$name]['align']);
                   }
                   if ($cols[$name]['label']) {
                       $column->setLabel($cols[$name]['label']);
                   }
                   if ($cols[$name]['width']) {
                       $column->setWidth($cols[$name]['width']);
                   }
               }
           }

           /**
            * Recupera todas as sumarizações e quebras de processo para os breakers informados
            */
           foreach ($config['cols-break']['fields'] as $colBreak => $configBreak) {
               if ($config['break-header-' . $colBreak]) {
                   $break['header'][$colBreak] = $config['break-header-' . $colBreak]['fields'];
               }
               if ($config['break-measure-' . $colBreak]) {
                   $break['measure'][$colBreak] = $config['break-measure-' . $colBreak]['fields'];
               }
           }

           /**
            * Monta o Filtro com Base no Profile
            */
           $postData = $this->getRequest()->getParams();
           $postData['page'] = false;
           $postData['count'] = false;

           if ($filters) {
               $this->getRequest()->setParam('_search', 'true');
               $postData = $this->getRequest()->getParams();

               /**
                * @todo Enviar o nome correto das colunas para o formulário, desde que o formulário aceite pontuações na nomenclatura das colunas
                */
               foreach ($columns as $column) {
                   if ($postData[$column->getName()]) {
                       $field = str_replace('.', '-', $column->getIndex());
                       $value = $postData[$column->getName()];
                       $this->getRequest()->setParam($field, $value);
                       unset($postData[$column->getName()]);
                   }
               }
           }

           $whereGroup = $this->getWherePostData();

           if ($this->_mapper instanceof ZendT_Db_View) {
               $dataGrid = $this->getMapper()->getDataGrid($whereGroup, $postData);
           } else {
               $dataGrid = $this->getModel()->getDataGrid($whereGroup, $postData);
           }

           /**
            * Instancia do objeto de relatório
            */
           $report = ZendT_Report::factory($type, $options);
           $report->addPage();

           /**
            * Recupera a estrutura do GRID
            */
           $row = $dataGrid->getRow();
           $logReport->finishDb();

           if (!$row) {
               throw new ZendT_Exception_Alert('Dados não encontrados!');
           }

           /**
            * Recupera o valor de Quebra inicial
            */
           $breaker = array();
           foreach ($row as $alias => $val) {
               if (in_array($alias, array_keys($break['header']))) {
                   $breaker[$alias] = $row[$alias]->toPhp();
               }
           }

           $keysBreaker = array_keys($breaker);

           /**
            * Configuração da coluna de título
            */
           $celulas = array();
           /**
            * Colunas Breaker
            */
           $colsBreaker = array();

           foreach ($columns as $column) {
               $key = $column->getName();
               if (in_array($key, $keysBreaker)) {
                   $colsBreaker[] = $column;
               }
           }

           /**
            * Colunas Detalhes
            */
           $colsDetail = array();
           $celulas = array();

           foreach ($columns as $column) {

               if (!$column->getHidden()) {
                   $key = $column->getName();
                   if (!in_array($key, array_keys($cols))) {
                       $column->setHidden(true);
                       continue;
                   } else {
                       $column->setHeaderTitle($cols[$key]['label']);
                   }
                   $colsDetail[] = $column;
               }
           }

           /**
            * Impressão dos registros detalhe
            */
           $callStylesRow = method_exists($this->getMapper(), 'getStylesRow');
           $celulas = array();

           /**
            * Preenche as células com os valores da consulta
            */
           $this->setReportHeader($colsBreaker, $breaker, $colsDetail, $report, $options);

           $numRows = 0;
           do {
               $stylesRow = array();

               if ($callStylesRow) {
                   $stylesRow = $this->getMapper()->getStylesRow($row);
               }

               foreach ($keysBreaker as $alias) {

                   if ($breaker[$alias] != $row[$alias]->toPhp()) {
                       /**
                        *  Imprimir Sumarizações
                        */
                       foreach ($columns as $column) {

                           if ($column->getHidden()) {
                               continue;
                           }

                           $key = $column->getName();

                           if (!isset($cell[$key])) {
                               $cell[$key] = new ZendT_Report_Cell($options['cellsTitle']);
                               $cell[$key]->setTextAlign($column->getAlign())
                                     ->setWidth($column->getWidth())
                                     ->setType($row[$alias]->getType())
                                     ->setStyleName('cellsTitle-' . $key);
                           }

                           if (isset($medida[$alias][$key]['value'])) {
                               $value = number_format($medida[$alias][$key]['value'], 2, ',', '.');
                               $cell[$key]->setValue($value);
                           } else {
                               $cell[$key]->setValue('');
                           }

                           $report->addCell($cell[$key]);
                           $medida[$alias][$key]['value'] = '';
                           $medida[$alias][$key]['sum'] = 0;
                           $medida[$alias][$key]['count'] = 0;
                       }

                       /**
                        * Atualiza o Breaker atual
                        */
                       $breaker[$alias] = $row[$alias]->toPhp();

                       /**
                        * Renderiza os dados
                        */
                       $report->drawLine();
                       $report->printCells();
                       $report->ln();

                       $this->setReportHeader($colsBreaker, $breaker, $colsDetail, $report, $options);
                   }
               }

               foreach ($columns as $column) {

                   if (!$column->getHidden()) {

                       $key = $column->getName();
                       $cellOptions = $column->getOptions();

                       /**
                        * Sumarizações
                        */
                       foreach ($keysBreaker as $alias) {
                           if ($break['measure'][$alias][$key] != '') {
                               if ($break['measure'][$alias][$key]['tipo'] == 'count') {
                                   $medida[$alias][$key]['value'] += 1;
                               }
                               if ($break['measure'][$alias][$key]['tipo'] == 'sum') {
                                   $medida[$alias][$key]['value'] += $row[strtolower($key)]->toPhp();
                               }
                               if ($break['measure'][$alias][$key]['tipo'] == 'avg') {
                                   $medida[$alias][$key]['sum'] += $row[strtolower($key)]->toPhp();
                                   $medida[$alias][$key]['count'] += 1;
                                   $medida[$alias][$key]['value'] = $medida[$alias][$key]['sum'] / $medida[$alias][$key]['count'];
                               }
                           }
                       }

                       if ($dataGrid->getType()) {
                           $value = $row[strtolower($key)];
                           $type = $value->getType();
                           if (isset($cellOptions['expandTree'])) {
                               $newValue = $value->get();
                               $newValue = str_repeat(' ', $row['tree_level']->toPhp() * 4) . $newValue;
                               $value->set($newValue);
                           }
                       } elseif ($dataGrid->isRowFormated()) {
                           $value = $row[strtolower($key)];
                           $type = $column->getSorttype();
                       } else {
                           $value = $column->format($row[strtolower($key)]);
                           $type = $column->getSorttype();
                       }

                       $celName = $key;
                       if (isset($stylesRow[$key])) {
                           if (!$stylesRow[$key]['suffix']) {
                               $stylesRow[$key]['suffix'] = 'plus';
                           }
                           $celName.= '-' . $stylesRow[$key]['suffix'];
                       }

                       if (!isset($celulas[$celName])) {
                           $celulas[$celName] = new ZendT_Report_Cell($options['default']);
                           $celulas[$celName]->setTextAlign($column->getAlign())
                                 ->setWidth($column->getWidth())
                                 ->setType($type);
                           $celulas[$celName]->setStyleName('default-' . $celName);
                           if (isset($stylesRow[$key])) {
                               $celulas[$celName]->setStyles($stylesRow[$key]);
                           }
                       }
                       $celulas[$celName]->setValue($value);
                       $report->addCell($celulas[$celName]);
                   }
               }
               $report->printCells();
               $numRows++;
           } while ($row = $dataGrid->getRow());

           /**
            * @author marquesini
            * @todo Renderizar apenas se o último breaker não foi sumarizado
            */
           foreach ($keysBreaker as $alias) {
               /**
                *  Imprimir Sumarizações
                */
               foreach ($columns as $column) {
                   if ($column->getHidden()) {
                       continue;
                   }
                   $key = $column->getName();
                   if (isset($cell[$key])) {
                       if ($medida[$alias][$key]['value'] != '') {
                           $value = number_format($medida[$alias][$key]['value'], 2, ',', '.');
                           $cell[$key]->setValue($value);
                       } else {
                           $cell[$key]->setValue('');
                       }
                       $report->addCell($cell[$key]);
                   }
               }

               /**
                * Renderiza os dados
                */
               $report->drawLine();
               $report->printCells();
               $report->ln();
           }

           $report->printCells();
           $logReport->finish($numRows);
           /**
            * Impressão/Saída do relatório
            */
           return array('name' => $nameReport,
              'content' => $report->output($nameReport, 'S'));
       }

       public function configReportSample($type = 'pdf', $options = false) {
           set_time_limit(3200);

           $moduleName = $this->getRequest()->getModuleName();
           $controllerName = $this->getRequest()->getControllerName();
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
           $empresa = 'TA';
           if (isset($dnsEmpresas[$domain])) {
               $empresa = $dnsEmpresas[$domain];
           }
           $default = array(
              'title' => array(
                 'fontSize' => 10,
                 'bold' => true,
                 'width' => 160,
                 'align' => 'center',
                 'value' => utf8_decode($this->_translate->_($moduleName . '.' . $controllerName . '.grid'))),
              'default' => array(
                 'fontSize' => 8,
                 'bold' => false,
                 'fontName' => 'Arial',
              ),
              'cellsTitle' => array(
                 'fontSize' => 8,
                 'bold' => true,
                 'align' => 'center'),
              'empresa' => $empresa,
              'maxPerLine' => 4,
              'orientation' => 'P'
           );

           if (is_array($options)) {
               $options = ZendT_Functions::array_merge_recursive_distinct($default, $options);
           } else {
               $options = $default;
           }

           $title = $this->_translate->_($moduleName . '.' . $controllerName . '.grid');

           if (is_array($options['title'])) {
               $options['title'] = new ZendT_Report_Cell($options['title']);
               $options['title']->setStyleName('title');
           }

           if (is_array($options['footer'])) {
               $options['footer'] = new ZendT_Report_Cell($options['footer']);
               $options['footer']->setStyleName('footer');
           }
           /**
            * Tratamento para buscar os dados no banco de dados
            */
           $postData = $this->getRequest()->getParams();
           $postData['page'] = false;
           $postData['count'] = false;
           $whereGroup = $this->getWherePostData();

           $mapperView = get_class($this->_mapper);
           $logReport = new ZendT_Log_Report($mapperView, $title);
           if ($this->_mapper instanceof ZendT_Db_View) {
               $dataGrid = $this->getMapper()->getDataGrid($whereGroup, $postData);
           } else {
               $dataGrid = $this->getModel()->getDataGrid($whereGroup, $postData);
           }
           $logReport->finishDb();
           /**
            * Instancia do objeto de relat�rio
            */
           $report = ZendT_Report::factory($type, $options);
           $report->addPage();
           /**
            * Configuração da coluna de título
            */
           $celulas = array();
           foreach ($this->getColumns() as $column) {
               if (!$column->getHidden()) {
                   $key = $column->getName();
                   $celulas[$key] = new ZendT_Report_Cell($options['cellsTitle']);
                   $celulas[$key]->setTextAlign($column->getAlign())
                         ->setWidth($column->getWidth())
                         ->setValue($column->getHeaderTitle());
                   $celulas[$key]->setStyleName('cellsTitle-' . $key);
                   $report->addCell($celulas[$key]);
               }
           }
           $report->printCells();
           /**
            * Impressão dos registros detalhe
            */
           $callStylesRow = method_exists($this->getMapper(), 'getStylesRow');
           $celulas = array();
           $numRows = 0;
           while ($row = $dataGrid->getRow()) {

               $stylesRow = array();
               if ($callStylesRow) {
                   $stylesRow = $this->getMapper()->getStylesRow($row);
               }

               foreach ($this->getColumns() as $column) {
                   if (!$column->getHidden()) {
                       $key = $column->getName();
                       $cellOptions = $column->getOptions();

                       if ($dataGrid->getType()) {
                           $value = $row[strtolower($key)];
                           $type = $value->getType();
                           if (isset($cellOptions['expandTree'])) {
                               $newValue = $value->get();
                               $newValue = str_repeat(' ', $row['tree_level']->toPhp() * 4) . $newValue;
                               $value->set($newValue);
                           }
                       } elseif ($dataGrid->isRowFormated()) {
                           $value = $row[strtolower($key)];
                           $type = $column->getSorttype();
                       } else {
                           $value = $column->format($row[strtolower($key)]);
                           $type = $column->getSorttype();
                       }

                       $celName = $key;
                       if (isset($stylesRow[$key])) {
                           if (!$stylesRow[$key]['suffix']) {
                               $stylesRow[$key]['suffix'] = 'plus';
                           }
                           $celName.= '-' . $stylesRow[$key]['suffix'];
                       }

                       if (!isset($celulas[$celName])) {
                           $celulas[$celName] = new ZendT_Report_Cell($options['default']);
                           $celulas[$celName]->setTextAlign($column->getAlign())
                                 ->setWidth($column->getWidth())
                                 ->setType($type);
                           $celulas[$celName]->setStyleName('default-' . $celName);
                           if (isset($stylesRow[$key])) {
                               $celulas[$celName]->setStyles($stylesRow[$key]);
                           }
                       }
                       $celulas[$celName]->setValue($value);
                       $report->addCell($celulas[$celName]);
                   }
               }
               $report->printCells();
               $numRows++;
           }
           /**
            * Impressão/Saída do relatório
            */
           $result = array('name' => str_replace(' ', '-', $title),
              'content' => $report->output(ZendT_Lib::getTableDesc(), 'S'));
           $logReport->finish($numRows);

           return $result;
       }

       /**
        * Aplica as configurações e gera o relatório
        *
        * @param string $type
        * @param array $options
        */
       public function configReport($type = 'pdf', $options = false) {
           set_time_limit(3200);
           $objectName = get_class($this->_mapper);
           if (ZendT_Acl::getInstance()->isAllowed('object-view', 'profile')) {
               $profile = ZendT_Profile::get($objectName, (($type == 'pdf') ? 'P' : 'X'));
               if ($profile) {
                   $result = $this->configReportProfile($type, $options, $profile);
               } else {
                   $result = $this->configReportSample($type, $options);
               }
           } else {
               $result = $this->configReportSample($type, $options);
           }
           return $result;
       }

       /**
        * Ação para exportar os dados do grid para PDF
        */
       public function pdfAction() {

           try {
               Zend_Layout::getMvcInstance()->setLayout('pdf');
               $result = $this->configReport('pdf');
               $this->view->placeholder('name')->set($result['name'] . '.pdf');
               $this->view->content = $result['content'];
           } catch (ZendT_Exception $ex) {
               Zend_Layout::getMvcInstance()->setLayout('window');
               $this->view->content = $this->view->exception($ex);
           }
           $this->renderScript('/index/render.phtml');
       }

       /**
        * Ação para exportar os dados do grid para XLS
        */
       public function xlsAction() {
           $this->_helper->layout->disableLayout();
           $this->_helper->viewRenderer->setNoRender(true);

           $json = new ZendT_Json_Result();
           try {
               $result = $this->configReport('xls');
               $file = new ZendT_File($result['name'] . '.xls', $result['content'], 'application/vnd.ms-excel');
               $json->setResult($file->toArrayJson());
           } catch (ZendT_Exception $ex) {
               $json->setException($ex);
           }
           echo $json->render();
       }

       protected function _prepareParam(&$param) {
           
       }

       protected function _dynamicInsertUpdateDelete($id) {
           $param = $this->getRequest()->getParams();
           if ($data instanceof ZendT_Type) {
               $id = $id->toPhp();
           }
           $param['id'] = $id;
           foreach ($param as $key => $values) {
               $arrayData = array();
               if (is_array($values) && isset($values['mapper']) && isset($values['column'])) {
                   #var_dump($values);die;
                   $arrayData[$key] = array();
                   $arrayData[$key]['mapper'] = $values['mapper'];
                   $arrayData[$key]['column'] = $values['column'];
                   $count = count($values['id']);
                   for ($i = 0; $i < $count; $i ++) {
                       $arrayData[$key][$i] = array();
                       foreach ($values as $key1 => $values1) {
                           if (is_array($values1) && count($values[$key1])) {
                               $arrayData[$key][$i][$key1] = $values1[$i];
                               unset($values[$key1][$i]);
                           }
                       }
                       if (!count($arrayData[$key][$i])) {
                           unset($arrayData[$key][$i]);
                       }
                   }
                   unset($param[$key]);
               }
               if (count($arrayData)) {
                   $this->_prepareParam($arrayData[$key]);
                   #var_dump($arrayData);die;
                   foreach ($arrayData as $key => $values) {
                       $mapper = new $values['mapper']();
                       $columns = explode("-", $values['column']);
                       unset($values['mapper']);
                       unset($values['column']);

                       $updates = array();
                       $inserts = array();
                       $updatesValues = array();
                       $filterValues = array();
                       foreach ($columns as $column) {
                           if (count($columns) == 1) {
                               $filterValues[$column] = $param['id'];
                           } else {
                               $filterValues[$column] = $param[$column];
                           }
                       }
                       foreach ($values as $key1 => $newValues) {
                           foreach ($filterValues as $key => $filter) {
                               $newValues[$key] = $filterValues[$key];
                           }
                           $mapper->newRow()->populate($newValues);
                           if (!$newValues['id']) {
                               $inserts[] = clone $mapper;
                           } else if ($mapper->exists()) {
                               $updatesValues[] = $newValues;
                               $updates[] = clone $mapper->retrieve();
                           }
                       }
                       $mapper->newRow()->populate($filterValues)->findAll(null, '*');
                       $deletes = array();
                       while ($mapper->fetch()) {
                           $exists = false;
                           foreach ($updates as $update) {
                               if (!count(array_diff($mapper->getData(), $update->getData()))) {
                                   $exists = true;
                                   break;
                               }
                           }
                           if (!$exists) {
                               $deletes[] = clone $mapper;
                           }
                       }
                       foreach ($updates as $index => $update) {
                           $update->populate($updatesValues[$index])->update();
                       }
                       foreach ($deletes as $delete) {
                           $delete->delete();
                       }
                       foreach ($inserts as $insert) {
                           $insert->insert();
                       }
                       /* var_dump(array("inserts" => count($inserts)), array("updates" => count($updates)), array("deletes" => count($deletes)));
                         die; */
                   }
               }
           }
           #$this->getRequest()->setParams($param);
       }

       public function saveAction() {
           $id = $this->getRequest()->getParam('id');

           $this->_helper->layout->disableLayout();
           $this->_helper->viewRenderer->setNoRender(true);

           $json = new ZendT_Json_Result();
           try {
               if ($id) {
                   if (ZendT_Acl::getInstance()->isAllowed('update', $this->_resourceBase)) {
                       $this->updateAction();
                   } else {
                       throw new ZendT_Exception_Alert('Acesso não autorizado para realizar alteração!');
                   }
               } else {
                   if (ZendT_Acl::getInstance()->isAllowed('insert', $this->_resourceBase)) {
                       $this->updateAction();
                   } else {
                       throw new ZendT_Exception_Alert('Acesso não autorizado para realizar inclusão!');
                   }
               }
           } catch (Exception $Ex) {
               $json->setException($Ex);
               echo $json->render();
           }
       }

       /**
        * Ação para inclusão de um novo registro
        */
       public function insertAction() {
           $this->_helper->layout->disableLayout();
           $this->_helper->viewRenderer->setNoRender(true);
           $db = $this->getModel()->getAdapter();
           $db->beginTransaction();

           $isJson = $this->getRequest()->getParam('json');

           $json = new ZendT_Json_Result();
           try {
               $param = $this->getRequest()->getParams();
               //$param = $this->appendFiles($param);
               $this->getMapper()->populate($param);
               #$this->getMapper()->valid(); # valida se os campos obrigatórios foram todos preenchidos
               $data = $this->getMapper()->insert();
               if (!isset($data['id']) && $data['id'] instanceof ZendT_Type) {
                   $data = $data['id'];
               }
               if ($data instanceof ZendT_Type) {
                   if ($isJson) {
                       $json->setResult(array('id' => $data->toPhp()));
                   } else {
                       $json->setResult($data->toPhp());
                   }
               } else {
                   if ($isJson) {
                       $json->setResult($data);
                   } else {
                       $json->setResult(true);
                   }
               }
               $this->_dynamicInsertUpdateDelete($data);
               $db->commit();
               $this->getMapper()->afterCommit();
           } catch (Exception $Ex) {
               $json->setException($Ex);
               $db->rollBack();
           }
           echo $json->render();
       }

       /**
        * Ação para alterar um registro
        */
       public function updateAction() {
           $this->_helper->layout->disableLayout();
           $this->_helper->viewRenderer->setNoRender(true);
           $db = $this->getModel()->getAdapter();
           $db->beginTransaction();

           $isJson = $this->getRequest()->getParam('json');

           $json = new ZendT_Json_Result();
           try {
               $param = $this->getRequest()->getParams();
               $param = $this->appendFiles($param);
               $this->getMapper()->populate($param);
               $data = $this->getMapper()->update();
               if (isset($data['id']) && $data['id'] instanceof ZendT_Type) {
                   $data = $data['id'];
               }
               $this->_dynamicInsertUpdateDelete($data);
               $db->commit();
               $this->getMapper()->afterCommit();
               if ($data instanceof ZendT_Type) {
                   if ($isJson) {
                       $json->setResult(array('id' => $data->toPhp()));
                   } else {
                       $json->setResult($data->toPhp());
                   }
               } else {
                   if ($isJson) {
                       $json->setResult($data);
                   } else {
                       $json->setResult(true);
                   }
               }
           } catch (Exception $Ex) {
               $json->setException($Ex);
               $db->rollBack();
           }
           $result = $json->render();
           echo $result;
       }

       /**
        * Ação para apagar um registro
        */
       public function deleteAction() {
           $this->_helper->layout->disableLayout();
           $this->_helper->viewRenderer->setNoRender(true);
           $db = $this->getModel()->getAdapter();
           $db->beginTransaction();

           $json = new ZendT_Json_Result();
           try {
               $param = $this->getRequest()->getParams();
               if (strpos($param['id'], ',') === false) {
                   $this->getMapper()->populate($param);
                   $this->getMapper()->delete();
               } else {
                   $ids = explode(',', $param['id']);
                   foreach ($ids as $id) {
                       $this->getMapper()->setId($id);
                       $this->getMapper()->delete();
                   }
               }
               $json->setResult(true);
               $db->commit();
               $this->getMapper()->afterCommit();
           } catch (Exception $Ex) {
               $json->setException($Ex);
               $db->rollBack();
           }
           echo $json->render();
       }

       /**
        * Retorna o formulário de pesquisa
        *
        * @return Zend_Form
        */
       public function getFormSearch() {
           return $this->_formSearch;
       }

       /**
        * Configura o formulário de pesquisa
        *
        * @return ZendT_Controller_ActionCrud
        */
       public function setFormSearch($formSearch) {
           $this->_formSearch = $formSearch;
           return $this;
       }

       /**
        * Retorna o formulário de inclusão e alteração
        *
        * @return Zend_Form
        */
       public function getForm() {
           return $this->_form;
       }

       /**
        * Configura o formulário de inclusão e alteração
        *
        * @return ZendT_Controller_ActionCrud
        */
       public function setForm($form) {
           $this->_form = $form;
           return $this;
       }

       /**
        * Retorna o objeto de Grid
        *
        * @return ZendT_Grid
        */
       public function getGrid() {
           return $this->_grid;
       }

       /**
        * Configura o objeto de Grid
        *
        * @param ZendT_Grid $grid
        * @return \ZendT_Controller_ActionCrud
        */
       public function setGrid(ZendT_Grid $grid) {
           $this->_grid = $grid;
           return $this;
       }

       public function appendHotKeys($name, $keys, $functionJs) {
           $appendFunction = $this->view->placeholder('hotKeys')->getValue();
           $appendFunction[$name] = $command;
           $this->view->placeholder('hotKeys')->set($appendFunction);
       }

       public function appendFiles(&$param = array()) {
           if (count($_FILES) > 0) {
               foreach ($_FILES as $key => $file) {
                   if ($file['tmp_name'] != '') {
                       $param[$key] = $file['tmp_name'];
                   }
               }
           }
           return $param;
       }

       protected function _quote() {
           $this->_disableRender();
           $fields = $this->getRequest()->getParam('fields');
           $values = $this->getRequest()->getParam('values');
           $mapper = $this->getRequest()->getParam('mapper');
           /**
            * @var Automacao_DataView_RegraAltoValor_MapperView
            */
           $_mapper = new $mapper();

           $columns = $_mapper->getColumns()->toArray();
           $_json = new ZendT_Json_Result();
           try {
               $result = array();
               $result['values'] = array();

               foreach ($fields as $index => $field) {
                   if (stripos($values[$index], 'SELECT') !== false) {
                       $result['values'][$index] = $values[$index];
                   } else {
                       $data = explode(';', $values[$index]);
                       $parseValue = '';
                       $column = $columns[strtolower($field)];
                       foreach ($data as $value) {
                           $column['mapperName']->set($value);
                           $value = $column['mapperName']->getValueToDb();
                           $value = $_mapper->getAdapter()->quote($value);
                           $parseValue.= ',' . $value;
                       }
                       $result['values'][$index] = substr($parseValue, 1);
                   }
               }
               $_json->setResult($result);
           } catch (Exception $ex) {
               $_json->setException($ex);
           }
           echo $_json->render();
       }

   }

?>