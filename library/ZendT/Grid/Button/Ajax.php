<?php
/**
 * Cria botão para disparar um Ajax
 * 
 * @author rsantos
 * @package ZendT
 * @subpackage Grid
 * @category Button 
 */
class ZendT_Grid_Button_Ajax extends ZendT_Grid_Button implements ZendT_JS_Interface {
    /**
     *
     * @var method string
     */
    private $_url;
    /**
     * Tipo de Requisição
     * 
     * @var method string
     */
    private $_method;
    /**
     *
     * @var string
     */
    private $_param = '';
    /**
     *
     * @var string
     */
    private $_onConfirm;
    /**
     * 
     */
    public function __construct(){
        $this->_method = 'POST';
        parent::__construct();
    }
    /**
     * Retorna a URL de Requisição
     * 
     * @return string
     */
    public function getUrl() {
        return $this->_url;
    }
    /**
     * Configura uma URL de requisição AJAX
     * 
     * @param string $url
     * @return \ZendT_Grid_Button_Ajax 
     */
    public function setUrl($url) {
        $this->_url = $url;
        return $this;
    }
    /**
     * Retorna o tipo de requisição AJAX POST ou GET
     * @return string
     */
    public function getMethod() {
        return $this->_method;
    }
    /**
     * Configura o tipo de requisiçao AJAX POST ou GET
     * @param method $method
     * @return \ZendT_Grid_Button_Ajax 
     */
    public function setMethod($method) {
        $this->_method = $method;
        return $this;
    }
    /**
     * Retorna os parâmetros da requisição AJAX
     * 
     * @return string
     */
    public function getParam() {
        return $this->_param;
    }
    /**
     * Configura os parâmetros de uma requisição AJAX
     * 
     * @param string $param
     * @return \ZendT_Grid_Button_Ajax 
     */
    public function setParam($param) {
        $this->_param = $param;
        return $this;
    }
    /**
     * Retorna a função de confirmação da solicitação AJAX
     * 
     * @return method 
     */
    public function getOnConfirm() {
        if (!$this->_onConfirm){
            return 'function(x){}';
        }else{
            return $this->_onConfirm;
        }
    }
    /**
     * Configura a função de confirmação da solicitação AJAX
     * 
     * @param string $onConfirm
     * @return \ZendT_Grid_Button_Ajax 
     */
    public function setOnConfirm($onConfirm) {
        $this->_onConfirm = $onConfirm;
        return $this;
    }
    /**
     * Retorna a função JavaScript que é acionada após carregamento
     * 
     * @return string 
     */
    public function getOnAfterLoad() {
        if (!$this->_onAfterLoad){
            return 'function(){}';
        }else{
            return $this->_onAfterLoad;
        }
    }
    /**
     * Configura a função JavaScript que é acionada após carregamento
     * 
     * @param string $onAfterLoad
     * @return \ZendT_Grid_Button_Default 
     */
    public function setOnAfterLoad($onAfterLoad) {
        $this->_onAfterLoad = $onAfterLoad;
        return $this;
    }
    /**
     * Cria o comando JavaScript
     * @return method 
     */
    public function createJS(){

        $clickFunction = '
            function (){
                jQuery.gridButtonAjax({
                    idGrid: "' . $this->getIdGrid() . '",
                    url: "' . $this->getUrl() . '",
                    method: "' . $this->getMethod() . '",
                    param: "' . $this->getParam() . '",
                    onConfirm: ' . $this->getOnConfirm() . ',
                    onAfterLoad: ' . $this->getOnAfterLoad() . '
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
