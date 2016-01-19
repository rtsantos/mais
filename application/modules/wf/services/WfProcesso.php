<?php
    /**
     * Colunas do Modelo
     */
    class WfProcesso_Columns {
        
        /**
            * Coluna Identificação,chave primária
            *
            * @var string
            */
        public $id;
            
        /**
            * Coluna Descrição
            *
            * @var string
            */
        public $descricao;
            
        /**
            * Coluna Aplicação
            *
            * @var string
            */
        public $id_aplicacao;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class WfProcesso_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class WfProcesso_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo WfProcesso
         * @var WfProcesso_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class WfProcesso_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo WfProcesso
         * @var WfProcesso_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo WfProcesso
     *
     * @package ZendT
     * @subpackage Service
     */
    class Wf_Service_WfProcesso extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Wf_Model_WfProcesso_Table();
        }
        /**
         * Insere um registro no modelo WfProcesso
         *
         * @param string $token
         * @param WfProcesso_Columns $data 
         * @return WfProcesso_Result
         */
        public function insert($token,$data){  
            $_result = new WfProcesso_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo WfProcesso
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param WfProcesso_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return WfProcesso_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new WfProcesso_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo WfProcesso
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param WfProcesso_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return WfProcesso_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new WfProcesso_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo WfProcesso
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return WfProcesso_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new WfProcesso_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo WfProcesso
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param WfProcesso_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return WfProcesso_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new WfProcesso_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>