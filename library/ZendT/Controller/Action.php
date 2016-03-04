<?php

    /**
     * Tem tem como finalidade padronizar as ações
     * que são usadas na Plataforma ZendT
     *      
     * @package ZendT
     * @subpackage Controler
     * @category Action
     * @author rsantos
     */
    class ZendT_Controller_Action extends Zend_Controller_Action {

        const LAYOUT_DEFAULT = 'default';
        const LAYOUT_AJAX = 'ajax';
        const LAYOUT_IFRAME = 'iframe';
        const LAYOUT_PDF = 'pdf';
        const LAYOUT_INTRANET = 'intranet';
        const LAYOUT_WINDOW = 'window';

        /**
         *
         * @var string
         */
        protected $_resourceBase = null;

        /**
         *
         * @var Zend_Translate 
         */
        protected $_translate = null;

        /**
         *
         * @var ZendT_Hotkeys
         */
        protected $_hotkeys;

        /**
         * Nome do objeto de mapeamento das colunas e tabela no DB
         *
         * @var ZendT_Db_Mapper
         */
        protected $_mapper;

        /**
         * 
         */
        public function _init() {
            $moduleName = $this->getRequest()->getModuleName();
            $controllerName = $this->getRequest()->getControllerName();
            $actionName = $this->getRequest()->getActionName();

            $portalName = $this->getTranslate()->_('portalName');
            $moduleNameTrans = $this->getTranslate()->_('moduleName');
            $screenName = $this->getTranslate()->_($moduleName . '.' . $controllerName . '.' . $actionName);

            $this->view->headTitle($portalName . ' - ' . $moduleNameTrans . ' - ' . $screenName);
            $this->view->placeholder('application')->set($moduleNameTrans);
            $this->view->placeholder('title')->set($screenName);

            $this->view->screenName = $screenName;
            $this->view->baseUrl = ZendT_Url::getBaseUrl();
        }

        public function setLayout($layout) {
            Zend_Layout::getMvcInstance()->setLayout($layout);
        }

        /**
         * Retorna o objeto de tradução dos dados
         * 
         * @return Zend_Translate 
         */
        public function getTranslate() {
            if ($this->_translate == null) {
                $moduleName = $this->getRequest()->getModuleName();
                $this->_translate = Zend_Registry::get('translate_' . $moduleName);
            }
            return $this->_translate;
        }

        /**
         * Retona o objeto de Mapeamento
         *
         * @return ZendT_Db_Mapper
         */
        public function getMapper() {
            if (!is_object($this->_mapper)) {
                if ($this->_mapper != '') {
                    $this->_mapper = new $this->_mapper();
                }
            }
            return $this->_mapper;
        }

        /**
         * Inicializa a sessão da aplicação e do usuário
         * 
         * @throws ZendT_Exception_Information 
         */
        protected function _startupAcl($options = array()) {
            $acl = ZendT_Acl::getInstance();
            if ($this->_resourceBase != '') {
                list($options['module'], $options['controller']) = explode('.', $this->_resourceBase);
            }
            $acl->startup($options);

            if (!$acl->isValid()) {
                throw new ZendT_Exception_Information($acl->getMessage(), 9999);
            }
        }

        protected function _defineLayout() {
            $typeModal = $this->getRequest()->getParam('typeModal');
            if ($typeModal == 'AJAX') {
                Zend_Layout::getMvcInstance()->setLayout('ajax');
            } else if ($typeModal == 'WINDOW') {
                Zend_Layout::getMvcInstance()->setLayout('window');
            } else if ($typeModal == 'IFRAME') {
                Zend_Layout::getMvcInstance()->setLayout('iframe');
            }
        }

        /**
         *  
         */
        public function filterAction() {
            $typeModal = $this->getRequest()->getParam('typeModal');
            if ($typeModal == 'AJAX') {
                Zend_Layout::getMvcInstance()->setLayout('ajax');
            } else if ($typeModal == 'WINDOW') {
                Zend_Layout::getMvcInstance()->setLayout('window');
            } else if ($typeModal == 'IFRAME') {
                Zend_Layout::getMvcInstance()->setLayout('iframe');
            }

            $params = $this->getRequest()->getParams();

            //var_dump($params);

            $profileId = $this->getRequest()->getParam('profile');
            $arquivo = $this->getRequest()->getParam('arquivo');
            $profileKey = $this->getRequest()->getParam('profile_key');
            $disableSidebar = $this->getRequest()->getParam('disable_sidebar');

            $objectName = get_class($this->_mapper);
            $columns = $this->_mapper->getColumns()->toArray();

            $this->view->profiles = ZendT_Profile::listProfile($objectName, array('C', 'D'));

            $profile = ZendT_Profile::get($objectName, '');
            $this->view->profileId = $profile['id'];
            $this->view->profileType = $profile['tipo'];
            $this->view->objectName = $objectName;
            $this->view->profileKey = $profileKey;
            $this->view->dynamic = false;
            $this->view->disableSidebar = $disableSidebar;

            $action = 'dynamic';
            $title = $profile['title'];
            $this->title = $profile['title'];
            if ($profile['tipo'] == 'B') {
                foreach ($profile['cols-filter']['fields'] as $name => $config) {
                    list($view, $id, $desc) = explode('-', $name);
                    break;
                }
                $profile = ZendT_Profile::get($objectName, '', $id);
                $action = 'panel';
            }

            $fields = $profile['cols-filter']['fields'];
            if (count($fields)) {
                foreach ($fields as $columnName => &$value) {
                    $value['column'] = $columns[$columnName]['column'];
                    $value['type'] = $columns[$columnName]['type'];
                    $value['required'] = $columns[$columnName]['required'];
                    $value['auto-complete'] = $columns[$columnName]['auto-complete'];
                    $value['seeker'] = $columns[$columnName]['seeker'];
                }
            }

            $form = new ZendT_Form();
            $form->loadProfileFilter($fields, $params);
            if (isset($params['toolbar'])) {
                $element = new ZendT_Form_Element_Hidden('toolbar');
                $element->setValue($params['toolbar']);
                $form->addElement($element);
            }

            if (isset($params['width'])) {
                $element = new ZendT_Form_Element_Hidden('width');
                $element->setValue($params['width']);
                $form->addElement($element);
            }

            if (isset($params['height'])) {
                $element = new ZendT_Form_Element_Hidden('height');
                $element->setValue($params['height']);
                $form->addElement($element);
            }

            if (isset($params['typeModal'])) {
                $element = new ZendT_Form_Element_Hidden('typeModal');
                $element->setValue($params['typeModal']);
                $form->addElement($element);
            }

            if (isset($disableSidebar)) {
                $element = new ZendT_Form_Element_Hidden('disable_sidebar');
                $element->setValue($disableSidebar);
                $form->addElement($element);
            }

            $form->setAction(ZendT_Url::getBaseUrl() . '/' . $params['module'] . '/' . $params['controller'] . '/' . $action . '?profile=' . $profileId . '&profile_key=' . $profileKey);

            $button = new ZendT_View_Button('btSearch', 'Pesquisar', new ZendT_JS_Command("function(){
				//jQuery('#btSearch').attr('disabled',true);
				var form = jQuery('#" . $form->getId() . "');
				if (form.valid()){
					var data = form.serialize();
					jQuery.AjaxT.json({
						url: '" . ZendT_Url::getBaseUrl() . '/' . $params['module'] . '/' . $params['controller'] . '/filter-valid?profile=' . $profile['id'] . "',
						data: data,
						success: function(result){
							if (result){
								jQuery('#btSearch').attr('disabled',true);
								jQuery('#pAguarde').show();
								form.submit();
								document.body.style.cursor = 'wait';
							}
						}/*,
						exception: function(ex){
							jQuery('#btSearch').attr('disabled',false);
						}*/
					});
				}
			}"));
            $button->setIcon('ui-icon-search');

            $_toolbar = new ZendT_View_Toolbar('toolChart');

            if (ZendT_Acl::getInstance()->isAllowed('object-view', 'profile')) {
                $onClick = "$.WindowT.open({id:'win-{$objectName}', type: 'WINDOW', url: '/Mais/index.php/profile/object-view/list-config', param: 'objeto={$objectName}&tipo={$profile['tipo']}&id={$profileId}', method: 'GET', title: 'Configuração da Visão', height: 580, width: 1370, modal: false });";
                $buttonConfig = new ZendT_View_Button('bt-' . $objectName, 'Configurar Visão', $onClick);
                $buttonConfig->setIcon('ui-icon-gear');
                $_toolbar->addButton($buttonConfig);
            }

            if (ZendT_Acl::getInstance()->isAllowed('relatorio', 'log')) {
                $buttonLog = new ZendT_View_Button('btLogViews', 'Log de Acesso', new ZendT_JS_Command("function(){
                    document.location.href = '" . ZendT_Url::getBaseUrl() . "/log/relatorio?arquivo=" . $objectName . "';
                }"));
                $buttonLog->setIcon('ui-icon-comment');
                $_toolbar->addButton($buttonLog);
            }


            if (ZendT_Acl::getInstance()->isAllowed('object-view', 'profile')) {
                $onClick = "$.WindowT.open({id:'win-users-access', type: 'WINDOW', url: '/Mais/index.php/profile/object-view-users/dynamic', param: 'profile=813&id_visao={$profileId}', method: 'GET', title: 'Usuários com Acesso a Visão', height: 580, width: 1370, modal: false });";
                $buttonConfig = new ZendT_View_Button('bt-users-access', 'Usuários com Acesso', $onClick);
                $buttonConfig->setIcon('ui-icon-person');
                $_toolbar->addButton($buttonConfig);
            }

            $buttonViews = new ZendT_View_Button('btMyViews', 'Minhas Visões', new ZendT_JS_Command("function(){
                document.location.href = '" . ZendT_Url::getUri(true) . "?arquivo=" . $arquivo . "&profile_key=" . $profileKey . "';
            }"));
            $buttonViews->setIcon('ui-icon-newwin');
            $_toolbar->addButton($buttonViews);

            //$_toolbar->setFloat('right');

            $this->view->placeholder('title')->set('');
            $this->view->toolbar = $_toolbar;
            $this->view->title = $title;
            $this->view->content = $form->render();
            if (count($fields)) {
                $this->view->content .= $button->render();
            }

            $this->view->addScriptPath(APPLICATION_PATH . '/views/scripts/index/');
            $this->renderScript('profile-report.phtml');
        }

        /**
         * 
         */
        public function filterValidAction() {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);
            $json = new ZendT_Json_Result();
            try {
                if (method_exists($this->_mapper, 'paramIsValid')) {
                    $objectName = get_class($this->_mapper);
                    $config = ZendT_Profile::get($objectName, 'C');
                    if ($config['id']) {
                        $view = new ZendT_Report_View_Dynamic('PDF', $this->_mapper, $config);
                        $where = $view->getWhere(true);
                    }
                }
                $json->setResult(true);
            } catch (Exception $Ex) {
                $json->setException($Ex);
            }
            echo $json->render();
        }

        /**
         *
         * @throws ZendT_Exception_Alert 
         */
        public function dynamicAction() {
            $typeModal = $this->getRequest()->getParam('typeModal');
            $iframeDownload = $this->getRequest()->getParam('iframeDownload');
            $driver = $this->getRequest()->getParam('driver');
            $download = $this->getRequest()->getParam('download');
            $arquivo = $this->getRequest()->getParam('arquivo');
            $profileKey = $this->getRequest()->getParam('profile_key');
            $noToolbar = $this->getRequest()->getParam('noToolbar');
            $toolbar = $this->getRequest()->getParam('toolbar');
            $width = $this->getRequest()->getParam('width');
            $height = $this->getRequest()->getParam('height');
            $disableSidebar = $this->getRequest()->getParam('disable_sidebar');

            if ($typeModal == 'AJAX') {
                Zend_Layout::getMvcInstance()->setLayout('ajax');
            } else if ($typeModal == 'WINDOW') {
                Zend_Layout::getMvcInstance()->setLayout('window');
            } else if ($typeModal == 'IFRAME') {
                Zend_Layout::getMvcInstance()->setLayout('iframe');
            } else if ($typeModal == 'PDF') {
                Zend_Layout::getMvcInstance()->setLayout('pdf');
            }
            try {
                $this->view->disableSidebar = $disableSidebar;

                $objectName = get_class($this->_mapper);
                $config = ZendT_Profile::get($objectName, 'C');

                $this->view->profiles = ZendT_Profile::listProfile($objectName, array('C', 'D'));
                $this->view->profileId = $config['id'];
                $this->view->profileKey = $profileKey;
                $this->view->dynamic = true;
                $this->view->objectName = $objectName;
                $this->view->profileType = $config['tipo'];

                if ($config['id']) {
                    //$listProfile = ZendT_Profile::listProfile($objectName, array('C', 'D'));
                    //$_profile = new ZendT_View_Profile('selProfile', $config['id'], $listProfile, 'C', $objectName);

                    $_toolbar = new ZendT_View_Toolbar('toolChart');
                    //$_toolbar->add($_profile);
                    if ($toolbar == 'simple' && $config['tipo'] == 'C') {
                        // quando for gráfico não mostra botões de exportação
                    } else {
                        $button = new ZendT_View_Button('btExportPDF', 'Download em PDF', new ZendT_JS_Command("function(){
                             jQuery('#driver').val('PDF');
                             jQuery('#download').val(1);                        
                             jQuery('#formChart').attr('action','" . ZendT_Url::getUri() . "').submit();
                         }"));
                        $button->setIcon('ui-icon-document');
                        //$button->addStyle('float', 'left');
                        $_toolbar->add($button, 'btExportPDF');

                        $button = new ZendT_View_Button('btExportXLS', 'Download em XLS', new ZendT_JS_Command("function(){
                             jQuery('#driver').val('XLS');
                             jQuery('#download').val(1);
                             jQuery('#formChart').attr('action','" . ZendT_Url::getUri() . "').submit();
                         }"));
                        $button->setIcon('ui-icon-calculator');
                        //$button->addStyle('float', 'left');
                        $_toolbar->add($button, 'btExportXLS');


                        $buttonMail = new ZendT_View_Button('btMail', 'Enviar e-mail', new ZendT_JS_Command(" function(){
                             var form = jQuery('#formChart');
                             form.attr('action','" . ZendT_Url::getUri(true) . "/mail');
                             jQuery.AjaxT.submitJson({selector:form});
                         }"));
                        $buttonMail->setIcon('ui-icon-mail-closed');
                        $_toolbar->add($buttonMail);
                    }

                    $button = new ZendT_View_Button('btFilterChart', 'Filtrar', new ZendT_JS_Command("function(){
                        jQuery('#formChart').attr('action','" . ZendT_Url::getUri(true) . "/filter').submit();
                    }"));
                    $button->setIcon('ui-icon-search');
                    $_toolbar->addButton($button);

                    $button = new ZendT_View_Button('btRefreshChart', 'Atualizar', new ZendT_JS_Command("function(){
                        jQuery('#formChart').attr('action','" . ZendT_Url::getUri() . "').submit();
                    }"));
                    $button->setIcon('ui-icon-refresh');
                    $_toolbar->addButton($button);


                    if ($toolbar != 'simple') {
                        if (ZendT_Acl::getInstance()->isAllowed('object-view', 'profile')) {
                            $onClick = "$.WindowT.open({id:'win-{$objectName}', type: 'WINDOW', url: '/Mais/index.php/profile/object-view/list-config', param: 'objeto={$objectName}&tipo={$config['tipo']}&id={$config['id']}', method: 'GET', title: 'Configuração da Visão', height: 580, width: 1370, modal: false });";
                            $buttonConfig = new ZendT_View_Button('bt-' . $objectName, 'Configurar Visão', $onClick);
                            $buttonConfig->setIcon('ui-icon-gear');
                            $_toolbar->addButton($buttonConfig);
                        }

                        if (ZendT_Acl::getInstance()->isAllowed('relatorio', 'log')) {
                            $buttonLog = new ZendT_View_Button('btLogViews', 'Log de Acesso', new ZendT_JS_Command("function(){
                             window.open('" . ZendT_Url::getBaseUrl() . "/log/relatorio?arquivo=" . $objectName . "','_BLANK');
                         }"));
                            $buttonLog->setIcon('ui-icon-comment');
                            $_toolbar->addButton($buttonLog);
                        }

                        if (ZendT_Acl::getInstance()->isAllowed('object-view', 'profile')) {
                            $onClick = "$.WindowT.open({id:'win-users-access', type: 'WINDOW', url: '/Mais/index.php/profile/object-view-users/dynamic', param: 'profile=813&id_visao={$config['id']}', method: 'GET', title: 'Usuários com Acesso a Visão', height: 580, width: 1370, modal: false });";
                            $buttonConfig = new ZendT_View_Button('bt-users-access', 'Usuários com Acesso', $onClick);
                            $buttonConfig->setIcon('ui-icon-person');
                            $_toolbar->addButton($buttonConfig);
                        }


                        $buttonViews = new ZendT_View_Button('btMyViews', 'Minhas Visões', new ZendT_JS_Command("function(){
                         document.location.href = '" . ZendT_Url::getUri(true) . "?arquivo=" . $arquivo . "&profile_key=" . $profileKey . "';
                     }"));
                        $buttonViews->setIcon('ui-icon-newwin');
                        $_toolbar->addButton($buttonViews);
                    }

                    //$_toolbar->setFloat('right');

                    $form = new ZendT_Form();
                    $form->setName('formChart');
                    $form->setAction(ZendT_Url::getUri());

                    $element = new ZendT_Form_Element_Hidden('profile');
                    $element->setValue($config['id']);
                    $form->addElement($element);

                    $element = new ZendT_Form_Element_Hidden('profile_key');
                    $element->setValue($profileKey);
                    $form->addElement($element);

                    $element = new ZendT_Form_Element_Hidden('toolbar');
                    $element->setValue($toolbar);
                    $form->addElement($element);

                    $element = new ZendT_Form_Element_Hidden('width');
                    $element->setValue($width);
                    $form->addElement($element);

                    $element = new ZendT_Form_Element_Hidden('height');
                    $element->setValue($height);
                    $form->addElement($element);

                    $element = new ZendT_Form_Element_Hidden('driver');
                    $element->setValue($driver);
                    $form->addElement($element);

                    $element = new ZendT_Form_Element_Hidden('download');
                    $element->setValue($download);
                    $form->addElement($element);

                    $element = new ZendT_Form_Element_Hidden('typeModal');
                    $element->setValue($typeModal);
                    $form->addElement($element);

                    $element = new ZendT_Form_Element_Hidden('disable_sidebar');
                    $element->setValue($disableSidebar);
                    $form->addElement($element);

                    if ($width) {
                        $config['width'] = $width;
                    }

                    if ($height) {
                        $config['height'] = $height - 58;
                    }

                    #$config['iframeDownload'] = $iframeDownload;

                    if ($config['tipo'] == 'C' && $driver == '') {
                        if ($toolbar == 'simple') {
                            $config['show_parameters'] = false;
                            $config['show_title'] = false;

                            $_label = new ZendT_View_Html('span');
                            $_label->setId('spn_filter');
                            $_label->addStyle('float', 'left');
                            $_label->addStyle('margin-top', '9px');
                            $_label->addAttr('title', 'Visualizar parâmetros');
                            $_label->addClass('ui-icon ui-icon-pin-w');
                            $_label->setAttr('value', ' ');
                            $_toolbar->addObject($_label);

                            $_label = new ZendT_View_Html('label');
                            $_label->addStyle('float', 'left');
                            $_label->addStyle('padding', '10px');
                            $_label->addStyle('font-weight', 'bold');
                            $_label->addClass('ui-widget');
                            $_label->setAttr('value', $config['title']);
                            $_toolbar->addObject($_label, 'lbl_title');

                            $_toolbar->addStyle('margin-bottom', '0px');
                        } else {
                            $config['show_parameters'] = true;
                            $config['show_title'] = true;
                        }

                        $view = new ZendT_Report_View_Chart('Chart', $this->_mapper, $config);
                    } else if ($config['tipo'] == 'I') {
                        $view = new ZendT_Report_View_Dynamic_Form($driver, $this->_mapper, $config);
                    } else {
                        $view = new ZendT_Report_View_Dynamic($driver, $this->_mapper, $config);
                    }
                    $viewRendered = $view->render($typeModal);

                    $params = $view->getParams();
                    if ($params) {
                        foreach ($params as $name => $value) {
                            $element = new ZendT_Form_Element_Hidden($name);
                            $element->setValue($value);
                            $form->addElement($element);
                        }
                    }
                    if ($iframeDownload) {
                        $this->_helper->layout->disableLayout();
                        #$this->_helper->viewRenderer->setNoRender(true);
                        $this->view->content = $viewRendered;
                    } else {
                        if ($typeModal == 'PDF') {
                            $this->view->content = $viewRendered;
                        } else {
                            $this->view->placeholder('title')->set('');
                            $this->view->title = $config['title'];
                            $this->view->typeModal = $typeModal;

                            $this->view->content = '';
                            /* if (!$noToolbar) {
                              $this->view->content = $_toolbar->render();
                              } */
                            $this->view->content.= $form->render() . $viewRendered;
                        }
                    }
                } else {
                    throw new ZendT_Exception_Alert('Nenhuma análise configurada para essa visão!');
                }
            } catch (Exception $ex) {
                $this->view->content = '';
                if ($_toolbar instanceof ZendT_View_Toolbar) {
                    $this->view->content.= $_toolbar->render();
                }
                if ($form instanceof ZendT_Form) {
                    $this->view->content.= $form->render();
                }
                $this->view->content.= $this->view->exception($ex);
            }

            $this->view->addScriptPath(APPLICATION_PATH . '/views/scripts/index/');
            $this->renderScript('profile-report.phtml');
        }

        /**
         *
         */
        public function autoCompleteAction() {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);
            try {
                $param = $this->getRequest()->getParams();
                if ($param['filter_json'] == 'false' || $param['search_valid'] == 'false') {
                    // não realiza o filtro do autocomplete, pois depende de outros filtros
                } else {

                    if (!$param['suggest']) {
                        $whereGroup = new ZendT_Db_Where_Group();
                        if (isset($param['filter_json'])) {
                            $whereJson = ZendT_Db_Where::fromJson(stripslashes($param['filter_json']));
                            $whereGroup->addWhere($whereJson);
                        }
                        $where = $this->getModel()->getWhereSeekerSearch($param['q']);
                        $whereGroup->addWhere($where);
                        $rows = $this->getMapper()->autoComplete($whereGroup, $param);
                    } else {
                        $rows = $this->getMapper()->suggest($param['q'], $param['column'], $param['profile']);
                    }

                    if ($rows) {
                        foreach ($rows as $row) {
                            $linha = "";
                            if (is_array($row)) {
                                foreach ($row as $value) {
                                    if ($value instanceof ZendT_Type) {
                                        $value = $value->get();
                                    }
                                    $linha.= '|' . $value;
                                }
                            }
                            $linha = substr($linha, 1) . "\n";
                            echo $linha;
                        }
                    }
                }
            } catch (Exception $Ex) {
                echo 'Alert :: ' . $Ex->getMessage();
            }
        }

        /**
         *
         * @throws ZendT_Exception_Alert 
         */
        public function indexAction() {
            $typeModal = $this->getRequest()->getParam('typeModal');
            $profile = $this->getRequest()->getParam('profile');
            $type = $this->getRequest()->getParam('type');
            $arquivo = $this->getRequest()->getParam('arquivo');
            if (!$type) {
                $type = array('C', 'D', 'B','I');
            }

            if ($typeModal == 'AJAX') {
                Zend_Layout::getMvcInstance()->setLayout('ajax');
            } else if ($typeModal == 'WINDOW') {
                Zend_Layout::getMvcInstance()->setLayout('window');
            } else if ($typeModal == 'IFRAME') {
                Zend_Layout::getMvcInstance()->setLayout('iframe');
            }
            try {
                $objectName = get_class($this->_mapper);
                $listProfile = ZendT_Profile::listProfile($objectName, $type);

                $this->view->objectName = $objectName;
                $this->view->listProfile = $listProfile;
                $this->view->arquivo = $arquivo;
                $this->view->profileKey = $this->getRequest()->getParam('profile_key');
            } catch (Exception $ex) {
                $this->view->content = $this->view->exception($ex);
            }
            $this->view->addScriptPath(APPLICATION_PATH . '/views/scripts/index/');
            $this->renderScript('index-profile.phtml');
        }

        /**
         * Avalia se haverá algum registro a ser exibido na visão
         * 
         * @throws ZendT_Exception_Alert 
         */
        public function foundAction() {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);
            try {
                $objectName = get_class($this->_mapper);
                $driver = 'PDF';
                $config = ZendT_Profile::get($objectName, array('C', 'D'));
                if ($config['id']) {
                    $config['log'] = false;
                    $view = new ZendT_Report_View_Dynamic($driver, $this->_mapper, $config);
                    if ($view->found() === false) {
                        throw new ZendT_Exception_Alert('Nenhum registro encontrado!');
                    }
                } else {
                    throw new ZendT_Exception_Alert('Nenhuma análise configurada para essa visão!');
                }
                echo 'OK';
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

        public function mailAction() {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);

            $driver = $this->getRequest()->getParam('driver');
            $to = $this->getRequest()->getParam('to');
            $subject = $this->getRequest()->getParam('subject');
            $comment = $this->getRequest()->getParam('comment');
            /**
             * Controle de cache 
             */
            $userId = Zend_Auth::getInstance()->getStorage()->read();
            if (is_object($userId)) {
                $userName = $userId->getName();
                $userEmail = $userId->getEmail();
                $userId = $userId->getId();
            } else {
                $userName = 'Transportadora Americana';
                $userEmail = 'no-reply@tanet.com.br';
                $userId = 0;
            }
            $idCache = 'profile' . $this->getRequest()->getParam('profile') . 'user' . $userId;
            $cache = new ZendT_Cache($idCache);

            $json = new ZendT_Json_Result();
            try {
                if (!$to) {
                    $form = new Profile_Form_ObjectView_Mail();
                    $params = $this->getRequest()->getParams();
                    foreach ($params as $name => $value) {
                        if (!in_array($name, array('module', 'controller', 'action'))) {
                            $hidden = new ZendT_Form_Element_Hidden($name);
                            $hidden->setValue($value);
                            $form->addElement($hidden);
                        }
                    }
                    $form->loadElements();


                    $dataCache = $cache->get();
                    if ($dataCache) {
                        $form->populate($dataCache);
                    }
                    $form->setAction(ZendT_Url::getUri());
                    throw new ZendT_Exception_Confirm($form->render());
                } else {
                    $data = array();
                    $data['to'] = $to;
                    $data['subject'] = $subject;
                    $data['comment'] = $comment;
                    $cache->set($data);
                }

                $objectName = get_class($this->_mapper);
                $config = ZendT_Profile::get($objectName, 'C');

                if ($config['id']) {
                    $view = new ZendT_Report_View_Dynamic($driver, $this->_mapper, $config);
                    $file = $view->renderFile($subject);

                    $mail = new ZendT_Mail();

                    $to = str_replace(';', ',', trim($to));
                    $to = explode(',', $to);
                    foreach ($to as $email) {
                        $mail->addTo($email);
                    }
                    $mail->addFrom($userEmail, $userName);
                    $mail->setTitle($subject);
                    $mail->setSubject($subject);
                    $mail->addAttachment($file->getFilename(), $file->getName(), 'Blob');
                    $mail->setComment($comment);
                    $mail->setBody(' ');
                    $mail->save();
                }

                $json->setResult(true);
            } catch (Exception $ex) {
                $json->setException($ex);
            }
            echo $json->render();
        }

        public function panelAction() {
            $objectName = get_class($this->_mapper);
            $view = ZendT_Profile::get($objectName, array('B'));

            $this->view->panels = $view['cols-panel']['fields'];
            $this->view->refresh = $view['advanced']['refresh'];

            if (isset($view['title'])) {
                $title = $view['title'];
            } else {
                $title = 'Painel de Indicações';
            }
            $this->view->placeholder('title')->set($title);


            $_toolbar = new ZendT_View_Toolbar('toolChart');

            $button = new ZendT_View_Button('btFilter', 'Filtrar Geral', new ZendT_JS_Command("function(){
                 jQuery('#frm_panel').attr('action','" . ZendT_Url::getUri(true) . "/filter').submit();
             }"));
            $button->setIcon('ui-icon-search');
            $_toolbar->addButton($button);

            $button = new ZendT_View_Button('btRefresh', 'Atualizar Geral', new ZendT_JS_Command("function(){
                 jQuery('#frm_panel').attr('action','" . ZendT_Url::getUri() . "').submit();
             }"));
            $button->setIcon('ui-icon-refresh');
            $_toolbar->addButton($button);


            if (ZendT_Acl::getInstance()->isAllowed('object-view', 'profile')) {
                $onClick = "$.WindowT.open({id:'win-{$objectName}', type: 'WINDOW', url: '/Mais/index.php/profile/object-view/list-config', param: 'objeto={$objectName}&tipo=B&id={$config['id']}', method: 'GET', title: 'Configuração da Visão', height: 580, width: 1370, modal: false });";
                $buttonConfig = new ZendT_View_Button('bt-' . $objectName, 'Configurar Visão', $onClick);
                $buttonConfig->setIcon('ui-icon-gear');
                $_toolbar->addButton($buttonConfig);
            }

            $_toolbar->setFloat('right');

            $form = new ZendT_Form();
            $form->setName('frm_panel');
            $form->setAction(ZendT_Url::getUri());

            $params = $this->getRequest()->getParams();

            $element = new ZendT_Form_Element_Hidden('profile');
            $element->setValue($params['profile']);
            $form->addElement($element);

            unset($params['module']);
            unset($params['controller']);
            unset($params['action']);
            unset($params['profile']);
            unset($params['_search']);

            if (count($params) > 0) {
                foreach ($params as $name => &$value) {
                    if (isset($params[$name . '-multiple']) && $params[$name . '-multiple']) {
                        $value = $params[$name . '-multiple'];
                        //unset($params[$name.'-multiple']);
                    }
                }

                foreach ($params as $name => $value) {
                    $element = new ZendT_Form_Element_Hidden($name);
                    $element->setValue($value);
                    $form->addElement($element);
                }
            }

            $this->view->toolbar = $_toolbar;
            $this->view->form = $form;
            $this->view->params = $params;

            $this->view->addScriptPath(APPLICATION_PATH . '/views/scripts/index/');
            $this->renderScript('panel.phtml');
        }

        protected function _disableRender($layout = true, $view = true) {
            if ($layout)
                $this->_helper->layout->disableLayout();

            if ($view)
                $this->_helper->viewRenderer->setNoRender(true);
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

        /**
         * Pega o objeto grid pré-configurado para
         * manipulação.
         *
         * @return ZendT_Grid
         */
        public function configGrid() {
            $module = $this->getRequest()->getModuleName();
            $controller = $this->getRequest()->getControllerName();
            $params = $this->getRequest()->getParams();
            $profileKey = '';
            if (isset($params['profile_key'])) {
                $profileKey = $params['profile_key'];
            }

            $urlFilter = '?q=1';
            if (isset($params['filter_json'])) {
                $urlFilter.= '&filter_json=' . $params['filter_json'];
            }
            if (isset($params['mapper_view'])) {
                $urlFilter.= '&mapper_view=' . $params['mapper_view'];
            }


            if ($this->_mapper instanceof ZendT_Db_View) {
                $where = $this->getMapper()->getColumns()->getWhere($params);
                if ($where) {
                    $params['postData'] = $where->toJsonPostData($params['postData']);
                }
            }

            if ($params['postData'] != '') {
                $autoFilter = true;
            } else {
                $autoFilter = false;
            }


            $type = 'G'; #Grid
            $mapperName = get_class($this->_mapper);
            $profile = ZendT_Profile::get($mapperName, $type);
            $profileId = '';
            if (isset($profile['id'])) {
                $profileId = $profile['id'];
            }
            $profiles = ZendT_Profile::listProfile($mapperName, $type);

            $this->getGrid()
                    ->setUrl(ZendT_Url::getBaseUrl() . '/' . $module . '/' . $controller . '/grid-data/profile/' . $profileId . $urlFilter)
                    ->setDataType('json')
                    ->setMType('POST')
                    ->setRowNum(30)
                    ->setRowList(array(30, 60, 90))
                    ->setPager("#pager-" . $this->getGrid()->getID())
                    ->setViewRecords('true')
                    ->setToolbar(array('true', 'top'))
                    ->setMType('POST')
                    ->setWidth(960)
                    ->setAutoFilter($autoFilter)
                    ->setShrinkToFit(false)
                    ->setPostData(urldecode($params['postData']))
                    ->setBeforeRequest("function(){ gridResize('" . $this->getGrid()->getID() . "'); }")
                    ->setGridComplete(" function(){ jQuery.gridAtivaNavKey({ idGrid:'" . $this->getGrid()->getID() . "' }); }");
            
            /**
             * Analisa Parâmetros
             */
            $newPostData = array();
            foreach($params as $name=>$value){
                $param = $this->getMapper()->paramName($name);
                if ($param){
                    $newPostData[$param] = $value;
                }
            }
            
            if (count($newPostData) > 0){
                $this->getGrid()->setPostData($newPostData);
            }
            
            if ($this->getRequest()->getParam('seekerAjax')) {
                $objectRetrieve = 'TSeeker';
                if ($this->getRequest()->getParam('objectRetrive')) {
                    $objectRetrieve = $this->getRequest()->getParam('objectRetrive');
                }
                $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/' . $objectRetrieve . '.js');
                $seekerName = $this->getRequest()->getParam('seekerName');

                $seekerAccess = 'window.opener.jQuery';
                $seekerClose = 'window.close();';
                if ($params['typeModal'] == 'AJAX') {
                    $seekerAccess = 'jQuery';
                    $seekerClose = 'seeker.TSeeker(\'divClose\');';
                    $functionResize = "function(){
                                            var grid = jQuery('#" . $this->getGrid()->getID() . "');
                                            var seeker = " . $seekerAccess . "('#" . $seekerName . "');
                                            var div  = seeker.TSeeker('option','elements').div;
                                            grid.setGridHeight(250);
                                            grid.setGridWidth(700);
                                        }";
                } else {
                    $functionResize = "function(){
                                            $.gridResize({
                                                idGrid: '" . $this->getGrid()->getID() . "'
                                            });
                                            $(window).resize(function(){
                                                $.gridResize({
                                                    idGrid: '" . $this->getGrid()->getID() . "'
                                                });
                                            });
                                        }";
                }

                $functionRetorno = "function(){
                                        var grid  = jQuery('#" . $this->getGrid()->getID() . "');
                                        if( grid.jqGrid('getGridParam','multiselect') ){
                                            var id = grid.jqGrid('getGridParam','selarrrow');
                                        }else{
                                            var id = grid.jqGrid('getGridParam','selrow');
                                        }
                                        var seeker = " . $seekerAccess . "('#" . $seekerName . "');
                                        try{
                                            seeker.{$objectRetrieve}('retrieve',{value: id});
                                            {$seekerClose}
                                        }catch(err){
                                            {$seekerClose}
                                        }
                                    }";
                $this->getGrid()
                        ->setOndblClickRow($functionRetorno)
                        ->setBeforeRequest($functionResize)
                        ->setGridComplete("function(){
                                                $.gridAtivaNavKey({
                                                    idGrid: '" . $this->getGrid()->getID() . "',
                                                    functionEnter: " . $functionRetorno . "
                                                });
                                            }");
            }

            if ($params['callback']) {
                $functionCallback = base64_decode($params['callback']);
                $this->getGrid()
                        ->setOndblClickRow($functionCallback)
                        ->setGridComplete("function(){
                                                $.gridAtivaNavKey({
                                                    idGrid: '" . $this->getGrid()->getID() . "',
                                                    functionEnter: " . $functionCallback . "
                                                });
                                            }");
            }

            if ($params['multiple']) {
                $this->getGrid()->setMultiSelect(true);
                $idbt = 'selectGrid' . $this->getGrid()->getID();
                $multiSelect = new ZendT_Grid_Button($idbt);
                $multiSelect
                        ->setIdGrid($this->getGrid()->getID())
                        ->setButtonIcon("ui-icon-check")
                        ->setTitle("Selecionar")
                        ->setCaption("Selecionar")
                        ->setOnClick($functionRetorno);
                $this->view->hotkeys()->add('btMultiSelect', 'ctrl+s', '$("#' . $idbt . '").click();');
                $this->getGrid()->addToolbarButton("multiSel", $multiSelect);
            }

            $idbt = 'refreshGrid' . $this->getGrid()->getID();
            $refresh = new ZendT_Grid_Button_Refresh($idbt);
            $refresh
                    ->setIdGrid($this->getGrid()->getID())
                    ->setButtonIcon("ui-icon-refresh")
                    ->setTitle("Atualizar");
            $this->view->hotkeys()->add('btRefresh', 'ctrl+r', '$("#' . $idbt . '").click();');
            $this->getGrid()->addToolbarButton("refresh", $refresh, 'grid');

            /* $clearFiltro = new ZendT_Grid_Button();
              $clearFiltro->setIdGrid($this->getGrid()->getID())
              ->setButtonIcon('ui-icon ui-icon-arrowreturnthick-1-s')
              ->setOnClick('function(){$(\'#' . $this->getGrid()->getID() . '\')[0].clearToolbar();}')
              ->setTitle('Limpar Filtro');
              $this->getGrid()->addToolbarButton('clearFilter', $clearFiltro, 'grid'); */

            $autoFiltro = new ZendT_Grid_Button();
            $autoFiltro->setIdGrid($this->getGrid()->getID())
                    ->setButtonIcon('ui-icon  ui-icon-pin-s')
                    ->setOnClick('function(){$(\'#' . $this->getGrid()->getID() . '\')[0].toggleToolbar();}')
                    ->setTitle('Filtro');
            $this->getGrid()->addToolbarButton('autofiltro', $autoFiltro, 'grid');


            $_profile = new ZendT_View_Profile('selProfile', $profile['id'], $profiles, $type, $mapperName);
            $screenName = $this->view->screenName;
            $this->view->profileMenu = $_profile->render($screenName);
            $this->view->screenName = $screenName;
            $this->view->placeholder('title')->set($screenName);

            $navigator = '';
            if ($navigator) {
                $this->getGrid()->getNavigator()->addCommand('navigatorGrid', $navigator);
            }

            /**
             * Botão de adição de registro e
             * suas configurações vitais
             */
            if ($this instanceof ZendT_Controller_ActionCrud && ZendT_Acl::getInstance()->isAllowed('insert', $this->_resourceBase)) {

                $filterJson = $this->getRequest()->getParam('filter_json');

                $idbt = 'addGrid' . $this->getGrid()->getID();
                $add = new ZendT_Grid_Button_Add($idbt);
                $add
                        ->setIdGrid($this->getGrid()->getID())
                        ->setButtonIcon('ui-icon-plus')
                        ->setUrl(ZendT_Url::getBaseUrl() . '/' . $module . '/' . $controller . '/form?filter_json=' . $filterJson . '&profile_key=' . $profileKey)
                        ->setWindowWidth(860)
                        ->setWindowHeight(520)
                        ->setTitle('Adicionar');
                $this->view->hotkeys()->add('btInsert', 'ctrl+a', '$("#' . $idbt . '").click();');
                $this->getGrid()->addToolbarButton('add', $add, 'edit');
            }



            /**
             * Botão de edição de linha e
             * suas configurações vitais
             */
            if ($this instanceof ZendT_Controller_ActionCrud && ZendT_Acl::getInstance()->isAllowed('update', $this->_resourceBase)) {
                $idbt = 'editGrid' . $this->getGrid()->getID();
                $edit = new ZendT_Grid_Button_Edit($idbt);
                $edit
                        ->setIdGrid($this->getGrid()->getID())
                        ->setButtonIcon('ui-icon-pencil')
                        ->setUrl(ZendT_Url::getBaseUrl() . '/' . $module . '/' . $controller . '/form' . '?profile_key=' . $profileKey)
                        ->setUrlRetrieve(ZendT_Url::getBaseUrl() . '/' . $module . '/' . $controller . '/retrive')
                        ->setWindowWidth(860)
                        ->setWindowHeight(520)
                        ->setTitle('Editar');
                $this->view->hotkeys()->add('btEdit', 'ctrl+e', '$("#' . $idbt . '").click();');
                $this->getGrid()->addToolbarButton('edit', $edit, 'edit');

                if (!$this->getRequest()->getParam('seekerAjax')) {
                    $this->getGrid()->setOndblClickRow("function(){jQuery('#" . $idbt . "').click();}");
                }
            }

            #Button - Delete
            if ($this instanceof ZendT_Controller_ActionCrud && ZendT_Acl::getInstance()->isAllowed('delete', $this->_resourceBase)) {
                $idbt = 'delGrid' . $this->getGrid()->getID();
                $del = new ZendT_Grid_Button_Delete($idbt);
                $del
                        ->setIdGrid($this->getGrid()->getID())
                        ->setButtonIcon('ui-icon-trash')
                        ->setUrl(ZendT_Url::getBaseUrl() . '/' . $module . '/' . $controller . '/delete')
                        ->setWindowWidth(800)
                        ->setWindowHeight(520)
                        ->setTitle('Excluir');
                $this->view->hotkeys()->add('btDelete', 'ctrl+d', '$("#' . $idbt . '").click();');
                $this->getGrid()->addToolbarButton('del', $del, 'edit');
            }



            if ($this instanceof ZendT_Controller_ActionCrud && ZendT_Acl::getInstance()->isAllowed('log', $this->_resourceBase) && method_exists($this->_mapper, 'isLogger') && $this->_mapper->isLogger()) {
                $log = new ZendT_Grid_Button_Window();
                $log->setIdGrid($this->getGrid()->getID())
                        ->setButtonIcon('ui-icon-info')
                        ->setUrl(ZendT_Url::getBaseUrl() . '/' . $module . '/' . $controller . '/log')
                        ->setWindowWidth(650)
                        ->setWindowHeight(450)
                        ->setTitle('Log');
                $this->getGrid()->addToolbarButton('Log', $log, 'edit');
            }

            $this->view->typeModal = $params['typeModal'];
            if ($params['typeModal'] == 'AJAX') {
                Zend_Layout::getMvcInstance()->setLayout('ajax');
            } else if ($params['typeModal'] == 'WINDOW') {
                $this->view->onLoad = stripslashes(urldecode($params['afterLoad']));
                $this->view->onClose = stripslashes(urldecode($params['onClose']));
                Zend_Layout::getMvcInstance()->setLayout('window');
            }
        }

        /**
         * Ação para montar o Grid
         */
        public function gridAction() {
            $configColumns = $this->_mapper->getColumns()->toArray();
            foreach ($configColumns as $column => $key) {
                if ($key['subtotal']) {
                    $this->getGrid()->setFooterRow(true);
                    $this->getGrid()->setUserDataOnFooter(true);
                    break;
                }
            }

            $this->configGrid();
            if ($this->_mapper instanceof ZendT_Db_View) {
                $this->getColumns();
            }
            $this->view->grid = $this->getGrid();
        }

        /**
         * Retona a condição de filtro que será usado
         * para listar os dados de uma tabela e assim
         * poderá ser usado nas ações de grid, retrieve e etc...
         *
         * @return ZendT_Db_Where_Group
         */
        public function getWherePostData() {
            $param = $this->getRequest()->getParams();
            $whereGroup = new ZendT_Db_Where_Group('AND');

            if ($this->_mapper instanceof ZendT_Db_View) {
                $columns = $this->getMapper()->getColumns()->getColumnsMapper();
                $columns->add('*', $this->getModel()->getMapperName());
            } else {
                $columns = $this->getModel()->getColumnsMapper();
            }
            /**
             * Pega do filtro que é usado em tela.
             */
            if (isset($param['isSearch'])) {
                $where1 = ZendT_Db_Where::fromPostDataSearch($param, $columns);
                $whereGroup->addWhere($where1);
            }
            /**
             *
             */
            if (isset($param['_search'])) {

                $where2 = ZendT_Db_Where::fromAutoFilter($param, $columns);
                $whereGroup->addWhere($where2);
            }
            /**
             * Pega o filtro usado usado em json
             */
            if ($param['filter_json']) {
                $where3 = ZendT_Db_Where::fromJson(stripslashes($param['filter_json']));
                $whereGroup->addWhere($where3);
            }
            return $whereGroup;
        }

        /**
         * Ação de montagem dos dados para o Grid
         */
        public function gridDataAction() {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);

            $postData = $this->getRequest()->getParams();

            $whereGroup = $this->getWherePostData();
            if ($this->_mapper instanceof ZendT_Db_View) {
                $dataGrid = $this->getMapper()->getDataGrid($whereGroup, $postData);
            } else {
                $dataGrid = $this->getModel()->getDataGrid($whereGroup, $postData);
            }
            $this->getGrid()->setRecords($dataGrid->getNumRows());
            $rowsByPage = $postData['rows'];
            $listOptions = $this->getModel()->getListOptions();

            $hasStylesRow = method_exists($this->getMapper(), 'getStylesRow');

            $line = array();
            $columns = $this->getColumns(true);
            $profileId = $this->getRequest()->getParam('profile');
            $configColumns = $this->_mapper->getColumns()->toArray();
            while ($row = $dataGrid->getRow()) {
                $stylesRow = array();
                if ($hasStylesRow)
                    $stylesRow = $this->getMapper()->getStylesRow($row, $profileId);

                #$line['id'] = $row['id'];
                foreach ($columns as $column) {
                    $key = $column->getName();
                    if ($dataGrid->getType()) {
                        $line[$key] = $row[strtolower($key)]->get();
                    } elseif ($dataGrid->isRowFormated()) {
                        $line[$key] = $row[strtolower($key)];
                    } else {
                        $line[$key] = $column->format($row[strtolower($key)]);
                    }
                    if (isset($listOptions[$key][$line[$key]])) {
                        $line[$key] = $listOptions[$key][$line[$key]];
                    }

                    if (trim($configColumns[$key]['subtotal'])) {
                        $subtotal = $configColumns[$key]['subtotal'];
                        if (!$this->_subtotal[$key]) {
                            $options = array('numDecimal' => 2);
                            if ($subtotal == 'count') {
                                $options = array('numDecimal' => 0);
                            }
                            $this->_subtotal[$key] = new ZendT_Type_Number(0, $options);
                        }
                        $value = $row[strtolower($key)]->getValueToDb();
                        $this->_subtotal[$key]->setTotal($value, $configColumns[$key]['subtotal']);
                    }
                }

                $this->getGrid()->addRow($line, $stylesRow);
            }

            if (isset($this->_subtotal)) {
                foreach ($this->_subtotal as $column => $key) {
                    $columnBase = $configColumns[$column]['aliasTable'] . "_" . $column;
                    $userData[$columnBase] = $this->_subtotal[$column]->getTotal()->get();
                }
                $this->getGrid()->setUserData($userData);
            }

            echo $this->getGrid()->toJson($dataGrid->getNumPage(), $rowsByPage);
        }

        /**
         * Ação para buscar os dados para uma Seeker
         * Pode retornar o dado para preenchimento ou
         * retornar um PostData com os dados usados
         * para pesquisa
         */
        public function seekerSearchAction() {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);

            $json = new ZendT_Json_Result();
            try {
                $value = ltrim($this->getRequest()->getParam('value'));
                $field = $this->getRequest()->getParam('field');

                if ($value) {
                    if (method_exists($this->getMapper(), 'getWhereSeekerSearch')) {
                        $where = $this->getMapper()->getWhereSeekerSearch($value, $field);
                    } else {
                        $where = $this->getModel()->getWhereSeekerSearch($value, $field);
                    }
                } else {
                    $where = new ZendT_Db_Where();
                }
                $whereGroup = new ZendT_Db_Where_Group('AND');
                $whereGroup->addWhere($where);
                /**
                 * Pega o filtro usado usado em json
                 */
                $filterJson = $this->getRequest()->getParam('filter_json');
                if ($filterJson) {
                    $whereFilter = ZendT_Db_Where::fromJson($filterJson);
                    $whereGroup->addWhere($whereFilter);
                }
                if ($this->_mapper instanceof ZendT_Db_View) {
                    $dataGrid = $this->getMapper()->getDataGrid($whereGroup, array());
                } else {
                    $dataGrid = $this->getModel()->getDataGrid($whereGroup, array());
                }
                $data = true;
                if ($dataGrid->getNumRows() == 1 && $this->getRequest()->getParam('makePostData') != '1') {
                    $data = array();
                    if ($dataGrid->isRowFormated()) {
                        $data['row'] = $dataGrid->getRow();
                        foreach ($data['row'] as $key => $row) {
                            if ($row instanceof ZendT_Type) {
                                $data['row'][$key] = $row->get();
                            }
                        }
                    } else {
                        $row = $dataGrid->getRow();
                        foreach ($this->getColumns() as $column) {
                            $data['row'][strtolower($column->getName())] = $column->format($row[strtolower($column->getName())]);
                        }
                    }

                    $this->_prepareRetrieveRow($data['row']);
                } else {
                    $data = array('postData' => $where->toJsonPostData()
                        , 'numRows' => $dataGrid->getNumRows());
                }
                $json->setResult($data);
            } catch (Exception $Ex) {
                $json->setException($Ex);
            }
            echo $json->render();
        }

        protected function _prepareRetrieveRow(&$row) {
            
        }

        protected function _retrive() {
            return $this->_retrieve();
        }

        protected function _retrieve() {
            $param = $this->getRequest()->getParams();
            if (isset($param['id']) && strpos($param['id'], ',') !== false) {
                $multi = true;
                /**
                 * @todo analisar uma forma de popular o Mapper para identificação da coluna
                 */
                $tableName = $this->getMapper()->getModel()->getName();
                $columnId = $this->getMapper()->getModel()->getPrimary();
                $columnId = $columnId[0];

                $where = new ZendT_Db_Where();
                $where->addFilter($tableName . '.' . $columnId, explode(',', $param['id']), 'in', $this->getMapper()->getModel()->getMapperName());
            } else {
                $multi = false;
                $where = $this->getMapper()->getWhere($param);
            }

            $wData = array('noPage' => true, 'returnType' => true);
            if ($param['findAll']) {
                $multi = true;
                $wData['count'] = false;
            }
            if ($this->_mapper instanceof ZendT_Db_View) {
                $dataGrid = $this->getMapper()->getDataGrid($where, $wData, true);
            } else {
                $dataGrid = $this->getModel()->getDataGrid($where, $wData);
            }

            $result = array();
            while ($row = $dataGrid->getRow()) {
                if ($row && count($row) > 0) {
                    foreach ($row as $key => &$value) {
                        if ($value instanceof ZendT_Type_Blob) {
                            if (isset($row[$key . '_name'])) {
                                $name = $row[$key . '_name'];
                            } else {
                                $name = 'Arquivo-' . date('dmyhis') . '.txt';
                            }
                            if (isset($row[$key . '_type'])) {
                                $type = $row[$key . '_type'];
                            } else {
                                $type = 'application/txt';
                            }
                            $_file = new ZendT_File($name, $value->get(), $type);
                            $value = $_file->toFilenameCrypt();
                            $row[$key . '_id'] = $_file->getId();
                            $row[$key . '_name'] = $name;
                            $row[$key . '_type'] = $type;
                            $row[$key . '_file'] = $value;
                        } elseif ($value instanceof ZendT_Type_FileSystem) {
                            $_file = $value->getFile();
                            if ($_file) {
                                $row[$key . '_name'] = $_file->getName();
                                $row[$key . '_type'] = $_file->getType();
                                $row[$key . '_id'] = $_file->getId();
                                $row[$key . '_file'] = $_file->toFilenameCrypt();
                                $value = $_file->getName();
                            } else {
                                unset($row[$key]);
                            }
                        } elseif ($value instanceof ZendT_Type) {
                            $value = $value->get();
                        }
                    }
                    $listOptions = $this->getModel()->getListOptions();
                    foreach ($this->getColumns() as $column) {
                        if (!$dataGrid->isRowFormated()) {
                            if (isset($listOptions[$column->getName()])) {
                                $chave = array_search($row[$column->getName()], $listOptions[$column->getName()]);
                                if ($chave !== false) {
                                    $row[$column->getName()] = $column->format($chave);
                                }
                            }
                            $row[$column->getName()] = $column->format($row[$column->getName()]);
                        } else {
                            if (isset($listOptions[$column->getName()])) {
                                $chave = array_search($row[$column->getName()], $listOptions[$column->getName()]);
                                if ($chave !== false) {
                                    $row[$column->getName()] = $chave;
                                }
                            }
                        }
                    }
                }

                // $referenceMap = $this->getMapper()->getReferenceMap();
                // if (count($referenceMap) > 0) {
                // foreach ($referenceMap as $column => $prop) {
                // $column = strtolower($column);
                // if (isset($row[$column]) && $row[$column]) {
                // $id = $row[$column];
                // $_mapper = new $prop['mapper'];
                // $action = 'set' . $this->getMapper()->fieldToMethod($prop['column']);
                // unset($row[$column]);
                // $row[$column] = $_mapper->$action($id)->retrieveRow();
                // }
                // }
                // }
                $this->_prepareRetrieveRow($row);

                if ($multi == false) {
                    $result = $row;
                    break;
                } else {
                    $result[] = $row;
                }
            }
            return $result;
        }

        /**
         * @deprecated since version 1.1
         */
        public function retriveAction() {
            $this->retrieveAction();
        }

        /**
         * 
         */
        public function retrieveAction() {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);
            $json = new ZendT_Json_Result();
            try {
                $row = $this->_retrieve();
                if (!$row) {
                    $row = array('found' => false);
                }
                $json->setResult($row);
            } catch (Exception $Ex) {
                $json->setException($Ex);
            }
            echo $json->render();
        }

        public function disableHotkeys() {
            $this->_hotkeys = '';
            return $this;
        }

        public function getHotkeys() {
            return $this->_hotkeys;
        }

        /**
         * Retorna as colunas da visualização
         *
         * @return \ZendT_Grid_Column[]
         */
        public function getColumns($data = false) {
            $columns = $this->getGrid()->getColModel()->getColumns();
            if (count($columns) == 0) {
                if (!$this->getGrid()->getSortName()) {
                    $order = true;
                }

                $columns = $this->getMapper()->getColumns()->getColumnsGrid($data);
                foreach ($columns as $column) {
                    $this->getGrid()->addColumn($column);
                    if ($order) {
                        if (!$column->getHidden()) {
                            $this->getGrid()->setSortName($column->getTableAndFieldName());
                            $this->getGrid()->setSortOrder('DESC');
                            $order = false;
                        }
                    }
                }
                $columns = $this->getGrid()->getColModel()->getColumns();
            }
            return $columns;
        }

        /**
         * Retona o objeto de modelo
         *
         * @return ZendT_Db_Table_Abstract
         */
        public function getModel() {
            return $this->getMapper()->getModel();
        }

    }
    