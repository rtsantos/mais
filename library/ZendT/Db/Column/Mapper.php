<?php
    /**
     * 
     */
    class ZendT_Db_Column_Mapper {
        private $_columns = array();
        /**
         * @param string $alias
         * @param string|ZendT_Type $mapper
         * @param string $column optional quando o $mapper for do tipo ZendT_Type
         * @return ZendT_Db_Mapper_Column
         */
        public function add($alias,$mapper,$column=null,$operation=null,$expression=null){
            if ($alias == '*'){
                $alias = 'default';
            }
            if($column==null){
                $column = $alias;
            }
            if ($operation==null){
                $operation = '';
            }
            $this->_columns[$alias] = array('mapper'=>$mapper,'column'=>$column,'operation'=>$operation,'expression'=>$expression);
            return $this;
        }
        /**
         *
         * @return array
         */
        public function getColumnsMapper(){
            return $this->_columns;
        }
        /**
         *
         * @param array $columns
         * @return \ZendT_Db_Column_Mapper 
         */
        public function setColumnsMapper($columns){
            $this->_columns = $columns;
            return $this;
        }
    }
?>
