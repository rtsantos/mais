<?php
    /**
     * Colunas do Modelo
     */
    class LogOperac_Columns {
        
        /**
            * Coluna Identificação,chave primária
            *
            * @var string
            */
        public $id;
            
        /**
            * Coluna Código
            *
            * @var string
            */
        public $codigo;
            
        /**
            * Coluna Operação
            *
            * @var string
            */
        public $operacao;
            
        /**
            * Coluna Situação
            *
            * @var string
            */
        public $status;
            
        /**
            * Coluna Ação
            *
            * @var string
            */
        public $acao;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class LogOperac_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class LogOperac_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo LogOperac
         * @var LogOperac_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class LogOperac_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo LogOperac
         * @var LogOperac_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo LogOperac
     *
     * @package ZendT
     * @subpackage Service
     */
    class Log_Service_LogOperac extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Log_Model_LogOperac_Table();
        }
        /**
         * Insere um registro no modelo LogOperac
         *
         * @param string $token
         * @param LogOperac_Columns $data 
         * @return LogOperac_Result
         */
        public function insert($token,$data){  
            $_result = new LogOperac_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo LogOperac
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param LogOperac_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return LogOperac_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new LogOperac_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo LogOperac
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param LogOperac_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return LogOperac_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new LogOperac_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo LogOperac
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return LogOperac_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new LogOperac_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo LogOperac
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param LogOperac_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return LogOperac_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new LogOperac_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>