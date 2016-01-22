<?php

    /**
     * Objeto para retornar os dados vindos do modelo que serão 
     * tratados e passados para a classe ZendT_Grid_Content
     *
     * @author rsantos
     */
    class ZendT_Grid_Data extends ZendT_Db_Recordset {

        /**
         *
         * @var int
         */
        private $_numRows;

        /**
         *
         * @var int 
         */
        private $_numPage;

        /**
         * Busca o número da página
         * 
         * @return int
         */
        public function getNumPage() {
            return $this->_numPage;
        }

        /**
         * Configura o número da página
         * 
         * @param int $value 
         * @return ZendT_Grid_Data
         */
        public function setNumPage($value) {
            $this->_numPage = $value;
            return $this;
        }

        /**
         * Configura o número de registros que o SQL vai retornar
         * 
         * @param int $value 
         * @return ZendT_Grid_Data
         */
        public function setNumRows($value) {
            $this->_numRows = $value;
            $this->_index = -1;
            return $this;
        }

        /**
         * Retorna o número de registros
         * 
         * @return int 
         */
        public function getNumRows() {
            return $this->_numRows;
        }

        /**
         * Configura os registros que serão tratados no recordset
         * 
         * @param array|Zend_Db_Statement $record
         * @return ZendT_Grid_Data
         */
        public function setRows($record) {
            $this->_index = 0;
            $this->_record = $record;
            return $this;
        }

        /**
         *
         * @param array|Zend_Db_Statement $record
         * @param array $columnMappers 
         */
        public function __construct($record = array(), $columnMappers = array(), $returnType = false) {
            parent::__construct($record, $columnMappers, $returnType);
        }

    }

?>
