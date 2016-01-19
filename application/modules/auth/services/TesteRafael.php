<?php
    /**
     * Colunas do Modelo
     */
    class TesteRafael_Columns {
        
        /**
            * Coluna id
            *
            * @var string
            */
        public $id;
            
        /**
            * Coluna nome
            *
            * @var string
            */
        public $nome;
            
        /**
            * Coluna dt_emissao
            *
            * @var string
            */
        public $dt_emissao;
            
        /**
            * Coluna dh_inc
            *
            * @var string
            */
        public $dh_inc;
            
        /**
            * Coluna valor
            *
            * @var string
            */
        public $valor;
            
        /**
            * Coluna aliq
            *
            * @var string
            */
        public $aliq;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class TesteRafael_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class TesteRafael_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo TesteRafael
         * @var TesteRafael_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class TesteRafael_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo TesteRafael
         * @var TesteRafael_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo TesteRafael
     *
     * @package ZendT
     * @subpackage Service
     */
    class Auth_Service_TesteRafael extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Auth_Model_TesteRafael();
        }
        /**
         * Insere um registro no modelo TesteRafael
         *
         * @param string $token
         * @param TesteRafael_Columns $data 
         * @return TesteRafael_Result
         */
        public function insert($token,$data){  
            $_result = new TesteRafael_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo TesteRafael
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param TesteRafael_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return TesteRafael_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new TesteRafael_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo TesteRafael
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param TesteRafael_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return TesteRafael_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new TesteRafael_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo TesteRafael
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return TesteRafael_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new TesteRafael_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo TesteRafael
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param TesteRafael_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return TesteRafael_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new TesteRafael_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>