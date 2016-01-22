<?php

   /**
    * 
    */
   class ZendT_Db_Column_View {

       /**
        * @var string
        */
       private $_name;

       /**
        *
        * @var ZendT_Db_Column_View_Profile 
        */
       private $_profile;

       /**
        *
        * @var array
        */
       private $_profileDefault;

       /**
        *
        * @var array
        */
       private $_columns = array();
       private $_adapter = null;
       private $_replaceAlias = array();

       /**
        * 
        */
       public function __construct($name, $profile, $retrieve = false) {
           $this->_name = $name;
           $this->_profileDefault = $profile;
           if (!$retrieve) {
               $this->loadProfile($this->_name);
           }
       }

       public function loadProfile($object) {
           /**
            * Consultar o Profile cadastrado pelo usuário e alterar o $profile Default
            */
           if (!strpos($this->_name, '_ObjectView_')) {
               $profileUser = ZendT_Profile::get($this->_name, 'G');
               if ($profileUser) {
                   $fields = $profileUser['cols-detail']['fields'];
                   if ($fields) {
                       $arrFields = array_keys($fields);
                       $hiddenFields = array_diff($this->_profileDefault['order'], $arrFields);
                       $this->_profileDefault['hidden'] = array();
                       $this->_profileDefault['order'] = array();
                       foreach ($hiddenFields as $field) {
                           $this->_profileDefault['hidden'][] = $field;
                       }
                       foreach ($fields as $field => $config) {
                           if (isset($config['width'])) {
                               $this->_profileDefault['width'][$field] = $config['width'];
                           }
                           if (isset($config['align'])) {
                               $this->_profileDefault['align'][$field] = $config['align'];
                           }
                           if (isset($config['label'])) {
                               $this->_profileDefault['label'][$field] = $config['label'];
                           }
                           if (isset($config['value']) && $config['value']) {
                               $this->_profileDefault['value'][$field] = $config['value'];
                           }
                           if (isset($config['subtotal'])) {
                               $this->_profileDefault['subtotal'][$field] = $config['subtotal'];
                           }
                           if (isset($config['hidden']) && $config['hidden']) {
                               $this->_profileDefault['hidden'][] = $field;
                           }
                           $this->_profileDefault['order'][] = $field;
                       }
                   }
               }
           }
       }

       /**
        *
        * @param string $aliasColumn
        * @param string $aliasTable
        * @param string $columnName
        * @param string|ZendT_Type $mapperName
        * @param string $label
        * @param int $size
        * @param string $type
        * @return \ZendT_Db_Column_View 
        */
       public function add($aliasColumn, $aliasTable, $columnName, $mapperName, $label = null, $type = null, $operation = null, $input=null) {

           $aliasColumn = strtolower($aliasColumn);
           $this->_columns[$aliasColumn] = array();
           $this->_columns[$aliasColumn]['aliasTable'] = $aliasTable;
           $this->_columns[$aliasColumn]['columnName'] = $columnName;
           $this->_columns[$aliasColumn]['mapperName'] = $mapperName;

           if (isset($this->_profileDefault['label'][$aliasColumn])) {
               $this->_columns[$aliasColumn]['label'] = $this->_profileDefault['label'][$aliasColumn];
           } else {
               $this->_columns[$aliasColumn]['label'] = $label;
           }

           $this->_columns[$aliasColumn]['operation'] = $operation;
           $this->_columns[$aliasColumn]['input'] = $input;

           #if ($type == null){
           if (is_object($mapperName)) {
               $_type = $mapperName;
           } else {
               try {
                   $_obj = new $mapperName();
                   $_type = $_obj->phpToType('', $columnName);
               } catch (Exception $e) {
                   null;
               }
           }
           if ($_type instanceof ZendT_Type_Date) {
               $type = $_type->getType();
           } elseif ($_type instanceof ZendT_Type_Number) {
               $type = 'Number';
           }
           if ($type == null || !$type) {
               $type = 'String';
           }
           #}
           $this->_columns[$aliasColumn]['type'] = $type;
           return $this;
       }

       /**
        *
        * @param string $aliasColumn
        * @param string $expression
        * @param string|ZendT_Type $mapperName
        * @param string $label
        * @param int $size
        * @param string $type
        * @return \ZendT_Db_Column_View 
        */
       public function addExpression($aliasColumn, $expression, $mapperName, $label = null, $type = null, $operation = null) {
           $aliasColumn = strtolower($aliasColumn);
           $this->_columns[$aliasColumn] = array();
           $this->_columns[$aliasColumn]['aliasTable'] = 'expression';
           $this->_columns[$aliasColumn]['expression'] = $expression;
           $this->_columns[$aliasColumn]['mapperName'] = $mapperName;
           $this->_columns[$aliasColumn]['label'] = $label;
           $this->_columns[$aliasColumn]['type'] = $type;
           $this->_columns[$aliasColumn]['operation'] = $operation;
           return $this;
       }

       /**
        * Retorna as propriedades das colunas
        *
        * @param string $aliasColumn
        * @param string $prop
        * @return array
        */
       public function get($aliasColumn, $prop = null) {
           if ($prop == null) {
               return $this->_columns[$aliasColumn];
           } else {
               return $this->_columns[$aliasColumn][$prop];
           }
       }

       /**
        * 
        * @param string $aliasColumn
        * @param array|string $value
        * @return ZendT_Db_Where
        */
       public function mountWhere($aliasColumn, $value) {
           $value = explode(';', $value);
           $where = new ZendT_Db_Where();
           if ($this->_columns[$aliasColumn]['expression']) {
               $where->addFilter(new Zend_Db_Expr($this->_columns[$aliasColumn]['expression']), $value, 'in', $this->_columns['mapperName']);
           } else {
               $where->addFilter($this->_columns[$aliasColumn]['aliasTable'] . '.' . $this->_columns[$aliasColumn]['columnName'], $value, 'in', $this->_columns['mapperName']);
           }
           return $where;
       }

       /**
        * Configura as propriedades da coluna
        *
        * @param string $aliasColumn
        * @param array $prop
        * @return \ZendT_Db_Column_View 
        */
       public function set($aliasColumn, $prop) {
           $this->_columns[$aliasColumn] = $prop;
           return $this;
       }

       /**
        * Remove uma coluna
        *
        * @param string $aliasColumn
        * @return \ZendT_Db_Column_View 
        */
       public function remove($aliasColumn) {
           unset($this->_columns[$aliasColumn]);
           return $this;
       }

       public function _getAdapter() {
           if ($this->_adapter == null) {
               $this->_adapter = new $this->_name();
               $this->_adapter = $this->_adapter->getModel()->getAdapter();
           }
       }

       /**
        * 
        * @return array
        */
       public function getReplaceAlias() {
           return $this->_replaceAlias;
       }

       /**
        * Retorna as colunas que serão colocadas dentro da sentença SQL
        * 
        * @return string
        * @throws ZendT_Exception_Error 
        */
       public function getColumnsSelect($retrive = false, $fields = '*', $adapter = null) {
           if (count($this->_columns) == 0) {
               throw new ZendT_Exception_Error('Favor adicionar as colunas!');
           }

           $_select = '';
           $_order = $this->_getOrder();
           $seqAlias = 1;
           foreach ($_order as $aliasColumn) {
               $aliasName = $aliasColumn;
               if (strlen($aliasColumn) > 25) {
                   $aliasName = substr($aliasColumn, 0, 25) . $seqAlias;
                   $this->_replaceAlias[$aliasColumn] = $aliasName;
                   $seqAlias++;
               }

               if ($fields != '*' && !in_array($aliasColumn, $fields)) {
                   continue;
               }
               if ($retrive == false && $this->_getProfile()->getRemove($aliasColumn)) {
                   continue;
               }
               if (!isset($this->_columns[$aliasColumn])) {
                   continue;
               }
               if (isset($this->_columns[$aliasColumn]['expression'])) {
                   $_select.= ', ' . $this->_columns[$aliasColumn]['expression'] . ' as ' . $aliasName;
               } else {
                   if ($adapter == null) {
                       $_select.= ', ' . $this->_columns[$aliasColumn]['aliasTable'] . '.' . $this->_columns[$aliasColumn]['columnName'] . ' as ' . $aliasName;
                   } else {
                       $_select.= ', ' . $adapter->quoteObject($this->_columns[$aliasColumn]['aliasTable']) . '.' . $adapter->quoteObject($this->_columns[$aliasColumn]['columnName']) . ' as ' . $adapter->quoteObject(strtoupper($aliasName));
                   }
               }
           }
           return substr($_select, 1);
       }

       /**
        *
        * @return type 
        */
       public function getGroupHeaders() {
           if (isset($this->_profileDefault['groupHeaders'])) {
               return $this->_profileDefault['groupHeaders'];
           } else {
               return false;
           }
       }

       /**
        * Retornar as colunas de mapeamento para execução do recordset
        * 
        * @return \ZendT_Db_Column_Mapper
        * @throws ZendT_Exception_Error 
        */
       public function getColumnsMapper() {
           if (count($this->_columns) == 0) {
               throw new ZendT_Exception_Error('Favor adicionar as colunas!');
           }
           $columnsMapper = new ZendT_Db_Column_Mapper();
           $_order = $this->_getOrder();

           foreach ($_order as $aliasColumn) {
               if (!isset($this->_columns[$aliasColumn])) {
                   continue;
               }
               $aliasTable = $this->_columns[$aliasColumn]['aliasTable'];
               $columnName = $this->_columns[$aliasColumn]['columnName'];
               if (isset($this->_columns[$aliasColumn]['expression'])) {
                   $columnsMapper->add($aliasColumn, $this->_columns[$aliasColumn]['mapperName'], $this->_columns[$aliasColumn]['columnName'], $this->_columns[$aliasColumn]['operation'], $this->_columns[$aliasColumn]['expression']);
               } else {
                   $columnsMapper->add($columnName . '_' . $aliasTable, $this->_columns[$aliasColumn]['mapperName'], $this->_columns[$aliasColumn]['columnName'], $this->_columns[$aliasColumn]['operation']);

                   $columnsMapper->add($aliasColumn, $this->_columns[$aliasColumn]['mapperName'], $this->_columns[$aliasColumn]['columnName'], $this->_columns[$aliasColumn]['operation']);
               }
           }
           return $columnsMapper;
       }

       /**
        * Retorna as colunas para o Grid
        *
        * @param $data Diz se o acesso é para montar os dados
        * @return \ZendT_Grid_Column[]
        * @throws ZendT_Exception_Error 
        */
       public function getColumnsGrid($data = false) {
           if (count($this->_columns) == 0) {
               throw new ZendT_Exception_Error('Favor adicionar as colunas!');
           }
           $_grid = array();
           $_order = $this->_getOrder();
           foreach ($_order as $key => $aliasColumn) {
               if ($this->_getProfile()->getRemove($aliasColumn) || (!$data && $this->_getProfile()->getTree($aliasColumn))) {
                   continue;
               }
               if (!isset($this->_columns[$aliasColumn])) {
                   continue;
               }
               $_grid[$aliasColumn] = new ZendT_Grid_Column();
               $_grid[$aliasColumn]->setHeaderTitle($this->_columns[$aliasColumn]['label']);
               $_grid[$aliasColumn]->setName($aliasColumn);
               if (isset($this->_columns[$aliasColumn]['expression'])) {
                   $_grid[$aliasColumn]->setTableAndFieldName('expression.' . $key);
               } else {
                   $_grid[$aliasColumn]->setTableAndFieldName($this->_columns[$aliasColumn]['aliasTable'] . '.' . $this->_columns[$aliasColumn]['columnName']);
               }
               $_grid[$aliasColumn]->setType($this->_columns[$aliasColumn]['type']);
               $_grid[$aliasColumn]->setWidth($this->_getProfile()->getWidth($aliasColumn));
               $_grid[$aliasColumn]->setAlign($this->_getProfile()->getAlign($aliasColumn));
               $_grid[$aliasColumn]->setHidden($this->_getProfile()->getHidden($aliasColumn));
               $_grid[$aliasColumn]->setListOptions($this->_getProfile()->getListOptions($aliasColumn));
               $_grid[$aliasColumn]->setOptions($this->_getProfile()->getOptions($aliasColumn));
           }
           return $_grid;
       }

       private function _parseValue($value, $type) {
           $valueParse = $value;
           if (in_array($type, array('Date', 'DateTime'))) {
               $values = array();
               if (strpos($valueParse, ';')) {
                   $sep = ';';
                   $values = explode(';', $valueParse);
               } else if (strpos($valueParse, ' ')) {
                   $sep = ' ';
                   $values = explode(' ', $valueParse);
               } else if ($value != '') {
                   $sep = '';
                   $values = array($valueParse);
               } else if ($valueParse) {
                   $sep = '';
                   $values = array($valueParse);
               }
               $valueParse = '';
               foreach ($values as $value) {
                   $date = ZendT_Type_Date::parse($value, $type);
                   if ($valueParse) {
                       $valueParse.= $sep . str_replace(" ", "-", $date->get());
                   } else {
                       $valueParse = str_replace(" ", "-", $date->get());
                   }
               }
           }
           return $valueParse;
       }

       public function getWhere($params = array()) {
           if (count($this->_columns) == 0) {
               throw new ZendT_Exception_Error('Favor adicionar as colunas!');
           }
           
           if($params['filter_json']){
               if(!is_array($this->_profileDefault['value'])){
                   $this->_profileDefault['value'] = array();
               }
               $whereJson = ZendT_Db_Where::fromJson(stripslashes($params['filter_json']));
               foreach($whereJson->getFilters() as $key => $val){
                   $valueFilter = $val['value'];
                   if(is_array($valueFilter)){
                       $valueFilter = implode(";", $valueFilter);
                   }
                   $this->_profileDefault['value'][$val['field']] = $val['operation'] . $valueFilter;
               }
           }
           
           if (is_array($this->_profileDefault['value'])) {
               foreach ($this->_profileDefault['value'] as $aliasColumn => $value) {
                   if (isset($params[$aliasColumn]) && $params[$aliasColumn]) {
                       $value = $params[$aliasColumn];
                   }
                   if ($value) {
                       $arrayNull = array('NULO', 'NULL', 'VAZIO'); /* Alterar também em: library\ZendT\Db\Where.php */
                       if (!in_array(strtoupper($value), $arrayNull) && !in_array(strtoupper(substr($value, 1)), $arrayNull) && !in_array(strtoupper(substr($value, 2)), $arrayNull)) {
                           $value = $this->_parseValue($value, $this->_columns[$aliasColumn]['type']);
                       }

                       if (isset($this->_columns[$aliasColumn]['expression'])) {
                           $params['expression-' . $aliasColumn] = $value;
                       } else {
                           $params[$this->_columns[$aliasColumn]['aliasTable'] . '-' . $this->_columns[$aliasColumn]['columnName']] = $value;
                       }
                   }
               }
           }


           if (count($params) > 0) {
               $columns = $this->getColumnsMapper();
               $where = ZendT_Db_Where::fromAutoFilter($params, $columns);
           } else {
               $where = false;
           }
           return $where;
       }

       public function toArray() {
           if (count($this->_columns) == 0) {
               throw new ZendT_Exception_Error('Favor adicionar as colunas!');
           }
           $_order = $this->_getOrder();
           $columns = array();
           foreach ($_order as $i => $aliasColumn) {
               $columns[$aliasColumn] = $this->_columns[$aliasColumn];
               if ($columns[$aliasColumn]['value']) {
                   $columns[$aliasColumn]['value'] = $this->_parseValue($columns[$aliasColumn]['value'], $columns[$aliasColumn]['type']);
               }
               $columns[$aliasColumn]['width'] = $this->_getProfile()->getWidth($aliasColumn);
               $columns[$aliasColumn]['align'] = $this->_getProfile()->getAlign($aliasColumn);
               $columns[$aliasColumn]['subtotal'] = $this->_getProfile()->getSubtotal($aliasColumn);
               $columns[$aliasColumn]['required'] = $this->_getProfile()->getRequired($aliasColumn);
               $columns[$aliasColumn]['bind'] = $this->_getProfile()->getBind($aliasColumn);
               $columns[$aliasColumn]['seeker'] = $this->_getProfile()->getSeeker($aliasColumn);
               $columns[$aliasColumn]['listOptions'] = $this->_getProfile()->getListOptions($aliasColumn);
               $columns[$aliasColumn]['column'] = $columns[$aliasColumn]['aliasTable'] . '.' . $columns[$aliasColumn]['columnName'];
               $columns[$aliasColumn]['ordem'] = $i;
               $columns[$aliasColumn]['autocomplete-filter'] = $this->_getProfile()->getAutoCompleteFilter($aliasColumn);
           }
           $columns['groupHeaders'] = $this->_getProfile()->getGroupHeaders();
           return $columns;
       }

       public function toQuery() {
           $columns = $this->toArray();
           unset($columns['groupHeaders']);

           foreach ($columns as &$column) {

               unset($column['columnName']);
               unset($column['aliasTable']);
               unset($column['mapperName']);
               unset($column['width']);
               unset($column['align']);
               unset($column['subtotal']);
               unset($column['required']);
               unset($column['bind']);
               unset($column['seeker']);
               unset($column['column']);
               unset($column['ordem']);

               if (count($column['listOptions']) == 0) {
                   $column['listOptions'] = null;
               }
           }

           return $columns;
       }

       /**
        * 
        * @return \ZendT_Db_Column_View_Profile
        */
       protected function _getProfile() {
           if ($this->_profile == null) {
               $this->_profile = new ZendT_Db_Column_View_Profile($this->_name, $this->_profileDefault);
           }
           return $this->_profile;
       }

       /**
        *
        * @return array
        */
       private function _getOrder() {
           $_order = $this->_getProfile()->getOrder();
           $newOrder = array();
           foreach ($_order as $aliasColumn) {
               $newOrder[$aliasColumn] = $aliasColumn;
           }
           foreach ($this->_columns as $aliasColumn => $column) {
               if (!$newOrder[$aliasColumn]) {
                   $newOrder[$aliasColumn] = $aliasColumn;
                   $this->_getProfile()->addHidden($aliasColumn);
               }
           }
           return $newOrder;
       }

   }

?>
