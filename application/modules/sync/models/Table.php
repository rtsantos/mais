<?php

   class Sync_Model_Table {

       public function mirror($table, $adapter, $adapterMirror, $where='1 = 1') {
           $table = strtoupper($table);
           /* @var Zend_Db_Adapter_Oracle */
           $_adapter = Zend_Registry::get('db.' . strtolower($adapter));
           /* @var Zend_Db_Adapter_Oracle */
           $_adapterMirror = Zend_Registry::get('db.' . strtolower($adapterMirror));

           $desc = $_adapterMirror->describeTable($table);
           if (count($desc['reference_map']) > 0){
               foreach($desc['reference_map'] as $key=>$reference){
                   unset($desc['reference_map'][$key]);
                   $field = strtolower($reference['column_name']);
                   $desc['reference_map'][$field] = $reference;
               }
           }
           /*echo '<pre>';
           print_r($desc);
           echo '</pre>';
           exit;*/

           $sql = "SELECT * FROM " . $table ." WHERE " . $where;
           $rows = $_adapter->fetchAll($sql);
           if ($rows) {
               foreach ($rows as $row) {
                   $sql = "SELECT 1 as Found FROM " . $table;
                   $sql.= " WHERE ID = " . $row['id'];
                   $found = $_adapterMirror->fetchOne($sql);

                   $bind = array();
                   foreach ($row as $field => $value) {
                       if (isset($desc[$field])) {
                           $bind[strtoupper($field)] = $value;
                           if (isset($desc['reference_map'][$field])){
                               $sql = 'SELECT 1 FROM '.
                                      $desc['reference_map'][$field]['schema_name_reference'] . 
                                      '.' .
                                      $desc['reference_map'][$field]['table_name_reference'] .
                                      ' WHERE ' . $desc['reference_map'][$field]['column_name_reference'] . ' = ' . $value;
                               if (!$_adapterMirror->fetchOne($sql)){
                                   $this->mirror( $desc['reference_map'][$field]['table_name_reference']
                                                , strtolower($desc['reference_map'][$field]['schema_name_reference'])
                                                , strtolower($desc['reference_map'][$field]['schema_name_reference']).'-mirror'
                                                , $desc['reference_map'][$field]['column_name_reference'] . ' = ' . $value);
                               }
                           }
                       }
                   }

                   if ($found) {
                       $_adapterMirror->update($table, $bind, ' ID = ' . $row['id']);
                   } else {
                       $_adapterMirror->insert($table, $bind);
                   }
               }
           }
       }

   }
   