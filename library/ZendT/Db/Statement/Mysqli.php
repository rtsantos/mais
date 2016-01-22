<?php

    require_once('Zend/Db/Statement/Mysqli.php');

    /**
     * 
     */
    class ZendT_Db_Statement_Mysqli extends Zend_Db_Statement_Mysqli {

        /**
         * (non-PHPdoc)
         * @see library/Zend/Db/Statement/Zend_Db_Statement_Mysqli::fetch()
         */
        public function fetch($style = null, $cursor = null, $offset = null) {
            $result = parent::fetch($style, $cursor, $offset);
            if (is_array($result)) {
                foreach ($result as $key => $value) {
                    unset($result[$key]);
                    $result[$this->_adapter->foldCase($key)] = $value;
                }
            } else {
                $aux = $result;
                $result = new stdClass();
                foreach ($aux as $key => $value) {
                    $result->{$this->_adapter->foldCase($key)} = $value;
                }
            }
            return $result;
        }

        /**
         * (non-PHPdoc)
         * @see library/Zend/Db/Statement/Zend_Db_Statement_Mysqli::fetchAll()
         */
        public function fetchAll($style = null, $col = 0) {
            $result = parent::fetchAll($style, $col);
            if (isset($result[0])) {
                for ($iLine = 0; $iLine < count($result); $iLine++) {
                    if (is_array($result[$iLine])) {
                        foreach ($result[$iLine] as $key => $value) {
                            unset($result[$iLine][$key]);
                            $result[$iLine][$this->_adapter->foldCase($key)] = $value;
                        }
                    } else {
                        $object = new stdClass();
                        foreach ($result[$iLine] as $key => $value) {
                            $object->{$this->_adapter->foldCase($key)} = $value;
                        }
                        $result[$iLine] = $object;
                    }
                }
            }
            return $result;
        }

        /**
         * Binds a parameter to the specified variable name.
         *
         * @param mixed $parameter Name the parameter, either integer or string.
         * @param mixed $variable  Reference to PHP variable containing the value.
         * @param mixed $type      OPTIONAL Datatype of SQL parameter.
         * @param mixed $length    OPTIONAL Length of SQL parameter.
         * @param mixed $options   OPTIONAL Other options.
         * @return bool
         * @throws Zend_Db_Statement_Exception
         */
        /*protected function _bindParam($parameter, &$variable, $type = null, $length = null, $options = null) {
            return true;
        }*/

    }

?>