<?php
    /**
     * Colunas do Modelo
     */
    class Arquivo_Columns {
        
        /**
            * Coluna Identificação,chave primária
            *
            * @var string
            */
        public $id;
            
        /**
            * Coluna Tipo
            *
            * @var string
            */
        public $tipo;
            
        /**
            * Coluna Tempo de Vida
            *
            * @var string
            */
        public $tempo_vida;
            
        /**
            * Coluna DH. Inc.
            *
            * @var string
            */
        public $dh_inc;
            
        /**
            * Coluna Hashcode
            *
            * @var string
            */
        public $hashcode;
            
        /**
            * Coluna Nome
            *
            * @var string
            */
        public $nome;
            
        /**
            * Coluna Arq. Clob
            *
            * @var string
            */
        public $arq_clob;
            
        /**
            * Coluna Chave Acesso
            *
            * @var string
            */
        public $chave_acesso;
            
        /**
            * Coluna Arq Blob
            *
            * @var string
            */
        public $arq_blob;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class Arquivo_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class Arquivo_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo Arquivo
         * @var Arquivo_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class Arquivo_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo Arquivo
         * @var Arquivo_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo Arquivo
     *
     * @package ZendT
     * @subpackage Service
     */
    class Tools_Service_Arquivo extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Tools_Model_Arquivo_Table();
        }
        /**
         * Insere um registro no modelo Arquivo
         *
         * @param string $token
         * @param Arquivo_Columns $data 
         * @return Arquivo_Result
         */
        public function insert($token,$data){  
            $_result = new Arquivo_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo Arquivo
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param Arquivo_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Arquivo_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new Arquivo_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo Arquivo
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param Arquivo_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Arquivo_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new Arquivo_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo Arquivo
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return Arquivo_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new Arquivo_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo Arquivo
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param Arquivo_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Arquivo_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new Arquivo_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>