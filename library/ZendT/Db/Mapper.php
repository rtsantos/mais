<?php

   /**
    * Classe para tratamento dos dados a serem inseridos no Banco de Dados
    * Está ligado diretamente ao modelo
    * 
    * @author rsantos
    */
   class ZendT_Db_Mapper {

       /**
        * Array de dados
        * 
        * @var array
        */
       protected $_data;

       /**
        * Dados Old
        * 
        * @var ZendT_Db_Mapper
        */
       protected $_dataOld;

       /**
        *
        * @var type 
        */
       protected $_required;

       /**
        *
        * @var boolean
        */
       protected $_logger;

       /**
        * Observação do Log
        * 
        * @var string
        */
       protected $_loggerNote;

       /**
        * Objeto de modelo para comunicação com a base de dados (tabela)
        * 
        * @var ZendT_Db_Table_Abstract
        */
       protected $_model;

       /**
        *
        * @var ZendT_Db_Column_View
        */
       protected $_columns = null;

       /**
        *
        * @var string @example insert, update, delete
        */
       protected $_action;

       /**
        *
        * @var ZendT_Db_Recordset
        */
       private $_record;

       /**
        * Carrega as colunas que serão usdas na visão
        * 
        * @throws ZendT_Exception_Error 
        */
       protected function _loadColumns() {
           throw new ZendT_Exception_Error('Implementar método');
       }

       /**
        * Retorna as colunas que serão usadas na visão
        *
        * @return ZendT_Db_Column_View 
        */
       public function getColumns($retrieve = false) {
           if ($this->_columns == null) {
               $this->_loadColumns($retrieve);
           }
           return $this->_columns;
       }

       /**
        * Retorna o SQL Base da visão
        * @return string
        */
       protected function _getSqlBase() {
           return $this->getModel()->getTableName() . ' ' . $this->getModel()->getAlias();
       }

       /**
        * Procedimento pode ser usado para criar um Where específico sobre o MapperView
        *
        * @param type $postData
        * @return boolean 
        */
       protected function _getWhere($postData) {
           return false;
       }

       /**
        * Define a ordenação das colunas via MapperView
        *
        * @param type $postData
        * @return boolean 
        */
       protected function _getOrderBy() {
           return false;
       }

       /**
        * Método para trabalhar o SQL, para ganho de performance
        * 
        * @param string $sql
        * @param array $binds 
        * @param string $type @example count, limit, full
        */
       protected function _prepareSql(&$sql, &$binds, $type) {
           
       }

       /**
        * 
        * @return array
        */
       public function getReferenceMap() {
           return array();
       }

       /**
        *
        * @param string $value
        * @param string $column 
        * @return \ZendT_Grid_Data 
        */
       public function suggest($value, $columnAlias, $profileId = '') {
           if ($profileId) {
               $_profile = new Profile_Model_ObjectView_Mapper();
               $_profile->setId($profileId)
                     ->retrieve();
               $config = unserialize($_profile->getConfig());
               $this->parseExprProfile($config);
           }

           $configColumns = $this->getColumns()->toArray();
           $mappers = $this->getColumns()->getColumnsMapper()->getColumnsMapper();
           $listOptions = $configColumns[$columnAlias]['listOptions'];

           if (!$listOptions && $mappers[$columnAlias]['mapper'] instanceof ZendT_Type_String && $mappers[$columnAlias]['mapper']->getListOptions() !== false) {
               $listOptions = $mappers[$columnAlias]['mapper']->getListOptions();
           }
           /**
            * @todo melhorar essa implementação 
            */
           if ($listOptions) {
               foreach ($listOptions as $key => $value) {
                   $rows[] = array($key => $value);
               }
               return $rows;
           }

           $filters = Zend_Controller_Front::getInstance()->getRequest()->getParam('filters');

           $paramValid = array();
           $paramsAutoFilter = array();
           $notIn = array();
           $binds = array();

           if ($filters) {
               $filters = explode('&', $filters);
               foreach ($filters as $data) {
                   $data = str_replace('!=', '<>', $data);
                   list($columnName, $valueFilter) = explode('=', $data);
                   $valueFilter = str_replace('<>', '!=', $valueFilter);

                   $columnName = str_replace('-multiple', '', $columnName);
                   if (!$valueFilter && $columnName != $columnAlias) {
                       continue;
                   }

                   if ($mappers[$columnName]) {
                       if ($mappers[$columnName]['expression']) {
                           $fieldSearch = 'expression-' . $columnName;
                       } else {
                           $fieldSearch = str_replace('.', '-', $configColumns[$columnName]['column']);
                       }

                       if ($columnName == $columnAlias) {
                           if ($valueFilter)
                               $notIn[$fieldSearch] = true;
                           else
                               continue;
                       }

                       $paramsAutoFilter[$fieldSearch] = $valueFilter;
                       $paramValid[$columnName] = true;
                       if (is_array($configColumns[$columnName]['bind'])) {
                           $binds[$columnName] = $configColumns[$columnName]['bind'];
                       }
                   }
               }
           }

           foreach ($configColumns as $columnName => $column) {
               if ($column['required'] && !$paramValid[$columnName]) {
                   throw new ZendT_Exception_Alert($column['required']);
               }
           }

           $_whereAutoFilter = ZendT_Db_Where::fromAutoFilter($paramsAutoFilter, $mappers, $notIn, $binds);
           if (method_exists($this, 'setWhere')) {
               $this->setWhere($_whereAutoFilter);
           }

           $rows = array();
           if ($listOptions) {
               foreach ($listOptions as $key => $value) {
                   $rows[] = array($key => $value);
               }
           } else {


               if ($configColumns[$columnAlias]['expression'])
                   $column = "(" . $configColumns[$columnAlias]['expression'] . ")";
               else
                   $column = $configColumns[$columnAlias]['aliasTable'] . '.' . $configColumns[$columnAlias]['columnName'];

               $autoCompleteFilter = $configColumns[$columnAlias]['autocomplete-filter'];
               if ($autoCompleteFilter) {
                   $field = explode(".", $autoCompleteFilter);
                   $cmdSelect = "SELECT " . $field[1] . " as " . $columnAlias . " FROM " . $field[0] . " filtro WHERE EXISTS ( SELECT 1 ";
                   $cmdFrom = "   FROM " . $this->_getSqlBase();
                   $cmdWhereFilter = " AND " . $column . " = filtro." . $field[1] . ")";
                   $cmdRownum = " AND ROWNUM = 1 ";
                   $cmdLimit = " LIMIT 1 ";
               } else {
                   $cmdSelect = "SELECT DISTINCT " . $column . " as " . $columnAlias;
                   $cmdFrom = "   FROM " . $this->_getSqlBase();
                   $cmdRownum = " AND ROWNUM <= 30000 ";
                   $cmdLimit = " LIMIT 30000 ";
               }

               $whereGroup = new ZendT_Db_Where_Group();
               if ($_whereAutoFilter) {
                   $whereGroup->addWhere($_whereAutoFilter);
               }
               /**
                * Avalia se existe algum Where específico do MapperView
                * colocando o mesmo dentro do objeto que agrupa os wheres
                */
               $_whereMapperView = $this->_getWhere($postData, $_whereAutoFilter);
               if ($_whereMapperView) {
                   $whereGroup->addWhere($_whereMapperView);
               }


               $where = new ZendT_Db_Where();
               if ($configColumns[$columnAlias]['expression']) {
                   $columnFilter = new Zend_Db_Expr($column);
               } else {
                   $columnFilter = $column;
               }

               if ($value) {
                   $where->addFilter($columnFilter, $value, '?%', $mappers[$columnAlias]['mapper']);
                   $whereGroup->addWhere($where);
               }

               /**
                * Monta o comando Where
                */
               $binds = $whereGroup->getBinds();
               $cmdWhere = "  WHERE " . $whereGroup->getSqlWhere();

               $cmdOrderBy = "  ORDER BY 1 ";

               $oracle = false;
               if ($oracle) {
                   $sql = $cmdSelect
                         . $cmdFrom
                         . $cmdWhere
                         . $cmdRownum
                         . $cmdWhereFilter
                         . $cmdGroupBy
                         . $cmdOrderBy;
               } else {
                   $sql = $cmdSelect
                         . $cmdFrom
                         . $cmdWhere
                         . $cmdWhereFilter
                         . $cmdGroupBy
                         . $cmdOrderBy
                         . $cmdLimit;
               }


               $this->_prepareSql($sql, $binds, 'full');
               /**
                * Pega os dados
                */
               $stmt = $this->getModel()->getAdapter()->query($sql, $binds);

               $data = new ZendT_Grid_Data($stmt, $mappers, true);
               $rows = $data->getRows();
           }

           return $rows;
       }

       private function _parsePivot(&$columnsPivot, &$columnsTitle, $where, &$configColumns, &$columnsTotal, &$mappers, $columnsProfile) {
           if (count($columnsPivot) > 0) {
               $mapper = new ZendT_Db_Column_Mapper();
               $cmdSelect = '';
               $cmdOrder = '';
               foreach ($columnsPivot as $name => &$column) {
                   if ($configColumns[$name]['expression']) {
                       $cmdSelect.= ',' . $configColumns[$name]['expression'] . ' as ' . $name;
                   } else {
                       $cmdSelect.= ',' . $configColumns[$name]['column'] . ' as ' . $name;
                   }
                   $cmdOrder.= ',' . $name;

                   $mapper->add($name, $configColumns[$name]['mapperName'], $name);
               }
               $cmdFrom = ' FROM ' . $this->_getSqlBase();
               /**
                * Trata a entrada do Where para ser um Grupo de Where 
                */
               if ($where instanceof ZendT_Db_Where_Group) {
                   $whereGroup = $where;
               } else if ($where instanceof ZendT_Db_Where) {
                   $whereGroup = new ZendT_Db_Where_Group();
                   $whereGroup->addWhere($where);
               } else {
                   $whereGroup = new ZendT_Db_Where_Group();
               }
               /**
                * Avalia se existe algum Where específico do MapperView
                * colocando o mesmo dentro do objeto que agrupa os wheres
                */
               $_whereMapperView = $this->_getWhere($postData, $where);
               if ($_whereMapperView) {
                   $whereGroup->addWhere($_whereMapperView);
               }
               /**
                * Monta o comando Where
                */
               $binds = $whereGroup->getBinds();
               $cmdWhere = "  WHERE " . $whereGroup->getSqlWhere();

               $sql = 'SELECT DISTINCT ' . substr($cmdSelect, 1)
                     . $cmdFrom
                     . $cmdWhere
                     . ' ORDER BY ' . substr($cmdOrder, 1);
               $this->_prepareSql($sql, $binds, 'full');
               $stmt = $this->getModel()->getAdapter()->query($sql, $binds);


               $recordset = new ZendT_Grid_Data($stmt, $mapper, true);

               $iLine = 0;
               $newColumnsGroup = array();
               $columnsTitle = array();
               while ($row = $recordset->getRow()) {
                   $nameIndex = '';
                   $colLabel = '';
                   $colValue = '';
                   $colName = '';
                   $colspan = count($columnsTotal);

                   foreach ($columnsPivot as $name => &$column) {
                       $iColumn = 'c' . $iLine;
                       $column['values'][$iColumn] = '';
                       $nameIndex = $iColumn . '_';
                       if ($colValue) {
                           $colLabel.= ' - ';
                           $colValue.= ' - ';
                           $colName.= "||' - '||";
                       }
                       $colLabel.= $row[$name]->get();
                       if ($row[$name] instanceof ZendT_Type_Date) {
                           $colValue.= $row[$name]->getValueToDb();
                           $column['values'][$iColumn] = $colValue;
                           $column['labels'][$iColumn] = $colLabel;
                           $colValue = "TO_DATE('" . $colValue . "','YYYY-MM-DD HH24:MI:SS')";
                       } else {
                           $colValue.= $row[$name]->getValueToDb();
                           $column['values'][$iColumn] = $colValue;
                           $column['labels'][$iColumn] = $colLabel;
                           $colValue = "'" . str_replace("'", "''", $colValue) . "'";
                       }
                       if ($configColumns[$name]['expression']) {
                           $colName.= $configColumns[$name]['expression'];
                       } else {
                           $colName.= $configColumns[$name]['column'];
                       }
                   }
                   $columnsTitle[$colLabel]['label'] = $colLabel;
                   $columnsTitle[$colLabel]['colspan'] = $colspan;
                   $columnsTitle[$colLabel]['width'] = 0;
                   $columnsTitle[$colLabel]['colspan'] = 0;

                   foreach ($columnsTotal as $columnTotal => $infoColumnTotal) {
                       $columnAlias = $infoColumnTotal['column'];
                       $indexColumnOrig = $columnTotal . '_' . $infoColumnTotal['func'];

                       if (!$newColumnsGroup[$columnAlias] &&
                             (!$this->_userExp[$columnAlias] || $this->_userExp[$columnAlias]['force'] == 1)) {
                           $newColumnsGroup[$columnAlias] = $infoColumnTotal;
                           $newColumnsGroup[$columnAlias]['label'] = $configColumns[$columnAlias]['label'];
                           $newColumnsGroup[$columnAlias]['align'] = $configColumns[$columnAlias]['align'];
                           $newColumnsGroup[$columnAlias]['subtotal'] = $configColumns[$columnAlias]['subtotal'];
                           $newColumnsGroup[$columnAlias]['width'] = $configColumns[$columnAlias]['width'];
                           $newColumnsGroup[$columnAlias]['border'] = $configColumns[$columnAlias]['border'];
                           if ($columnsTotal[$columnAlias]) {
                               $newColumnsGroup[$columnAlias]['label'] = $columnsProfile[$indexColumnOrig]['label'];
                               $newColumnsGroup[$columnAlias]['align'] = $columnsProfile[$indexColumnOrig]['align'];
                               $newColumnsGroup[$columnAlias]['subtotal'] = $columnsProfile[$indexColumnOrig]['subtotal'];
                               $newColumnsGroup[$columnAlias]['width'] = $columnsProfile[$indexColumnOrig]['width'];
                               $newColumnsGroup[$columnAlias]['border'] = $columnsProfile[$indexColumnOrig]['border'];
                           }
                       }

                       $index = $nameIndex . $columnTotal;
                       $newColumnsGroup[$index]['label'] = $colLabel;
                       $newColumnsGroup[$index] = $infoColumnTotal;
                       $newColumnsGroup[$index]['oldName'] = $columnTotal . '_' . $infoColumnTotal['func'];
                       $newColumnsGroup[$index]['oldLabel'] = $infoColumnTotal['label'];
                       $newColumnsGroup[$index]['isExp'] = true;

                       if ($configColumns[$columnAlias]['expression']) {
                           if (isset($this->_userExp[$columnAlias])) {
                               $this->_userExp[$index] = $this->_userExp[$columnAlias];
                               $this->_userExp[$index]['force'] = 0;
                               foreach ($this->_userExp[$index]['columns'][0] as &$colExpr) {
                                   $namCol = str_replace(array('{', '}'), '', $colExpr);
                                   $this->_userExp[$index]['expression_original'] = str_replace($colExpr, '{' . $nameIndex . $namCol . '}', $this->_userExp[$index]['expression_original']);
                                   $colExpr = '{' . $nameIndex . $namCol . '}';
                               }
                               $countExpr = 0;
                               foreach ($this->_userExp[$index]['columns'][1] as &$colExpr) {
                                   $newColumnsGroup[$index]['columns-exp'][$countExpr] = "CASE WHEN {$colName} = {$colValue} THEN {$colExpr} ELSE 0 END";
                                   $countExpr++;
                               }
                           }
                           $exp = $configColumns[$columnAlias]['expression'];
                       } else {
                           $exp = $configColumns[$columnAlias]['column'];
                       }
                       /* if($infoColumnTotal['func'] == 'count'){
                         $exp = 1;
                         } */
                       $newColumnsGroup[$index]['column'] = "CASE WHEN {$colName} = {$colValue} THEN {$exp} ELSE 0 END";

                       $configColumns[$index] = $configColumns[$infoColumnTotal['column']];
                       $configColumns[$index]['label'] = $colLabel;
                       $configColumns[$index]['column'] = $newColumnsGroup[$index]['column'];
                       $configColumns[$index]['order'] = $index;
                       $configColumns[$index]['aliasTable'] = 'expression';
                       $configColumns[$index]['columnName'] = $index;
                       $configColumns[$index]['expression'] = $newColumnsGroup[$index]['column'];
                       $configColumns[$index]['colspan'] = $colspan;

                       $mappers[$index] = $configColumns[$index];
                       $mappers[$index]['mapper'] = $mappers[$index]['mapperName'];
                       $mappers[$index]['operation'] = '=';

                       #$indexColumnOrig = $columnTotal.'_'.$infoColumnTotal['func'];
                       $columnsTitle[$colLabel]['width']+= $columnsProfile[$indexColumnOrig]['width'];
                       $columnsTitle[$colLabel]['colspan'] ++;
                   }

                   $iLine++;
               }
               $columnsTotal = $newColumnsGroup;
           }
       }

       private function _parsePercentage(&$config, $where) {
           if ($config['percentage-total']) {
               $cmdSelect = 'SELECT SUM(' . $config['expression'] . ') total ';
               $cmdFrom = ' FROM ' . $this->_getSqlBase();
               /**
                * Trata a entrada do Where para ser um Grupo de Where 
                */
               if ($where instanceof ZendT_Db_Where_Group) {
                   $whereGroup = $where;
               } else if ($where instanceof ZendT_Db_Where) {
                   $whereGroup = new ZendT_Db_Where_Group();
                   $whereGroup->addWhere($where);
               } else {
                   $whereGroup = new ZendT_Db_Where_Group();
               }
               /**
                * Avalia se existe algum Where específico do MapperView
                * colocando o mesmo dentro do objeto que agrupa os wheres
                */
               $_whereMapperView = $this->_getWhere($postData, $where);
               if ($_whereMapperView) {
                   $whereGroup->addWhere($_whereMapperView);
               }
               /**
                * Monta o comando Where
                */
               $binds = $whereGroup->getBinds();
               $cmdWhere = "  WHERE " . $whereGroup->getSqlWhere();

               $sql = $cmdSelect
                     . $cmdFrom
                     . $cmdWhere;
               $this->_prepareSql($sql, $binds, 'full');
               $stmt = $this->getModel()->getAdapter()->query($sql, $binds);

               $mappers = array();
               $mappers['total']['mapper'] = new ZendT_Type_Number(null, array('numDecimal' => 0));
               $mappers['total']['column'] = 'total';
               $mappers['total']['operation'] = '=';
               $mappers['total']['expression'] = '';
               $data = new ZendT_Grid_Data($stmt, $mappers, true);
               $row = $data->getRow();
               $total = $row['total']->toPhp();

               $columnFat = $config['columns'][0][0];
               $config['column-fat'] = str_replace(array('{', '}'), '', $config['columns'][0][0]);

               if ($columnFat == '') {
                   throw new ZendT_Exception_Alert('Formula de porcentagem não contém a coluna fator para divisão!');
               }

               $config['expression_original'] = 'CASE WHEN ' . $columnFat . ' IS NULL OR ' . $columnFat . ' = 0 THEN 0 ELSE (' . $columnFat . '/' . $total . ')*100 END';
               $config['expression'] = $config['expression_original'];
               return true;
           } else if ($config['percentage-columns']) {
               $columnFat = $config['columns'][0][0];
               $columnDiv = $config['columns'][0][1];

               $config['column-fat'] = str_replace(array('{', '}'), '', $config['columns'][0][0]);
               $config['column-div'] = str_replace(array('{', '}'), '', $config['columns'][0][1]);

               if ($columnFat == '') {
                   throw new ZendT_Exception_Alert('Formula de porcentagem não contém a coluna fator para divisão!');
               }
               if ($columnDiv == '') {
                   throw new ZendT_Exception_Alert('Formula de porcentagem não contém a coluna para divisão!');
               }

               $config['expression_original'] = 'CASE WHEN ' . $columnFat . ' IS NULL OR ' . $columnFat . ' = 0 THEN 0 ELSE (' . $columnFat . '/' . $columnDiv . ')*100) END';
               $config['expression'] = $config['expression_original'];
               return true;
           }
       }

       /**
        * Monta o Recordset do DataView, fazendo agrupamento de dados
        *
        * @param type $where
        * @param type $columnsGroup
        * @param type $columnsTotal
        * @return \ZendT_Grid_Data 
        */
       public function recordsetGroup($where, $columnsGroup, $columnsTotal, $order = array(), &$columnsPivot = array(), &$columns = array(), &$columnsTitle = array()) {
           $configColumns = $this->getColumns()->toArray();
           $mappers = $this->getColumns()->getColumnsMapper()->getColumnsMapper();

           $cmdColumnsSelect = '';
           $cmdColumnsGroup = '';
           $cmdColumnsSelectInt = '';
           $cmdColumnsOrder = '';

           $columnsOrder = array();

           if (count($columnsPivot) > 0) {
               /**
                * Força a mostrar as expressões simples (sem percentual) quando houver colunas de pivot
                */
               foreach ($this->_userExp as $exp => $group) {
                   if (!$this->_userExp[$exp]['percentage-total'] &&
                         !$this->_userExp[$exp]['percentage-columns']) {
                       $this->_userExp[$exp]['force'] = 1;
                   }
               }

               $this->_parsePivot($columnsPivot, $columnsTitle, $where, $configColumns, $columnsTotal, $mappers, $columns);

               $keyDelete = array();
               foreach ($columnsTotal as $name => $column) {
                   if (isset($column['oldName'])) {
                       $columns[$name . '_' . $column['func']] = $columns[$column['oldName']];
                       $columns[$name . '_' . $column['func']]['newLabel'] = $columns[$name . '_' . $column['func']]['label'];
                       #$columns[$name. '_' . $column['func']]['label']    = $columns[$column['oldName']]['label'];
                       #$columns[$name. '_' . $column['func']]['align']    = $columns[$column['oldName']]['align'];
                       $keyDelete[$column['oldName']] = $column['oldName'];
                   }
               }
               foreach ($keyDelete as $name) {
                   unset($columns[$name]);
               }
           }

           if ($columnsGroup) {
               foreach ($columnsGroup as $columnAlias) {
                   if ($configColumns[$columnAlias]['expression']) {
                       if (isset($this->_userExp[$columnAlias])) {
                           if ($this->_parsePercentage($this->_userExp[$columnAlias], $where)) {
                               $this->_userExp[$columnAlias]['expression'] = str_replace($this->_userExp[$columnAlias]['columns'][0]
                                     , $this->_userExp[$columnAlias]['columns'][1]
                                     , $this->_userExp[$columnAlias]['expression']);
                           }
                           $column = $this->_userExp[$columnAlias]['expression'];
                       } else {
                           $column = $configColumns[$columnAlias]['expression'];
                       }
                   } else {
                       $column = $configColumns[$columnAlias]['aliasTable'] . '.' . $configColumns[$columnAlias]['columnName'];
                   }
                   $columnsOrder[] = $columnAlias;
                   $cmdColumnsSelect.= ', ' . $columnAlias;
                   $cmdColumnsSelectInt.= ', ' . $column . ' as ' . $columnAlias;

                   $cmdColumnsGroup.= ', ' . $columnAlias;
                   $cmdColumnsOrder.= ', ' . $columnAlias;
               }
           }

           $columnsFunc = '';
           $userPer = array();
           $userTot = array();
           $columnsFuncGroup = array();

           if ($columnsTotal && count($columnsTotal) > 0) {
               foreach ($columnsTotal as $columnAlias => $group) {
                   if ($group['func'] == '') {
                       $group['func'] = 'count';
                   }

                   if ($configColumns[$columnAlias]['expression']) {
                       if (isset($this->_userExp[$columnAlias])) {
                           if ($this->_parsePercentage($this->_userExp[$columnAlias], $where)) {
                               $userPer[$columnAlias] = $this->_userExp[$columnAlias];
                               if ($group['columns-exp']) {
                                   $userPer[$columnAlias]['columns-exp'] = $group['columns-exp'];
                               }
                               $userPer[$columnAlias]['func'] = $group['func'];
                               $userPer[$columnAlias]['label'] = $columns[$columnAlias . '_' . $userPer[$columnAlias]['func']]['label'];
                               $userPer[$columnAlias]['subtotal'] = $columns[$columnAlias . '_' . $userPer[$columnAlias]['func']]['subtotal'];
                               $userPer[$columnAlias]['align'] = $columns[$columnAlias . '_' . $userPer[$columnAlias]['func']]['align'];
                               $userPer[$columnAlias]['width'] = $columns[$columnAlias . '_' . $userPer[$columnAlias]['func']]['width'];
                               continue;
                           }
                       }
                       $column = $configColumns[$columnAlias]['expression'];
                   } else {
                       $column = $configColumns[$columnAlias]['aliasTable'] . '.' . $configColumns[$columnAlias]['columnName'];
                   }

                   if (!$configColumns[$columnAlias]['expression'] || $this->_userExp[$columnAlias]['force'] == 1) {
                       if ($group['func'] && $group['subtotal']) {
                           $userTot[$columnAlias . '_' . $group['func']] = $group;
                       }
                   }

                   $cmdColumnsSelectInt.= ', ' . $column . ' as ' . $columnAlias;
                   $distinct = '';
                   if ($group['func'] == 'count-distinct' || $group['func'] == 'count_distinct') {
                       $group['func'] = 'count';
                       $distinct = 'DISTINCT ';
                   }
                   $valueExpr = $columnAlias;
                   $_exprCol = 'NVL(' . $group['func'] . '(' . $distinct . $valueExpr . '), 0)';
                   $columnsFuncGroup[$columnAlias] = $_exprCol;
                   $columnsFunc.= ', ' . $_exprCol . ' as ' . $columnAlias . '_' . $group['func'];
                   $mappers[$columnAlias . '_' . $group['func']] = $mappers[$columnAlias];

                   $value = $mappers[$columnAlias . '_' . $group['func']]['mapper'];
                   if (!($value instanceof ZendT_Type_Number || $value instanceof ZendT_Type_NumberTime)) {
                       $mappers[$columnAlias . '_' . $group['func']]['mapper'] = new ZendT_Type_Number(null, array('numDecimal' => 0));
                   }
               }
           } else {
               $cmdColumnsGroup = '';
           }

           /**
            * Trata as colunas de total por linha caso existam colunas de pivot
            */
           if (count($userTot) > 0 && count($columnsPivot) > 0) {
               foreach ($userTot as $columnAlias => $group) {
                   $mappers[$columnAlias]['mapper'] = $configColumns[$userTot[$columnAlias]['column']]['mapperName'];
                   $value = $mappers[$columnAlias]['mapper'];
                   if (!($value instanceof ZendT_Type_Number || $value instanceof ZendT_Type_NumberTime)) {
                       $mappers[$columnAlias]['mapper'] = new ZendT_Type_Number(null, array('numDecimal' => 0));
                   }
                   $mappers[$columnAlias]['column'] = $columnAlias;
                   $mappers[$columnAlias]['operation'] = '=';

                   $columns[$columnAlias] = $userTot[$columnAlias];
                   $columns[$columnAlias]['label_original'] = $columns[$columnAlias]['label'];
                   $columns[$columnAlias]['label'] = 'Total ' . $columns[$columnAlias]['label'];
                   $columns[$columnAlias]['font-size'] = $columns['c0_' . $columnAlias]['font-size'];
                   $columns[$columnAlias]['width'] = $columns['c0_' . $columnAlias]['width'];
                   $columns[$columnAlias]['align'] = $columns['c0_' . $columnAlias]['align'];
               }
           }

           /**
            * Trata as colunas de percentual
            */
           $expColumns = array('column-fat', 'column-div');
           if (count($userPer) > 0) {
               foreach ($userPer as $columnAlias => $group) {
                   if (is_array($group['columns'])) {
                       $columnName = $group['columns'][0];
                       if ($group['columns-exp']) {
                           $columnExpr = $group['columns-exp'];
                       } else {
                           $columnExpr = $group['columns'][1];
                       }
                       foreach ($columnName as $key => $exprName) {
                           $name = str_replace(array('{', '}'), '', $exprName);
                           if (strpos($cmdColumnsSelectInt, $name) === false) {
                               $cmdColumnsSelectInt.= ', ' . $columnExpr[$key] . ' as ' . $name;
                           }
                       }
                   }

                   if ($group['column-fat']) {
                       $replace = array();
                       if (!isset($columnsFuncGroup[$group['column-fat']])) {
                           $_exprCol = 'NVL(SUM(' . $group['column-fat'] . '), 0)';
                           $columnsFuncGroup[$group['column-fat']] = $_exprCol;
                       }
                       $replace[] = $columnsFuncGroup[$group['column-fat']];

                       if ($group['column-div']) {
                           if (!isset($columnsFuncGroup[$group['column-div']])) {
                               $_exprCol = 'NVL(SUM(' . $group['column-div'] . '), 0)';
                               $columnsFuncGroup[$group['column-div']] = $_exprCol;
                           }
                           $replace[] = $columnsFuncGroup[$group['column-div']];
                       }

                       $columnExpr = str_replace($group['columns'][0], $replace, $group['expression']);

                       $columnsFunc.= ', NVL(' . $columnExpr . ', 0) as ' . $columnAlias . '_' . $group['func'];
                       $mappers[$columnAlias . '_' . $group['func']]['mapper'] = new ZendT_Type_Number(null, array('numDecimal' => 2));
                       $mappers[$columnAlias . '_' . $group['func']]['column'] = $columnAlias . '_' . $group['func'];
                       $mappers[$columnAlias . '_' . $group['func']]['operation'] = '=';
                       $mappers[$columnAlias . '_' . $group['func']]['expression'] = '';

                       $columns[$columnAlias . '_' . $group['func']]['calctotal']['expression'] = $this->_userExp[$columnAlias]['expression'];
                       $columns[$columnAlias . '_' . $group['func']]['calctotal']['columns'] = array();
                       foreach ($this->_userExp[$columnAlias]['columns'][0] as $columnReplace) {
                           $columns[$columnAlias . '_' . $group['func']]['calctotal']['columns'][$columnReplace] = str_replace(array('{', '}'), '', $columnReplace) . '_sum';
                       }
                   }

                   /**
                    * Monta a string $columnsFatDiv (colunas de fat e div) e o array $arrayFatDiv (total por linha dessas colunas)
                    */
                   $groupLine = 't_' . substr($group['column-fat'], strpos($group['column-fat'], '_') + 1) .
                         '_' . substr($group['column-div'], strpos($group['column-div'], '_') + 1);

                   if (($group['column-fat'] || $group['column-div']) && $group['subtotal'] && !$arrayFatDiv[$groupLine]) {
                       $arrayFatDiv[$groupLine]['label'] = 'Total ' . $group['label'];
                       $arrayFatDiv[$groupLine]['subtotal'] = $group['subtotal'];
                       $arrayFatDiv[$groupLine]['align'] = $group['align'];
                   }

                   foreach ($expColumns as $fatdiv) {
                       if ($group[$fatdiv] && $arrayFatDiv[$groupLine]['subtotal']) {
                           $alias = $group[$fatdiv] . '_sum';
                           $exp = ', NVL(SUM(' . $group[$fatdiv] . '), 0) ' . $alias;
                           if (strpos($columnsFatDiv, $exp) === false) {
                               $columnsFatDiv .= $exp;
                               $mappers[$alias]['column'] = $alias;
                               $mappers[$alias]['operation'] = '=';
                               $mappers[$alias]['expression'] = '';

                               if ($group[$fatdiv]['mapper']) {
                                   $mappers[$alias]['mapper'] = $mappers[$group[$fatdiv]]['mapper']; //new ZendT_Type_Number(null,array('numDecimal'=>2));
                               }
                               if (!$mappers[$alias]['mapper']) {
                                   $mappers[$alias]['mapper'] = $mappers[substr($group[$fatdiv], strpos($group[$fatdiv], '_') + 1)]['mapper'];
                               }
                           }

                           $alias = substr($group[$fatdiv], strpos($group[$fatdiv], '_') + 1);
                           $exp = ' NVL(SUM(' . $group[$fatdiv] . '), 0) ';
                           if (strpos($arrayFatDiv[$groupLine][$fatdiv]['exp'], $exp) === false) {
                               $arrayFatDiv[$groupLine][$fatdiv]['exp'] .= ($arrayFatDiv[$groupLine][$fatdiv]['exp'] ? '+' : '') . $exp;
                           }
                           if (!$arrayFatDiv[$groupLine][$fatdiv]['alias']) {
                               $arrayFatDiv[$groupLine][$fatdiv]['alias'] = 't_' . $alias;
                           }
                       }
                   }
               }
               #print_r($mappers);die;

               /**
                * Monta a coluna de total sobre percentual caso existam colunas de pivot
                */
               if ($arrayFatDiv && count($columnsPivot) > 0) {
                   foreach ($arrayFatDiv as $alias => $column) {
                       $calculo = "(" . $column['column-fat']['exp'] . ") / (" . $column['column-div']['exp'] . ") * 100 ";
                       $linesFatDiv .= ", " . $calculo . $alias;
                       $linesFatDiv .= ", " . $column['column-fat']['exp'] . " " . $column['column-fat']['alias'];
                       $linesFatDiv .= ", " . $column['column-div']['exp'] . " " . $column['column-div']['alias'];

                       /**
                        * Coluna de Total
                        */
                       $mappers[$alias]['mapper'] = new ZendT_Type_Number(null, array('numDecimal' => 2));
                       $mappers[$alias]['column'] = $alias;
                       $mappers[$alias]['operation'] = '=';
                       $mappers[$alias]['expression'] = '';

                       $columns[$alias]['label'] = $column['label'];
                       $columns[$alias]['align'] = $column['align'];
                       $columns[$alias]['subtotal'] = 'sum';
                       $columns[$alias]['calctotal']['expression'] = " (" . $column['column-fat']['alias'] . ") / (" . $column['column-div']['alias'] . ") * 100 ";
                       $columns[$alias]['calctotal']['columns'] = array();
                       $columns[$alias]['calctotal']['columns'][$column['column-fat']['alias']] = $column['column-fat']['alias'];
                       $columns[$alias]['calctotal']['columns'][$column['column-div']['alias']] = $column['column-div']['alias'];

                       /**
                        * Colunas FAT e DIV
                        */
                       foreach ($expColumns as $fatdiv) {
                           if ($group[$fatdiv]) {
                               $mappers[$column[$fatdiv]['alias']]['mapper'] = new ZendT_Type_Number(null, array('numDecimal' => 2));
                               $mappers[$column[$fatdiv]['alias']]['column'] = $column[$fatdiv]['alias'];
                               $mappers[$column[$fatdiv]['alias']]['operation'] = '=';
                               $mappers[$column[$fatdiv]['alias']]['expression'] = $column[$fatdiv]['exp'];
                           }
                       }
                   }
               }
           }

           /**
            * Monta a base do SQL 
            */
           if ($cmdColumnsSelect) {
               $cmdSelect = " SELECT " . substr($cmdColumnsSelect, 1) . $columnsFunc . $columnsFatDiv . $linesFatDiv;
           } else {
               $cmdSelect = " SELECT " . substr($columnsFunc, 1);
           }

           $cmdFrom = ' FROM (SELECT ' . substr($cmdColumnsSelectInt, 1) . ' FROM ' . $this->_getSqlBase();
           /**
            * Trata a entrada do Where para ser um Grupo de Where 
            */
           if ($where instanceof ZendT_Db_Where_Group) {
               $whereGroup = $where;
           } else if ($where instanceof ZendT_Db_Where) {
               $whereGroup = new ZendT_Db_Where_Group();
               $whereGroup->addWhere($where);
           } else {
               $whereGroup = new ZendT_Db_Where_Group();
           }
           /**
            * Avalia se existe algum Where específico do MapperView
            * colocando o mesmo dentro do objeto que agrupa os wheres
            */
           $_whereMapperView = $this->_getWhere($postData, $where);
           if ($_whereMapperView) {
               $whereGroup->addWhere($_whereMapperView);
           }
           /**
            * Monta o comando Where
            */
           $binds = $whereGroup->getBinds();
           $cmdWhere = "  WHERE " . $whereGroup->getSqlWhere();

           if ($cmdColumnsGroup) {
               $cmdGroupBy = "  GROUP BY " . substr($cmdColumnsGroup, 1);
           }

           if ($order['column']) {

               foreach ($columnsFuncGroup as $key => $value) {
                   $columnsOrder[] = $key;
               }

               $numCol = 1;
               foreach ($columnsOrder as $column) {
                   if ($column == $order['column']) {
                       break;
                   }
                   $numCol++;
               }

               if ($order['type'] == '') {
                   $order['type'] = 'ASC';
               }
               $cmdColumnsOrder = ' ' . $numCol . ' ' . $order['type'];
           }

           $orderBy = $this->_getOrderBy();
           if ($orderBy) {
               $cmdOrderBy = "  ORDER BY " . $orderBy;
           } else if ($cmdColumnsOrder) {
               $cmdOrderBy = "  ORDER BY " . substr($cmdColumnsOrder, 1);
           }

           $sql = $cmdSelect
                 . $cmdFrom
                 . $cmdWhere . ') total '
                 . $cmdGroupBy
                 . $cmdOrderBy;

           /* echo '<pre>';
             print_r($sql);
             print_r($binds);
             echo '</pre>';
             exit; */
           $this->_prepareSql($sql, $binds, 'full');

           #print_r($sql);die;
           #print_r($binds);
           #exit;
           #print $sql;
           #exit;
           /**
            * Pega os dados
            */
           $stmt = $this->getModel()->getAdapter()->query($sql, $binds);
           /**
            * Retorna os dados através do objeto Data
            * para facilar a codificação na action
            */
           /* print '<pre>';
             print_r($mappers);
             print '</pre>'; */

           $data = new ZendT_Grid_Data($stmt, $mappers, true);
           return $data;
       }

       /**
        *
        * @param array $profile 
        */
       public function parseExprProfile($profile, $where = null) {

           /* echo '<pre>';
             print_r($profile);
             echo '</pre>';
             exit; */

           $this->_userExp = array();
           $arrExpression = array();
           if ($profile['ini']) {
               foreach ($profile['ini'] as $fields) {
                   foreach ($fields as $column => $config) {
                       if ($config['expression']) {
                           $expressionObject = null;
                           $percentageTotal = ($config['expr_type'] == 'percentage-total');
                           $percentageColumns = ($config['expr_type'] == 'percentage-columns');
                           $replace = ($config['expr_type'] == 'replace');
                           /**
                            * Separa em um array todos os elementos da Expressão
                            */
                           preg_match_all("/\{(.*?)\}/", $config['expression'], $expElements);
                           if ($expElements) {
                               foreach ($expElements[1] as &$field) {
                                   /**
                                    * Reutiliza uma expressão
                                    */
                                   if ($arrExpression[$field]) {
                                       $key = $field;
                                       $field = '(' . $arrExpression[$field]['expression'] . ')';
                                   }
                                   /**
                                    * Adiciona o alias da tabela no elemento da expressão
                                    */
                                   $col = $this->getColumns()->get($field);
                                   if ($col) {
                                       if ($col['expression']) {
                                           $field = $col['expression'];
                                       } else {
                                           $field = $col['aliasTable'] . '.' . $col['columnName'];
                                       }
                                   }
                               }

                               if ($replace) {
                                   $lines = explode("\n", $config['expr_replace_value']);
                                   if (is_array($lines)) {
                                       $config['expression'] = 'CASE WHEN ' . $expElements[0][0];
                                       foreach ($lines as $line) {
                                           list($value, $newValue) = explode('=', $line);
                                           if ($value && $newValue) {
                                               $config['expression'].= ' = ' . $this->getModel()->getAdapter()->quote($value);
                                               $config['expression'].= ' THEN ' . $this->getModel()->getAdapter()->quote($newValue);
                                           }
                                       }
                                       $config['expression'].= ' ELSE ' . $expElements[0][0] . ' END';
                                   }
                               }
                               $expression = str_replace($expElements[0], $expElements[1], $config['expression']);
                               /**
                                * Caso exista expressão lógica dentro da coluna calculada, realiza os parses correspondentes
                                */
                               if (stripos($expression, '#SE') !== false) {
                                   $arrReplace = array(
                                      '#SENAO' => 'ELSE',
                                      '#SE' => 'CASE WHEN',
                                      '#ENTAO' => 'THEN',
                                      '#FIM' => 'END',
                                   );

                                   $expression = str_ireplace(array_keys($arrReplace), array_values($arrReplace), $expression);
                               }

                               $expressionType = $config['expression_type'];
                               if ($expressionType == 'date') {
                                   $mask = '';
                                   if ($config['expression_type_date_day']) {
                                       $mask.= ' - DD';
                                   }
                                   if ($config['expression_type_date_day_week']) {
                                       $mask.= ' - D - Day';
                                   }
                                   if ($config['expression_type_date_month']) {
                                       if ($mask == '') {
                                           $mask.= ' - MM - Month';
                                       } else {
                                           $mask.= ' - MM';
                                       }
                                   }
                                   if ($config['expression_type_date_month_desc']) {
                                       if ($mask == '') {
                                           $mask.= ' - MM - Month';
                                       } else {
                                           $mask.= ' - MM';
                                       }
                                   }
                                   if ($config['expression_type_date_year']) {
                                       $mask.= ' - YYYY';
                                   }
                                   if ($config['expression_type_date_hour']) {
                                       $mask.= ' - HH24';
                                   }
                                   if ($config['expression_type_date_minute']) {
                                       if (strpos($mask, 'HH24') !== false) {
                                           $mask.= ':MI';
                                       } else {
                                           $mask.= '  :MI';
                                       }
                                   }
                                   if ($config['expression_type_date_second']) {
                                       if (strpos($mask, 'MI') !== false) {
                                           $mask.= ':SS';
                                       } else {
                                           $mask.= '  :SS';
                                       }
                                   }
                                   $mask = substr($mask, 3);
                                   if ($mask == '') {
                                       $mask = 'DD/MM/YYYY';
                                   }
                                   $options['format'] = array();
                                   if ($mask == 'DD - MM - YYYY') {
                                       $options['format'] = array('substr' => array(9));
                                       $mask = 'YYYYMMDD DD - MM - YYYY';
                                   }

                                   $expression = " REPLACE(TO_CHAR(" . trim($expression) . ", '" . $mask . "','NLS_DATE_LANGUAGE=Portuguese'), ' ', '')";

                                   if (substr($mask, 0, 4) == 'D - ') {
                                       $options['format'] = array('substr' => array(2));
                                   } else if (substr($mask, 0, 5) == 'MM - ') {
                                       $options['format'] = array('substr' => array(3));
                                   }
                                   $options['format']+= array('replace' => array(' ', ''));
                                   $expressionObject = new ZendT_Type_String(null, $options);
                               } else if ($expressionType == 'numeric') {
                                   $expressionObject = new ZendT_Type_Number(null, array('numDecimal' => ($config['expression_type_numeric_qtd'] * 1)));
                               } else if ($expressionType == 'time') {
                                   $expressionObject = new ZendT_Type_NumberTime(null, array('format' => '[hh]:mi:ss'));
                               } else if ($expressionType == 'string') {
                                   $mask = array();
                                   $format = $config['expression_type_string_format'];
                                   if ($format) {
                                       list($function, $params) = explode("(", $format);
                                       $params = str_replace(")", "", $params);
                                       $array = explode(",", $params);
                                       if (function_exists($function)) {
                                           $mask = array('format' => array($function => $array));
                                       } else {
                                           $mask = array('mask' => $format);
                                       }
                                   }
                                   $expressionObject = new ZendT_Type_String(null, $mask);
                               }

                               if ($expressionObject == null) {
                                   $expressionObject = new ZendT_Type_Number(null, array('numDecimal' => 0));
                               }

                               $arrExpression[$column] = array(
                                  'expression' => utf8_decode($expression),
                                  'expression_original' => utf8_decode($config['expression']),
                                  'expression_object' => $expressionObject,
                                  'tipo' => $config['tipo'],
                                  'columns' => $expElements,
                                  'percentage-total' => $percentageTotal,
                                  'percentage-columns' => $percentageColumns,
                                  'replace' => $replace,
                                  'label' => $config['label']);
                           }
                       }
                   }
               }
               foreach ($arrExpression as $alias => $exp) {
                   $col = $this->getColumns()->get($alias);
                   if ($col) {
                       continue;
                   }
                   $this->_userExp[$alias] = $exp;
                   $this->_columns->addExpression($alias, $exp['expression'], $exp['expression_object'], $exp['label'], null, '%?%');
               }
           }
           /* echo '<pre>';
             print_r($this->_userExp);
             echo '</pre>';
             exit; */
       }

       /**
        * Monta o recordset do DataView
        *
        * @param ZendT_Db_Where $where
        * @return ZendT_Grid_Data 
        */
       public function recordset($where, $retrieve = false, $found = false, $orderBy = '1') {
           if ($where === null) {
               $where = $this->getWhere(null);
           }
           $postData = Zend_Controller_Front::getInstance()->getRequest()->getParams();
           $postData['count'] = false;
           $postData['page'] = false;
           $postData['sidx'] = $orderBy;
           return $this->getDataGrid($where, $postData, $retrieve, $found);
       }

       /**
        * Monta o recorset para a visão
        *
        * @param ZendT_Db_Where $where
        * @param array $postData
        * @return ZendT_Grid_Data 
        */
       public function getDataGrid($where, $postData, $retrieve = false, $found = false) {
           /**
            * Através dos dados postados adquire as informações
            * para paginar os dados e ordená-los
            */
           $pager = new ZendT_Grid_Paginator($postData);
           /**
            * Monta a base do SQL 
            */
           if ($found) {
               $cmdSelect = " SELECT 1 as found ";
           } else {
               $cmdSelect = " SELECT " . $this->getColumns($retrieve)->getColumnsSelect($retrieve, '*', $this->getModel()->getAdapter());
           }

           $cmdFrom = "   FROM " . $this->_getSqlBase();
           /**
            * Trata a entrada do Where para ser um Grupo de Where 
            */
           if ($where instanceof ZendT_Db_Where_Group) {
               $whereGroup = $where;
           } else if ($where instanceof ZendT_Db_Where) {
               $whereGroup = new ZendT_Db_Where_Group();
               $whereGroup->addWhere($where);
           } else {
               $whereGroup = new ZendT_Db_Where_Group();
           }
           /**
            * Avalia se existe algum Where específico do MapperView
            * colocando o mesmo dentro do objeto que agrupa os wheres
            */
           $_whereMapperView = $this->_getWhere($postData, $where);
           if ($_whereMapperView) {
               $whereGroup->addWhere($_whereMapperView);
           }

           /**
            * Monta o comando Where
            */
           $binds = $whereGroup->getBinds();
           $cmdWhere = "  WHERE " . $whereGroup->getSqlWhere();
           if ($found) {
               $cmdWhere .= " AND rownum = 1 ";
           }

           /**
            * Define a ordenação
            */
           $orderBy = $this->_getOrderBy();
           if ($orderBy) {
               $cmdOrderBy = "  ORDER BY " . $orderBy;
           } else {
               $orderBy = str_replace("expression.", "", $pager->getOrderBy());
               $cmdOrderBy = "  ORDER BY " . $orderBy;
           }
           /**
            * Pega o número de registro para paginação
            */
           if (!isset($postData['count'])) {
               $postData['count'] = true;
           }
           if (!isset($postData['page'])) {
               if (isset($postData['noPage'])) {
                   $postData['page'] = false;
               } else {
                   $postData['page'] = true;
               }
           }
           $numRows = 0;
           if ($postData['count']) {
               $sql = $this->getModel()->getAdapter()->sqlCount($cmdFrom
                     , $cmdWhere
                     , $pager->getLimitCount()
                     , $pager->getLimitOffset());
               $this->_prepareSql($sql, $binds, 'count');
               $numRows = $this->getModel()->getAdapter()->fetchOne($sql, $binds);
           }
           /**
            * Configura o range de dados que será buscado
            */
           if ($postData['page']) {
               $sql = $this->getModel()->getAdapter()->sqlLimit($cmdSelect
                     , $cmdFrom
                     , $cmdWhere
                     , $cmdOrderBy
                     , $pager->getLimitCount()
                     , $pager->getLimitOffset());
               $this->_prepareSql($sql, $binds, 'limit');
           } else {
               $sql = $cmdSelect
                     . $cmdFrom
                     . $cmdWhere
                     . $cmdOrderBy;
               $this->_prepareSql($sql, $binds, 'full');
           }
           /**
            * Pega os dados
            */
           $stmt = $this->getModel()->getAdapter()->query($sql, $binds);
           /**
            * Retorna os dados através do objeto Data
            * para facilar a codificação na action
            */
           if ($found) {
               $mapper = new ZendT_Db_Column_Mapper();
               $mapper->add('found', new ZendT_Type_Number());
               $data = new ZendT_Grid_Data($stmt, $mapper, true);
           } else {
               $data = new ZendT_Grid_Data($stmt, $this->getColumns($retrieve)->getColumnsMapper(), true);
           }

           $replaceAlias = $this->getColumns($retrieve)->getReplaceAlias();
           if (count($replaceAlias) > 0) {
               foreach ($replaceAlias as $alias => $newAlias) {
                   $data->addReplaceAlias($newAlias, $alias);
               }
           }
           $data->setNumRows($numRows);
           $data->setNumPage($pager->getNumPage());
           return $data;
       }

       /**
        *
        * @param ZendT_Db_Where $where
        * @param array $postData
        * @return array
        */
       public function autoComplete($where, $postData) {
           /**
            * Configura as variáveis de paginação 
            */
           $fields = explode(',', $postData['fields']);
           if (isset($postData['order_by'])) {
               $postData['sidx'] = $postData['order_by'];
           } else {
               $postData['sidx'] = $fields[1];
           }
           $postData['rows'] = $postData['limit'];
           $postData['sord'] = 'ASC';
           $postData['count'] = false;
           $data = $this->getDataGrid($where, $postData);

           $rows = array();
           while ($row = $data->getRow()) {
               foreach ($fields as $field) {
                   $newRow[$field] = $row[$field];
               }
               $rows[] = $newRow;
           }
           return $rows;
       }

       /**
        * Retorna o registro usando a saída do MapperView
        * 
        * @param int|array|ZendT_Db_Where $where
        * @return array|bool
        */
       public function retriveRow($where = null) {
           return $this->retrieveRow($where);
       }

       /**
        * 
        * @param int|array|ZendT_Db_Where $where
        * @return array|bool
        */
       public function retrieveRow($where = null, $populate = false) {
           if ($where == null) {
               $where = $this->getWhere();
           }
           $postData = array();
           $postData['count'] = false;
           $postData['page'] = false;
           $postData['returnType'] = false;
           $rows = $this->getDataGrid($where, $postData, true);
           $row = $rows->getRow();
           if ($populate) {
               $this->populate($row);
           }
           return $row;
       }

       /**
        * Propriedade tem como finalidade executar 
        * a consulta SQL colocando o recordset sobre a mémoria 
        * desse objeto permitindo assim usar o fetch
        * para posicionar as linhas e realizar alteração sobre
        * elas
        *
        * @param ZendT_Db_Where $where
        * @return \ZendT_Db_Mapper 
        */
       public function findAll($where = null, $fields = array('id'), $orderBy = array('1')) {
           if ($where == null) {
               $where = $this->getWhere();
           }
           /**
            * Monta a base do SQL 
            */
           $cmdSelect = " SELECT " . $this->getColumns(true)->getColumnsSelect(true, $fields);
           $cmdFrom = "   FROM " . $this->_getSqlBase();
           /**
            * Trata a entrada do Where para ser um Grupo de Where 
            */
           if ($where instanceof ZendT_Db_Where_Group) {
               $whereGroup = $where;
           } else if ($where instanceof ZendT_Db_Where) {
               $whereGroup = new ZendT_Db_Where_Group();
               $whereGroup->addWhere($where);
           } else {
               $whereGroup = new ZendT_Db_Where_Group();
           }
           /**
            * Avalia se existe algum Where específico do MapperView
            * colocando o mesmo dentro do objeto que agrupa os wheres
            */
           $_whereMapperView = $this->_getWhere($postData, $where);
           if ($_whereMapperView) {
               $whereGroup->addWhere($_whereMapperView);
           }
           /**
            * Monta o comando Where
            */
           $binds = $whereGroup->getBinds();
           $cmdWhere = "  WHERE " . $whereGroup->getSqlWhere();
           /**
            * 
            */
           if (!is_array($orderBy)) {
               $orderBy = array($orderBy);
           }
           /**
            * Configura o range de dados que será buscado
            */
           $sql = $cmdSelect
                 . $cmdFrom
                 . $cmdWhere
                 . ' ORDER BY ' . implode(',', $orderBy);
           $this->_prepareSql($sql, $binds, 'full');
           /**
            * Pega os dados
            */
           //$this->_record = $this->getModel()->getAdapter()->query($sql, $binds);

           $this->_rows = $this->getModel()->getAdapter()->fetchAll($sql, $binds);
           $this->_iRows = -1;
           return $this;
       }

       /**
        * Retorna a próxima linha do recorset criado através do query
        * posicionando o registro para possíveis alterações
        *
        * @return boolean 
        */
       public function fetch($retrieve = false) {
           if (!$this->_rows) {
               return false;
           }
           $iRow = $this->_iRows;
           $this->_iRows++;

           $row = false;
           if (isset($this->_rows[$this->_iRows])) {
               $row = $this->_rows[$this->_iRows];
           }
           if ($iRow >= 0) {
               unset($this->_rows[$iRow]);
           }

           if ($row) {
               $this->newRow();
               $this->populate($row, true);
               if ($retrieve) {
                   $this->retrieve();
               }
               return $row;
           } else {
               $this->_rows = false;
               return false;
           }
       }

       /**
        * Retorna o objeto de modelo para comunicação com a base de dados
        * 
        * @return ZendT_Db_Table_Abstract 
        */
       public function getModel() {
           if (!is_object($this->_model)) {
               if ($this->_model != '') {
                   $model = $this->_model;
                   $this->_model = new $model;
               }
           }
           return $this->_model;
       }

       /**
        * Retorna o objeto Where Preenchido com a chave primária
        *
        * @return \ZendT_Db_Where 
        */
       public function getWhere($data = null) {
           $where = new ZendT_Db_Where('AND');
           if ($data == null) {
               $hasFilter = false;
               foreach ($this->getModel()->getPrimary() as $field) {
                   $tableAndField = $this->getModel()->getAlias() . '.' . $field;
                   if ($this->_data[strtolower($field)]) {
                       $hasFilter = true;
                       $where->addFilter($tableAndField, array($this->_data[strtolower($field)]), '=');
                   }
               }
               if (!$hasFilter && is_array($this->_data)) {
                   foreach ($this->_data as $field => $value) {
                       if (!$value instanceof ZendT_Type) {
                           $value = $this->escape($value, $field);
                       }
                       $tableAndField = $this->getModel()->getAlias() . '.' . $field;
                       $where->addFilter($tableAndField, $value, '=');
                   }
               }
           } else {
               foreach ($data as $field => $value) {
                   $tableAndField = $this->getModel()->getAlias() . '.' . $field;
                   $method = 'set' . $this->fieldToMethod($field);
                   if (method_exists($this, $method)) {
                       if (strtolower($field) == 'id') {
                           $_primary = $this->getModel()->getPrimary();
                           if (count($_primary) > 1) {
                               $this->$method($value);
                               foreach ($_primary as $fieldPrimay) {
                                   $tableAndField = $this->getModel()->getAlias() . '.' . $fieldPrimay;
                                   $method = 'get' . $this->fieldToMethod(strtolower($fieldPrimay));
                                   $value = $this->$method();
                                   $where->addFilter($tableAndField, $value, '=', $this->getModel()->getMapperName());
                               }
                           } else {
                               $tableAndField = $this->getModel()->getAlias() . '.' . $_primary[0];
                               $where->addFilter($tableAndField, $value, '=', $this->getModel()->getMapperName());
                           }
                       } else {
                           $where->addFilter($tableAndField, $value, '=', $this->getModel()->getMapperName());
                       }
                   }
               }
           }
           return $where;
       }

       /**
        * Converte um coluna em método
        * 
        * @param type $field
        * @return type 
        * @todo Colocar no ZendT_Lib
        */
       public function fieldToMethod($field) {
           $aux = explode('_', $field);
           $method = '';
           foreach ($aux as $value) {
               $method.= ucfirst($value);
           }
           return $method;
       }

       /**
        * Popula os dados no array de valores
        * 
        * @param array $data 
        * @param bool $fromDb
        * @return \ZendT_Db_Mapper
        */
       public function populate($data, $fromDb = false) {
           if (count($data) > 0) {
               foreach ($data as $key => $value) {
                   $method = 'set' . $this->fieldToMethod($key);
                   if (method_exists($this, $method)) {
                       $this->$method($value, array('required' => true, 'db' => $fromDb));
                   }
               }
           } else {
               
           }
           return $this;
       }

       public function paramName($name) {
           $method = 'set' . $this->fieldToMethod($name);
           if (method_exists($this, $method)) {
               return strtolower($this->getModel()->getAlias() . '-' . $name);
           } else {
               return false;
           }
       }

       /**
        * Trata o valor do campo para pesquisa no Banco de Dados
        *
        * @param string|int $value
        * @param string $columnName
        * @return string|int
        */
       public function escape($value, $columnName, $options = array('required' => false, 'db' => false)) {
           $method = $this->fieldToMethod($columnName);
           if (method_exists($this, 'set' . $method)) {
               $methodSet = 'set' . $method;
               $methodGet = 'get' . $method;
               $this->$methodSet($value, $options);
               $value = $this->$methodGet();
           } else if ($this instanceof ZendT_Db_View) {
               $columns = $this->getColumns(true)->toArray();
               if (isset($columns[trim(strtolower($columnName))])) {
                   $_mapper = $columns[trim(strtolower($columnName))]['mapperName'];
                   if ($_mapper instanceof ZendT_Type) {
                       $_mapper->set($value);
                       $value = $_mapper;
                   }
               }
           }
           return $value;
       }

       /**
        * Formata o valor que será mostrado ao usuário
        *
        * @param string $value
        * @param string $columnName
        * @param string $format
        * @param Zend_Locale $locale
        * @param bool $fromDb
        * @return string
        */
       public function format($value, $columnName, $format = null, $locale = null, $fromDb = true) {
           $method = $this->fieldToMethod($columnName);
           if (method_exists($this, 'set' . $method)) {
               $methodSet = 'set' . $method;
               $methodGet = 'get' . $method;
               $this->$methodSet($value, array('required' => false, 'db' => $fromDb));
               $result = $this->$methodGet();
               if (is_object($result)) {
                   $result = $result->get($format, $locale);
               }
               return $result;
           } else {
               return $value;
           }
       }

       /**
        * Pega o array de dados
        */
       public function getData($key = null) {
           if ($key != null) {
               $method = 'get' . $this->fieldToMethod($key);
               return $this->$method();
           } else {
               return $this->_data;
           }
       }

       /**
        * Retorna os dados populados em um array
        * @return array
        */
       public function toArray() {
           return $this->_data;
       }

       /**
        * Atribuí o valor do dado 
        */
       public function setData($value, $key = null) {
           if ($key != null) {
               $method = 'set' . $this->fieldToMethod($key);
               $this->$method($value);
               return $this;
           } else {
               $this->_data = $value;
               return $this;
           }
       }

       /**
        * Valida se os dados obrigatórios foram todos informados
        * para inserção
        */
       public function valid() {
           /**
            * Retira a coluna de Primary Key, pois muitas vezes
            * esse campos são atribuídos via sequencia
            * 
            */
           $primary = $this->getModel()->getPrimary();
           foreach ($primary as &$value) {
               $value = strtolower($value);
           }
           if (count($primary) == 1) {
               $_required = array_diff($this->_required, $primary);
           } else {
               $_required = $this->_required;
           }
           foreach ($_required as $columnRequired) {
               if ($this->_data[$columnRequired] instanceof ZendT_Type) {
                   if ($this->_data[$columnRequired]->get() == '') {
                       throw new ZendT_Exception_Business('Obrigatório o preenchimento do campo "' . $columnRequired . '"!');
                   }
               } else {
                   if ($this->_data[$columnRequired] == '') {
                       throw new ZendT_Exception_Business('Obrigatório o preenchimento do campo "' . $columnRequired . '"!');
                   }
               }
           }
           return true;
       }

       /**
        * Avalia se a coluna é obrigatório
        * 
        * @param type $value
        * @param type $column
        * @throws ZendT_Exception_Business 
        */
       public function isRequired($value, $column) {
           /**
            * Retira a coluna de Primary Key, pois muitas vezes
            * esse campos são atribuídos via sequencia
            * 
            */
           if ($value instanceof ZendT_Type) {
               $value = $value->toPhp();
           }
           $primary = $this->getModel()->getPrimary();
           foreach ($primary as &$columnName) {
               $columnName = strtolower($columnName);
           }
           if (count($primary) == 1) {
               $_required = array_diff($this->_required, $primary);
           } else {
               $_required = $this->_required;
           }
           foreach ($_required as $columnRequired) {
               if ($columnRequired == $column) {
                   if ($value == '') {
                       #throw new ZendT_Exception_Business('Obrigatório o preenchimento do campo "' . $columnRequired . '"!');
                   }
               }
           }
       }

       /**
        * Transforma o valor do Banco de Dados para o Formato do Usuário
        * 
        * @param string $value
        * @param string $columnName 
        */
       public function transformDbToUser($value, $columnName) {
           $method = $this->fieldToMethod($columnName);
           $set = 'set' . $method;
           $get = 'get' . $method;
           if (!method_exists($this, $set)) {
               throw new ZendT_Exception('Método ' . $set . ' não encontrado na classe!');
           }
           if (!method_exists($this, $get)) {
               throw new ZendT_Exception('Método ' . $get . ' não encontrado na classe!');
           }
           $this->{$set}($value, array('db' => true));
           $userValue = $this->{$get}();
           if ($userValue instanceof ZendT_Type) {
               return $userValue->get();
           } else {
               return $userValue;
           }
       }

       /**
        * Transforma o valor do PHP para o Formato do Usuário
        * 
        * @param string $value
        * @param string $columnName 
        */
       public function transformPhpToUser($value, $columnName) {
           return $this->transformDbToUser($value, $columnName);
       }

       /**
        * Transforma o valor do Usuário para o Formato do Banco de Dados
        * 
        * @param string $value
        * @param string $columnName 
        */
       public function transformUserToDb($value, $columnName) {
           $method = $this->fieldToMethod($columnName);
           $set = 'set' . $method;
           $get = 'get' . $method;
           if (!method_exists($this, $set)) {
               throw new ZendT_Exception('Método ' . $set . ' não encontrado na classe!');
           }
           if (!method_exists($this, $get)) {
               throw new ZendT_Exception('Método ' . $get . ' não encontrado na classe!');
           }
           $this->{$set}($value);
           $userValue = $this->{$get}();
           if ($userValue instanceof ZendT_Type) {
               return $userValue->getValueToDb();
           } else {
               return $userValue;
           }
       }

       /**
        * Retorna o objeto com o valor configurado da coluna mencionada
        * Nesse caso o dado está formatado
        * 
        * @param string $value
        * @param string $columnName
        * @return \ZendT_Type
        * @throws ZendT_Exception 
        */
       public function userToType($value, $columnName) {
           $method = $this->fieldToMethod($columnName);
           $set = 'set' . $method;
           $get = 'get' . $method;
           if (!method_exists($this, $set)) {
               throw new ZendT_Exception('Método ' . $set . ' não encontrado na classe!');
           }
           if (!method_exists($this, $get)) {
               throw new ZendT_Exception('Método ' . $get . ' não encontrado na classe!');
           }
           $this->{$set}($value, array('required' => false));
           $userValue = $this->{$get}();
           return $userValue;
       }

       /**
        * Retorna o objeto com o valor configurado da coluna mencionada
        * Nesse caso o dado não está formatado
        * 
        * @param int|float|string $value
        * @param string $columnName
        * @return \ZendT_Type
        * @throws ZendT_Exception 
        */
       public function phpToType($value, $columnName) {
           $method = $this->fieldToMethod($columnName);
           $set = 'set' . $method;
           $get = 'get' . $method;

           if (!method_exists($this, $set)) {
               $userValue = new ZendT_Type_Default($value);
               $userValue->setValueFromDb($value);
               return $userValue;
           }
           if (!method_exists($this, $get)) {
               throw new ZendT_Exception('Método ' . $get . ' não encontrado na classe!');
           }
           $this->{$set}($value, array('db' => true));
           $userValue = $this->{$get}();
           return $userValue;
       }

       /**
        * Transforma o valor do Usuário para o Formato do PHP
        * 
        * @param string $value
        * @param string $columnName 
        */
       public function transformUserToPhp($value, $columnName) {
           return $this->transformUserToDb($value, $columnName);
       }

       /**
        * Apaga o registro selecionado
        * 
        * @param ZendT_Db_Where $where
        * @return bool 
        */
       public function delete($where = null) {
           $this->_action = 'delete';
           if ($where == null) {
               $where = $this->getWhere();
               if ($where->hasFilters() === false) {
                   throw new ZendT_Exception('Não é possível continuar a exclusão sem filtros!');
               }
           } else if ($where instanceof ZendT_Db_Where) {
               if ($where->hasFilters() === false) {
                   throw new ZendT_Exception('Não é possível continuar a exclusão sem filtros!');
               }
           } else {
               throw new ZendT_Exception('Error: "' . $where . '". Não é possível continuar a exclusão sem filtros!');
           }
           $this->_setProcess();
           $this->_beforeSave();
           $result = $this->getModel()->delete($where);
           $this->_afterSave();
           return $result;
       }

       /**
        * Preenche os dados do objeto, usando um where
        * ou a coluna de chave primaria preenchida
        * 
        * @param ZendT_Db_Where $where 
        * @return ZendT_Db_Mapper
        */
       public function retrive($where = null, $columns = null) {
           return $this->retrieve($where, $columns);
       }

       /**
        * Preenche os dados do objeto, usando um where
        * ou a coluna de chave primaria preenchida
        * 
        * @param ZendT_Db_Where $where 
        * @return ZendT_Db_Mapper
        */
       public function retrieve($where = null, $columns = null) {
           if ($where == null) {
               $where = $this->getWhere();
           }
           $data = $this->getModel()->retrieve($where, $columns, false);
           $this->_data = array();
           $this->populate($data, true);
           return $this;
       }

       public function retrieveLock($where = null, $columns = null) {
           if ($where == null) {
               $where = $this->getWhere();
           }
           $data = $this->getModel()->retrieve($where, $columns, false, true);
           $this->_data = array();
           $this->populate($data, true);
           return $this;
       }

       /**
        * Verifica se registro existe no cadastro
        * 
        * @param type $where
        * @return type 
        */
       public function exists($where = null) {
           if ($where == null) {
               $where = $this->getWhere();
           }
           $data = $this->getModel()->retrieve($where, null, false);
           if (count($data) > 0) {
               $wherePop = array();
               foreach ($this->getModel()->getPrimary() as $column) {
                   $wherePop[strtolower($column)] = $data[strtolower($column)];
               }
               $this->populate($wherePop, true);
               return true;
           } else {
               return false;
           }
       }

       /**
        * Altera o registro da tabela
        * 
        * @param ZendT_Db_Where $where 
        * @return int
        */
       public function update($where = null) {
           $this->_action = 'update';
           if ($where == null) {
               $where = $this->getWhere();
           }
           $this->_setProcess();
           $this->_beforeSave();
           $data = $this->getModel()->save($this, 'update', $where);
           if (is_array($data)) {
               $this->populate($data);
               $data = $this->getData();
           }
           $this->_afterSave();
           return $data;
       }

       /**
        * Insere um registro na tabela
        * 
        * @return array
        */
       public function insert() {
           $this->_action = 'insert';
           $this->_setProcess();
           $this->_beforeSave();
           $data = $this->getModel()->save($this, 'insert');
           if (is_array($data)) {
               $this->populate($data);
               $data = $this->getData();
           }
           $this->_afterSave();
           return $data;
       }

       /**
        * Limpa os campos para gerar uma nova inserção de dados
        * 
        * @return \ZendT_Db_Mapper 
        */
       public function newRow() {
           $this->_data = array();
           $this->_dataOld = null;
           return $this;
       }

       protected function _setProcess() {
           //ZendT_Workflow::getInstance()->setProcess($this);
       }

       protected function _afterSave() {
           if ($this->_logger) {
               $_logEvento = new Log_Model_LogEvento_Mapper();
               $_logEvento->save($this->getModel()->getTableName(), $this->_action, $this->_data['id']->getValueToDb(), $this->_loggerNote);
           }
       }

       protected function _beforeSave() {
           
       }

       public function afterCommit() {
           
       }

       public function setLogger($value) {
           $this->_logger = $value;
           return $this;
       }

       public function isLogger() {
           return $this->_logger;
       }

       /**
        * Retorna o campo com os filtros para o campo do bando
        * Ex: se o campo tiver o filtro 'strtoupper', então esta função retornará
        * upper(nomeDoCampo)
        * 
        * @param string $fieldName
        * @param string $value
        * @return string 
        */
       public function formatFieldName($fieldName, $value) {
           if ($value instanceof ZendT_Type_String) {
               $filters = $value->getFiltersDb();
               if (is_array($filters)) {
                   foreach ($filters as $filter) {
                       $fieldName = $filter . '(' . $fieldName . ')';
                   }
               }
           }
           return $fieldName;
       }

       /**
        * Retorna o nome metodo já verificado se existe GET e SET para o mesmo.
        * 
        * @param string $columnName
        * @return string
        * @throws ZendT_Exception 
        */
       protected function _getMethod($columnName) {
           $method = $this->fieldToMethod($columnName);
           $set = 'set' . $method;
           $get = 'get' . $method;
           if (!method_exists($this, $set)) {
               throw new ZendT_Exception('Método ' . $set . ' não encontrado na classe!');
           }
           if (!method_exists($this, $get)) {
               throw new ZendT_Exception('Método ' . $get . ' não encontrado na classe!');
           }
           return $method;
       }

       protected function _setFileSystem($value, $options) {
           if ($value instanceof ZendT_Type_FileSystem) {
               $fileSystem = $value;
               //$value = $fileSystem->getValueToDb();
           } else {
               if ($options['db']) {
                   $options['id'] = $value;
                   $value = array('file' => $value);
               } else {
                   if (!$value['file'] && !is_array($value)) {
                       $value['file'] = $value;
                   }

                   if (is_array($value) && $value['id']) {
                       $options['id'] = $value['id'];
                   }
               }

               $fileSystem = new ZendT_Type_FileSystem($value['file'], $options);
               if (!is_numeric($value) && $value && $value != null) {
                   $value = $fileSystem;
               }
           }

           if (!$value) {
               $value = new ZendT_Type_FileSystem();
           }
           return $value;
       }

   }

?>