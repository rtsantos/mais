<?php
    /**
     * Colunas do Modelo
     */
    class Recurso_Columns {
        
        /**
            * Coluna Identificação,chave primária
            *
            * @var string
            */
        public $id;
            
        /**
            * Coluna Tipo de Recurso
            *
            * @var string
            */
        public $id_tipo_recurso;
            
        /**
            * Coluna Aplicação
            *
            * @var string
            */
        public $id_aplicacao;
            
        /**
            * Coluna Recurso Pai
            *
            * @var string
            */
        public $id_recurso_pai;
            
        /**
            * Coluna Nome
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
            * Coluna Ícone
            *
            * @var string
            */
        public $icone;
            
        /**
            * Coluna Observação
            *
            * @var string
            */
        public $observacao;
            
        /**
            * Coluna Ordem
            *
            * @var string
            */
        public $ordem;
            
        /**
            * Coluna Nível
            *
            * @var string
            */
        public $nivel;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class Recurso_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class Recurso_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo Recurso
         * @var Recurso_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class Recurso_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo Recurso
         * @var Recurso_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo Recurso
     *
     * @package ZendT
     * @subpackage Service
     */
    class Auth_Service_Recurso extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Auth_Model_Recurso_Table();
        }
        /**
         * Insere um registro no modelo Recurso
         *
         * @param string $token
         * @param Recurso_Columns $data 
         * @return Recurso_Result
         */
        public function insert($token,$data){  
            $_result = new Recurso_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo Recurso
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param Recurso_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Recurso_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new Recurso_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo Recurso
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param Recurso_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Recurso_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new Recurso_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo Recurso
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return Recurso_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new Recurso_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo Recurso
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param Recurso_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Recurso_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new Recurso_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>