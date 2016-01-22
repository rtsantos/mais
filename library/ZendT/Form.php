<?php

    /**
     * Classe para renderização de um Formulário HTML
     * 
     * @package ZendT
     * @subpackage Form
     * @author rsantos
     */
    class ZendT_Form extends ZendX_JQuery_Form {

        /**
         *
         * @var array 
         */
        protected $_errorsValid;

        /**
         *
         * @var bool 
         */
        protected $_enablejQueryValidate;

        /**
         *
         * @var bool
         */
        protected $_enableFocusFirstElement;

        /**
         *
         * @param array $options 
         */
        public function __construct($options = null) {
            parent::__construct($options);
            $this->_errorsValid = array();
            $this->_enablejQueryValidate = false;
            $this->_enableFocusFirstElement = true;
            #$this->setAttrib('id', 'zendt_form');
            $this->setName('zendt_form');
        }

        /**
         *
         * @param bool $value
         * @return \ZendT_Form 
         */
        public function enablejQueryValidate($value = true) {
            $this->_enablejQueryValidate = $value;
            return $this;
        }

        /**
         *
         * @param bool $value
         * @return \ZendT_Form 
         */
        public function enableFocusFirstElement($value = true) {
            $this->_enableFocusFirstElement = $value;
            return $this;
        }

        /**
         * Load the default decorators
         *
         * @return Zend_Form
         */
        public function loadDefaultDecorators() {
            if ($this->loadDefaultDecoratorsIsDisabled()) {
                return $this;
            }

            $decorators = $this->getDecorators();
            if (empty($decorators)) {
                $this->addDecorator('FormElements')
                        ->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'zend_form'))
                        ->addDecorator('Form');
            }
            return $this;
        }

        /**
         *
         * @param Zend_View_Interface $view
         * @return type 
         */
        public function render(Zend_View_Interface $view = null) {
            $element = new ZendT_Form_Element('clear_both');
            $element->setDecorators(array(new ZendT_Form_Decorator_ClearBoth()));
            $this->addElement($element);
            if ($this->_enablejQueryValidate) {
                $onLoad = $this->getView()->placeholder('onLoad')->getValue();
                $onLoad['jQueryValidate'] = "jQuery('#" . $this->getId() . "').validate({ignore:[]});";
                $this->getView()->placeholder('onLoad')->set($onLoad);
            }

            if ($this->_enableFocusFirstElement) {
                $onLoad = $this->getView()->placeholder('onLoad')->getValue();
                $onLoad['jQueryValidate'] = "focusFirstElement('#" . $this->getId() . " input, #" . $this->getId() . " textare, #" . $this->getId() . " select');";
                $this->getView()->placeholder('onLoad')->set($onLoad);
            }
            $enableTinyMCE = false;
            $elements = $this->getElements();
            $tinyMCE = '';
            foreach ($elements as $element) {
                if ($element instanceof ZendT_Form_Element_Textarea) {
                    if ($element->isEditorHtml()) {
                        $tinyMCE.= "tinyMCE.get('" . $element->getId() . "').save();";
                        $enableTinyMCE = true;
                    }
                }
            }

            if ($enableTinyMCE) {
                $onLoad = $this->getView()->placeholder('onLoad')->getValue();
                $onLoad['tinyMCE'] = "jQuery('#" . $this->getId() . "').submit(function(){" . $tinyMCE . "});";
                $this->getView()->placeholder('onLoad')->set($onLoad);
            }
            return parent::render($view);
        }

        /**
         * Adiciona um agrupador de campos
         * 
         * @param array $elements
         * @param type $name
         * @param array $options 
         */
        public function addDisplayGroup(array $elements, $name, $options = null) {
            $options['displayGroupClass'] = 'ZendT_Form_DisplayGroup';
            parent::addDisplayGroup($elements, $name, $options);
            if ($options['legend']) {
                $this->_displayGroups[$name]->setLegend($options['legend']);
            }
            if ($options['id']) {
                $this->_displayGroups[$name]->setAttrib('id', $options['id']);
            }
        }

        /**
         * Ordena os elementos para renderização do formulário
         *
         * @param array $order 
         */
        public function sortElements($order) {
            $_elementsOrder = array();
            $_elementsNotOrder = array();

            $_order = 1;
            foreach ($this->_order as $elementName => &$value) {
                if (is_numeric($_order)) {
                    $value = $_order;
                }
                $_order++;
            }

            $_order = 1;
            foreach ($order as $elementName) {
                if (isset($this->_order[$elementName])) {
                    $_elementsOrder[$elementName] = $_order;
                    $_order++;
                }
            }
            foreach ($this->_order as $elementName => $value) {
                if (!$_elementsOrder[$elementName]) {
                    $_elementsNotOrder[$elementName] = $_order;
                    $_order++;
                }
            }
            foreach ($_elementsOrder as $elementName => $order) {
                $this->_order[$elementName] = $order;
            }
            foreach ($_elementsNotOrder as $elementName => $order) {
                $this->_order[$elementName] = $order;
            }
            $this->_orderUpdated = true;
        }

        /**
         * Prepara o valor que será carregado no elemento,
         * esse valor pode conter macros de data e sessão do logon.
         * 
         * @param string $value
         * @param ZendT_Form_Element_Date $element
         * @return string
         */
        public function _parseValue($value, $element = null, $type = '') {

            if ($element instanceof ZendT_Form_Element_Date || $element instanceof ZendT_Form_Element_DateTime || $element instanceof ZendT_Form_Element_DateMulti || $element instanceof ZendT_Form_Element_DateDynamic) {

                $value = trim($value);
                $values = array();
                if (strpos($value, ';')) {
                    $sep = ';';
                    $values = explode(';', $value);
                } else if (strpos($value, ' ')) {
                    $sep = ' ';
                    $values = explode(' ', $value);
                } else if ($value != '') {
                    $sep = '';
                    $values = array($value);
                }

                if ($element instanceof ZendT_Form_Element_DateTime) {
                    $type = 'DateTime';
                } else {
                    $type = 'Date';
                }
                $value = '';
                foreach ($values as $newValue) {
                    $date = ZendT_Type_Date::parse($newValue, $type);
                    if ($value) {
                        $value.= $sep . str_replace(" ", "-", $date->get());
                    } else if ($type == 'DateTime') {
                        $value = $date->get();
                    } else {
                        $value = str_replace(" ", "-", $date->get());
                    }
                }
            } else if (strtolower(substr($value, 0, 5)) == 'logon') {
                $levels = explode('.', $value);
                $_sessionValue = $_SESSION;
                foreach ($levels as $level) {
                    $_sessionValue = $_sessionValue[$level];
                }
                $value = $_sessionValue;
            }
            if ($element instanceof ZendT_Form_Element_Seeker) {
                $_mapperView = $element->getMapperView();
                if ($_mapperView) {
                    $_mapperView = new $_mapperView();
                    $where = $_mapperView->getColumns()->mountWhere('id', $value);
                    $value = $_mapperView->recordset($where);
                }
            }
            return $value;
        }

        /**
         * Carrega o Profile do Usuário
         * 
         * @param type $objectName 
         */
        public function loadProfile($_profile) {

            $groups = array();
            $fieldsProfile = array();
            $elements = array_keys($this->getElements());

            foreach ($_profile as $group => $config) {

                if (!isset($config['fields']) || !is_array($config['fields'])) {
                    continue;
                }

                foreach ($config['fields'] as $name => $element) {

                    $fieldsProfile[] = $name;

                    $_element = $this->getElement($name);
                    if (!$_element) {
                        continue;
                    }

                    if ($element['autoselect'] && !($_element instanceof ZendT_Form_Element_Seeker)) {
                        #echo $name.": ".$element['autoselect'];
                        $_element = new ZendT_Form_Element_Select($name);
                        $this->removeElement($name);
                        $this->addElement($_element);
                        if ($element['filter_value']){
                            $options = explode(";",$element['filter_value']);
                            foreach($options as $option){
                                $data = explode("|",$option);                                
                                $_element->addMultiOption($data[0], $data[1]);
                            }
                        }
                    } else {
                        if ($element['filter_value'] && $_element instanceof ZendT_Form_Element_Select) {
                            $filters = explode(';', $element['filter_value']);
                            $options = $_element->getMultiOptions();
                            foreach ($options as $key => $option) {
                                $exists = false;
                                foreach ($filters as $filter) {
                                    if ($filter == $key || $filter == $option) {
                                        $exists = true;
                                        break;
                                    }
                                }
                                if (!$exists) {
                                    unset($options[$key]);
                                }
                            }
                            $_element->setMultiOptions($options);
                        }
                    }
                    
                    if (isset($element['order'])) {
                        $_element->setOrder($element['order']);
                    }
                    if (isset($element['label'])) {
                        $_element->setLabel($element['label']);
                    }
                    if ($element['value']) {
                        $element['value'] = $this->_parseValue($element['value'], $_element);
                        if($element['autoselect']){
                            $row = $element['value']->getRow();
                            $element['value'] = $row['id']->get();
                        }

                        $_element->setValue($element['value']);
                        $_element->setAttrib('valueExp', true);
                    }

                    if ($element['value'] && $_element instanceof ZendT_Form_Element_Select) {
                        $_element->setAttrib('selected', $element['value']);
                    }


                    if ($_element instanceof ZendT_Form_Element_Seeker) {

                        if ($element['autoselect']) {
                            $_element->autoSelect(true);
                            if ($element['filter_value']) {
                                $_element->setWhere($element['filter_value']);
                            }
                        } else if ($element['filter_value']) {
                            $whereOp = "=";
                            $whereValue = $element['filter_value'];
                            if (substr($whereValue, 0, 10) == 'expression') {
                                $whereValue = substr($whereValue, 11);
                                $whereValue = str_replace("'", "\'", $whereValue);
                                $whereField = " ";
                                $whereOp = 'expression';
                            }

                            if (substr($whereValue, 0, 10) == 'javascript') {
                                list($whereField, $whereValue) = explode($whereOp, $element['filter_value']);
                                $whereValue = substr($whereValue, 11);
                            } else {
                                $whereValue = "'" . $whereValue . "'";
                            }

                            $onFilter = "function(){"
                                    . "  var where = new TWhere('AND'); "
                                    . "  where.addFilter({"
                                    . "     field: '{$whereField}',"
                                    . "     value: {$whereValue},"
                                    . "     operation: '{$whereOp}'"
                                    . "  });"
                                    . "  return where.toJson(); "
                                    . "}";
                            $_element->setOnFilter($onFilter);
                        }
                    }

                    if ($element['width']) {
                        if (is_numeric($element['width'])) {
                            $element['width'].= 'px';
                        }
                        $_element->setAttrib('css-width', $element['width']);
                    }
                    if ($element['height']) {
                        $_element->setAttrib('css-height', $element['height'] . 'px');
                    }
                    if ($element['box-width']) {
                        if (is_numeric($element['box-width'])) {
                            $element['box-width'].= 'px';
                        }
                        $_element->setAttribBox('css-min-width', $element['box-width']);
                    }
                    if ($element['box-height']) {
                        $_element->setAttribBox('css-min-height', $element['box-height'] . 'px');
                    }
                    if ($element['hidden']) {
                        $_element->setDecorators(array(new ZendT_Form_Decorator_Hidden()));
                    }
                    if ($element['readonly']) {
                        $_element->setAttrib('readonly', true);
                        $_element->setAttrib('disabled', true);
                        if ($_element->helper == 'seeker') {
                            $_element->setSearchAttrib('disabled', true);
                        }
                    }

                    if (!$this->getElement($name)->isRequired()) {
                        $this->getElement($name)->setRequired($element['required']);
                    }

                    $groups[$group]['fields'][] = $name;
                    $groups[$group]['label'] = $config['label'];
                    $groups[$group]['style'] = '';
                    $groups[$group]['group_repeat'] = $config['group_repeat'];
                }
            }

            /**
             * Os campos não configurados no profile serão adicionados ao formulário como HIDDEN
             */
            $hiddenFields = array_diff($elements, $fieldsProfile);
            foreach ($hiddenFields as $field) {
                foreach ($this->getElement($field)->getDecorators() as $name => $values) {
                    $this->getElement($field)->removeDecorator($name);
                }
                $this->getElement($field)->addDecorator(new ZendT_Form_Decorator_Hidden());
            }

            if ($groups) {

                foreach ($groups as $name => $group) {

                    if (!$group['fields']) {
                        continue;
                    }

                    $group['style'] = '';
                    if ($name == 'padrao' || $name == 'cols-default') {
                        $group['label'] = '';
                        $group['style'] = 'border: 0px;';
                    }

                    $groupRepeat = "";
                    if ($group['group_repeat']) {
                        $groupRepeat = $name;
                    }

                    $this->addDisplayGroup(
                            $group['fields'], 'display-group-' . $name, array(
                        'id' => 'display-group-' . $name,
                        'legend' => $group['label'],
                        'style' => $group['style'],
                        'group_repeat' => $groupRepeat,
                            )
                    );
                }
            }
        }

        public function loadProfileFilter($fields, $params) {
            $this->enablejQueryValidate();

            $element = new ZendT_Form_Element_Hidden('_search');
            $element->setDecorators(array(new ZendT_Form_Decorator_Hidden()));
            $element->setValue('1');
            $this->addElement($element);

			if(count($fields)){
				foreach ($fields as $field => $config) {
					if ($config['seeker']) {
						$baseUri = $itens = ZendT_Lib::mapperViewToArrayUri($config['seeker']['mapperView']);
						foreach ($config['seeker']['fields'] as $searchName => $searchProp) {
							unset($config['seeker']['fields'][$searchName]);
							break;
						}

						$element = new ZendT_Form_Element_Seeker($field);
						$element->setSufix(str_replace('id_', '', $field));
						$element->setIdField('id');
						$element->setSearchField($searchName);
						$element->setSearchAttribs($searchProp);
						$element->modal()->setWidth(800);
						$element->modal()->setHeight(400);
						$element->url()->setGrid("/{$baseUri['module']}/{$baseUri['controller']}/grid");
						$element->url()->setSearch("/{$baseUri['module']}/{$baseUri['controller']}/seeker-search");
						$element->url()->setRetrive("/{$baseUri['module']}/{$baseUri['controller']}/retrive");
						$element->url()->setAutoComplete("/{$baseUri['module']}/{$baseUri['controller']}/auto-complete");
						//$element->enableAutoComplete();

						if ($config['multiple'] !== '0') {
							$element->setMultiple(true);
						} else {
							$element->setMultiple(false);
						}
						$element->setMapperView($config['seeker']['mapperView']);

						//Procura os elementos que referenciam essa seeker, para criar uma dependência (filterRefer)
						foreach ($fields as $field1 => $config1) {
							if (isset($config1['seeker']) && isset($config1['seeker']['filter'])) {
								$filterRefer = $config1['seeker']['filter'];
								if ($filterRefer) {
									foreach ($filterRefer as $filter1 => $key1) {
										if ($filter1 == $field) {
											$element->addFilterRefer($field1);
										}
									}
								}
							}
						}

						$_where = $config['seeker']['where'];
						$preFilter = $config['seeker']['filter'];
						if ($_where && !$preFilter) {
							$element->setWhere($_where);
						} else if ($preFilter) {
							/* print_r($config['seeker']);
							  exit; */

							$dynamicWhere = "var where = new TWhere('AND');";
							if ($_where) {
								$whereFilters = $_where->getFilters();
								foreach ($whereFilters as $i => $key) {
									$value = $key['value'];
									if (is_array($value)) {
										$value = $value[0];
									}
									$dynamicWhere .= "
									where.addFilter({
									   field: '{$key['field']}',
									   value: '{$value}',
									   mapper: '{$key['mapper']}',
									   operation: '{$key['operation']}'
									});
								";
								}
							}

							foreach ($preFilter as $filter => $key) {
								if ($filter) {
									$label = $fields[$filter]['label'];
									$operation = (!$key['operation'] ? 'in' : $key['operation']);
									$dynamicWhere .= "
										var value1 = $('#{$filter}').val();
										var value2 = $('#{$filter}-multiple').val();
										if(!value1 && !value2){
											var searchid = $('#{$field}').attr('searchid');
											$('#group-' + searchid + ' input').val('');
											alert('Favor preencher o campo {$label}!');
											var searchid = $('#{$filter}').attr('searchid');
											$('#' + searchid).focus();
											return false;
										}
										var value = (value1?value1:value2);
										if(value.indexOf(';') != -1){
											while(value.indexOf(';') != -1){
												value = value.replace(';',',');
											}
											value = [value];
										}
	 
										where.addFilter({
										   field: '{$key['field']}',
										   value: value,
										   mapper: '{$key['mapper']}',
										   operation: '{$operation}'
										});
									";
								}
							}
							$dynamicWhere = "function(){ {$dynamicWhere} return where.toJson(); }";
							#echo $preWhere;die;
							$element->setOnFilter($dynamicWhere);
						}
						foreach ($config['seeker']['fields'] as $fieldName => $fieldProp) {
							$element->addField($fieldName, $fieldName, 'text', $fieldProp);
						}
					} else if ($config['autocomplete']) {
						$element = new ZendT_Form_Element_AutoComplete($field);
						$url = ZendT_Url::getUri(true) . '/auto-complete/suggest/1/column/' . $field . '/profile/' . $params['profile'];
						$element->setDataSource($url);

						$extraParams = array('filters' => new ZendT_JS_Command("function(){
							var formData = jQuery('#" . $this->getId() . "').serializeArray();
							var data = '';
							for(var index in formData){
								data = data + '&' + formData[index].name + '=' + formData[index].value;
							}
							return data.substr(1);
						}"));

						$element->setJQueryParam('limit', 100);
						$element->setJQueryParam('extraParams', $extraParams);
						$element->setJQueryParam('showButtonSearch', true);
						if ($config['multiple'] !== '0') {
							$element->setJQueryParam('multiple', true);
						} else {
							$element->setJQueryParam('multiple', false);
						}

						$element->setJQueryParam('multipleSeparator', ';');
						$element->setJQueryParam('mustMatch', true);
						$element->setJQueryParam('autoFill', true);
					} else if (in_array($config['type'], array('Date', 'DateTime'))) {
						if (getBrowser() != 'IE 8.0') {
							$element = new ZendT_Form_Element_DateDynamic($field);
							$_profile = new Profile_DataView_ObjectView_MapperView();
							$_profile->newRow()->setId($params['profile'])->retrieve();
							if ($_profile->getObjeto()) {
								$objeto = $_profile->getObjeto()->toPhp();
								$objeto = new $objeto();
								$columns = $objeto->getColumns()->toArray();
								if ($columns[$field]['bind']) {
									$element->setJQueryParam('fix_elements', count($columns[$field]['bind']));
								}
							}
							if ($config['max_periodo']) {
								$element->setMaxPeriodo($config['max_periodo']);
							}
						} else {
							$element = new ZendT_Form_Element_DateMulti($field);
						}
					} else if (in_array($config['type'], array('Numeric', 'Number'))) {
						$element = new ZendT_Form_Element_NumericMulti($field);
					} else {
						$element = new ZendT_Form_Element_Text($field);
					}
					/**
					 * Trata o valor a ser preenchido no elemento
					 */
					if ($params[$field]) {
						$value = $params[$field];
					} else {
						$value = $config['value'];
					}
					$value = $this->_parseValue($value, $element, $config['type']);
					/**
					 * Preenche as propriedaddes do elemento
					 */
					$element->setValue($value);
					$element->setLabel($config['label'] . ':');
					$element->setRequired($config['required']);
					if ($element instanceof ZendT_Form_Element_DateDynamic) {
						$element->addStyle('width', '90px');
					} else {
						$element->addStyle('width', '270px');
					}
					if ($config['hidden']) {
						$element->setDecorators(array(new ZendT_Form_Decorator_Hidden()));
					}
					#var_dump($config);die;
					$this->addElement($element);
				}
			}

            /* $element = new ZendT_Form_Element_Button('btPesquisar');
              $element->setDecorators(array(new ZendT_Form_Decorator_Button()));
              $element->setLabel('Pesquisar');
              $element->setIcon('ui-icon-search');

              $element->setAttrib('onClick', "jQuery('form').submit();");
              $this->addElement($element); */
        }

        /**
         * Retorna a lista de profile
         *
         * @param string $objectName
         * @return array
         */
        public function getListProfile($objectName) {
            return ZendT_Profile_FieldsForm::getListProfile($objectName);
        }

        /**
         * Valida se o formulário teve todos seus campos preenchidos
         * 
         * @param array $data
         * @return boolean 
         */
        public function isValid($data) {
            if ($data !== null) {
                $this->populate($data);
            }
            $isValid = true;
            $this->_errorsValid = array();
            foreach ($this->getElements() as $key => $element) {
                if ($element->isRequired() && $element->getValue() == '') {
                    $this->_errorsValid[$key][] = '<b>' . $element->getLabel() . '</b> É um campo obrigatório!';
                    $isValid = false;
                }
            }
            return $isValid;
        }

        /**
         * Retorna as mensagens de erro gerado pelo isValid
         *
         * @return string 
         */
        public function getErrorsValid() {
            $messages = '';
            foreach ($this->_errorsValid as $message) {
                foreach ($message as $value) {
                    $messages.= $value . "<br /><br />";
                }
            }
            return $messages;
        }

    }

?>