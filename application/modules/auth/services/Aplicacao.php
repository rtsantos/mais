<?php
    /**
     * Colunas do Modelo
     */
    class Aplicacao_Columns {
        
        /**
            * Coluna Código,chave primária
            *
            * @var string
            */
        public $id;
            
        /**
            * Coluna Sigla
            *
            * @var string
            */
        public $sigla;
            
        /**
            * Coluna Nome
            *
            * @var string
            */
        public $nome;
            
        /**
            * Coluna Situação
            *
            * @var string
            */
        public $status;
            
        /**
            * Coluna Observação
            *
            * @var string
            */
        public $observacao;
            
        /**
            * Coluna Data de Cadastro
            *
            * @var string
            */
        public $datahora;
            
        /**
            * Coluna Schema
            *
            * @var string
            */
        public $schema;
            
        /**
            * Coluna Senha
            *
            * @var string
            */
        public $senha;
            
        /**
            * Coluna Aplicação Web
            *
            * @var string
            */
        public $webapp;
            
        /**
            * Coluna Área
            *
            * @var string
            */
        public $area;
            
        /**
            * Coluna Ícone
            *
            * @var string
            */
        public $icone;
            
        /**
            * Coluna Url
            *
            * @var string
            */
        public $url;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class Aplicacao_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class Aplicacao_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo Aplicacao
         * @var Aplicacao_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class Aplicacao_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo Aplicacao
         * @var Aplicacao_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo Aplicacao
     *
     * @package ZendT
     * @subpackage Service
     */
    class Auth_Service_Aplicacao extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Auth_Model_Aplicacao_Table();
        }
        /**
         * Insere um registro no modelo Aplicacao
         *
         * @param string $token
         * @param Aplicacao_Columns $data 
         * @return Aplicacao_Result
         */
        public function insert($token,$data){  
            $_result = new Aplicacao_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo Aplicacao
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param Aplicacao_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Aplicacao_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new Aplicacao_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo Aplicacao
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param Aplicacao_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Aplicacao_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new Aplicacao_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo Aplicacao
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return Aplicacao_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new Aplicacao_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo Aplicacao
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param Aplicacao_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Aplicacao_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new Aplicacao_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>