<?php

require_once('Zend/Db/Statement/Oracle.php');

/**
 * 
 */
class ZendT_Db_Statement_Oracle extends Zend_Db_Statement_Oracle {

    /**
     * (non-PHPdoc)
     * @see library/Zend/Db/Statement/Zend_Db_Statement_Oracle::fetch()
     */
    public function fetch($style = null, $cursor = null, $offset = null) {
        $result = parent::fetch($style, $cursor, $offset);        
        if ($result === false)
            return false;
        
        if (is_array($result)) {
            foreach ($result as $key => $value) {
                unset($result[$key]);
                if (is_object($value)){
                    @$lobValue = $value->load();
                    @$value->free();
                    $value = $lobValue;
                }
                $result[$this->_adapter->foldCase($key)] = $value;
            }
        } else {
            $aux = $result;
            $result = new stdClass();
            foreach ($aux as $key => $value) {
                if (is_object($value)){
                    @$lobValue = $value->load();
                    @$value->free();
                    $value = $lobValue;
                }
                $result->{$this->_adapter->foldCase($key)} = $value;
            }
        }
        return $result;
    }

    /**
     * (non-PHPdoc)
     * @see library/Zend/Db/Statement/Zend_Db_Statement_Oracle::fetchAll()
     */
    public function fetchAll($style = null, $col = 0) {
        $result = parent::fetchAll($style, $col);
        if (isset($result[0])) {
            for ($iLine = 0; $iLine < count($result); $iLine++) {
                if (is_array($result[$iLine])) {
                    foreach ($result[$iLine] as $key => $value) {
                        unset($result[$iLine][$key]);
                        if (is_object($value)){
                            @$lobValue = $value->load();
                            @$value->free();
                            $value = $lobValue;
                        }
                        $result[$iLine][$this->_adapter->foldCase($key)] = $value;
                    }
                } else {
                    $object = new stdClass();
                    foreach ($result[$iLine] as $key => $value) {
                        if (is_object($value)){
                            @$lobValue = $value->load();
                            @$value->free();
                            $value = $lobValue;
                        }
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
    protected function _bindParam($parameter, &$variable, $type = null, $length = null, $options = null) {
        $valueLob = '';
        if ($variable instanceof ZendT_Type_Date) {
            $variable = $variable->getValueToDb();
            $variable = substr(str_replace('T', ' ', $variable), 0, 19);
        }else if($variable instanceof ZendT_Type_Number) {
            $variable = $variable->getValueToDb();
            $type = SQLT_FLT;
        }else if ($variable instanceof ZendT_Type_Clob) {
            $valueLob = $variable->getValueToDb();
            $variable = oci_new_descriptor($this->_adapter->getConnection(), OCI_D_LOB);
            $type = OCI_B_CLOB;
            $length = -1;
        }else if ($variable instanceof ZendT_Type_Blob) {
            $valueLob = $variable->getValueToDb();
            $variable = oci_new_descriptor($this->_adapter->getConnection(), OCI_D_LOB);            
            $type = OCI_B_BLOB;
            $length = -1;
        }
        if ($variable instanceof ZendT_Type){
            $variable = $variable->getValueToDb();
        }
        // default value
        if ($type === NULL || $type === Zend_Db::PARAM_STR) {
            $type = SQLT_CHR;
        }

        if ($type == Zend_Db::PARAM_STMT) {
            $type = OCI_B_CURSOR;
            $variable = @oci_new_cursor($this->_adapter->getConnection());
            if (empty($variable)) {
                /**
                 * @see Zend_Db_Adapter_Oracle_Exception
                 */
                require_once 'Zend/Db/Statement/Oracle/Exception.php';
                $error = array("code" => "", "message" => "Error to create oracle cursor");
                throw new Zend_Db_Statement_Oracle_Exception(oci_error($variable));
            }
        }

        // default value
        if ($length === NULL) {
            $length = -1;
        }

        $retval = @oci_bind_by_name($this->_stmt, $parameter, $variable, $length, $type);
        if ($valueLob){
            $variable->WriteTemporary($valueLob);
        }

        if ($retval === false) {
            /**
             * @see Zend_Db_Adapter_Oracle_Exception
             */
            require_once 'Zend/Db/Statement/Oracle/Exception.php';
            throw new Zend_Db_Statement_Oracle_Exception(oci_error($this->_stmt));
        }

        return true;
    }
    
    protected function _prepare($sql) {
        $sql = str_replace(array(chr(10),chr(13)),array(' ',' '),$sql);
        parent::_prepare($sql);
    }

    /**
     * Executes a prepared statement.
     *
     * @param array $params OPTIONAL Values to bind to parameter placeholders.
     * @return bool
     * @throws Zend_Db_Statement_Exception
     */
    public function _execute(array $params = null) {
        $connection = $this->_adapter->getConnection();
        $lobs = array();

        if (!$this->_stmt) {
            return false;
        }
        
        if ($params !== null) {
            if (!is_array($params)) {
                $params = array($params);
            }
            $error = false;
            foreach (array_keys($params) as $name) {                
                if ($params[$name] instanceof ZendT_Type_Clob) {
                    $valueLob = $params[$name]->getValueToDb();
                    $type = OCI_B_CLOB;
                    $length = -1;
                    
                    $lobs[$name] = oci_new_descriptor($connection,OCI_D_LOB);
                } else if ($params[$name] instanceof ZendT_Type_Blob) {
                    $valueLob = $params[$name]->getValueToDb();
                    $type = OCI_B_BLOB;
                    $length = -1;
                    
                    $lobs[$name] = oci_new_descriptor($connection,OCI_D_LOB);
                } else if ($params[$name] instanceof ZendT_Type){
                    $valueParam = $params[$name]->getValueToDb();
                    if($valueParam instanceof ZendT_Type){
                        $valueParam = $valueParam->getValueToDb();
                    }
                    $params[$name] = $valueParam;
                }                
                if (isset($lobs[$name])){
                    if (!@oci_bind_by_name($this->_stmt, $name, $lobs[$name], $length, $type)) {
                        $error = true;
                        break;
                    }else{
                        $lobs[$name]->WriteTemporary($valueLob);
                    }                    
                }else{
                    if (!@oci_bind_by_name($this->_stmt, $name, $params[$name], -1)) {
                        $error = true;
                        break;
                    }
                }
            }
            if ($error) {
                /**
                 * @see Zend_Db_Adapter_Oracle_Exception
                 */
                require_once 'Zend/Db/Statement/Oracle/Exception.php';
                throw new Zend_Db_Statement_Oracle_Exception(oci_error($this->_stmt));
            }
        }

        $retval = @oci_execute($this->_stmt, $this->_adapter->_getExecuteMode());
        if ($retval === false) {
            /**
             * @see Zend_Db_Adapter_Oracle_Exception
             */
            require_once 'Zend/Db/Statement/Oracle/Exception.php';
            throw new Zend_Db_Statement_Oracle_Exception(oci_error($this->_stmt));
        }
        
        foreach ($lobs as &$value){
            $value->free();
        }
        $this->_keys = Array();
        if ($field_num = oci_num_fields($this->_stmt)) {
            for ($i = 1; $i <= $field_num; $i++) {
                $name = oci_field_name($this->_stmt, $i);
                $this->_keys[] = $name;
            }
        }

        $this->_values = Array();
        if ($this->_keys) {
            $this->_values = array_fill(0, count($this->_keys), null);
        }

        return $retval;
    }

}

?>