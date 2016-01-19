<?php
    /**
     * Colunas do Modelo
     */
    class WslsServidor_Columns {
        
        /**
            * Coluna Identificação,chave primária
            *
            * @var string
            */
        public $id;
            
        /**
            * Coluna IP
            *
            * @var string
            */
        public $ip;
            
        /**
            * Coluna Padrão
            *
            * @var string
            */
        public $padrao;
            
        /**
            * Coluna Situação
            *
            * @var string
            */
        public $status;
            
        /**
            * Coluna Filial
            *
            * @var string
            */
        public $id_filial;
            
        /**
            * Coluna Posto Avançado
            *
            * @var string
            */
        public $id_posto_avancado;
            
        /**
            * Coluna Impressora Padrão
            *
            * @var string
            */
        public $impressora_padrao;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class WslsServidor_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class WslsServidor_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo WslsServidor
         * @var WslsServidor_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class WslsServidor_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo WslsServidor
         * @var WslsServidor_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo WslsServidor
     *
     * @package ZendT
     * @subpackage Service
     */
    class Tools_Service_WslsServidor extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Tools_Model_WslsServidor_Table();
        }
        /**
         * Insere um registro no modelo WslsServidor
         *
         * @param string $token
         * @param WslsServidor_Columns $data 
         * @return WslsServidor_Result
         */
        public function insert($token,$data){  
            $_result = new WslsServidor_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo WslsServidor
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param WslsServidor_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return WslsServidor_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new WslsServidor_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo WslsServidor
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param WslsServidor_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return WslsServidor_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new WslsServidor_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo WslsServidor
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return WslsServidor_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new WslsServidor_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo WslsServidor
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param WslsServidor_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return WslsServidor_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new WslsServidor_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>