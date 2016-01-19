<?php
    /**
     * Colunas do Modelo
     */
    class LogEvento_Columns {
        
        /**
            * Coluna Objeto
            *
            * @var string
            */
        public $id_log_objeto;
            
        /**
            * Coluna Operação
            *
            * @var string
            */
        public $id_log_operac;
            
        /**
            * Coluna Objeto,chave primária
            *
            * @var string
            */
        public $id_objeto;
            
        /**
            * Coluna Usuário
            *
            * @var string
            */
        public $id_usuario;
            
        /**
            * Coluna Data Hora do Evento
            *
            * @var string
            */
        public $dh_evento;
            
        /**
            * Coluna Chave
            *
            * @var string
            */
        public $chave;
            
        /**
            * Coluna Observação
            *
            * @var string
            */
        public $observacao;
            
        /**
            * Coluna Tabela,chave primária
            *
            * @var string
            */
        public $id_log_tabela;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class LogEvento_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class LogEvento_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo LogEvento
         * @var LogEvento_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class LogEvento_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo LogEvento
         * @var LogEvento_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo LogEvento
     *
     * @package ZendT
     * @subpackage Service
     */
    class Log_Service_LogEvento extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Log_Model_LogEvento_Table();
        }
        /**
         * Insere um registro no modelo LogEvento
         *
         * @param string $token
         * @param LogEvento_Columns $data 
         * @return LogEvento_Result
         */
        public function insert($token,$data){  
            $_result = new LogEvento_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo LogEvento
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param LogEvento_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return LogEvento_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new LogEvento_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo LogEvento
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param LogEvento_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return LogEvento_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new LogEvento_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo LogEvento
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return LogEvento_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new LogEvento_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo LogEvento
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param LogEvento_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return LogEvento_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new LogEvento_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>