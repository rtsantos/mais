<?php

    /**
     * My_Db_Table_Abstract
     *  
     * @author Rafael Tiago
     * @version 1.0
     */
    class ZendT_Db_Table_Abstract extends Zend_Db_Table_Abstract {

        /**
         * Lista de opções de uma coluna da tabela
         * 
         * @var array
         */
        protected $_listOptions;

        /**
         * Coluna de pesquisa padrão
         * usado na seeker para efetuar uma pesquisa na tabela
         * 
         * @var string
         */
        protected $_search;

        /**
         * Nome do Mapper
         * 
         * @var type 
         */
        protected $_mapper;

        /**
         * Define os campos que devem ser únicos na tabela,
         * não deixando assim replicar valores
         * 
         * @var array 
         */
        protected $_unique;

        /**
         *
         * @var array
         */
        protected $_columnMappers;
        protected $_tableAlias;

        /**
         * Colunas de preenchimento obrigatório
         * 
         * @var array
         */
        protected $_required = array();

        /**
         * Gets the Zend_Db_Adapter_Abstract for this particular Zend_Db_Table object.
         *
         * @return ZendT_Db_Adapter_Oracle
         */
        public function getAdapter() {
            $this->_setAdapter($this->_adapter);
            return $this->_db;
        }

        /**
         * Salva os dados na tabela
         *
         * @param array|ZendT_Db_Mapper $data
         * @param string $event @example update,insert,delete
         * @param array|ZendT_Db_Where $where
         */
        public function save($data, $event = 'insert', $where = null) {
            $this->_setAdapter($this->_adapter);

            $event = strtolower($event);
            $rowPrimary = null;

            if (!is_array($this->_unique) && count($this->_primary) > 1) {
                $this->_unique = $this->_primary;
            }

            if (is_array($this->_unique)) {
                $wherePrimary = new ZendT_Db_Where();
                $existUnique = false;
                foreach ($this->_unique as $column) {
                    if ($column) {
                        if ($data instanceof ZendT_Db_Mapper) {
                            $valueUnique = $data->getData($column);
                        } else {
                            $valueUnique = $data[$column];
                        }
                        $wherePrimary->addFilter($column, $valueUnique, '=', $this->_mapper, true);
                        $existUnique = true;
                    }
                }
                if ($existUnique)
                    $rowPrimary = $wherePrimary;
            }
            /**
             * Valida se o registro que está sendo inserido ou alterado
             * contém um dos dados cadastrados no banco de dados
             * caso tenha não permite a alteração ou inclusão 
             */
            if ($rowPrimary instanceof ZendT_Db_Where && in_array($event, array('insert', 'update'))) {
                $wherePrimary = new ZendT_Db_Where();
                if ($event == 'update') {
                    if (is_string($this->_primary) && $this->_primary != '') {
                        $wherePrimary->addFilter($this->_primary, $data[$this->_primary], '<>');
                    } else {
                        if ($where == null) {
                            foreach ($this->_primary as $column) {
                                $valuePrimary = '';
                                if ($data instanceof ZendT_Db_Mapper) {
                                    $valuePrimary = $data->getData($column);
                                } else {
                                    $valuePrimary = $data[$column];
                                }
                                $wherePrimary->addFilter($column, $valuePrimary, '=', $this->_mapper, true);
                            }
                        } else {
                            $wherePrimary = $where;
                        }
                    }
                }
                $binds = $wherePrimary->getBinds();
                $binds+= $rowPrimary->getBinds();
                $sql = 'SELECT 1 FROM ' . $this->getTableName() . ' WHERE ' . $rowPrimary->getSqlWhere();
                if ($event == 'update') {
                    $sql.= ' AND NOT ' . $wherePrimary->getSqlWhere();
                }
                if ($this->getAdapter()->fetchOne($sql, $binds)) {
                    throw new ZendT_Exception_Business('Registro existente no cadastro!');
                }
            }
            /**
             * Caso existe sequencia, configura a coluna de Primary Key para receber a nova sequencia
             */
            if (isset($this->_sequence) && $this->_sequence != '' && $event == 'insert') {
                $id = '';
                if (is_string($this->_primary)) {
                    $id = $this->getAdapter()->nextSequenceTable($this->_name, $this->_primary, $this->_sequence);
                    //$this->getAdapter()->nextSequenceId(strtoupper($this->_sequence));
                } else if (count($this->_primary) == 1) {
                    //$id = $this->getAdapter()->nextSequenceId(strtoupper($this->_sequence));
                    if (isset($this->_primary[0])) {
                        $columnName = $this->_primary[0];
                    } elseif (isset($this->_primary[1])) {
                        $columnName = $this->_primary[1];
                    }
                    $id = $this->getAdapter()->nextSequenceTable($this->_name, $columnName, $this->_sequence);
                } else {
                    //throw new ZendT_Exception_Business('Não é possível atribuir sequencia para uma chave primária multipla!');
                }
                if ($id != '') {
                    foreach ($this->_primary as $column) {
                        if ($data instanceof ZendT_Db_Mapper) {
                            $data->setData($id, $column);
                        } else {
                            $data[$column] = $id;
                        }
                    }
                }
            }
            if ($event == 'insert') {
                return $this->insert($data);
            } elseif ($event == 'update') {
                return $this->update($data, $where);
            } elseif ($event == 'delete') {
                return $this->delete($where);
            }
        }

        /**
         * Junta o comando where com os valores, eliminando assim
         * a variavel de bind. Isso para pode usar os métodos de 
         * update e delete
         * 
         * @param type $cmdWhere
         * @param type $bindWhere 
         */
        private function mergeWhereToString($cmdWhere, $bindWhere) {
            $commandMerge = $cmdWhere;
            foreach ($bindWhere as $key => $value) {
                $commandMerge = str_replace(':' . $key, $this->getAdapter()->quote($value), $commandMerge);
            }
            return $commandMerge;
        }

        /**
         * Apaga uma linha da tabela
         * 
         * @param array|ZendT_Db_Where $where
         */
        public function delete($where) {
            $bindWhere = array();
            if (is_array($where)) {
                $_where = new ZendT_Db_Where('AND');
                foreach ($where as $column => $value) {
                    $_where->addFilter($column, $value);
                }
                $where = $_where;
                $bindWhere = $where->getBinds();
                $cmdWhere = $where->getSqlWhere();
            } elseif ($where instanceof ZendT_Db_Where) {
                $bindWhere = $where->getBinds();
                $cmdWhere = $where->getSqlWhere();
            } elseif (is_numeric($where)) {
                $cmdWhere = 'id = :id';
                $bindWhere = array('id' => $where);
            } elseif (is_string($where)) {
                $cmdWhere = $where;
            }
            if (count($bindWhere) > 0) {
                $cmdWhere = $this->mergeWhereToString($cmdWhere, $bindWhere);
            }
            if ($cmdWhere == '')
                throw new ZendT_Exception_Business('É necessário informar os parâmetros para continuar com essa ação!');

            $this->_setAdapter($this->_adapter);
            /**
             * @todo implementar se existe dependencia em tabelas 
             */
            $tableSpec = ($this->_schema ? $this->_schema . '.' : '') . $this->_name;
            return $this->_db->delete($tableSpec, $cmdWhere);

            //return parent::delete($cmdWhere);
        }

        /**
         * Altera um registro da tabela
         * 
         * @param array|ZendT_Db_Mapper $data 
         * @param array|ZendT_Db_Where $where
         */
        public function update($data, $where) {
            if ($data instanceof ZendT_Db_Mapper) {
                if (!$where) {
                    $where = $data->getWhere();
                }
                $data = $data->getData();
            }
            $bindWhere = array();
            if (is_array($where)) {
                $_where = new ZendT_Db_Where('AND');
                foreach ($where as $column => $value) {
                    $_where->addFilter($column, $value);
                }
                $where = $_where;
                $bindWhere = $where->getBinds();
                $cmdWhere = $where->getSqlWhere();
            } elseif ($where instanceof ZendT_Db_Where) {
                $bindWhere = $where->getBinds();
                $cmdWhere = $where->getSqlWhere();
            } elseif (is_string($where)) {
                $cmdWhere = $where;
            }
            if (count($bindWhere) > 0) {
                $cmdWhere = $this->mergeWhereToString($cmdWhere, $bindWhere);
            }
            foreach ($data as $columName => $value) {
                #@todo verificar motivo das colunas que represetam a chave primária estar sendo populado para update            
                if (in_array(strtoupper($columName), $this->_primary) && count($this->_primary) == 1) {
                    unset($data[$columName]);
                } else {
                    $data[strtoupper($columName)] = $value;
                    unset($data[$columName]);
                }
            }

            $this->_setAdapter($this->_adapter);
            if ($data) {
                $result = parent::update($data, $cmdWhere);
            }
            if (!$result) {
                return false;
            }
            return $data;
        }

        /**
         * Insere uma linha na tabela
         * 
         * @param array|ZendT_Db_Mapper $data 
         */
        public function insert($data) {
            if ($data instanceof ZendT_Db_Mapper) {
                $data = $data->getData();
            }
            foreach ($data as $columName => $value) {
                $data[strtoupper($columName)] = $value;
                unset($data[$columName]);
            }

            $this->_setAdapter($this->_adapter);
            $result = parent::insert($data);
            if ($result || $result === null) {
                $result = $data;
                $cid = strtoupper($this->_primary[1]);
                $id = $result[$cid];
                if ($id instanceof ZendT_Type){
                    $id = $id->toPhp();
                }
                if (count($this->_primary) == 1 && !$id){
                    $result[$cid] = $this->getAdapter()->lastInsertId($this->_name, $cid);
                }
            }
            return $result;
        }

        /**
         * Retorna os registros da tabela
         *
         * @param array|ZendT_Db_Where $where
         * @param array|string $columns
         * @param array|string $orderBy 
         */
        public function getRows($where = null, $columns = null, $orderBy = null, $type = false, $lock = false) {
            if ($columns == null || $columns == '')
                $columns = array('*');
            if ($orderBy == null || $orderBy == '')
                $orderBy = array('1');

            if (is_string($columns)) {
                $columns = array($columns);
            }

            if (is_string($orderBy)) {
                $orderBy = array($orderBy);
            }

            if (is_array($where)) {
                $_where = new ZendT_Db_Where('AND');
                foreach ($where as $column => $value) {
                    //$_where->addFilter($column, $value);
                    $_where->addFilter($column, $value, '=', $this->_mapper, true);
                }
                $where = $_where;
                $binds = $where->getBinds();
                $cmdwhere = $where->getSqlWhere();
            } elseif ($where instanceof ZendT_Db_Where || $where instanceof ZendT_Db_Where_Group) {
                $binds = $where->getBinds();
                $cmdwhere = $where->getSqlWhere();
            } elseif (is_numeric($where)) {
                $cmdwhere = 'id = :id';
                $binds = array('id' => $where);
            } elseif (is_string($where)) {
                $cmdwhere = $where;
            } elseif (is_int($where)) {
                $cmdwhere = 'id = :id';
                $binds = array('id' => $where);
            } elseif ($where === null) {
                $cmdwhere = '1 = 1';
                $binds = array();
            } else {
                $cmdwhere = '1 = 1';
                $binds = array();
            }

            $sql = 'SELECT ' . implode(',', $columns) . ' FROM ' . $this->getTableName() . ' ' . $this->getName() . ' WHERE ' . $cmdwhere;
            $sql.= ' ORDER BY ' . implode(',', $orderBy);

            if ($lock) {
                $sql .= ' FOR UPDATE';
            }

            $stmt = $this->getAdapter()->query($sql, $binds);

            if ($this->_columnMappers == '') {
                $this->_columnMappers = new ZendT_Db_Column_Mapper();
                $this->_columnMappers->add('default', $this->_mapper);
                /* foreach ($columns as $column){
                  $this->_columnMappers->add($column, $this->_mapper);
                  } */
            }
            if ($type) {
                $recordset = new ZendT_Db_Recordset($stmt, $this->_columnMappers, $type);
            } else {
                $recordset = new ZendT_Db_Recordset($stmt);
            }
            return $recordset->getRows();
        }

        /**
         * Retorna o registro
         *
         * @param int|string|ZendT_Db_Where|array $where
         * @param array $columns
         * @param bool $retObject Retorna em objeto
         * @return \stdClass 
         */
        public function retrieve($where, $columns = null, $retObject = true, $lock = false) {
            $row = new stdClass();
            $rows = $this->getRows($where, $columns, null, false, $lock);
            if (isset($rows[0])) {
                foreach ($rows[0] as $column => $value) {
                    $row->{$column} = $value;
                }
            } elseif (is_array($columns)) {
                foreach ($columns as $column) {
                    $row->{$column} = '';
                }
            }
            if (!$retObject) {
                $aux = array();
                foreach ($row as $key => $value) {
                    $aux[$key] = $value;
                }
                $row = $aux;
            }
            return $row;
        }

        /**
         * Retorna o registro
         *
         * @param int|string|ZendT_Db_Where|array $where
         * @param array $columns
         * @param bool $retObject Retorna em objeto
         * @return \stdClass 
         * @deprecated since version 1.1
         */
        public function retrive($where, $columns = null, $retObject = true, $lock = false) {
            return $this->retrieve($where, $columns, $retObject, $lock);
        }

        /**
         * Retorna o Nome da Tabela mapeado
         * 
         * @return type 
         */
        public function getTableName() {
            $tableName = '';
            if ($this->_schema) {
                $tableName = $this->getAdapter()->quoteObject($this->_schema).'.';
            }
            $tableName.= $this->getAdapter()->quoteObject($this->_name);
            return $tableName;
        }

        /**
         * Retorna a lista de opções de uma coluna
         *
         * @param string $columnName
         * @return array
         */
        public function getListOptions($columnName = null) {
            if ($columnName == null)
                return $this->_listOptions;
            else
                return $this->_listOptions[$columnName];
        }

        /**
         * Retorna o where do Seeker
         * 
         * @param string $value
         * @return ZendT_Db_Where 
         */
        public function getWhereSeekerSearch($value, $field = '') {
            $where = new ZendT_Db_Where('AND');
            $result = array();
            $result['column'] = '';
            $result['operation'] = '';
            $result['mapper'] = $this->getMapperName();

            if (count($this->_primary) == 1) {
                if (is_numeric($value)) {
                    $result['column'] = $this->_name . "." . $this->_primary[0];
                    $result['operation'] = '=';
                }
            }
            if ($result['column'] == '') {
                $result['column'] = $this->_name . "." . $this->_search;
                $result['operation'] = '?%';
            }
            if ($value) {
                $where->addFilter($result['column']
                        , $value
                        , $result['operation']
                        , $result['mapper']);
            }
            return $where;
        }

        /**
         * Busca o nome do Mapper
         * 
         * @return string
         */
        public function getMapperName() {
            return $this->_mapper;
        }

        /**
         * Retorna a chave primária da tabela
         * 
         * @return string|array
         */
        public function getPrimary() {
            return $this->_primary;
        }

        /**
         * Retorna o nome da tabela sem o schema
         * 
         * @return string
         */
        public function getName() {
            if (isset($this->_alias)){
                return $this->_alias;
            }
            return $this->_name;
        }

        /**
         *
         * @param array $columns
         * @return \ZendT_Db_Table_Select 
         */
        /* public function select($columns='',$tableAlias=''){
          if ($tableAlias)
          $this->_tableAlias = $tableAlias;

          if (!($this->_select instanceof ZendT_Db_Table_Select)){
          $this->_select = new ZendT_Db_Table_Select($this);
          $this->_select->setTableAlias($this->getTableAlias());
          $this->_select->select($columns);
          }
          return $this->_select;
          } */

        public function setTableAlias($tableAlias) {
            $this->_tableAlias = $tableAlias;
        }

        /**
         * Retorna o Alias da Tabela, para efetuar o Select
         * 
         * @return string 
         */
        public function getTableAlias() {
            if ($this->_tableAlias == '') {
                $this->_tableAlias = $this->_name;
            }
            return $this->_tableAlias;
        }

        /**
         * Pesquisa a referencia, caso encontre retorna os dados
         * da referência
         *
         * @param string $referenceKey
         * @return array 
         */
        public function getReferenceKey($referenceKey) {
            if (isset($this->_referenceMap[$referenceKey])) {
                return $this->_referenceMap[$referenceKey];
            } else {
                return false;
            }
        }

        /**
         * Retorna as configurações do elemento HTML
         *
         * @param string $columnName
         * @return ZendT_Form_Element
         */
        public function getElement($columnName) {
            
        }

        /**
         * Retorna as colunas de mapeamento
         * @return array
         */
        public function getColumnsMapper() {
            return $this->_columnMappers;
        }

        /**
         * Retorna um array contendo todas as colunas obrigatórias
         *
         * @return array
         */
        public function getRequired() {
            return $this->_required;
        }

        /**
         * Informa se a coluna é obrigatória
         *
         * @param string $field
         * @return boolean
         */
        public function isRequired($field) {
            return in_array($field, $this->_required);
        }

        /**
         * 
         * @return array
         */
        public function getCols() {
            return $this->_cols;
        }

        /**
         * Initialize database adapter.
         *
         * @return void
         * @throws Zend_Db_Table_Exception
         */
        protected function _setupDatabaseAdapter() {
            if (!$this->_db) {
                $this->_db = Zend_Registry::get($this->_adapter);
                if (!$this->_db instanceof Zend_Db_Adapter_Abstract) {
                    require_once 'Zend/Db/Table/Exception.php';
                    throw new Zend_Db_Table_Exception('No adapter found for ' . get_class($this));
                }
            }
        }

    }

?>