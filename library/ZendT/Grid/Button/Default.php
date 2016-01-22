<?php
/**
 * Cria botão para disparar um evento de Janela
 * 
 * @author rsantos
 * @package ZendT
 * @subpackage Grid
 * @category Button 
 */
class ZendT_Grid_Button_Default extends ZendT_Grid_Button implements ZendT_JS_Interface {
    /**
     *
     * @var type string
     */
    private $_url;
    /**
     *
     * @var type numeric
     */
    private $_windowHeight = 520;
    /**
     *
     * @var type numeric
     */
    private $_windowWidth = 720;
    /**
     * 
     * @var type function
     */
    private $_onAfterLoad;
    /**
     *
     * @var type string
     */
    private $_modal = 'true';
    /**
     *
     * @var type string
     */
    private $_type = 'WINDOW';
    /**
     *
     * @var string
     */
    private $_param = '';
    /**
     * 
     */
    public function __construct(){
        parent::__construct();
    }
    /**
     * Retorna a URL de requisição
     * 
     * @return string
     */
    public function getUrl() {
        return $this->_url;
    }
    /**
     * Configura uma URL de requisição Window
     * 
     * @param type $url
     * @return \ZendT_Grid_Button_Default 
     */
    public function setUrl($url) {
        $this->_url = $url;
        return $this;
    }
    /**
     * Retorna a Altura da Janela
     * @return int
     */
    public function getWindowHeight() {
        return $this->_windowHeight;
    }
    /**
     * Configura a altura da Janela
     * 
     * @param int $windowHeight
     * @return \ZendT_Grid_Button_Default 
     */
    public function setWindowHeight($windowHeight) {
        $this->_windowHeight = $windowHeight;
        return $this;
    }
    /**
     * Retorna a Largura da Janela
     * @return int
     */
    public function getWindowWidth() {
        return $this->_windowWidth;
    }
    /**
     * Configura a largura da Janela
     * 
     * @param int $windowHeight
     * @return \ZendT_Grid_Button_Default 
     */
    public function setWindowWidth($windowWidth) {
        $this->_windowWidth = $windowWidth;
        return $this;
    }
    /**
     * Retorna a função JavaScript que é acionada após carregamento
     * 
     * @return string 
     */
    public function getOnAfterLoad() {
        return $this->_onAfterLoad;
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
     * Retorna se a janela será aberta em Modal
     * 
     * @return bool
     */
    public function getModal() {
        return $this->_modal;
    }
    /**
     * Configura se a janela será aberta em modal
     * 
     * @param bool $modal
     * @return \ZendT_Grid_Button_Default 
     */
    public function setModal($modal) {
        $this->_modal = $modal;
        return $this;
    }
    /**
     * Retorna o tipo de requisição POST ou GET
     * 
     * @return string
     */
    public function getType() {
        return $this->_type;
    }
    /**
     * Configura o tipo de requisição POST ou GET
     * 
     * @param string $type
     * @return \ZendT_Grid_Button_Default 
     */
    public function setType($type) {
        $this->_type = $type;
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
     * Função para criar o JavaScript do Botão
     * 
     * @return string 
     */
    public function createJS(){
        $clickFunction = '
            function(){
                jQuery.gridButtonDefault({
                    idGrid: "' . $this->getIdGrid() . '",
                    url: "' . $this->getUrl() . '",
                    param: "' . $this->getParam() . '"
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
