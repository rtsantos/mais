<?php
    /**
     * Classe tem como finalidade logar as consulta realizada sobre um relatório.
     *
     * @author rsantos
     */
    class ZendT_Log_Report {
        /**
         *
         * @var string
         */
        protected $_log = null;
        /**
         *
         * @param string $mapperView
         * @param string $title 
         */
        public function __construct($mapperView,$title) {
            $this->_log =  new Log_Context_Relatorio();
            $this->_log->start($mapperView,$title);
        }
        /**
         * Atualiza a data de término de execução junto ao banco de dados
         * 
         * @return \ZendT_Log_Report 
         */
        public function finishDb(){
            $this->_log->finishDb();
            return $this;
        }
        /**
         * Atualiza o término de exeução do relatório
         *
         * @param int $numRows Quantidade de Registro Processado
         * @return \ZendT_Log_Report 
         */
        public function finish($numRows=''){
            $this->_log->finish($numRows);
            return $this;
        }
    }
?>
