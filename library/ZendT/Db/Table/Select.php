<?php
    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */
    class ZendT_Db_Table_Select{
        /**
         *
         * @var ZendT_Db_Table_Abstract 
         */
        private $_table;
        /**
         *
         * @var ZendT_Db_Where 
         */
        private $_where;
        /**
         *
         * @var array
         */
        private $_columnsMapper;
        /**
         *
         * @var array|string
         */
        private $_columns;
        /**
         *
         * @var ZendT_Db_Table_Abstract[] 
         */
        private $_objectTable = array();
        /**
         *
         * @var string
         */
        private $_join;
        /**
         *
         * @param ZendT_Db_Table_Abstract $table 
         */
        public function __construct($table) {
            $this->_table = $table;
            $this->_columnsMapper = array();
            $this->_join = '';
        }
        /**
         *
         * @param type $name
         * @param type $arguments
         * @return ZendT_Db_Table_Abstract
         * @throws ZendT_Exception 
         */
        public function __call($name, $arguments) {
            if (substr($name,0,4) == 'join'){
                $reference = $this->_table->getReferenceKey('Id'.substr($name,4));
                if ($reference){
                    $objectName = $reference['refTableClass'].'_Table';
                    /**
                     * @var  ZendT_Db_Table_Abstract
                     */
                    $this->_objectTable[$objectName] = new $objectName();                    
                    $tableName = $this->_objectTable[$objectName]->getTableName();
                    if (isset($arguments[0])){
                        $this->_tableAlias = strtoupper( $arguments[0] );
                    }else{
                        $this->_tableAlias = strtoupper( substr($name,4).'_'.$this->_table->getTableAlias() );
                    }
                    $this->_join.= 'LEFT JOIN '.$tableName.' "'.$this->_tableAlias.'" ON ("'.$this->_table->getTableAlias().'".'.$reference['columns'].' = "'.$this->_tableAlias.'".'.$reference['refColumns'].')';
                    
                    $this->_objectTable[$objectName]->setTableAlias($this->_tableAlias);
                }else{
                    throw new ZendT_Exception('Tabela '.substr($name,4).' não relacionado ao objeto '.get_class($this->_table));
                }
            }
            return $this->_objectTable[$objectName];
        }
        /**
         *
         * @return string
         */
        public function getJoin(){
            return $this->_join;
        }
        /**
         *
         * @return string
         */
        public function getColumnsSelect(){
            if ($this->_columns && is_string($this->_columns)){
                $this->_columns = array($this->_columns);
            }
            $tableAlias = $this->_table->getTableAlias();
            $tableAlias = strtoupper($tableAlias);
            $this->_columnsMapper = array();
            if (is_array($this->_columns)){
                $cmdColumns = '';                
                foreach ($this->_columns as $column){
                    $column = strtoupper($column);
                    $aliasName = $column.'_'.$tableAlias;
                    $cmdColumns.= ',"'.$tableAlias.'"."'.$column.'" as "'.$aliasName.'" ';
                    $aliasName = strtolower($aliasName);
                    $this->_columnsMapper+= array($aliasName=>array('mapper'=>$this->_table->getMapperName()
                                                                   ,'column'=>$column));
                }
                $cmdColumns = substr($cmdColumns,1);
            }else{
                $cmdColumns = '"'.$tableAlias.'".*';
                $this->_columnsMapper = array('default'=>array('mapper'=>$this->_mapperName));
            }
            return $cmdColumns;
        }
        /**
         *
         * @param array $columns
         * @return \ZendT_Db_Table_Select 
         */
        public function select($columns=''){
            $this->_columns = $columns;            
            return $this;
        }
        /**
         *
         * @return array
         */
        public function getCommands(){
            $commands = array('columns'       => $this->getColumnsSelect()
                             ,'join'          => $this->getJoin());
            if (is_array($this->_objectTable)){
                foreach ($this->_objectTable as $table){
                    $_commands = $table->select()->getCommands();
                    $commands['columns'].= ','.$_commands['columns'];
                    $commands['join'].= ' '.$_commands['join'];
                    $this->_columnsMapper+= $_commands['columnMappers'];
                }
            }
            $commands['columnMappers'] = $this->_columnsMapper;
            return $commands;
        }
        
        public function setTableAlias($tableAlias){
            $this->_tableAlias = $tableAlias;
        }
        /**
         *
         * @param type $where
         * @return \ZendT_Db_Table_Select 
         */
        public function where($where){
            $this->_where = $where;
            return $this;
        }
        
        public function orderBy($order){
            $this->_order = $order;
        }
        
        public function sqlBase(){
            $cmdWhere = '';
            $this->_binds = array();
            if ($this->_where instanceof ZendT_Db_Table_Select){
                $cmdWhere = $this->_where->getSqlWhere();
                $this->_binds = $this->_where->getBinds();
            }
            
            $commands = $this->getCommands();            
            $sql = 'SELECT '.$commands['columns'];
            $sql.= '  FROM '.$this->_table->getTableName().' "'.$this->_table->getTableAlias().'" ';
            $sql.= ' '.$commands['join'];
            $sql.= ' WHERE 1 = 1 ';
            $sql.= $cmdWhere;
            if ($this->_order)
                $sql.= ' ORDER BY '.$this->_order;            
            print $sql;
            return $sql;
        }
        
        public function fetchAll(){
            $sql = $this->sqlBase();
            $query = new ZendT_Db_Recordset($this->_table->getAdapter()->query($sql, $this->_binds), $this->_columnsMapper);
            return $query->getRows();
        }
    }
?>
