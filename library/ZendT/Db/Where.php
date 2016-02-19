<?php

   /**
    * Essa classe tem como finalidade montar um comando Where
    * para ser processado pelo Banco de Dados
    * 
    * @author rsantos
    * @package ZendT
    * @subpackage ZendT_Db
    * @copyright ZendT
    */
   class ZendT_Db_Where {

       /**
        * Array de filtros
        * @example array('field' => $field , 'value' => $value , 'operation' => $operation)
        * 
        * @var array
        */
       private $_filter;

       /**
        * Comando SQL que representa o Where, usando Bind Variable
        * 
        * @var string
        */
       private $_sqlWhere;

       /**
        * Variáveis Bind que serão representadas na String Where
        * 
        * @var array
        */
       private $_binds;

       /**
        * Variáveis Bind que estão prontas na sentença SQL
        * 
        * @var array
        */
       private $_othersBind;

       /**
        * Valor de agrupamento do SQL
        * @example AND, OR
        * 
        * @var string
        */
       private $_groupOp;

       /**
        *
        * @var array
        */
       private $_bindsExists = array();

       /**
        * Constutor da classe
        *
        * @param string $groupOp Valor de agrupamento do SQL @example AND, OR
        */
       public function __construct($groupOp = 'AND') {
           if (!in_array(strtoupper($groupOp), array('AND', 'OR'))) {
               $groupOp = 'AND';
           }
           $this->_groupOp = $groupOp;
           $this->_clearValues();
       }

       private function _clearValues($removeFilters = true) {
           if ($removeFilters) {
               $this->_filter = array();
           }
           $this->_sqlWhere = null;
           $this->_binds = array();
           $this->_bindsExists = array();
           $this->_othersBind = array();
       }

       /**
        *
        * @param array $data
        * @param array $columnsMapper 
        * @return \ZendT_Db_Where 
        */
       public static function fromAutoFilter($data, $columnsMapper, $notIn = null, $bind = false) {
           if ($columnsMapper instanceof ZendT_Db_Column_Mapper) {
               $columnsMapper = $columnsMapper->getColumnsMapper();
           }
           if ($data['raw']) {
               $tipoBusca = 'OR';
           } else {
               $tipoBusca = 'AND';
           }
           $where = new ZendT_Db_Where($tipoBusca);
           foreach ($data as $field => $value) {
               if (strpos($field, '-multiple') !== false) {
                   continue;
               }
               $pos = strpos($field, '-');
               if ($pos !== false) {
                   $value = trim($value);
                   $columnName = substr($field, $pos + 1);
                   $tableName = substr($field, 0, $pos);
                   $list = "";
                   if (isset($columnsMapper[$columnName . '_' . $tableName])) {
                       $mapperName = $columnsMapper[$columnName . '_' . $tableName]['mapper'];
                       $tableColumn = $columnsMapper[$columnName . '_' . $tableName]['column'];
                       $_operationDefault = $columnsMapper[$columnName . '_' . $tableName]['operation'];
                   } else if (isset($columnsMapper[$columnName])) {
                       $mapperName = $columnsMapper[$columnName]['mapper'];
                       $tableColumn = $columnsMapper[$columnName]['column'];
                       $_operationDefault = $columnsMapper[$columnName]['operation'];
                       if (isset($columnsMapper[$columnName]['expression'])) {
                           $field = new Zend_Db_Expr($columnsMapper[$columnName]['expression']);
                           $mapper = $columnsMapper[$columnName]['mapper'];
                           if (is_object($mapper) && method_exists($mapper, 'getListOptions')) {
                               $list = $mapper->getListOptions();
                           }
                       }
                   } else {
                       $mapperName = $columnsMapper['default']['mapper'];
                       $tableColumn = $columnName;
                       $_operationDefault = $columnsMapper['default']['operation'];
                   }
                   if ($mapperName instanceof ZendT_Type) {
                       $type = $mapperName;
                   } else if ($mapperName) {
                       $mapper = new $mapperName();
                       $type = $mapper->userToType('', $tableColumn);
                       $list = $mapper->getModel()->getListOptions($tableColumn);
                   }

                   $arrayNull = array('NULO', 'NULL', 'VAZIO'); /* Alterar também em: library\ZendT\Db\Column\View.php */
                   if (in_array(strtoupper($value), $arrayNull) || in_array(strtoupper(substr($value, 1)), $arrayNull) || in_array(strtoupper(substr($value, 2)), $arrayNull)) {
                       $myOper = substr($value, 0, 1);
                       if ($myOper != '!')
                           $myOper = '';
                       else
                           $valueOper = '!=';
                       $value = $valueOper . "VAZIO"; //Exibe o filtro como "VAZIO" para melhor o entendimento do usuário
                       $operation = $myOper . 'NULL'; //Determina o filtro com (operação + NULL)
                   } else {
                       $operationDefault = '=';
                       $oldValue = $value;
                       if ($type instanceof ZendT_Type_Date) {
                           $_formatType = $type->getType();
                           $valueData = str_replace(array('>', '=', '<', '!'), '', $value);
                           $sep = '';
                           if (strpos($valueData, ';') === false) {
                               $sep = ' ';
                               $arrValue = explode(' ', $valueData);
                           } else {
                               $arrValue = explode(';', $valueData);
                               $sep = ';';
                           }
                           #print_r($arrValue);
                           #exit;
                           $newValue = '';
                           foreach ($arrValue as $key => $data) {
                               list($data, $hora) = explode('-', $data);
                               if ($_formatType == 'DateTime' && $hora == '') {
                                   if ($key == 0) {
                                       $hora = '00:00';
                                   } else {
                                       $hora = '23:59';
                                   }
                               }
                               if ($hora) {
                                   $hora = trim(str_replace(':', '', $hora));
                                   $hora = substr($hora, 0, 2) . ':' . substr($hora, 2);
                               }
                               $dataFormat = trim(str_replace('/', '', $data));
                               $ano = substr($dataFormat, 4);
                               if (strlen($ano) == 2) {
                                   $ano = substr(date('Y'), 0, 2) . $ano;
                               }
                               $dataFormat = substr($dataFormat, 0, 2) . '/' . substr($dataFormat, 2, 2) . '/' . $ano;
                               #$value = str_replace($arrValue[$key], $dataFormat, $value);
                               $newValue.= $sep . $dataFormat;
                               if ($hora) {
                                   $newValue.= '_' . $hora;
                               }
                           }
                           $value = substr($newValue, 1);
                       } else if ($type instanceof ZendT_Type_Number) {
                           
                       } else {
                           if (is_array($list)) {
                               $value = str_replace(',', ';', $value);
                               $arrStr = explode(';', strtoupper($value));
                               $value = '';
                               foreach ($list as $_key => $_value) {
                                   foreach ($arrStr as $_vUpper) {
                                       if (strtoupper($_value) == $_vUpper || strtoupper($_key) == $_vUpper) {
                                           $value.= ';' . $_key;
                                       }
                                   }
                               }
                               $value = substr($value, 1);
                           }

                           $string = true;
                           if (strpos(trim($value), ' ') !== false) {
                               list($num0, $num1) = explode(' ', trim($value));
                               if (is_numeric($num0) && is_numeric($num1)) {
                                   $string = false;
                               }
                           }

                           if ($string) {
                               $value = str_replace(' ', '%', $value);
                               if ($_operationDefault) {
                                   $operationDefault = $_operationDefault;
                               } else {
                                   $operationDefault = '%?%';
                               }
                           }
                       }
                       $value = explode(' ', $value);
                       if (count($value) > 1) {
                           $operation = 'BETWEEN';
                       } else {
                           $operation1 = substr($oldValue, 0, 1);
                           $operation2 = substr($oldValue, 1, 1);
                           if (in_array($operation1, array('<', '>', '=', '!'))) {
                               if (in_array($operation2, array('='))) {
                                   $operation = $operation1 . $operation2;
                                   $value[0] = substr($oldValue, 2);
                               } else {
                                   $operation = $operation1;
                                   $value[0] = substr($oldValue, 1);

                                   if (strpos($value[0], ';') > 0) {
                                       $value = explode(';', $value[0]);
                                       $operation = '!in';
                                   }
                               }
                           } else {
                               $value = $value[0];
                               $value = explode(';', $value);
                               if (count($value) > 1) {
                                   $value = str_replace('%', ' ', $value);
                                   $operation = 'in';
                               } else {
                                   $operation = $operationDefault;
                                   if ($_operationDefault == '=') {
                                       $value = str_replace('%', ' ', $value);
                                   }
                               }
                           }
                       }
                   }

                   if (isset($bind[$columnName]) && is_array($bind[$columnName])) {
                       foreach ($bind[$columnName] as $index => $bindName) {
                           if (!$value[$index] && $value[0]) {
                               $value[$index] = $value[0];
                           }
                           $valueAux = $value[$index];
                           $value[$index] = clone $type;
                           $value[$index]->set($valueAux);
                           if ($field instanceof Zend_Db_Expr) {
                               $where->addBind($bindName, $value[$index], $columnName);
                           } else {
                               $where->addBind($bindName, $value[$index], str_replace('-', '.', $field), $columnName);
                           }
                       }
                   } else {
                       if ($field instanceof Zend_Db_Expr) {
                           
                       } else {
                           if ($notIn[$field]) {
                               $operation = '!' . $operation;
                           }
                       }
                       if ($field instanceof Zend_Db_Expr) {
                           $field = $field->__toString();
                           $where->addFilter($field, $value, $operation, $mapperName, false, $columnName);
                           #$where->addFilter($field, $value, $operation, $mapperName, $nullable)
                       } else {
                           $where->addFilter(str_replace('-', '.', $field), $value, $operation, $mapperName, false, $columnName);
                       }
                   }
               }
           }
           return $where;
       }

       /**
        * Converte os dados de uma STRING JSON para o Objeto Where
        * 
        * @param string $data
        * @return \ZendT_Db_Where 
        */
       public static function fromJson($data) {
           if (is_string($data)) {
               try {
                   $data = Zend_Json_Decoder::decode(stripslashes(base64_decode($data)));
               } catch (Exception $ex) {
                   $data = stripslashes(urldecode($data));
                   $data = Zend_Json_Decoder::decode($data);
                   if (!isset($data['ZendT_Db_Where'])) {
                       if (count($data['filter']) > 0) {
                           $where = array();
                           $where['groupOp'] = $data['filter_groupop'];
                           $where['filter'] = $data['filter'];

                           $data = array();
                           $data['ZendT_Db_Where'] = $where;
                       }
                   }
               }
           }
           if (!isset($data['ZendT_Db_Where']['groupOp'])) {
               return new ZendT_Db_Where();
           }
           if ($data['ZendT_Db_Where']['filter']) {
               foreach ($data['ZendT_Db_Where']['filter'] as $filter) {
                   if ($filter['operation'] == 'in') {
                       if (is_string($filter['value']) && strpos($filter['value'], ',') !== false) {
                           $filter['value'] = explode(',', $filter['value']);
                       }
                   }
               }
           }
           $filter = $data['ZendT_Db_Where']['filter'];
           $groupOp = $data['ZendT_Db_Where']['groupOp'];
           $result = new ZendT_Db_Where($groupOp);
           $result->setFilter($filter);
           return $result;
       }

       /**
        * Transforma os dados do objeto Where para um String JSON
        * 
        * @return string 
        */
       public function toJson() {
           $data['ZendT_Db_Where'] = array('filter' => $this->_filter, 'groupOp' => $this->_groupOp, 'json' => true);
           return base64_encode(Zend_Json::encode($data));
       }

       /**
        * Converte o comando Where em uma string PostData em formato json
        * será usado a pesquisa do seeker, quando encontrar mais de um registro
        * ou não encontrar nenhum registro.
        * Com esse PostData será passado para o Grid gerar os dados e 
        * também ser utilizado na tela de pesquisa do Grid, com os dados
        * sugeridos como pesquisa pelo objeto seeker
        * 
        * @return string
        */
       public function toJsonPostData($postData = '') {
           $data['filter_groupop'] = $this->_groupOp;
           foreach ($this->_filter as $filter) {
               $field = $filter['field'];
               if ($field instanceof Zend_Db_Expr) {
                   $field = $filter['name'];
               }
               $pos = strpos($field, '.');
               if ($pos !== false)
                   $columnName = substr($field, $pos + 1);
               else
                   $columnName = $field;

               if ($filter['operation'] == '=') {
                   $filter['operation'] = '';
               }
               $data['filter'][$columnName]['op'][$columnName . 'op'] = $filter['operation'];
               $data['filter'][$columnName]['field'][$columnName . 'field'] = $field;
               $data['filter'][$columnName]['mapper'][$columnName . 'mapper'] = $filter['mapper'];
               /* foreach($filter['value'] as $key => $val){
                 $filter['value'][$key] = $filter['operation'] . $val;
                 } */
               $data['filter'][$columnName]['value'][$columnName] = $filter['value'];
           }
           $data['isSearch'] = 'true';
           if ($postData) {
               $postData = ZendT_Db_Where::fromJson($postData);
               if ($postData instanceof ZendT_Db_Where) {
                   $filters = $postData->getFilters();
                   foreach ($filters as $columnName => $filter) {
                       $data['filter'][$columnName] = $filter;
                   }
               }
           }
           /* echo "<pre>";
             print_r($data['filter']);
             echo "</pre>";die; */

           return Zend_Json::encode($data);
       }

       /**
        * Converte o comando Where em uma string PostData em formato json
        * será usado a pesquisa do seeker, quando encontrar mais de um registro
        * ou não encontrar nenhum registro.
        * Com esse PostData será passado para o Grid gerar os dados e 
        * também ser utilizado na tela de pesquisa do Grid, com os dados
        * sugeridos como pesquisa pelo objeto seeker
        * 
        * @return string
        */
       public function toPostData() {
           $url = 'filter[group]=' . urlencode($this->_groupOp);
           foreach ($this->_filter as $key => $filter) {
               if ($filter['operation'] == '=') {
                   $filter['operation'] = '';
               }
               $url.= '&filter[' . $key . '][op]=' . urlencode($filter['operation']);
               $url.= '&filter[' . $key . '][field]=' . urlencode($filter['field']);
               if (is_array($filter['value'])) {
                   foreach ($filter['value'] as $value) {
                       $url.= '&filter[' . $key . '][value][]=' . urlencode($value);
                   }
               } else {
                   $url.= '&filter[' . $key . '][value][]=' . urlencode($filter['value']);
               }
           }
           return $url;
       }

       public static function whereColumnTableFormat($field) {
           $charset = '/[^A-Z0-9]/';
           $tableName = preg_replace($charset, '', $field);
           if (strlen($tableName) > 0) {
               $columName = str_replace($tableName, '', $field);
               $tableColumn = strtolower($tableName) . '.' . $columName;
           } else {
               $columName = $field;
               $tableColumn = $field;
           }
           return array('columnName' => $columName, 'tableName' => $tableName, 'tableColumn' => $tableColumn);
       }

       /**
        * Converte o Post Data um objeto Where, para pesquisa no DB.
        * 
        * @param array $param
        * @return ZendT_Db_Where
        */
       public static function fromPostData($params) {
           $where = new ZendT_Db_Where($params['filter']['group']);
           unset($params['filter']['group']);
           foreach ($params as $keys => $values) {
               if ($keys == 'filter') {
                   foreach ($values as $key => $value) {
                       if ($value['value']) {
                           $column = ZendT_Db_Where::whereColumnTableFormat($value['field']);
                           $where->addFilter($column['tableColumn'], $value['value'], $value['op']);
                       }
                   }
               }
           }
           return $where;
       }

       /**
        * Converte o Post Data um objeto Where, para pesquisa no DB. Especifico para o search
        * 
        * @param array $param
        */
       public static function fromPostDataSearch($params, $columnsMapper = null) {
           if ($columnsMapper instanceof ZendT_Db_Column_Mapper) {
               $columnsMapper = $columnsMapper->getColumnsMapper();
           }
           $where = new ZendT_Db_Where($params['filter_groupop']);
           unset($params['filter_groupop']);
           $mapper = array();
           foreach ($params as $keys => $values) {
               if ($keys == 'filter') {
                   foreach ($values as $columnName => $value) {
                       $mapperName = $value['mapper'][$columnName . 'mapper'];
                       $field = $value['field'][$columnName . 'field'];
                       $op = $value['op'][$columnName . 'op'];
                       if ($value['value'][$columnName]) {
                           if (!isset($mapper[$mapperName]) && $mapperName) {
                               $mapper[$mapperName] = new $mapperName();
                           }
                           $pos = strpos($field, '.');
                           if ($pos !== false)
                               $columnName = substr($field, $pos + 1);
                           else
                               $columnName = $field;

                           if (is_array($value['value'][$columnName])) {
                               $newValues = array();
                               foreach ($value['value'][$columnName] as &$value) {
                                   if ($value && $mapper[$mapperName]) {
                                       $newValues[] = $mapper[$mapperName]->escape($value, $columnName);
                                   } else if ($value) {
                                       $newValues[] = $value;
                                   } else if (in_array($op, array('NULL', '!NULL'))) {
                                       $newValues[] = $op;
                                   }
                               }
                               if (count($newValues) > 0) {
                                   if (isset($columnsMapper[$columnName]) && isset($columnsMapper[$columnName]['expression'])) {
                                       $mapperName = $columnsMapper[$columnName]['mapper'];
                                       $field = new Zend_Db_Expr($columnsMapper[$columnName]['expression']);
                                       $field = $field->__toString();
                                   }
                                   $where->addFilter($field, $newValues, $op, $mapperName, true);
                               }
                           } else if ($value['value'][$columnName]) {
                               if (isset($columnsMapper[$columnName]['expression'])) {
                                   $mapperName = $columnsMapper[$columnName]['mapper'];
                                   $field = new Zend_Db_Expr($columnsMapper[$columnName]['expression']);
                                   $_valueTransform = $value['value'][$columnName];
                               } else {
                                   $_valueTransform = $mapper[$mapperName]->escape($value['value'][$columnName], $columnName);
                               }
                               $where->addFilter($field, array($_valueTransform), $op, $mapperName, true);
                           }
                       }
                   }
               }
           }
           return $where;
       }

       private function _getColumnName($value) {
           $pos = strpos($value, '.');
           if ($pos !== false)
               $columnName = substr($value, $pos + 1);
           else
               $columnName = $value;
           return $columnName;
       }

       /**
        * Configura um filtro no comando SQL
        * 
        * @param array $value 
        */
       public function setFilter($value) {
           if (is_array($value)) {
               $fieldName = 0;
               foreach ($value as $fieldName => $aux) {
                   break;
               }
               if (isset($value[$fieldName]['field']) && isset($value[$fieldName]['value'])) {
                   $this->_filter = $value;
               }
           }
       }

       public function removeFilter($fieldName) {
           if (count($this->_filter) > 0) {
               foreach ($this->_filter as $key => $values) {
                   if ($values['field'] == $fieldName) {
                       unset($this->_filter[$key]);
                   }
               }
           }
           $this->_clearValues(false);
           if ($this->_sqlWhere) {
               $this->loadBindsAndSqlWhere();
           }
           return $this;
       }

       /**
        * Adiciona uma variável bind pronta
        *
        * @param string $name
        * @param string|int|ZendT_Type $value
        * @return \ZendT_Db_Where 
        */
       public function addBind($name, $value, $groupName = null) {
           $this->_othersBind[$name] = $value;
           /**
            * @todo melhorar implementação de bind 
            */
           if ($value instanceof ZendT_Type) {
               $this->_bindsGroup[$groupName][] = $value->get();
           } else {
               $this->_bindsGroup[$groupName][] = $value;
           }
           return $this;
       }

       /**
        * Adiciona um filtro no comando SQL
        * 
        * @param type $field
        * @param type $value
        * @param type $operation 
        */
       public function addFilter($field, $value = '', $operation = '=', $mapperName = '', $nullable = false, $nameField = '') {
           if (!is_array($value))
               $value = array($value);

           if ($nullable) {
               $_value = '';
               $valueComp = '';
               if (isset($value[0])) {
                   $valueComp = $value[0];
               } elseif (is_array($value)) {
                   foreach ($value as $aux) {
                       $valueComp = $aux;
                   }
               } elseif (isset($value)) {
                   $valueComp = $value;
               }
               if ($valueComp instanceof ZendT_Type) {
                   $_value = $valueComp->getValueToDb();
                   if ($_value === '' || $_value === null) {
                       $operation = 'NULL';
                   }
               } elseif ($valueComp === '' || $valueComp === null) {
                   $operation = 'NULL';
               }
           }
           $expr = false;
           if ($value[0] instanceof Zend_Db_Expr) {
               $expr = true;
               $value[0] = $value[0]->__toString();
           }
           /* if ($nameField == '' && !$field instanceof Zend_Db_Expr){
             $nameField = $field;
             } */
           if ($field instanceof Zend_Db_Expr) {
               if ($nameField == '') {
                   $nameField = 'expression_' . count($this->_filter) + 1;
               } else {
                   $field = 'expression.' . $nameField;
               }
           } else {
               //$field = strtolower($field);
           }
           $this->_filter[] = array('field' => $field
              , 'value' => $value
              , 'valueExpr' => $expr
              , 'operation' => $operation
              , 'mapper' => $mapperName
              , 'name' => $nameField);
       }

       /**
        * Transforma o valor para o formato de armazenamento do Banco de Dados
        * 
        * @param string|int|ZendT_Type_Date|ZendT_Type_Number $value
        * @return \ZendT_Type_Number 
        */
       private function getValueToDb($value) {
           if ($value instanceof ZendT_Type) {
               return $value->getValueToDb();
           } else {
               return $value;
           }
       }

       /**
        * Renderiza os dados da memória e cria o comando SQL
        * e as variáveis de Bind 
        */
       private function loadBindsAndSqlWhere() {
           $mapper = array();
           if ($this->_groupOp == 'OR') {
               $this->_sqlWhere = '( 1 = 0 ';
           } else {
               $this->_sqlWhere = '( 1 = 1 ';
           }
           $contBind = 1;
           foreach ($this->_filter as $filter) {
               if (!$filter['field']) {
                   continue;
               }
               unset($valor);
               $this->_sqlWhere.= ' ' . $this->_groupOp;
               if ($filter['field'] instanceof Zend_Db_Expr) {
                   if ($filter['name'] != '') {
                       $bind = 'exp_' . $filter['name'];
                   } else {
                       $bind = 'exp_' . $contBind;
                       $contBind++;
                   }
               } else {
                   $bind = preg_replace("/[^a-zA-Z0-9]/", "", $filter['field']);
               }

               if (strlen($bind) > 25) {
                   $bind = substr($bind, 0, 25) . $contBind++;
               }

               while ($this->_bindsExists[$bind]) {
                   $bind = substr($bind, 0, 25) . $contBind++;
                   if ($contBind > 300) {
                       break;
                   }
               }
               $this->_bindsExists[$bind] = true;

               if (!is_array($filter['value'])) {
                   $filter['value'] = array($filter['value']);
               }
               if ($filter['mapper']) {
                   $columnName = $this->_getColumnName($filter['field']);
                   foreach ($filter['value'] as &$valueSearch) {
                       if (!($valueSearch instanceof ZendT_Type)) {
                           if ($filter['mapper'] instanceof ZendT_Type) {
                               $filter['mapper']->set($valueSearch);
                               $valueSearch = clone $filter['mapper'];
                           } else if (is_object($filter['mapper'])) {
                               $valueSearch = $filter['mapper']->escape($valueSearch, $columnName);
                           } else if (is_string($filter['mapper'])) {
                               $filter['mapper'] = new $filter['mapper']();
                               $valueSearch = $filter['mapper']->escape($valueSearch, $columnName);
                           }
                       }
                   }
                   if (is_string($filter['mapper']) && $mapper[$filter['mapper']] instanceof ZendT_Db_Mapper) {
                       $fieldFilter = $mapper[$filter['mapper']]->formatFieldName($columnName, $valueSearch);
                       $filter['field'] = str_replace($columnName, $filter['field'], $fieldFilter);
                   }
               }
               if (strtoupper($filter['operation']) == 'BETWEEN') {
                   $this->_sqlWhere.= ' ' . $filter['field'] . ' ' . $filter['operation'] . ' :' . $bind . '0 AND :' . $bind . '1 ';
                   foreach ($filter['value'] as $value) {
                       #$valor[] = $this->getValueToDb($value);
                       $valor[] = $value;
                   }
                   $this->_binds[$bind . '0'] = $valor[0];
                   $this->_binds[$bind . '1'] = $valor[1];
               } else if (strtoupper($filter['operation']) == 'EXPRESSION') {
                   $this->_sqlWhere.= ' ( ' . $filter['value'][0] . ' ) ';
               } else if (strtoupper($filter['operation']) == 'IN') {
                   $expr = false;
                   foreach ($filter['value'] as &$value) {
                       if ($value instanceof ZendT_Type) {
                           $value = $value->getValueToDb();
                       } else if (substr($value, 0, 11) == 'expression:') {
                           $expr = true;
                           $value = substr($value, 11);
                       }
                   }
                   if ($expr) {
                       $this->_sqlWhere.= ' ' . $filter['field'] . ' ' . $filter['operation'] . '( ' . $filter['value'][0] . ' ) ';
                   } else {
                       $this->_sqlWhere.= ' ' . $filter['field'] . ' ' . $filter['operation'] . ' (\'' . implode("','", $filter['value']) . '\') ';
                   }
               } else if (strtoupper($filter['operation']) == '!IN') {
                   $itens = '';
                   if (is_array($filter['value'])) {
                       foreach ($filter['value'] as $value) {
                           $newValue = '';
                           if ($value instanceof ZendT_Type) {
                               $newValue = $value->getValueToDb();
                           } else {
                               $newValue = $value;
                           }
                           if ($newValue) {
                               $itens.= ",'" . $newValue . "' ";
                           }
                       }
                   }
                   $this->_sqlWhere.= ' ' . $filter['field'] . ' NOT IN (' . substr($itens, 1) . ') ';
               } else if (strtoupper($filter['operation']) == '?%') {
                   $this->_sqlWhere.= ' ' . $filter['field'] . ' LIKE :' . $bind;
                   $filter['value'] = str_replace(' ', '%', $this->getValueToDb($filter['value'][0])) . '%';
                   $this->_binds[$bind] = $filter['value'];
               } else if (strtoupper($filter['operation']) == '%?%') {
                   $this->_sqlWhere.= ' ' . $filter['field'] . ' LIKE :' . $bind;
                   $filter['value'] = '%' . str_replace(' ', '%', $this->getValueToDb($filter['value'][0])) . '%';
                   $this->_binds[$bind] = $filter['value'];
               } else if (strtoupper($filter['operation']) == '%?') {
                   $this->_sqlWhere.= ' ' . $filter['field'] . ' LIKE :' . $bind;
                   $filter['value'] = '%' . str_replace(' ', '%', $this->getValueToDb($filter['value'][0]));
                   $this->_binds[$bind] = $filter['value'];
               } else if (strtoupper($filter['operation']) == '!?%') {
                   $this->_sqlWhere.= ' ' . $filter['field'] . ' NOT LIKE :' . $bind;
                   $filter['value'] = str_replace(' ', '%', $this->getValueToDb($filter['value'][0])) . '%';
                   $this->_binds[$bind] = $filter['value'];
               } else if (strtoupper($filter['operation']) == '!%?%') {
                   $this->_sqlWhere.= ' ' . $filter['field'] . ' NOT LIKE :' . $bind;
                   $filter['value'] = '%' . str_replace(' ', '%', $this->getValueToDb($filter['value'][0])) . '%';
                   $this->_binds[$bind] = $filter['value'];
               } else if (strtoupper($filter['operation']) == '!%?') {
                   $this->_sqlWhere.= ' ' . $filter['field'] . ' NOT LIKE :' . $bind;
                   $filter['value'] = '%' . str_replace(' ', '%', $this->getValueToDb($filter['value'][0]));
                   $this->_binds[$bind] = $filter['value'];
               } else if (strtoupper($filter['operation']) == 'NULL') {
                   $this->_sqlWhere.= ' ' . $filter['field'] . ' IS NULL ';
               } else if (strtoupper($filter['operation']) == '!NULL') {
                   $this->_sqlWhere.= ' ' . $filter['field'] . ' IS NOT NULL ';
               } else if (strtoupper($filter['operation']) == '') {
                   $this->_sqlWhere.= ' ' . $filter['field'] . ' = :' . $bind;
                   $this->_binds[$bind] = $this->getValueToDb($filter['value'][0]);
               } else if (strtoupper($filter['operation']) == 'EXISTS') {
                   $this->_sqlWhere.= ' EXISTS ' . $filter['value'][0];
               } else if (strtoupper($filter['operation']) == '!EXISTS') {
                   $this->_sqlWhere.= ' NOT EXISTS ' . $filter['value'][0];
               } else {
                   if (isset($filter['value'][0])) {
                       $_value = $filter['value'][0];
                   } else {
                       $_value = $filter['value'];
                   }
                   if (is_object($_value)) {
                       $_value = $_value->__toString();
                   }
                   $_field = $filter['field'];
                   if (is_object($_field)) {
                       $_field = $_field->__toString();
                   }
                   if ($filter['valueExpr']) {
                       if (strtoupper($filter['operation']) == 'EXISTS') {
                           $this->_sqlWhere.= ' EXISTS ' . $this->getValueToDb($filter['value'][0]);
                       } else if (strtoupper($filter['operation']) == '!EXISTS') {
                           $this->_sqlWhere.= ' NOT EXISTS ' . $this->getValueToDb($filter['value'][0]);
                       } else {
                           $this->_sqlWhere.= ' ' . $filter['field'] . ' ' . $filter['operation'] . ' ' . $this->getValueToDb($filter['value'][0]);
                       }
                   } else if (is_string($_value) && substr($_value, 0, 11) == 'expression:') {
                       if (substr($_field, 0, 11) == 'expression:') {
                           $this->_sqlWhere.= ' ' . substr($filter['field'], 11) . ' ' . $filter['operation'] . ' ' . $this->getValueToDb(substr($filter['value'][0], 11));
                       } else {
                           $this->_sqlWhere.= ' ' . $filter['field'] . ' ' . $filter['operation'] . ' ' . $this->getValueToDb(substr($filter['value'][0], 11));
                       }
                   } else {
                       $this->_sqlWhere.= ' ' . $filter['field'] . ' ' . $filter['operation'] . ' :' . $bind;
                       if ($filter['value'][0] instanceof ZendT_Type_Date) {
                           $this->_binds[$bind] = $filter['value'][0];
                       } else {
                           $this->_binds[$bind] = $this->getValueToDb($filter['value'][0]);
                       }
                   }
                   unset($_value);
                   unset($_field);
               }
           }
           $this->_sqlWhere.= ') ';
       }

       /**
        * Retorna o comando SQL para filtragem de dados
        * 
        * @return string
        */
       public function getSqlWhere() {
           if ($this->_sqlWhere == null) {
               $this->loadBindsAndSqlWhere();
           }
           return $this->_sqlWhere;
       }

       /**
        * Retorna um array com as variáveis de bind
        * 
        * @return array
        */
       public function getBinds($bindsExists = array()) {
           if (count($bindsExists) > 0) {
               foreach ($bindsExists as $name => $value) {
                   $this->_bindsExists[$name] = $value;
               }
           }
           if ($this->_sqlWhere == null) {
               $this->loadBindsAndSqlWhere();
           }
           if (count($this->_othersBind)) {
               return $this->_binds + $this->_othersBind;
           } else {
               return $this->_binds;
           }
       }

       /**
        * Retorna o valor de uma variável bind
        *
        * @param string $name
        * @return string|ZendT_Type|null
        */
       public function getBind($name) {
           if (isset($this->_othersBind[$name])) {
               return $this->_othersBind[$name];
           }
           if (isset($this->_binds[$name])) {
               return $this->_binds[$name];
           }
           return null;
       }

       /**
        * Remove o filtro da lista de Binds.
        *
        * @param string $name
        * @return string|ZendT_Type|null
        */
       public function removeBind($name) {

           if (isset($this->_othersBind[$name])) {
               unset($this->_othersBind[$name]);
           }

           if (isset($this->_binds[$name])) {
               unset($this->_binds[$name]);
           }
           if (isset($this->_bindsGroup[$name])) {
               unset($this->_bindsGroup[$name]);
           }

           return null;
       }

       /**
        * 
        * @param string $name
        * @param string $value
        * @return \ZendT_Db_Where
        */
       public function setBind($name, $value) {
           if (isset($this->_othersBind[$name])) {
               $this->_othersBind[$name] = $value;
           } else if (isset($this->_binds[$name])) {
               $this->_binds[$name] = $value;
           } else {
               $this->_binds[$name] = $value;
           }
           return $this;
       }

       /**
        *
        * @return string 
        */
       public function getOperations() {
           $operations = array('BETWEEN', 'IN', '?%', '%?%', '%?', '!?%', '!%?%', '!%?', '!%?', '');
           return $operations;
       }

       /**
        * 
        */
       public function validateOperation($value) {
           if (!in_array($this->getOperations(), $value)) {
               throw new Zend_Exception('Error: Operation para where invalida, verifique as opções validas com getOperations em ZendT_Db_Where');
           }
       }

       /**
        *
        * @param array $customName
        * @return array
        */
       public function getFriendlyFilter($customName = array()) {
           $operation = array('=' => ':',
              '!=' => 'diferente de:',
              '?%' => 'começa:',
              '%?' => 'termina:',
              '%?%' => 'contem:',
              '!?%' => 'não começa:',
              '!%?' => 'não termina:',
              '!%?%' => 'não contem:',
              'NULL' => 'é nulo',
              '!NULL' => 'não é nulo',
              '' => ':',
              'IN' => ':',
              'BETWEEN' => 'entre:',
           );
           $filterU = array();

           if (count($this->_bindsGroup) > 0) {
               foreach ($this->_bindsGroup as $field => $value) {
                   if (is_array($value)) {
                       if (count($value) == 2) {
                           if ($value[0] != $value[1]) {
                               $value = $value[0] . ' e ' . $value[1];
                           } else {
                               $value = $value[0];
                           }
                       } else if (count($value) == 1) {
                           $value = $value[0];
                       } else if (count($value) > 2) {
                           $value = implode(',', $value);
                       }
                   }
                   $filterU[$thisFilter['field']] = array('field' => $customName[$field]
                      , 'operation' => ':'
                      , 'value' => $value);
               }
           }

           if (count($this->_filter) > 0) {
               foreach ($this->_filter as $thisFilter) {
                   unset($value);

                   if ($thisFilter['field'] instanceof Zend_Db_Expr) {
                       $columnName = $thisFilter['name'];
                   } else {
                       $columnName = $thisFilter['field'];
                   }

                   if ($columnName == '') {
                       continue;
                   }

                   if (!$customName[$columnName]) {
                       $modelName = substr($thisFilter['mapper'], 0, strpos($thisFilter['mapper'], '_'));
                       $field = ZendT_Lib::translate($columnName, strtolower($modelName));
                   } else {
                       $field = $customName[$columnName];
                   }


                   $_field = explode('.', $columnName);
                   $_field = array_pop($_field);
                   $_columnMapper = $thisFilter['mapper'];
                   $_listOptions = null;

                   if (!$_columnMapper instanceof ZendT_Type && $_columnMapper) {
                       $_columnMapper = new $_columnMapper();
                       $_columnModel = $_columnMapper->getModel();
                       $_listOptions = $_columnModel->getListOptions($_field);
                   }

                   if ($_listOptions) {
                       if (!is_array($thisFilter['value'])) {
                           $thisFilter['value'] = $_listOptions[$thisFilter['value']];
                       } else {
                           foreach ($thisFilter['value'] as $key => $value) {
                               $thisFilter['value'][$key] = $_listOptions[$value];
                           }
                       }
                   }

                   if (!is_array($thisFilter['value'])) {
                       $value = $thisFilter['value'];
                   } else {
                       if (count($thisFilter['value']) == 2) {
                           $value = $thisFilter['value'][0] . ' e ' . $thisFilter['value'][1];
                       } else if (count($thisFilter['value']) == 1) {
                           $value = $thisFilter['value'][0];
                       } else if (count($thisFilter['value']) > 2) {
                           $value = implode(',', $thisFilter['value']);
                       }
                   }

                   $filterU[$columnName] = array('field' => $field
                      , 'operation' => $operation[strtoupper($thisFilter['operation'])]
                      , 'value' => $value);
               }
           }
           return $filterU;
       }

       /**
        * Retorna o filtro com base no nome.
        * Usado para pegar valores, vindos do filter_json, para
        * popular um formulário.
        * 
        * @param string $fieldName
        * @return boolean|array
        */
       public function getFilter($fieldName) {
           if (count($this->_filter) > 0) {
               foreach ($this->_filter as $filter) {
                   if ($filter['field'] == $fieldName) {
                       return $filter;
                   }
               }
           }
           if (count($this->_bindsGroup) > 0) {
               foreach ($this->_bindsGroup as $name => $filter) {
                   if ($name == $fieldName) {
                       return $filter;
                   }
               }
           }
           return false;
       }

       /**
        * Retorna o filtro com base no nome.
        * Usado para pegar valores, vindos do filter_json, para
        * popular um formulário.
        * 
        * @param string $fieldName
        * @return boolean|array
        */
       public function getFilterByName($fieldName) {
           if (count($this->_filter) > 0) {
               foreach ($this->_filter as $filter) {
                   if ($filter['name'] == $fieldName) {
                       return $filter;
                   }
               }
           }
           if (count($this->_bindsGroup) > 0) {
               foreach ($this->_bindsGroup as $name => $filter) {
                   if ($name == $fieldName) {
                       return $filter;
                   }
               }
           }
           return false;
       }

       /**
        * 
        * @return boolean
        */
       public function hasFilters() {
           if (count($this->_filter) > 0) {
               return true;
           } else {
               return false;
           }
       }

       /**
        * 
        * @return array
        */
       public function getFilters() {
           if (count($this->_filter) > 0) {
               return $this->_filter;
           } else {
               return array();
           }
       }

       /**
        * 
        */
       public function getBindsName() {
           return $this->_bindsExists;
       }

       /**
        * Adiciona um filtro SQL com operação EXISTS
        * 
        * @param string $sql
        * @param string $operation 
        */
       public function addFilterExists($sql, $operation = 'EXISTS') {
           $this->addFilter('1', $sql, $operation);
       }

   }

?>
