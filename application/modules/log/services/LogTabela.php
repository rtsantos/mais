<?php
    /**
     * Colunas do Modelo
     */
    class LogTabela_Columns {
        
        /**
            * Coluna Identificação,chave primária
            *
            * @var string
            */
        public $id;
            
        /**
            * Coluna Nome
            *
            * @var string
            */
        public $nome;
            
        /**
            * Coluna OWNER
            *
            * @var string
            */
        public $owner;
            
        /**
            * Coluna Nome da Tabela
            *
            * @var string
            */
        public $table_name;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class LogTabela_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class LogTabela_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo LogTabela
         * @var LogTabela_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class LogTabela_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo LogTabela
         * @var LogTabela_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo LogTabela
     *
     * @package ZendT
     * @subpackage Service
     */
    class Log_Service_LogTabela extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Log_Model_LogTabela_Table();
        }
        /**
         * Insere um registro no modelo LogTabela
         *
         * @param string $token
         * @param LogTabela_Columns $data 
         * @return LogTabela_Result
         */
        public function insert($token,$data){  
            $_result = new LogTabela_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo LogTabela
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param LogTabela_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return LogTabela_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new LogTabela_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo LogTabela
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param LogTabela_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return LogTabela_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new LogTabela_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo LogTabela
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return LogTabela_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new LogTabela_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo LogTabela
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param LogTabela_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return LogTabela_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new LogTabela_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>