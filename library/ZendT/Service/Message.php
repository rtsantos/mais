<?php
/**
 * Essa classe tem como finalidade padronizar 
 * as mensagens que serão geradas no webservice
 *
 * @package ZendT
 * @subpackage Service
 * @author rsantos
 */
class ZendT_Service_Message {
    /**
     * Código da mensagem, podendo ser o erro
     * 
     * @var string
     */
    public $code;
    /**
     * Descrição da mensagem
     * 
     * @var string
     */
    public $message;
    /**
     * Diz se a mensagem deve ser exibida para o usuário
     * 
     * @example  1 - Exibe 0 - Não exibe 
     * 
     * @var int
     */
    public $show;
    /**
     * Diz qual é o tipo de mensagem que deve ser exibida para
     * o usuário
     * 
     * @example  Alert, Error, Confirm
     * 
     * @var string
     */
    public $notification;
    /**
     * Contrutor da classe
     * Configura algumas variáveis padrões 
     */
    public function __construct(){
        $this->code = 1;
        $this->message = '';
        $this->show = 0;
        $this->notification = 'Alert';
    }
}
?>
