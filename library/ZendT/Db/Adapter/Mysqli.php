<?php

   require_once('Zend/Db/Adapter/Mysqli.php');
   require_once('ZendT/Config.php');

   /**
    * @category   ZendT
    * @package    ZendT_Db
    * @subpackage Adapter
    */
   class ZendT_Db_Adapter_Mysqli extends Zend_Db_Adapter_Mysqli {

       /**
        * Returns the column descriptions for a table.
        *
        * The return value is an associative array keyed by the column name,
        * as returned by the RDBMS.
        *
        * The value of each array element is an associative array
        * with the following keys:
        *
        * SCHEMA_NAME      => string; name of schema
        * TABLE_NAME       => string;
        * COLUMN_NAME      => string; column name
        * COLUMN_POSITION  => number; ordinal position of column in table
        * DATA_TYPE        => string; SQL datatype name of column
        * DEFAULT          => string; default expression of column, null if none
        * NULLABLE         => boolean; true if column can have nulls
        * LENGTH           => number; length of CHAR/VARCHAR
        * SCALE            => number; scale of NUMERIC/DECIMAL
        * PRECISION        => number; precision of NUMERIC/DECIMAL
        * UNSIGNED         => boolean; unsigned property of an integer type
        * PRIMARY          => boolean; true if column is part of the primary key
        * PRIMARY_POSITION => integer; position of column in primary key
        * IDENTITY         => integer; true if column is auto-generated with unique values
        *
        * @todo Discover integer unsigned property.
        *
        * @param string $tableName
        * @param string $schemaName OPTIONAL
        * @return array
        */
       public function describeTable($tableName, $schemaName = null) {
           $desc = parent::describeTable($tableName, $schemaName);
           $tableName = strtolower($tableName);
           $schemaName = strtolower($schemaName);

           $sql = "select distinct table_name
                      from information_schema.key_column_usage
                     where referenced_table_name = ? ";
           $bind = array();
           $bind[] = $tableName;
           if ($schemaName != null) {
               $bind[] = $schemaName;
               $sql.= " and constraint_schema = ? ";
           }
           $dependentTables = $this->fetchAll($sql, $bind);

           $sql = "select column_name,
                           referenced_table_name as 'table_name_reference',
                           referenced_table_schema as 'schema_name_reference',
                           referenced_column_name as 'column_name_reference'
                      from information_schema.key_column_usage
                     where referenced_table_name is not null
                       and table_name = ?";
           $bind = array();
           $bind[] = $tableName;
           /* if ($schemaName != null) {
             $bind[]= $schemaName;
             $sql.= " table_schema = ? ";
             } */
           $referenceMap = $this->fetchAll($sql, $bind);

           $desc[$this->foldCase('reference_map')] = $referenceMap;
           $desc[$this->foldCase('dependent_tables')] = $dependentTables;
           return $desc;
       }

       /**
        * Codifique uma string para se compor no comando SQL do Mysqli
        * Implementado formatação de Data e Hora
        * @example quote($value,'Date'); quote($value,'DateTime');
        *
        * @param string $value
        * @param string $type
        * @return string 
        */
       public function quote($value, $type = null) {
           if ($type == 'Date') {
               $value = parent::quote($value);
               return "to_date($value,'DD/MM/YYYY')";
           } else if ($type == 'DateTime') {
               $value = parent::quote($value);
               return "to_date($value,'DD/MM/YYYY HH24:MI')";
           } else {
               if ($value instanceof ZendT_Type_Date) {
                   $value = $value->getIso();
                   $value = str_replace('T', ' ', $value);
               }
               if ($value instanceof ZendT_Type_Number) {
                   $value = $value->getIso();
                   return $value;
               }
               return parent::quote($value, $type);
           }
       }

       /**
        * Executa o comando SQL dentro do Banco de Dados
        * 
        * @param string $sql
        * @param array $bind
        * @return bool 
        */
       public function query($sql, $bind = array()) {
           $cmd = strtolower(substr($sql, 0, 6));
           ZendT_Config::$type = $this->_config['options']['charset'];

           $orderParam = array();
           foreach ($bind as $name => $value) {
               if ($value instanceof ZendT_Type_Date) {
                   $value = $value->getIso();
                   $value = str_replace('T', ' ', $value);
               } else if ($value instanceof ZendT_Type_Number && in_array($cmd, array('insert', 'update'))) {
                   $value = $value->getValueToDb();
                   if (!$value) {
                       $value = null;
                   }
               } else if ($value instanceof ZendT_Type) {
                   $value = $value->getValueToDb();
               }
               $bind[$name] = $value;
               if (!is_numeric($name)) {
                   $orderParam[] = $name;
               }
           }
           if (count($orderParam) > 0) {
               sort($orderParam);
               $count = count($orderParam) - 1;
               for ($i = $count; $i >= 0; $i--) {
                   $name = $orderParam[$i];
                   $value = $bind[$name];
                   if (substr($name, 0, 1) != ':') {
                       $sql = str_replace(':' . $name, $this->quote($value), $sql);
                   } else {
                       $sql = str_replace($name, $this->quote($value), $sql);
                   }
                   unset($bind[$name]);
               }
           }
           /* if (count($bind) > 0) {
             foreach ($bind as $name => $value) {
             if (!is_numeric($name)) {
             if (substr($name, 0, 1) != ':') {
             $sql = str_replace(':' . $name, $this->quote($value), $sql);
             } else {
             $sql = str_replace($name, $this->quote($value), $sql);
             }
             unset($bind[$name]);
             }
             }
             } */
           return parent::query($sql, $bind);
       }

       /**
        * Adds an adapter-specific LIMIT clause to the SELECT statement.
        *
        * @param string $sql
        * @param integer $count
        * @param integer $offset OPTIONAL
        * @return string
        * @throws Zend_Db_Adapter_Oracle_Exception
        */
       public function sqlLimit($select
       , $from
       , $where
       , $orderBy
       , $count
       , $offset = 0) {
           $count = intval($count);
           if ($count <= 0) {
               /**
                * @see Zend_Db_Adapter_Oracle_Exception
                */
               require_once 'Zend/Db/Adapter/Oracle/Exception.php';
               throw new Zend_Db_Adapter_Oracle_Exception("LIMIT argument count=$count is not valid");
           }

           $offset = intval($offset);
           if ($offset < 0) {
               /**
                * @see Zend_Db_Adapter_Oracle_Exception
                */
               require_once 'Zend/Db/Adapter/Oracle/Exception.php';
               throw new Zend_Db_Adapter_Oracle_Exception("LIMIT argument offset=$offset is not valid");
           }

           /**
            * Oracle does not implement the LIMIT clause as some RDBMS do.
            * We have to simulate it with subqueries and ROWNUM.
            * Unfortunately because we use the column wildcard "*",
            * this puts an extra column into the query result set.
            */
           $limit_sql = $select .
                 $from .
                 $where .
                 $orderBy .
                 " LIMIT $count ";
           if ($offset > 0) {
               $limit_sql.= " OFFSET " . $offset;
           }
           return $limit_sql;
       }

       /**
        * Adds an adapter-specific LIMIT clause to the SELECT statement.
        *
        * @param string $sql
        * @param integer $count
        * @param integer $offset OPTIONAL
        * @return string
        * @throws Zend_Db_Adapter_Oracle_Exception
        */
       public function sqlCount($from, $where, $count, $offset = 0) {
           $count = intval($count);
           if ($count <= 0) {
               /**
                * @see Zend_Db_Adapter_Oracle_Exception
                */
               require_once 'Zend/Db/Adapter/Oracle/Exception.php';
               throw new Zend_Db_Adapter_Oracle_Exception("LIMIT argument count=$count is not valid");
           }

           $offset = intval($offset);
           if ($offset < 0) {
               /**
                * @see Zend_Db_Adapter_Oracle_Exception
                */
               require_once 'Zend/Db/Adapter/Oracle/Exception.php';
               throw new Zend_Db_Adapter_Oracle_Exception("LIMIT argument offset=$offset is not valid");
           }

           /**
            * Oracle does not implement the LIMIT clause as some RDBMS do.
            * We have to simulate it with subqueries and ROWNUM.
            * Unfortunately because we use the column wildcard "*",
            * this puts an extra column into the query result set.
            */
           $sqlOffset = '';
           if ($offset > 0) {
               $sqlOffset = " OFFSET $offset";
           }

           $sqlCount = "SELECT COUNT(*) as \"TOTAL\" 
                           FROM (SELECT 1 as \"FOUND\" 
                                 $from 
                                 $where
                                 LIMIT $count 
                                 $sqlOffset) total ";
           return $sqlCount;
       }

       /**
        * 
        */
       public function quoteObject($name) {
           return "`" . strtolower($name) . "`";
       }

       /**
        * gera uma expressão de concatenação
        * 
        * @param array $columns 
        */
       public function concat($columns, $quote = false) {
           if (count($columns) == 1) {
               if ($quote) {
                   $columns[0] = $this->quoteObject($columns[0]);
               }
               return $columns[0];
           }
           $cmd = '';
           for ($i = 0; $i < count($columns); $i++) {
               $value = $columns[$i];
               if ($quote) {
                   $value = $this->quoteObject($value);
               }
               if ($i % 2) {
                   $cmd.= ",{$value})";
               } else {
                   $cmd.= ",CONCAT({$value}";
               }
           }
           if (count($columns) % 2) {
               $cmd.= ",)";
           }
           return substr($cmd, 1);
       }

       /**
        *
        * @param string $tableName
        * @param string $columnName
        * @return int 
        */
       public function nextSequenceTable($tableName, $columnName) {
           return 0;
       }

       /**
        * Updates table rows with specified data based on a WHERE clause.
        *
        * @param  mixed        $table The table to update.
        * @param  array        $bind  Column-value pairs.
        * @param  mixed        $where UPDATE WHERE clause(s).
        * @return int          The number of affected rows.
        * @throws Zend_Db_Adapter_Exception
        */
       public function update($table, array $bind, $where = '') {
           /**
            * Build "col = ?" pairs for the statement,
            * except for Zend_Db_Expr which is treated literally.
            */
           $set = array();
           $i = 0;
           foreach ($bind as $col => $val) {
               if ($val instanceof Zend_Db_Expr) {
                   $val = $val->__toString();
                   unset($bind[$col]);
               } else {
                   if ($this->supportsParameters('positional')) {
                       $val = '?';
                   } else {
                       if ($this->supportsParameters('named')) {
                           unset($bind[$col]);
                           $bind[':col' . $i] = $val;
                           $val = ':col' . $i;
                           $i++;
                       } else {
                           /** @see Zend_Db_Adapter_Exception */
                           require_once 'Zend/Db/Adapter/Exception.php';
                           throw new Zend_Db_Adapter_Exception(get_class($this) . " doesn't support positional or named binding");
                       }
                   }
               }
               $set[] = $this->quoteIdentifier($col, true) . ' = ' . $val;
           }

           $where = $this->_whereExpr($where);

           /**
            * Build the UPDATE statement
            */
           $sql = "UPDATE "
                 . $table
                 . ' SET ' . implode(', ', $set)
                 . (($where) ? " WHERE $where" : '');

           /**
            * Execute the statement and return the number of affected rows
            */
           if ($this->supportsParameters('positional')) {
               $stmt = $this->query($sql, array_values($bind));
           } else {
               $stmt = $this->query($sql, $bind);
           }
           $result = $stmt->rowCount();
           return true;
       }

       /**
        * Deletes table rows based on a WHERE clause.
        *
        * @param  mixed        $table The table to update.
        * @param  mixed        $where DELETE WHERE clause(s).
        * @return int          The number of affected rows.
        */
       public function delete($table, $where = '') {
           $where = $this->_whereExpr($where);

           /**
            * Build the DELETE statement
            */
           $sql = "DELETE FROM "
                 . $table
                 . (($where) ? " WHERE $where" : '');

           /**
            * Execute the statement and return the number of affected rows
            */
           $stmt = $this->query($sql);
           $result = $stmt->rowCount();
           return true;
       }

   }
   