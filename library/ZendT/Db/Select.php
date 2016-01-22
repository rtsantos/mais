<?php
    /**
     * Classe responsável por converter array em sentença SQL de consulta
     * 
     * @author lmarquesini
     */
    class ZendT_Db_Select {
        
        /**
         * Constantes de Comandos
         */        
        const SELECT = 'SELECT';
        const MAX    = 'MAX';
        const MIN    = 'MIN';
        const COUNT  = 'COUNT';
        const SUM    = 'SUM';
        const JOIN   = 'JOIN';
        
        /**
         * Quantidade máxima de dígitos para os alias da consulta
         */
        const LIMIT_ALIAS_CHAR = 30;
        
        /**
         * Table base da consulta
         *
         * @var ZendT_Db_Table_Abstract
         */
        private $_table;
        
        /**
         * 
         * @var bool
         */
        private $_loaded = false;
        
        /**
         *
         * @var string
         */
        private $_aliasCurrent = '';
        
        /**
         * Notação da consulta em array
         *
         * @var array
         */
        private $_arrSql;

        /**
         * Array com a estrutura de colunas a serem retornadas
         *  $key: Alias da tabela
         *  $value: Nome da coluna
         *
         * @param array 
         */
        private $_cols;

        /**
         * Array com a estrutura de JOINs da consulta
         * 1ª Chave: Tabela base do JOIN
         * 2ª Chave: Tabela referenciada
         * Valor: Coluna de ligação entre as duas tabelas
         *
         * @var array
         */
        private $_joins;
        
        /**
         * Array com as colunas MAX
         * 
         * @var array
         */
        private $_max;
        
        /**
         * Array com as colunas MIN
         * 
         * @var array
         */
        private $_min;
        
        /**
         * Array com as colunas COUNT
         * 
         * @var array
         */
        private $_count;
        
        /**
         * Array com as colunas SUM
         * 
         * @var array
         */
        private $_sum;
        
        /**
         * Array de Objetos Tables utilizados na consulta.
         * $key = Alias da Tabela
         * $value = Instancia Table da tabela
         * 
         * @var ZendT_Db_Table_Abstract[]
         */
        private $_tables = array();
        
        /**
         *
         * @var ZendT_Db_Column_Mapper
         */
        private $_mappers;
        
        /**
         *
         * @var array
         */
        private $_replaceAlias;
        
        /**
         *
         * @param string $alias
         * @param ZendT_Db_Table_Abstract $table 
         */
        public function addTable($alias, $table) {
            $alias = strtoupper($alias);
            $this->_tables[$alias] = $table;            
        }
        
        /**
         * Retorna a instancia Table correspondente ao alias informado.
         *
         * @param string $alias
         * @return ZendT_Db_Table_Abstract 
         */
        public function getTable($alias) {
            
            if (!isset($this->_tables[$alias])) {
                return false;
            }
            
            return $this->_tables[$alias];
        }

        /**
         * Para a alias informada, grava a coluna de referência utilizada
         * 
         * @param string $alias
         * @param string $colName 
         */
        public function addCol($alias, $colName) {
            $this->_cols[$alias][] = strtoupper($colName);
        }

        /**
         * Retorna todas as colunas geradas
         * 
         * @return array
         */
        public function listCols() {
            return $this->_cols;
        }

        /**
         * Armazena em um array a tabela de referencia, a tabela referenciada e a
         * coluna de referência
         * 
         * @param string $parentTable
         * @param string $childTable
         * @param string $column 
         */
        public function addJoin($parentTable, $childTable, $column) {

            $parentTable = strtoupper($parentTable);
            $childTable  = strtoupper($childTable);
            $column      = strtoupper($column);

            $this->_joins[$parentTable][$childTable] = $column;

        }

        /**
         * Retorna o array de join gerado
         *
         * @return array
         */
        public function listJoins() {
            return $this->_joins;
        }

        /**
         *
         * @param string $alias
         * @param string $column 
         */
        public function addMax($alias, $column) {
            $this->_max[$alias] = $column;
        }
        
        /**
         *
         * @return array
         */
        public function listMax() {
            return $this->_max;
        }

        /**
         *
         * @param string $alias
         * @param string $column 
         */
        public function addMin($alias, $column) {
            $this->_min[$alias] = $column;
        }
        
        /**
         *
         * @return array
         */
        public function listMin() {
            return $this->_min;
        }

        /**
         *
         * @param string $alias
         * @param string $column 
         */
        public function addCount($alias, $column) {
            $this->_count[$alias] = $column;
        }
        
        /**
         *
         * @return array
         */
        public function listCount() {
            return $this->_count;
        }

        /**
         *
         * @param string $alias
         * @param string $column 
         */
        public function addSum($alias, $column) {
            $this->_sum[$alias] = $column;
        }
        
        /**
         *
         * @return array
         */
        public function listSum() {
            return $this->_sum;
        }
        
        /**
         *
         * @param ZendT_Db_Table_Abstract $table
         * @param array $arrSql 
         */
        public function __construct(ZendT_Db_Table_Abstract $table, array $arrSql = array()) {

            $this->_table = $table;
            
            if ($arrSql) {
                $this->_arrSql = $this->upperArray($arrSql);
                $this->_load($table, $this->_arrSql);
            } else {
                $this->_arrSql[$table->getTableAlias()][self::SELECT] = array();
                $this->addTable($table->getTableAlias(), $table);
                $this->_aliasCurrent = $table->getTableAlias();
            }            
            
            $this->_replaceAlias = array();
            $this->_mappers = new ZendT_Db_Column_Mapper();
        }
        
        /**
         * Retorna o SQL gerado
         *
         * @return string
         */
        public function __toString() {
            return $this->getSql();
        }
        
        /**
         * Converte todas as chaves e todos os valores do Array para UPPERCASE
         * 
         * @param array $arr
         * @return array 
         */
        public function upperArray(array $arr) {

            $arr = array_change_key_case($arr, CASE_UPPER);

            foreach ($arr as &$m) {

                if (is_array($m)) {
                    $m = array_change_key_case($m, CASE_UPPER);
                    $m = $this->upperArray($m);
                } else {
                    $m = strtoupper($m);
                }

            }

            return $arr;

        }

        /**
         * Percorre os índices do array informado para organizar as colunas e os JOINs
         *
         * @staticvar boolean $firstTable
         * @param ZendT_Db_Table_Abstract $table
         * @param array $array 
         */
        protected function _load(ZendT_Db_Table_Abstract $table, array $array) {
            
            $first = true;
            
            foreach ($array as $alias => $cmd) {
                
                /**
                 * Separação de Comandos
                 */
                $cols  = (isset($cmd[self::SELECT])) ? $cmd[self::SELECT] : array();
                $join  = (isset($cmd[self::JOIN]))   ? $cmd[self::JOIN]   : array();
                $max   = (isset($cmd[self::MAX]))    ? $cmd[self::MAX]    : array();
                $min   = (isset($cmd[self::MIN]))    ? $cmd[self::MIN]    : array();
                $count = (isset($cmd[self::COUNT]))  ? $cmd[self::COUNT]  : array();
                $sum   = (isset($cmd[self::SUM]))    ? $cmd[self::SUM]    : array();
                
                $class = '';
                
                if ($first) {
                    
                    $first = false;
                    $class = get_class($table);
                    $this->addTable($alias, new $class);
                    
                    foreach ($cols as $field) {
                        $this->addCol($alias, strtoupper($field));
                    }
                    
                } else {
                    
                    $column = $join[key($join)];
                    $parentTable = key($join);
                    
                    if (! isset($this->_tables[$alias])) {
                        $childTable = $this->getTableByRef($this->_tables[key($join)], $column);
                        $this->addTable($alias, new $childTable);
                    }
                    
                    foreach ($cols as $field) {
                        $this->addCol($alias, strtoupper($field));
                    }
                    
                    $this->addJoin($parentTable, $alias, $column);
                }
                
                if ($max) {
                    $this->addMax($alias, $max);
                }
                if ($min) {
                    $this->addMin($alias, $min);
                }
                if ($count) {
                    $this->addCount($alias, $count);
                }
                if ($sum) {
                    $this->addSum($alias, $sum);
                }
                
            }
            
            $this->_loaded = true;
        }
        
        /**
         * Gera o SQL com base na estrutura do array passado ao Construtor
         * 
         * @return string
         */
        public function getSql() {

            if (!$this->_loaded) {
                $this->_load($this->_table, $this->_arrSql);
            }
            
            $sql = self::SELECT;
            
            $joins = $this->listJoins();
            $cols  = $this->listCols();
            
            $max   = $this->listMax();
            $min   = $this->listMin();
            $sum   = $this->listSum();
            $count = $this->listCount();
            
            /**
             * Colunas sem Agrupamento
             */
            if (is_array($cols)) {

                foreach ($cols as $alias => &$columns) {
                    
                    $table = $this->getTable($alias);
                    
                    /**
                     * Remove as colunas de Agrupamento
                     */
                    if (isset($min[$alias])) {
                        $columns = array_diff($columns, $min[$alias]);
                    }
                    if (isset($max[$alias])) {
                        $columns = array_diff($columns, $max[$alias]);
                    }
                    if (isset($sum[$alias])) {
                        $columns = array_diff($columns, $sum[$alias]);
                    }
                    if (isset($count[$alias])) {
                        $columns = array_diff($columns, $count[$alias]);
                    }
                    
                    foreach ($columns as $field) {
                        $sql .= $this->generateColumn($alias, $field);
                    }
                }
            }
            
            /**
             * Colunas com Agrupamento
             */
            $sql .= $this->getGroupColumns();
            
            $first = true;
            $sql = trim($sql);
            $sql = rtrim($sql, ',');
            
            if (is_array($joins)) {

                foreach ($joins as $parent => $relation) {
                    
                    $parentTable = $this->getTable($parent);

                    if ($first) {
                        $first = false;
                        $sql .= " FROM {$parentTable->getTableName()} $parent ";
                    }
                    
                    foreach ($relation as $child => $ref) {
                        
                        $childTable = $this->getTable($child);

                        /**
                         * Verifica se a coluna não é obrigatória e usa LEFT
                         */
                        $join = self::JOIN;

                        if (! $parentTable->isRequired($ref)) {
                            $join = 'LEFT ' . $join;
                        }

                        $sql .= " $join {$childTable->getTableName()} $child ";
                        $sql .= " ON ($child.ID = $parent.$ref) ";

                    }
                }
            } else {
                $a = $this->_arrSql;
                $alias = key($a);
                $table = $this->getTable($alias);
                $sql .= " FROM {$table->getTableName()} $alias ";
            }
            
            /**
             * Clausula Group By
             */
            $sql .= $this->getGroupClause();
            
            return $sql;

        }

        /**
         *
         * @return string 
         */
        public function getGroupColumns() {
            
            $sql = '';
            
            $min = $this->listMin();
            if ($min) {
                foreach ($min as $alias => $columns) {
                    foreach ($columns as $field) {
                        $sql .= $this->generateColumn($alias, $field, self::MIN);
                    }
                }
            }
            
            $max = $this->listMax();
            if ($max) {
                foreach ($max as $alias => $columns) {
                    foreach ($columns as $field) {
                        $sql .= $this->generateColumn($alias, $field, self::MAX);
                    }
                }
            }
            
            $sum = $this->listSum();
            if ($sum) {
                foreach ($sum as $alias => $columns) {
                    foreach ($columns as $field) {
                        $sql .= $this->generateColumn($alias, $field, self::SUM);
                    }
                }
            }
            
            $count = $this->listCount();
            if ($count) {
                foreach ($count as $alias => $columns) {
                    foreach ($columns as $field) {
                        $sql .= $this->generateColumn($alias, $field, self::COUNT);
                    }
                }
            }
            
            $sql = trim($sql);
            $sql = rtrim($sql, ',');
            
            return $sql;
        }

        /**
         *
         * @param string $aliasTable
         * @param string $field
         * @param string $command
         * @return string
         */
        public function generateColumn($aliasTable, $field, $command = '') {
            
            $aliasCommand = '';
            
            if ($command) {
                $aliasCommand = strtoupper($command . '-');
            }
            
            $aliasOrig = $aliasCommand . "$aliasTable-$field";
            $aliasName = $this->_table->getAdapter()->foldCase($aliasOrig);
            $aliasAux = $aliasOrig;
            
            /**
             * O Banco não trabalha com Alias possuindo mais de 30 dígitos
             */
            if (strlen($aliasOrig) > self::LIMIT_ALIAS_CHAR) {
                $increment = count($this->_replaceAlias) + 1;
                $aliasAux = substr($aliasOrig, 0, (self::LIMIT_ALIAS_CHAR - 2) - strlen($aliasCommand)) . $increment;
                $this->_replaceAlias[$this->_table->getAdapter()->foldCase($aliasAux)] = $aliasName;
            }

            /**
             * Instancia os mappers a serem utilizados após execução da consulta
             */
            $this->_mappers->add($aliasName, $this->getTable($aliasTable)->getMapperName(), $field);
            
            return " $command($aliasTable.$field) AS \"$aliasAux\", ";
            
        }
        
        /**
         *
         * @return string 
         */
        public function getGroupClause() {
            
            $sql = '';
            
            $max   = $this->listMax();
            $min   = $this->listMin();
            $sum   = $this->listSum();
            $count = $this->listCount();
            
            if (!($max || $min || $sum || $count)) {
                return '';
            }
            
            $cols = $this->listCols();
            
            if ($cols) {
                foreach ($cols as $alias => $columns) {
                    foreach ($columns as $field) {

                        if (isset($max[$alias]) && in_array($field, $max[$alias])) {
                            continue;
                        }
                        if (isset($min[$alias]) && in_array($field, $min[$alias])) {
                            continue;
                        }
                        if (isset($sum[$alias]) && in_array($field, $sum[$alias])) {
                            continue;
                        }
                        if (isset($count[$alias]) && in_array($field, $count[$alias])) {
                            continue;
                        }

                        $sql .= " $alias.$field, ";
                    }
                }
            }

            $sql = trim($sql);
            $sql = rtrim($sql, ',');
            
            if ($sql) {
                $sql = ' GROUP BY ' . $sql;
            }
            
            return $sql;
        }
        
        /**
         * Verifica para a chave informada se existe referência dela com a tabela
         * de Origem
         * 
         * @param type $table
         * @param type $referenceKey
         * @return type
         * @throws ZendT_Exception_Alert 
         */
        public function getTableByRef($table, $referenceKey) {

            $key = explode('_', $referenceKey);
            $key = array_map('strtolower', $key);
            $key = array_map('ucfirst', $key);
            $key = implode($key);
            
            $reference = $table->getReferenceKey($key);
            
            $className = $reference['refTableClass'];

            if (!$className) {
                throw new ZendT_Exception_Alert('Chave estrangeira (reference map) não configurada: ' . $referenceKey);
            }

            return $className;

        }
        
        /**
         *
         * @return \ZendT_Db_Select 
         */
        public function select() {
            $args = array_map('strtoupper', func_get_args());
            $this->_arrSql[$this->_aliasCurrent][self::SELECT] = $args;
            return $this;
        }
        
        /**
         *
         * @param string $alias
         * @return \ZendT_Db_Select 
         */
        public function join($alias){
            $this->_aliasCurrent = strtoupper($alias);
            return $this;
        }
        
        /**
         *
         * @param string $aliasRef
         * @param string $columnRef
         * @param string $tableName
         * @param string $columnName
         * @param string $schemaName
         * @return \ZendT_Db_Select 
         */
        public function on($aliasRef, $columnRef, $tableName='', $columnName='', $schemaName='') {
            
            $childTable = $this->getTableByRef($this->getTable(strtoupper($aliasRef)), $columnRef);
            $this->addTable($this->_aliasCurrent, new $childTable);
            
            $this->_arrSql[$this->_aliasCurrent][self::JOIN] = array(strtoupper($aliasRef) => strtoupper($columnRef));
            return $this;
        }
        
        /**
         *
         * @return \ZendT_Db_Select 
         */
        public function sum(){
            $args = func_get_args();
            $this->_arrSql[$this->_aliasCurrent][self::SUM] = array_map('strtoupper', $args);
            return $this;
        }
        
        /**
         *
         * @return \ZendT_Db_Select 
         */
        public function count(){
            $args = func_get_args();
            $this->_arrSql[$this->_aliasCurrent][self::COUNT] = array_map('strtoupper', $args);
            return $this;
        }
        
        /**
         *
         * @return \ZendT_Db_Select 
         */
        public function max(){
            $args = func_get_args();
            $this->_arrSql[$this->_aliasCurrent][self::MAX] = array_map('strtoupper', $args);
            return $this;
        }
        
        /**
         *
         * @return \ZendT_Db_Select 
         */
        public function min(){
            $args = func_get_args();
            $this->_arrSql[$this->_aliasCurrent][self::MIN] = array_map('strtoupper', $args);
            return $this;
        }
        
        /**
         *
         * @return \ZendT_Db_Select 
         */
        public function expr(){
            $args = func_get_args();
            $this->_arrSql[$this->_aliasCurrent]['EXPR'] = array_map('strtoupper', $args);
            return $this;
        }
        
        /**
         *
         * @return \ZendT_Db_Recordset 
         */
        public function getRecordSet() {
            
            $stmt = $this->_table->getAdapter()->query($this->getSql());
            $obj = new ZendT_Db_Recordset($stmt, $this->_mappers, true);
            
            if (count($this->_replaceAlias) > 0){
                foreach($this->_replaceAlias as $key=>$value){
                    $obj->addReplaceAlias($key,$value);
                }
            }
            
            return $obj;
        }
    }

?>
