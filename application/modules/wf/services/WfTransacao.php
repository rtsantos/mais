<?php
    /**
     * Colunas do Modelo
     */
    class WfTransacao_Columns {
        
        /**
            * Coluna id_wf_fase,chave primária
            *
            * @var string
            */
        public $id_wf_fase;
            
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
        public $id_usuario_aloc;
            
        /**
            * Coluna Inclusão
            *
            * @var string
            */
        public $dh_inc;
            
        /**
            * Coluna Observação
            *
            * @var string
            */
        public $observacao;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class WfTransacao_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class WfTransacao_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo WfTransacao
         * @var WfTransacao_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class WfTransacao_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo WfTransacao
         * @var WfTransacao_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo WfTransacao
     *
     * @package ZendT
     * @subpackage Service
     */
    class Wf_Service_WfTransacao extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Wf_Model_WfTransacao_Table();
        }
        /**
         * Insere um registro no modelo WfTransacao
         *
         * @param string $token
         * @param WfTransacao_Columns $data 
         * @return WfTransacao_Result
         */
        public function insert($token,$data){  
            $_result = new WfTransacao_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo WfTransacao
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param WfTransacao_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return WfTransacao_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new WfTransacao_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo WfTransacao
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param WfTransacao_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return WfTransacao_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new WfTransacao_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo WfTransacao
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return WfTransacao_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new WfTransacao_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo WfTransacao
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param WfTransacao_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return WfTransacao_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new WfTransacao_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>