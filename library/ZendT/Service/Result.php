<?php
/**
 * Essa classe tem como finalidade padronizar 
 * o resultado a ser mostrado no cliente
 *
 * @package ZendT
 * @subpackage Service
 * @author rsantos
 */
class ZendT_Service_Result {
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
     * Contrutor da classe
     * Configura algumas variáveis padrões 
     */
    public function __construct(){
        $this->success = 1;
        $this->service = '';
        $this->message = new ZendT_Service_Message();
    }
}

?>
