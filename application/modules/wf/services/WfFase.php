<?php
    /**
     * Colunas do Modelo
     */
    class WfFase_Columns {
        
        /**
            * Coluna Identificação,chave primária
            *
            * @var string
            */
        public $id;
            
        /**
            * Coluna Processo
            *
            * @var string
            */
        public $id_wf_processo;
            
        /**
            * Coluna Valor
            *
            * @var string
            */
        public $valor;
            
        /**
            * Coluna Descrição
            *
            * @var string
            */
        public $descricao;
            
        /**
            * Coluna Proxima Fase Processo
            *
            * @var string
            */
        public $proc_prox_fase;
            
        /**
            * Coluna Proximo Usuário Processo
            *
            * @var string
            */
        public $proc_prox_usuario;
            
        /**
            * Coluna Notificação Processo
            *
            * @var string
            */
        public $proc_notif;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class WfFase_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class WfFase_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo WfFase
         * @var WfFase_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class WfFase_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo WfFase
         * @var WfFase_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo WfFase
     *
     * @package ZendT
     * @subpackage Service
     */
    class Wf_Service_WfFase extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Wf_Model_WfFase_Table();
        }
        /**
         * Insere um registro no modelo WfFase
         *
         * @param string $token
         * @param WfFase_Columns $data 
         * @return WfFase_Result
         */
        public function insert($token,$data){  
            $_result = new WfFase_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo WfFase
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param WfFase_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return WfFase_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new WfFase_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo WfFase
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param WfFase_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return WfFase_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new WfFase_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo WfFase
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return WfFase_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new WfFase_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo WfFase
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param WfFase_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return WfFase_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new WfFase_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>