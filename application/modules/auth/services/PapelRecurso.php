<?php
    /**
     * Colunas do Modelo
     */
    class PapelRecurso_Columns {
        
        /**
            * Coluna Papel,chave primária
            *
            * @var string
            */
        public $id_papel;
            
        /**
            * Coluna Recurso,chave primária
            *
            * @var string
            */
        public $id_recurso;
            
        /**
            * Coluna acesso
            *
            * @var string
            */
        public $acesso;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class PapelRecurso_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class PapelRecurso_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo PapelRecurso
         * @var PapelRecurso_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class PapelRecurso_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo PapelRecurso
         * @var PapelRecurso_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo PapelRecurso
     *
     * @package ZendT
     * @subpackage Service
     */
    class Auth_Service_PapelRecurso extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Auth_Model_PapelRecurso_Table();
        }
        /**
         * Insere um registro no modelo PapelRecurso
         *
         * @param string $token
         * @param PapelRecurso_Columns $data 
         * @return PapelRecurso_Result
         */
        public function insert($token,$data){  
            $_result = new PapelRecurso_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo PapelRecurso
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param PapelRecurso_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return PapelRecurso_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new PapelRecurso_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo PapelRecurso
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param PapelRecurso_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return PapelRecurso_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new PapelRecurso_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo PapelRecurso
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return PapelRecurso_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new PapelRecurso_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo PapelRecurso
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param PapelRecurso_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return PapelRecurso_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new PapelRecurso_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>