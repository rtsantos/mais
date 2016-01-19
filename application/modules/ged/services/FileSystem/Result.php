<?php

    /**
     * Essa classe tem como finalidade padronizar 
     * o resultado a ser mostrado no cliente
     *
     * @package ZendT
     * @subpackage Service
     * @author preis
     */
    class Ged_Service_FileSystem_Result {

        /**
         * Retorna a identificação de um registro
         * quando afetado
         * 
         * @var string 
         */
        public $id;

        /**
         * Retorna se o Serviço foi executado com sucesso
         * 
         * @example 0 -> Erro e 1 -> OK 
         * 
         * @var int 
         */
        public $success;

        /**
         * Nome do serviço que foi executado
         * 
         * @var string
         */
        public $service;

        /**
         * Retorna a estrtura padronizada da mensagem
         * 
         * @var ZendT_Service_Message
         */
        public $message;

        /**
         * 
         * Conteudo do Arquivo. ComplexType Criado para carregar o ZendT_Type_FileSystem
         * 
         * @var Ged_Service_FileSystem_Params
         */
        public $conteudo;

        /**
         * Contrutor da classe
         * Configura algumas variáveis padrões 
         */
        public function __construct() {
            $this->success = 1;
            $this->service = '';
            $this->message = new ZendT_Service_Message();
            //$this->conteudo = new Ged_Service_FileSystem_Params();
        }

    }

?>
