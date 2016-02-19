<?php

   /**
    * Form Element para Seeker do ZendT
    *
    * @category    ZendT
    * @author      ksantoja
    */
   class ZendT_Form_Element_Seeker extends ZendT_Form_Element {

       /**
        *
        * 
        * @var ZendT_Form_Element_Seeker_Modal
        */
       private $_modal;

       /**
        *
        * 
        * @var ZendT_Form_Element_Seeker_Url
        */
       private $_url;

       /**
        *
        * @var bool 
        */
       private $_enableAutoComplete = false;

       /**
        * Define o helper
        */
       public $helper = "seeker";

       public function __construct($spec, $options = null, $urlLocal = false) {
           $this->_modal = new ZendT_Form_Element_Seeker_Modal();
           $this->_url = new ZendT_Form_Element_Seeker_Url($urlLocal);
           parent::__construct($spec, $options);
           $decorators = array(new ZendT_Form_Decorator_Default());
           $this->setDecorators($decorators);
           $button = new ZendT_Form_Element_Button('btSearch');
           $button->setIcon('ui-icon-search');
           $this->setAttrib('button', $button);
       }

       public function setName($name) {
           if (strpos($name, '[') !== false) {
               $this->setAttrib('arrayName', substr($name, 0, strpos($name, '[')));
           } else if (strpos($name, '-') !== false) {
               $this->setAttrib('arrayName', substr($name, 0, strpos($name, '-')));
           } else {
               return parent::setName($name);
           }
           return $this;
       }

       /**
        * Retorna o modal do elemento
        * 
        * @return object 
        */
       public function modal() {
           return $this->_modal;
       }

       /**
        * Retorna o url do elemento
        * 
        * @return object 
        */
       public function url() {
           return $this->_url;
       }

       /**
        * Configura o sufixo para os campos de search e display
        * 
        * @param string $value
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setSufix($value) {
           $this->setAttrib('suffix', $value);
           return $this;
       }

       /**
        * Retorna o sufixo para os campos de search e display
        * 
        * @return string
        */
       public function getSufix() {
           return $this->getAttrib('suffix');
       }

       /**
        * Configura o sufixo para os campos de search e display
        * 
        * @param string $value
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setSuffix($value) {
           $this->setAttrib('suffix', $value);
           return $this;
       }

       /**
        * Retorna o sufixo para os campos de search e display
        * 
        * @return string
        */
       public function getSuffix() {
           return $this->getAttrib('suffix');
       }

       /**
        * Configura o sufixo para os campos de search e display
        * 
        * @param string $value
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setPrefix($value) {
           $this->setAttrib('prefix', $value);
           return $this;
       }

       /**
        * Retorna o sufixo para os campos de search e display
        * 
        * @return string
        */
       public function getPrefix() {
           return $this->getAttrib('prefix');
       }

       /**
        *
        * @param type $name
        * @return \ZendT_Form_Element_Text 
        */
       public function getField($key) {
           $obj = $this->getAttrib('prop' . ucfirst($key));
           if (!is_object($obj)) {
               $obj = $this->getAttrib('propId');
               if (is_object($obj) && $obj->getAttrib('field') != $key) {
                   $obj = null;
               }

               if (!is_object($obj)) {
                   $obj = $this->getAttrib('propSearch');
                   if (is_object($obj) && $obj->getAttrib('field') != $key) {
                       $obj = null;
                   }
               }

               if (!is_object($obj)) {
                   $obj = $this->getAttrib('propDisplay');
                   if (is_object($obj) && $obj->getAttrib('field') != $key) {
                       $obj = null;
                   }
               }
           }
           return $obj;
       }

       /**
        * 
        * @param string $key
        * @param string $name
        * @param string $type
        * @return \ZendT_Form_Element_Seeker
        */
       public function setField($key, $name = '', $type = 'text', $attribs = array()) {
           return $this->addField($key, $name, $type, $attribs);
       }

       /**
        * 
        * @param string $key
        * @param string $name
        * @param string $type
        * @return \ZendT_Form_Element_Seeker
        */
       public function addField($key, $name = '', $type = 'text', $attribs = array()) {
           if ($name == '')
               $name = $key;
           $element = $this->getField($key);
           if (!($element instanceof ZendT_Form_Element)) {
               $objectElement = 'ZendT_Form_Element_' . ucfirst($type);
               $element = new $objectElement($name);
               $decorators = array();
               $decorators[] = new ZendT_Form_Decorator();
               $element->setDecorators($decorators);
               $element->setAttrib('field', $name);
               if (count($attribs) > 0) {
                   $element->setAttribs($attribs);
               }
               $fields = $this->getAttrib('fields');
               $fields[$name] = $name;
               $this->setAttrib('fields', $fields);
           }
           $this->setAttrib('prop' . ucfirst($key), $element);
           /**
            * @todo revisar
            */
           if ($this->_enableAutoComplete) {
               $this->enableAutoComplete();
           }
           return $this;
       }

       /**
        *
        * @param string $key 
        */
       private function getFieldName($key) {
           $element = $this->getField($key);
           if (!($element instanceof ZendT_Form_Element)) {
               require_once "ZendX/JQuery/Exception.php";
               throw new ZendX_JQuery_Exception(
               'Você deve definir um campo de retorno para Seeker' .
               ' utilize setField("' . $key . '") para definir'
               );
           }
           return $element->getAttrib('field');
       }

       /**
        * Define o campo que será retornado para retornar a chava do registro
        * 
        * @param string $value 
        */
       public function setIdField($name) {
           return $this->setField('id', $name, 'hidden');
       }

       /**
        * Retorna o nome do campo que será retornado para definir o registro
        *
        * @return string 
        */
       public function getIdField() {
           return $this->getFieldName('id');
       }

       /**
        * Define o campo que será retornado para retornar a chava do registro
        * 
        * @param string $value 
        */
       public function setSearchField($name) {
           return $this->setField('search', $name);
       }

       /**
        * Retorna o nome do campo que será retornado para definir o registro
        *
        * @return string 
        */
       public function getSearchField() {
           return $this->getFieldName('search');
       }

       /**
        * Define o campo que será retornado para retornar a chava do registro
        * 
        * @param string $value 
        */
       public function setDisplayField($name) {
           return $this->setField('display', $name);
       }

       /**
        * Retorna o nome do campo que será retornado para definir o registro
        *
        * @return string 
        */
       public function getDisplayField() {
           return $this->getFieldName('display');
       }

       /**
        * Passagem de uma função JavaScript para filtragem de informação
        * 
        * @param type $value
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setOnFilter($value) {
           $this->setAttrib('onFilter', $value);
           return $this;
       }

       /**
        * Avalia se o filtro que está sendo utilizado é válido 
        * para continuar a pesquisa
        * 
        * @param type $value
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setOnSearchValid($value) {
           $this->setAttrib('onSearchValid', $value);
           return $this;
       }

       /**
        *
        * @param type $value
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setOnNotFound($value) {
           $this->setAttrib('onNotFound', $value);
           return $this;
       }

       /**
        * Passagem de uma função JavaScript que será disparada na mudança de valor
        *
        * @param type $value
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setOnChange($value) {
           $this->setAttrib('onChange', $value);
           return $this;
       }

       /**
        * Passagem de uma função JavaScript que será disparada na mudança de valor
        *
        * @param type $value
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setOnResult($value) {
           $this->setAttrib('onResult', $value);
           return $this;
       }

       /**
        * Passagem de uma função JavaScript que será disparada na mudança de valor
        *
        * @param type $value
        * @return \ZendT_Form_Element_Seeker 
        */
       public function enableAutoComplete($url = '', $orderBy = '') {
           $this->_enableAutoComplete = true;
           $autoComplete = array();

           if ($url)
               $this->url()->setAutoComplete($url);
           else
               $this->url()->enableAutoComplete();

           $fields = $this->getAttrib('fields');

           $cmdOnResult = 'var data = {};' . "\n";
           $cmdOnFormat = "var itemFormat = '';\n";
           $index = 0;
           foreach ($fields as $field) {
               $cmdOnResult.= "            data.{$field} = row[{$index}]; \n";
               $element = $this->getField($field);
               $hidden = ($element instanceof ZendT_Form_Element_Hidden) ? true : false;
               if ($index > 0 && !$hidden) {
                   if (!$orderBy) {
                       $orderBy = $field;
                   }
                   if ($index % 2) {
                       $cmdOnFormat.= "            itemFormat = itemFormat + row[{$index}] + ', '; \n";
                   } else {
                       $cmdOnFormat.= "            itemFormat = itemFormat + '<i>'+row[{$index}]+'</i>, '; \n";
                   }
               }
               $index++;
           }

           $autoComplete['onResult'] = "function(event, row, formatted){
            {$cmdOnResult}
            jQuery('#{id}').TSeeker('loadData',data);
        }";

           $autoComplete['onFormat'] = "function(row){
            {$cmdOnFormat}
            return itemFormat;
        }";

           $autoComplete['extraParams'] = array('fields' => implode(',', $fields));
           $autoComplete['extraParams']+= array('order_by' => $orderBy);
           $this->setAttrib('autoComplete', $autoComplete);
           return $this;
       }
       
       public function enableEdit($url) {
           list($module, $controller) = explode('/', substr($url,1));
           if (!ZendT_Acl::getInstance()->isAllowed('update', $module . '.' . $controller)) {
               return $this;
           }

           $button = new ZendT_Form_Element_Button('btn_edit');
           //$button->setTitle(_i18n('Editar'));
           $button->setIcon('ui-icon-pencil');
           $button->setAttrib('url', ZendT_Url::getBaseUrl() . $url);
           $this->setAttrib('btn_edit', $button);
           return $this;
       }

       public function enableAdd($url) {
           list($module, $controller) = explode('/', substr($url,1));
           if (!ZendT_Acl::getInstance()->isAllowed('insert', $module . '.' . $controller)) {
               return $this;
           }

           $button = new ZendT_Form_Element_Button('btn_add');
           //$button->setTitle(_i18n('Adicionar'));
           $button->setIcon('ui-icon-plus');
           $button->setAttrib('url', ZendT_Url::getBaseUrl() . $url);
           $this->setAttrib('btn_add', $button);
           return $this;
       }

       /**
        * Muda o Helper para usar o AutoSelect/AutoComplete apenas.
        * 
        * @param bool $value
        * @return \ZendT_Form_Element_Seeker
        */
       public function autoSelect($value = true) {
           if ($value) {
               $this->helper = 'autoselect';
           } else {
               $this->helper = 'seeker';
           }
           return $this;
       }
       /**
        * 
        * @param string $value
        * @return \ZendT_Form_Element_Seeker
        */
       public function setFieldLevel($value) {
           $this->setAttrib('fieldLevel', $value);
           return $this;
       }
       
       public function setFieldOrder($value) {
           $this->setAttrib('fieldOrder', $value);
           return $this;
       }
       
       /**
        * 
        * @return string
        */
       public function getFieldLevel() {
           return $this->getAttrib('fieldLevel');
       }

       public function addFilterRefer($field) {
           $filterRefer = $this->getFilterRefer();
           $filterRefer[] = $field;
           $this->setAttrib('filterRefer', $filterRefer);
       }

       public function getFilterRefer() {
           return $this->getAttrib('filterRefer');
       }

       /**
        *
        * @return \ZendT_Form_Element_Seeker
        */
       public function enableMultiple() {
           $this->setAttrib('multiple', 1);
           $this->url()->enableMultiple();
           return $this;
       }

       /**
        *
        * @param bool $value
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setMultiple($value = true) {
           $this->setAttrib('multiple', ($value ? 1 : 0));
           return $this;
       }

       public function setLabels($fieldName, $label) {
           
       }

       /**
        *
        * @param string $name
        * @param string $value
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setIdAttrib($name, $value) {
           $this->getField('id')->setAttrib($name, $value);
           return $this;
       }

       /**
        *
        * @param ZendT_Db_Where $where
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setWhere($where) {
           if ($this->helper == 'seeker'){
               $this->url()->setWhere($where);
           }else{
               $this->setAttrib('where', $where);
           }
           return $this;
       }

       /**
        *
        * @param string $name
        * @param string $value
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setSearchAttrib($name, $value) {
           $this->getField('search')->setAttrib($name, $value);
           return $this;
       }

       /**
        *
        * @param string $name
        * @param string $value
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setDisplayAttrib($name, $value) {
           $this->getField('display')->setAttrib($name, $value);
           return $this;
       }

       /**
        *
        * @param string $name
        * @param string $value
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setBtSearchAttrib($name, $value) {
           $_button = $this->getAttrib('button');
           $_button->setAttrib($name, $value);
           $this->setAttrib('button', $_button);
           return $this;
       }

       public function setAllFieldsAttrib($name, $value) {
           $this->setSearchAttrib($name, $value);
           $this->setDisplayAttrib($name, $value);
           $this->setBtSearchAttrib($name, $value);
           return $this;
       }

       /**
        *
        * @param array $prop
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setIdAttribs($prop) {
           if (count($prop) > 0) {
               foreach ($prop as $name => $value) {
                   $this->getField('id')->setAttrib($name, $value);
               }
           }
           return $this;
       }

       /**
        *
        * @param array $prop
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setSearchAttribs($prop) {
           if (count($prop) > 0) {
               foreach ($prop as $name => $value) {
                   $this->getField('search')->setAttrib($name, $value);
               }
           }
           return $this;
       }

       /**
        *
        * @param array $prop
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setDisplayAttribs($prop) {
           if (count($prop) > 0) {
               foreach ($prop as $name => $value) {
                   $this->getField('display')->setAttrib($name, $value);
               }
           }
           return $this;
       }

       /**
        *
        * @param array $prop
        * @return \ZendT_Form_Element_Seeker 
        */
       public function setBtSearchAttribs($prop) {
           $_button = $this->getAttrib('button');
           if (count($prop) > 0) {
               foreach ($prop as $name => $value) {
                   $_button->setAttrib($name, $value);
               }
           }
           $this->setAttrib('button', $_button);
           return $this;
       }

       /**
        * 
        */
       public function getId() {
           $sufix = $this->getSufix();
           if (!$sufix) $sufix = $this->getName();
           $idSearch = $this->getAttrib('propSearch')->getId();
           $idSearch.= '_' . $sufix;
           return $idSearch;
       }

       /**
        * Função que retorna um array pronto para ser transformado em jquery
        * 
        * @return array
        */
       public function jQueryParams() {
           $params = array();
           $params['modal'] = $this->modal()->toArray();
           $params['url'] = $this->url()->toArray();
           return $params;
       }

       /**
        * Função para rendenizar o Seeker
        *  
        */
       public function renderSeeker() {
           
       }

       /**
        * 
        * @return string
        */
       public function getMapperView() {
           return $this->getAttrib('mapperView');
       }

       /**
        * 
        * @param string $name
        * @return \ZendT_Form_Element_Seeker
        */
       public function setMapperView($name) {
           $this->setAttrib('mapperView', $name);
           return $this;
       }

       /**
        * 
        * @param Zend_View_Interface $view
        * @return string
        */
       public function render(Zend_View_Interface $view = null) {
           $this->setJQueryParams($this->jQueryParams());
           return parent::render($view);
       }

   }
   