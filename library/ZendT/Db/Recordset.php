<?php

    /**
     * Classe para tratamento dos dados a serem inseridos no Banco de Dados
     * Está ligado diretamente ao modelo
     * 
     * @author rsantos
     */
    class ZendT_Db_Recordset {

        /**
         *
         * @var ZendT_Db_Mapper[]
         */
        private $_mappers;

        /**
         *
         * @var array|Zend_Db_Statement
         */
        private $_record;

        /**
         * Indice do array, quando recordset for array
         */
        private $_index;

        /**
         *
         * @var bool
         */
        private $_rowsFormated = false;

        /**
         *
         * @var array|stdClass
         */
        private $_row;

        /**
         *
         * @var array
         */
        private $_columnMappers;

        /**
         *
         * @var array
         */
        private $_replaceAlias;

        /**
         * Retorna o objeto no formato type ZendT_Type
         * 
         * @var bool
         */
        private $_type;

        /**
         *
         * @var array 
         */
        private $_typeColumn = array();

        /**
         * Retorna se as colunas foram formatadas
         * 
         * @return bool
         */
        public function isRowFormated() {
            return $this->_rowsFormated;
        }

        /**
         * Retorna o objeto mapper para tratar a saída dos dados
         * 
         * @param type $mapperName 
         * @return ZendT_Db_Mapper
         */
        private function _getMapper($mapperName) {
            if (!is_object($this->_mappers[$mapperName]) && $mapperName) {
                $this->_mappers[$mapperName] = new $mapperName();
            }
            return $this->_mappers[$mapperName];
        }

        /**
         *
         * @param ZendT_Type|string $mapperName
         * @param string $column
         * @return ZendT_Type
         */
        private function _getZendTType($mapperName, $column, $value) {
            $_type = null;
            if (is_object($mapperName)) {
                $_type = $mapperName;
                $_type->setValueFromDb($value);
            } else {
                $_mapper = $this->_getMapper($mapperName);
                if (!is_object($_mapper)) {
                    throw new ZendT_Exception('Mapper ' . $mapperName . ' parece não estar válido para coluna ' . $column);
                } else {
                    $_type = $_mapper->phpToType($value, $column);
                }
            }
            return $_type;
        }

        /**
         * Configura as colunas que serão formatadas antes da exibição dos dados
         * 
         * @param bool $value 
         */
        public function setColumnMappers($columnMappers) {
            if ($columnMappers instanceof ZendT_Db_Column_Mapper) {
                $columnMappers = $columnMappers->getColumnsMapper();
            }
            $this->_columnMappers = $columnMappers;
            $this->_rowsFormated = true;
            foreach ($this->_columnMappers as $mapper) {
                if (!is_object($mapper['mapper'])) {
                    if (!isset($this->_mappers[$mapper['mapper']])) {
                        $this->_mappers[$mapper['mapper']] = $mapper['mapper'];
                    }
                }
            }
        }

        /**
         * Formata os dados do array antes de retornar
         *
         * @param array|stdClass $row 
         */
        private function _formatRow(&$row) {
            foreach ($row as $key => $value) {
                $key = strtolower($key);
                $mapperName = '';
                if (isset($this->_columnMappers[$key]) && $this->_columnMappers[$key]['mapper']) {
                    $mapperName = $this->_columnMappers[$key]['mapper'];
                    $columnName = $this->_columnMappers[$key]['column'];
                } else {
                    $mapperName = $this->_columnMappers['default']['mapper'];
                    $columnName = $key;
                }
                if (!$mapperName) {
                    try {
                        throw new ZendT_Exception('Chave com mapper errado ' . $key);
                    } catch (ZendT_Exception $ex) {
                        echo nl2br($ex->getTraceAsString());
                    }
                }
                $_type = $this->_getZendTType($mapperName, $columnName, $value);
                if ($_type instanceof ZendT_Type) {
                    $_type->setValueFromDb($value);
                } else {
                    $app = getenv('APPLICATION_ENV');
                    if ($app == 'production' || $app == '' || 1 == 1) {
                        $_type = new ZendT_Type_Number($value);
                    } else {
                        throw new ZendT_Exception('Não definido o mapeamento para a coluna "' . $key . '" ');
                    }
                }
                /**
                 * 
                 */
                if ($this->_type) {
                    $row[$key] = clone $_type;
                } else {
                    $row[$key] = $_type->get();
                }
            }
        }

        /**
         *
         * @param type $oldAlias
         * @param type $newAlias 
         */
        public function addReplaceAlias($oldAlias, $newAlias) {
            $this->_replaceAlias[$oldAlias] = $newAlias;
        }

        /**
         * Busca o próximo registro
         *
         * @param type $style
         * @param type $cursor
         * @param type $offset
         * @return boolean 
         */
        public function fetch($style = null, $cursor = null, $offset = null) {
            $this->_row = false;
            if ($this->_record instanceof Zend_Db_Statement) {
                $this->_row = $this->_record->fetch($style, $cursor, $offset);
            } else {
                if ($this->_index > -1 && $this->_index < count($this->_record)) {
                    $this->_row = $this->_record[$this->_index];
                    $this->_index++;
                }
            }
            if ($this->_row) {
                if (count($this->_replaceAlias)) {
                    foreach ($this->_replaceAlias as $oldAlias => $newAlias) {
                        $this->_row[$newAlias] = $this->_row[$oldAlias];
                        unset($this->_row[$oldAlias]);
                    }
                }
                if ($this->isRowFormated()) {
                    $this->_formatRow($this->_row);
                }
            }
            return is_array($this->_row);
        }

        /**
         * Retorna os registros
         * @return array
         */
        public function getRows($style = null, $cursor = null, $offset = null) {
            $rows = array();
            while ($this->fetch($style, $cursor, $offset)) {
                $rows[] = $this->_row;
            }
            return $rows;
        }

        /**
         * Retorna o próximo registro em array
         * 
         * @return array
         */
        public function getRow($style = null, $cursor = null, $offset = null) {
            $this->fetch($style, $cursor, $offset);
            return $this->_row;
        }

        /**
         * Coloca os dados[record] na classe para tratamento dos dados
         *
         * @param array|Zend_Db_Statement $record
         * @param array $columnMappers 
         */
        public function __construct($record, $columnMappers = array(), $returnType = false) {
            $this->_record = $record;
            $this->_index = 0;
            $this->_type = $returnType;
            if ($columnMappers)
                $this->setColumnMappers($columnMappers);
            $this->_replaceAlias = array();
        }

        /**
         * Retorna se o retorno da função está no formato ZendT_Type
         * 
         * @return bool
         */
        public function getType() {
            return $this->_type;
        }

    }

?>
