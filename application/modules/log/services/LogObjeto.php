<?php
    /**
     * Colunas do Modelo
     */
    class LogObjeto_Columns {
        
        /**
            * Coluna id,chave primária
            *
            * @var string
            */
        public $id;
            
        /**
            * Coluna nome
            *
            * @var string
            */
        public $nome;
            
        /**
            * Coluna Descrição
            *
            * @var string
            */
        public $descricao;
            
        /**
            * Coluna Situação
            *
            * @var string
            */
        public $status;
            
        /**
            * Coluna Log Tabela
            *
            * @var string
            */
        public $id_log_tabela;
            
        /**
            * Coluna Tempo de Vida
            *
            * @var string
            */
        public $tempo_vida;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class LogObjeto_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class LogObjeto_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo LogObjeto
         * @var LogObjeto_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class LogObjeto_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo LogObjeto
         * @var LogObjeto_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo LogObjeto
     *
     * @package ZendT
     * @subpackage Service
     */
    class Log_Service_LogObjeto extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Log_Model_LogObjeto_Table();
        }
        /**
         * Insere um registro no modelo LogObjeto
         *
         * @param string $token
         * @param LogObjeto_Columns $data 
         * @return LogObjeto_Result
         */
        public function insert($token,$data){  
            $_result = new LogObjeto_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo LogObjeto
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param LogObjeto_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return LogObjeto_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new LogObjeto_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo LogObjeto
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param LogObjeto_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return LogObjeto_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new LogObjeto_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo LogObjeto
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return LogObjeto_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new LogObjeto_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo LogObjeto
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param LogObjeto_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return LogObjeto_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new LogObjeto_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>