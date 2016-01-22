<?php

    class ZendT_Db_Adapter_ParseSQL {

        /**
         *
         * @var array
         */
        private $_keysConditional = array(' AND NOT', ' AND ', ' OR NOT', ' OR ', 'AND(', 'OR(');

        /**
         *
         * @var array
         */
        private $_keysOperator = array('=', '>=', '<=', '<>', '>', '<', '!=', ' IS NULL ', ' IS NOT NULL ', 'NOT IN', 'NOT IN(', ' NOT IN ', ' NOT IN(', ')NOT IN(', ' IN ', ' IN(', ')IN(', 'NOT LIKE', 'LIKE', 'BETWEEN');

        /**
         * Quebra a string em pedaços, com base nas chaves passadas
         * 
         * @param string $cmd
         * @param array $keys
         * @return array
         */
        function _explode($cmd, $keys) {
            $cmds = array();
            for ($i = 0; $i < strlen($cmd); $i++) {
                foreach ($keys as $key) {
                    $strComp = strtoupper(substr($cmd, $i, strlen($key)));
                    if ($strComp == $key) {
                        if ($i > 0) {
                            $cmds[] = substr($cmd, 0, $i);
                        }
                        $cmds[] = trim($strComp);
                        $cmd = substr($cmd, $i + strlen($key));
                        $i = 0;
                        break;
                    }
                }
            }
            if (trim($cmd)) {
                $cmds[] = $cmd;
            }
            return $cmds;
        }

        protected function _breakCommand($commands) {
            //@todo: Patrick-> Erro no parseNode
            $commands = $this->_explode($commands, $this->_keysConditional);
            foreach ($commands as &$command) {
                $comment = '';
                $startComment = strpos($command, '/*');
                if ($startComment !== false) {
                    $finishComment = strpos($command, '*/');
                    $comment = substr($command, $startComment, ($finishComment - $startComment) + 2);
                    $command = str_replace($comment, '', $command);
                    $comment = str_replace(array('/*', '*/'), '', $comment);
                }
                $where = $this->_explode($command, $this->_keysOperator);
                if (count($where) > 1) {

                    if ($where[1] == 'IN') {
                        $command = array(
                            'comment' => trim($comment),
                            'field' => trim($where[0]),
                            'operator' => trim($where[1]),
                            'value' => trim(str_replace(array('|IN|', '[', ']'), array('IN', '(', ')'), trim($where[2], '|')))
                        );
                    } else if ($where[1] == 'NOT IN') {
                        $command = array(
                            'comment' => trim($comment),
                            'field' => trim($where[0]),
                            'operator' => trim($where[1]),
                            'value' => trim(str_replace(array('|NOT IN|', '[', ']'), array('NOT IN', '(', ')'), trim($where[2], '|')))
                        );
                    } else {
                        $command = array(
                            'comment' => trim($comment),
                            'field' => trim($where[0]),
                            'operator' => trim($where[1]),
                            'value' => trim($where[2])
                        );
                    }
                } else {
                    $command = array(
                        'condition' => trim($where[0])
                    );
                }
            }
            return $commands;
        }

        protected function _breakPrepare($sql) {
            $keys = array('IN(', 'IN (', 'NOT IN(', 'NOT IN (');
            $sql = str_replace("'", "", $sql);
            $prepare = true;
            $iInterator = 0;
            $cInterator = strlen($sql);
            while ($prepare) {
                foreach ($keys as $key) {
                    $pos = strpos(strtoupper($sql), $key);
                    if ($pos !== false) {
                        $level = 0;
                        $len = strlen($sql);
                        $iStart = false;
                        for ($i = $pos; $i < $len; $i++) {
                            if (substr($sql, $i, 1) == '(') {
                                if ($iStart === false) {
                                    $iStart = $i;
                                }
                                $level++;
                            } else if (substr($sql, $i, 1) == ')') {
                                $level--;
                            }
                            if ($level == 0 && $iStart !== false) {
                                $start = substr($sql, 0, $iStart);
                                $finish = substr($sql, $i + 1);

                                $part = substr($sql, $iStart + 1, ($i - $iStart) - 1);
                                $part = str_replace(array('(', ')'), array('[', ']'), $part);

                                $parts = $this->_explode($part, $this->_keysOperator);
                                foreach ($parts as &$part) {
                                    if (strtoupper(trim($part)) == "IN") {
                                        $part = '|IN|';
                                    } else if (strtoupper(trim($part)) == "NOT IN") {
                                        $part = '|NOT IN|';
                                    }
                                }
                                $part = implode(' ', $parts);

                                $sql = $start
                                        . '|'
                                        . $part
                                        . '|'
                                        . $finish;
                                $len = strlen($sql);
                                $i = $len;
                            }
                        }
                        break;
                    }
                }
                if ($pos === false || $iInterator == $cInterator) {
                    $prepare = false;
                }
                $iInterator++;
            }
            return $sql;
        }

        protected function _break($sql, $prepare = true) {
            if ($prepare) {
                $sql = $this->_breakPrepare($sql);
            }

            $data = array();
            $cmd = substr($sql, 0, strpos($sql, '('));
            if ($cmd) {
                $commands = $this->_breakCommand($cmd);
                $data = array_merge($data, $commands);
                $sql = substr($sql, strpos($sql, '('));
            }

            $level = 0;
            $found = false;
            $len = strlen($sql);
            for ($i = 0; $i < $len; $i++) {
                $char = substr($sql, $i, 1);
                if ($char == '(') {
                    $found = true;
                    $level++;
                } else if ($char == ')') {
                    $level--;
                }
                if ($level == 0 && $found) {
                    $cmd = substr($sql, 1,$i - 1);
                    $rules = array();
                    $isFind = (strpos($cmd, '(') !== false);
                    if ($isFind) {
                        $rules = $this->_break($cmd, false);
                        $data[] = array('rules' => $rules);
                    } else {
                        $commands = $this->_breakCommand($cmd);
                        $data[] = array('rules' => $commands);
                    }
                    $sql = substr($sql, $i + 1);
                    $iPos = strpos($sql, '(');
                    if ($iPos !== false){
                        $operator = substr($sql, 0, $iPos);
                        $data[] = array('condition' => trim($operator));
                        $sql = substr($sql,$iPos);
                    }
                    $i = -1;
                    $len = strlen($sql);
                    $found = false;
                }
            }

            if ($sql && !$found) {
                $commands = $this->_breakCommand($sql);
                $data = array_merge($data, $commands);
            }

            return $data;
        }

        /**
         * 
         * @param string $sql
         * @return array
         */
        function toArray($sql) {
            return $this->_break($sql);
        }

        public static function parse($sql) {

            if (($pos = strpos($sql, '_Model_')) !== false) {
                $objects = array();
                $sqlObject = $sql;
                while (($pos = strpos($sqlObject, '_Model_')) !== false) {
                    $st = strrpos(substr($sqlObject, 0, $pos), " ");
                    $fn = strpos($sqlObject, " ", $pos);
                    $objectName = substr($sqlObject, $st + 1, ($fn - $st) - 1);

                    $posSpace = strpos($sqlObject, " ", $fn + 1);
                    $len = ($posSpace - $fn);
                    if ($len) {
                        $aliasName = substr($sqlObject, $fn + 1, $len);
                    } else {
                        $aliasName = substr($sqlObject, $fn + 1);
                    }
                    $objects[$objectName] = trim($aliasName);
                    $sqlObject = substr($sqlObject, $fn);
                }


                $tableAlias = array();
                $columns = array();
                $sqlPoint = str_replace(array(' as ', ' As ', ' AS ', ' aS '), ' ', $sql);
                while (($pos = strpos($sqlPoint, '.')) !== false) {
                    /**
                     * find " " or "("
                     */
                    $aliasName = '';
                    $aliasFind = substr($sqlPoint, 0, $pos);

                    $aliasPos = strrpos($aliasFind, "(");
                    if ($aliasPos === false)
                        $aliasPos = strrpos($aliasFind, " ");

                    if ($aliasPos !== false) {
                        $aliasName = substr($aliasFind, $aliasPos + 1);
                    }
                    /**
                     * find column name
                     */
                    $columnName = '';
                    $columnFind = substr($sqlPoint, $pos);

                    $columnPos = strpos($columnFind, ",");
                    if ($columnPos === false)
                        $columnPos = strpos($columnFind, " ");
                    if ($columnPos === false)
                        $columnPos = strpos($columnFind, chr(10));
                    if ($columnPos === false)
                        $columnPos = strpos($columnFind, ")");

                    if ($columnPos !== false) {
                        $columnAlias = '';
                        $columnName = substr($columnFind, 1, $columnPos - 1);
                        list($columnName, $columnAlias) = explode(' ', $columnName);

                        if ($columnAlias == '') {
                            $columnFind = substr($columnFind, $columnPos);
                            $columnPos = strpos($columnFind, ",");
                            if ($columnPos === false) {
                                $columnPos = strpos(strtoupper($columnFind), " FROM ");
                                if ($columnPos !== false) {
                                    $columnFind = substr($columnFind, 1, $columnPos);
                                    if ($columnFind) {
                                        $columnAlias = trim($columnFind);
                                    } else {
                                        $columnAlias = $columnName;
                                    }
                                }
                            } else {
                                $columnAlias = $columnName;
                            }
                        }
                    }
                    if ($columnName) {
                        $columns[$aliasName][] = array(
                            'name' => $columnName,
                            'alias' => $columnAlias,
                            'st' => $st,
                            'fn' => $fn
                        );
                    }
                    /**
                     * 
                     */
                    $sqlPoint = substr($sqlPoint, $pos + 1);
                }
                if (count($objects) > 0) {
                    foreach ($objects as $objectName => $aliasName) {
                        $_table = new $objectName();
                        $tableName = $_table->getTableName();
                        $cols = $_table->getCols();

                        foreach ($columns[$aliasName] as $column) {
                            $columnName = $column['name'];
                            $columnAlias = $column['alias'];

                            $columnNameQuote = $_table->getAdapter()->quoteObject($columnName);
                            $columnAliasQuote = $_table->getAdapter()->quoteObject($columnAlias);
                            $sql = str_replace('.' . $columnName . ' ', '.' . $columnNameQuote . ' ', $sql);
                            $sql = str_replace('.' . $columnName . ',', '.' . $columnNameQuote . ',', $sql);
                            $sql = str_replace('.' . $columnName . chr(10), '.' . $columnNameQuote . chr(10), $sql);

                            if ($columnAlias) {
                                $sql = str_replace(' ' . $columnAlias . ' ', ' ' . $columnAliasQuote . ' ', $sql);
                                $sql = str_replace(' ' . $columnAlias . ',', ' ' . $columnAliasQuote . ',', $sql);
                                $sql = str_replace(' ' . $columnAlias . chr(10), ' ' . $columnAliasQuote . chr(10), $sql);
                            }

                            /* $cols = $_table->getCols();

                              foreach ($columns[$aliasName] as $columnName => $columnAlias) {
                              if (in_array(strtoupper($columnName), $cols)){

                              }
                              } */
                        }

                        $sql = str_replace($objectName, $tableName, $sql);
                    }
                }
                return $sql;
            } else {
                return $sql;
            }
        }

    }
    