<?php
    /**
     * Colunas do Modelo
     */
    class Maillisthist_Columns {
        
        /**
            * Coluna Identificação
            *
            * @var string
            */
        public $id_maillist;
            
        /**
            * Coluna Ação
            *
            * @var string
            */
        public $action;
            
        /**
            * Coluna DH. Ação
            *
            * @var string
            */
        public $dh_action;
            
        /**
            * Coluna Erro
            *
            * @var string
            */
        public $err_msg;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class Maillisthist_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class Maillisthist_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo Maillisthist
         * @var Maillisthist_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class Maillisthist_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo Maillisthist
         * @var Maillisthist_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo Maillisthist
     *
     * @package ZendT
     * @subpackage Service
     */
    class Tools_Service_Maillisthist extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Tools_Model_Maillisthist_Table();
        }
        /**
         * Insere um registro no modelo Maillisthist
         *
         * @param string $token
         * @param Maillisthist_Columns $data 
         * @return Maillisthist_Result
         */
        public function insert($token,$data){  
            $_result = new Maillisthist_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo Maillisthist
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param Maillisthist_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Maillisthist_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new Maillisthist_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo Maillisthist
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param Maillisthist_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Maillisthist_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new Maillisthist_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo Maillisthist
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return Maillisthist_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new Maillisthist_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo Maillisthist
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param Maillisthist_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Maillisthist_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new Maillisthist_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>