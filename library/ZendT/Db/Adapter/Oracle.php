<?php

   require_once('Zend/Db/Adapter/Oracle.php');

   /**
    * @category   ZendT
    * @package    ZendT_Db
    * @subpackage Adapter
    */
   class ZendT_Db_Adapter_Oracle extends Zend_Db_Adapter_Oracle {

       protected $_defaultStmtClass = 'ZendT_Db_Statement_Oracle';

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
           $limit_sql = "SELECT /*+ first_rows */ z2.*
            FROM (
                SELECT z1.*, ROWNUM AS \"zend_db_rownum\"
                FROM (
                    " . $select . "
                    " . $from . "
                    " . $where . "
                    AND ROWNUM <= " . ($offset + (4 * $count)) . "
                    " . $orderBy . "
                ) z1
            ) z2
            WHERE z2.\"zend_db_rownum\" BETWEEN " . ($offset + 1) . " AND " . ($offset + $count);
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
           $sqlCount = "SELECT /*+ first_rows */ COUNT(*) as \"total\" 
                       FROM (SELECT /*+ first_rows */ 1 as \"found\" 
                             " . $from . " 
                             " . $where . "
                             AND ROWNUM <= " . ($offset + (2 * $count)) . ") ";
           return $sqlCount;
       }

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
           $tableName = strtoupper($tableName);
           $schemaName = strtoupper($schemaName);

           $sql = "SELECT distinct uccfk.TABLE_NAME
                  FROM all_cons_columns uccfk
                     , all_constraints  uc
                     , all_cons_columns uccpk
                 WHERE uccfk.constraint_name = uc.constraint_name
                   AND uccfk.owner = uc.owner
                   AND uc.r_constraint_name = uccpk.constraint_name
                   AND uc.r_owner = uccpk.owner
                   AND uc.constraint_type = 'R'
                   AND uccpk.table_name = :table_name ";
           $bind = array('table_name' => $tableName);
           if ($schemaName != null) {
               $bind+= array('schema_name' => strtoupper($schemaName));
               $sql.= " AND uccpk.owner = :schema_name ";
           }
           $dependentTables = $this->fetchAll($sql, $bind);

           $sql = "SELECT uccfk.column_name
                      ,uccpk.table_name table_name_reference
                      ,uccpk.owner schema_name_reference
                      ,uccpk.column_name column_name_reference
                  FROM all_cons_columns uccfk
                      ,all_constraints  uc
                      ,all_cons_columns uccpk
                 WHERE uccfk.constraint_name = uc.constraint_name
                   AND uccfk.owner = uc.owner
                   AND uc.r_constraint_name = uccpk.constraint_name
                   AND uc.r_owner = uccpk.owner
                   AND uc.constraint_type = 'R'
                   AND uccfk.table_name = :table_name ";
           $bind = array('table_name' => $tableName);
           if ($schemaName != null) {
               $bind+= array('schema_name' => strtoupper($schemaName));
               $sql.= " AND uccfk.owner = :schema_name ";
           }
           $referenceMap = $this->fetchAll($sql, $bind);

           $desc[$this->foldCase('reference_map')] = $referenceMap;
           $desc[$this->foldCase('dependent_tables')] = $dependentTables;
           return $desc;
       }

       /**
        * Codifique uma string para se compor no comando SQL do Oracle
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
                   $value = $value->getValueToDb();
                   $value = substr(str_replace('T', ' ', $value), 0, 19);
                   return "TO_DATE('" . $value . "','YYYY-MM-DD HH24:MI')";
               } else if ($value instanceof ZendT_Type_Number) {
                   $value = $value->getValueToDb();
                   if (!$value) {
                       $value = 'NULL';
                   }
                   return $value;
               } else if ($value instanceof ZendT_Type) {
                   $value = $value->getValueToDb();
                   return parent::quote($value, $type);
               } else {
                   return parent::quote($value, $type);
               }
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
           if ($bind) {
               foreach ($bind as $name => &$value) {
                   if ($value instanceof Protheus_Type_Date) {
                       $value = $value->getValueToDb();
                   } else if ($value instanceof ZendT_Type_Date) {
                       if ($value->getType() == 'Date') {
                           $mask = 'YYYY-MM-DD';
                       } else {
                           $mask = 'YYYY-MM-DD HH24:MI';
                       }
                       $value = $value->getValueToDb();
                       $value = substr(str_replace('T', ' ', $value), 0, 19);

                       $sql = str_replace(':' . $name, "TO_DATE(:{$name},'{$mask}')", $sql);
                   }/* elseif ($value instanceof ZendT_Type){
                     $value = $value->getValueToDb();
                     } */
               }
           }
           return parent::query($sql, $bind);
       }

       /**
        * gera uma expressão de concatenação
        * 
        * @param array $columns 
        */
       public function concat($columns, $separator = '.') {
           $cmd = '';
           $first = true;
           foreach ($columns as $column) {
               if ($first) {
                   $first = false;
               } else {
                   $cmd.= "||'" . $separator . "'||";
               }
               $cmd.= $column;
           }
           return $cmd;
       }

       /**
        * Verifica se sequence existe
        * 
        * @param string $name
        * @return boolean 
        */
       public function existObject($name) {
           $name = strtoupper($name);
           $sql = 'SELECT 1 AS FOUND FROM user_objects WHERE object_name = :name ';
           $rows = $this->fetchAll($sql, array('name' => $name));
           if ($rows == false)
               return false;
           else
               return true;
       }

       /**
        * Crea a sequencia caso não exista
        *
        * @param string $name
        * @param string $numStart 
        */
       public function createSequence($name, $numStart = 1) {
           $sql = 'CREATE SEQUENCE ' . $name . ' START WITH ' . $numStart . ' INCREMENT BY 1 NOMAXVALUE NOCYCLE NOCACHE ';
           $stmt = $this->prepare($sql);
           $stmt->execute();
       }

       /**
        * Busca a próxima sequencia da tabela,
        * caso a sequencia não existe, esse procedimento cria
        * 
        * @param string $tableName
        * @param string $columnName 
        * @param string $sequence 
        * @return int
        */
       public function nextSequenceTable($tableName,$columnName,$sequence=''){
           if (!isset($sequence) || $sequence == '' || $sequence == '1') {
               $sequence = 'S'.$columnName.'_'.$tableName;
           }   
           $sequence = strtoupper($sequence);
           if (!$this->existObject($sequence)) {
               $sql = "SELECT NVL(MAX(" . $columnName . "),0) as num_start FROM " . $tableName;
               $rows = $this->fetchAll($sql);
               $numStart = $rows[0]['num_start'];
               $numStart+=1;
               $this->createSequence($sequence, $numStart);
           }
           return $this->nextSequenceId($sequence);
       }

       /**
        * Retorna a última sequencia inserida da tabela
        * 
        * @param string $tableName
        * @param string $columnName
        * @return int
        */
       public function lastSequenceTable($tableName, $columnName) {
           $sequence = 'S' . $columnName . '_' . $tableName;
           $sequence = strtoupper($sequence);
           return $this->lastSequenceId($sequence);
       }

       /**
        * 
        */
       protected function _connect() {
           $connected = $this->isConnected();
           /**
            * Está negado o IF abaixo, pois o comando deve ser executado 
            * apenas na primeira conexão para não dar lupe infinito 
            */
           if (!$connected) {
               parent::_connect();

               $stmt = $this->prepare("ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'");
               $stmt->execute();

               $stmt = $this->prepare("ALTER SESSION SET NLS_NUMERIC_CHARACTERS = '.,'");
               $stmt->execute();

               try {
                   @$uri = ZendT_Url::getUriApp();
                   @$obj = Zend_Auth::getInstance()->getStorage()->read();
                   if (method_exists($obj, 'getLogin')){
                      $user = Zend_Auth::getInstance()->getStorage()->read()->getLogin();
                   }else{
                       $user = 'ADMIN';
                   }

                   $sql = "BEGIN ";
                   $sql.= "  dbms_application_info.set_module('$uri', '$user'); ";
                   $sql.= "END; ";
                   $stmt = $this->prepare($sql);
                   $stmt->execute();
               } catch (Exception $ex) {
                   
               }
           }
       }

       /**
        * 
        *
        * @param string $value
        * @return string
        */
       public function quoteObject($value) {
           return '"' . strtoupper($value) . '"';
       }

   }
   