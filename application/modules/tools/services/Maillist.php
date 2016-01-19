<?php
    /**
     * Colunas do Modelo
     */
    class Maillist_Columns {
        
        /**
            * Coluna Identificação,chave primária
            *
            * @var string
            */
        public $id;
            
        /**
            * Coluna De
            *
            * @var string
            */
        public $mail_from;
            
        /**
            * Coluna Para
            *
            * @var string
            */
        public $mail_to;
            
        /**
            * Coluna Assunto
            *
            * @var string
            */
        public $mail_subject;
            
        /**
            * Coluna Cópia
            *
            * @var string
            */
        public $mail_cc;
            
        /**
            * Coluna Cópia Oculta
            *
            * @var string
            */
        public $mail_bcc;
            
        /**
            * Coluna Alerta
            *
            * @var string
            */
        public $mail_alert;
            
        /**
            * Coluna Envia Alerta
            *
            * @var string
            */
        public $send_alert;
            
        /**
            * Coluna Status
            *
            * @var string
            */
        public $status;
            
        /**
            * Coluna Html
            *
            * @var string
            */
        public $html;
            
        /**
            * Coluna Tentativas(ntry)
            *
            * @var string
            */
        public $ntry;
            
        /**
            * Coluna Tempo de Vida
            *
            * @var string
            */
        public $life_time;
            
        /**
            * Coluna Envio
            *
            * @var string
            */
        public $dh_send;
            
        /**
            * Coluna Requisição
            *
            * @var string
            */
        public $dh_request;
            
        /**
            * Coluna Anexo Descartado
            *
            * @var string
            */
        public $discard_attachment;
            
        /**
            * Coluna Anexo
            *
            * @var string
            */
        public $attachment;
            
        /**
            * Coluna Corpo
            *
            * @var string
            */
        public $mail_body;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class Maillist_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class Maillist_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo Maillist
         * @var Maillist_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class Maillist_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo Maillist
         * @var Maillist_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo Maillist
     *
     * @package ZendT
     * @subpackage Service
     */
    class Tools_Service_Maillist extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Tools_Model_Maillist_Table();
        }
        /**
         * Insere um registro no modelo Maillist
         *
         * @param string $token
         * @param Maillist_Columns $data 
         * @return Maillist_Result
         */
        public function insert($token,$data){  
            $_result = new Maillist_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo Maillist
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param Maillist_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Maillist_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new Maillist_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo Maillist
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param Maillist_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Maillist_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new Maillist_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo Maillist
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return Maillist_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new Maillist_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo Maillist
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param Maillist_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Maillist_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new Maillist_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>