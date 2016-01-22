<?php
/**
 * Cria botão para disparar um Ajax com confirmação do usuário
 * 
 * @author rsantos
 * @package ZendT
 * @subpackage Grid
 * @category Button 
 */
class ZendT_Grid_Button_Ajax_Confirm extends ZendT_Grid_Button_Ajax implements ZendT_JS_Interface {
    /**
     *
     * @var string
     */
    private $_message = '';
    /**
     * Retorna a mensagem de confirmação
     *
     * @return string 
     */
    public function getMessage() {
        return $this->_message;
    }
    /**
     * Configura a mensagem de confirmação
     * 
     * @param string $message
     * @return \ZendT_Grid_Button_Ajax_Confirm 
     */
    public function setMessage($message) {
        $this->_message = $message;
        return $this;
    }
    /**
     * Monta o comando JS
     * @return type 
     */
    public function createJS(){
        $clickFunction = '
            function (){
                jQuery.gridButtonAjaxConfirm({
                    idGrid: "' . $this->getIdGrid() . '",
                    url: "' . $this->getUrl() . '",
                    method: "' . $this->getMethod() . '",
                    param: "' . $this->getParam() . '",
                    onConfirm: ' . $this->getOnConfirm() . ',
                    onAfterLoad: ' . $this->getOnAfterLoad() . ',
                    message:\'' . str_replace(array("'",chr(10),chr(13)),array("\'",'',''),$this->getMessage()) . '\'
                });
            }
        ';
        return $clickFunction;
    }
    /**
     * Renderiza o botão
     * 
     * @return method 
     */
    public function render(){
        return parent::render();
    }
}
?>
