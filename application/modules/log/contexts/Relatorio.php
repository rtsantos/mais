<?php
    /**
     * Classe tem como finalidade logar as consulta realizada sobre um relatório.
     *
     * @author rsantos
     */
    class Log_Context_Relatorio extends Log_Model_Relatorio_Mapper{
        private $_session='';
        /**
         * Inicía o log de Relatório
         *
         * @param string $mapperView
         * @param string $title
         * @return \Log_Context_Relatorio 
         */
        public function start($mapperView,$title){
            $this->_session = Zend_Session::getId();
            if ($this->_session){
                $idUsuario = Zend_Auth::getInstance()->getStorage()->read()->getId();
                $this->setArquivo($mapperView)
                    ->setTitulo($title)
                    ->setSessao($this->_session)
                    ->setIdUsuario($idUsuario)
                    ->setDhIniExec(ZendT_Type_Date::nowDateTime())
                    ->setImpresso('N')
                    ->insert();
            }
            return $this;
        }
        /**
         * Atualiza a data de término de execução junto ao banco de dados
         * 
         * @return \Log_Context_Relatorio 
         */
        public function finishDb(){
            if ($this->_session){
                $this->setDhFimExec(ZendT_Type_Date::nowDateTime())
                    ->update();
            }
            return $this;
        }
        /**
         * Atualiza o término de exeução do relatório
         *
         * @param int $numRows Quantidade de Registro Processado
         * @return \Log_Context_Relatorio 
         */
        public function finish($numRows=''){
            if ($this->_session){
                $this->setQtdReg($numRows)
                    ->setDhFimRelat(ZendT_Type_Date::nowDateTime())
                    ->update();
            }
            return $this;
        }
    }
?>
